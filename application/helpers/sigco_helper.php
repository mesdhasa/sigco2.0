<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Outils communs SIGCO (Bloc 02).
 */

if ( ! function_exists('e'))
{
	/** Encodage HTML d'une valeur affichee dans une vue (AUDIT-008). */
	function e($valeur)
	{
		return html_escape((string) $valeur);
	}
}

if ( ! function_exists('sigco_url_retour'))
{
	/**
	 * Lien "Back" : page precedente seulement si elle appartient a SIGCO (sinon page par defaut).
	 * Remplace l'affichage brut de $_SERVER['HTTP_REFERER'] (absent = avertissement PHP 8 ;
	 * valeur externe = redirection ou XSS).
	 */
	function sigco_url_retour($defaut = 'home')
	{
		$ref = isset($_SERVER['HTTP_REFERER']) ? (string) $_SERVER['HTTP_REFERER'] : '';
		return ($ref !== '' && strpos($ref, base_url()) === 0) ? $ref : base_url($defaut);
	}
}

if ( ! function_exists('sigco_array_sum'))
{
	/**
	 * array_sum() tolerant comme en PHP 7 : sous PHP 8, array_sum(null) est une erreur fatale.
	 * Renvoie NULL (affiche vide, vaut 0 dans un calcul) si la valeur n'est pas un tableau.
	 */
	function sigco_array_sum($valeurs)
	{
		return is_array($valeurs) ? array_sum($valeurs) : NULL;
	}
}

if ( ! function_exists('sigco_count'))
{
	/** count() tolerant comme en PHP 7 : count(null) = 0 au lieu d'une erreur fatale. */
	function sigco_count($valeurs)
	{
		return (is_array($valeurs) OR $valeurs instanceof Countable) ? count($valeurs) : (($valeurs === NULL) ? 0 : 1);
	}
}

if ( ! function_exists('sigco_colonnes_any_value'))
{
	/**
	 * Equivalent conforme a ONLY_FULL_GROUP_BY (mode par defaut de MySQL 5.7+ / 8 / 9) d'un
	 * "SELECT *" dans une requete groupee : chaque colonne devient ANY_VALUE(`table`.`colonne`) AS `colonne`,
	 * ce qui est exactement ce que MySQL renvoyait quand ONLY_FULL_GROUP_BY etait desactive.
	 *
	 * Les tables sont donnees dans l'ordre du FROM / des JOIN. Comme pour "SELECT *" lu par PHP,
	 * quand deux tables ont une colonne de meme nom, c'est la DERNIERE qui l'emporte.
	 *
	 * @param array $tables  tables dans l'ordre de la requete
	 * @param array $exclure noms de colonnes re-selectionnees explicitement ensuite
	 */
	function sigco_colonnes_any_value(array $tables, array $exclure = array())
	{
		static $cache = array();
		$CI =& get_instance();
		$colonnes = array();
		foreach ($tables as $table)
		{
			if ( ! isset($cache[$table]))
			{
				$cache[$table] = $CI->db->list_fields($table);
			}
			foreach ($cache[$table] as $colonne)
			{
				unset($colonnes[$colonne]);
				$colonnes[$colonne] = 'ANY_VALUE(`'.$table.'`.`'.$colonne.'`) AS `'.$colonne.'`';
			}
		}
		foreach ($exclure as $colonne)
		{
			unset($colonnes[$colonne]);
		}
		return implode(', ', $colonnes);
	}
}

if ( ! function_exists('sigco_pagination'))
{
	/**
	 * Pagination serveur par ?page=N (les autres parametres de l'URL sont conserves).
	 *
	 * @param  int $total     nombre total de lignes
	 * @param  int $par_page  lignes par page
	 * @return array  array('offset' => int, 'par_page' => int, 'page' => int, 'pages' => int, 'liens' => string HTML)
	 */
	function sigco_pagination($total, $par_page = 50)
	{
		$CI =& get_instance();
		$CI->load->library('pagination');

		$total = max(0, (int) $total);
		$par_page = max(1, (int) $par_page);
		$pages = max(1, (int) ceil($total / $par_page));
		$page = (int) $CI->input->get('page');
		$page = min(max(1, $page), $pages);

		$config = array(
			'base_url'             => current_url(),
			'total_rows'           => $total,
			'per_page'             => $par_page,
			'page_query_string'    => TRUE,
			'query_string_segment' => 'page',
			'use_page_numbers'     => TRUE,
			'reuse_query_string'   => TRUE,
			'num_links'            => 4,
			'full_tag_open'        => '<ul class="pagination pagination-sm">',
			'full_tag_close'       => '</ul>',
			'first_link'           => '&laquo; Premi&egrave;re',
			'last_link'            => 'Derni&egrave;re &raquo;',
			'prev_link'            => '&lsaquo;',
			'next_link'            => '&rsaquo;',
			'first_tag_open'       => '<li>', 'first_tag_close' => '</li>',
			'last_tag_open'        => '<li>', 'last_tag_close'  => '</li>',
			'prev_tag_open'        => '<li>', 'prev_tag_close'  => '</li>',
			'next_tag_open'        => '<li>', 'next_tag_close'  => '</li>',
			'num_tag_open'         => '<li>', 'num_tag_close'   => '</li>',
			'cur_tag_open'         => '<li class="active"><a href="#">',
			'cur_tag_close'        => '</a></li>',
		);
		$CI->pagination->initialize($config);

		return array(
			'offset'   => ($page - 1) * $par_page,
			'par_page' => $par_page,
			'page'     => $page,
			'pages'    => $pages,
			'total'    => $total,
			'liens'    => $CI->pagination->create_links(),
		);
	}
}
