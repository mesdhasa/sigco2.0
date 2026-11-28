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

/*
 * Validation des parametres des rapports (AUDIT-001 : dates validees, listes blanches).
 * Une valeur valide est renvoyee telle quelle ; une valeur invalide est remplacee par une
 * valeur qui ne correspond a aucune ligne (resultat vide, comme avant en pratique).
 */
if ( ! function_exists('sigco_date'))
{
	/** Date AAAA-MM-JJ (ou AAAA-MM-JJ HH:MM:SS) valide, sinon '0000-00-00'. */
	function sigco_date($valeur)
	{
		$valeur = trim((string) $valeur);
		if (preg_match('/^(\d{4})-(\d{2})-(\d{2})( \d{2}:\d{2}(:\d{2})?)?$/', $valeur, $m)
			&& checkdate((int) $m[2], (int) $m[3], (int) $m[1]))
		{
			return $valeur;
		}
		return '0000-00-00';
	}
}

if ( ! function_exists('sigco_type_awbl'))
{
	/** Type de document : import, export ou MESDHASA2 (casse libre, comme en base). */
	function sigco_type_awbl($valeur)
	{
		$valeur = (string) $valeur;
		return in_array(strtolower($valeur), array('import', 'export', 'mesdhasa2'), TRUE) ? $valeur : '';
	}
}

if ( ! function_exists('sigco_devise'))
{
	/** Devise : USD ou HTG. */
	function sigco_devise($valeur)
	{
		$valeur = strtoupper((string) $valeur);
		return in_array($valeur, array('USD', 'HTG'), TRUE) ? $valeur : '';
	}
}

if ( ! function_exists('sigco_id'))
{
	/** Identifiant numerique (ex. idcompagnie), sinon 0. */
	function sigco_id($valeur)
	{
		return ctype_digit((string) $valeur) ? (int) $valeur : 0;
	}
}

/*
 * Cache des calculs lourds (tableau de bord, factures impayees).
 * Un resultat reste valable tant qu'aucune ecriture n'a eu lieu depuis son calcul
 * (toute requete POST appelle sigco_cache_invalider(), voir MY_Controller) et qu'il a
 * moins de $duree secondes. Un resultat perime peut quand meme etre lu (affichage immediat).
 */
if ( ! function_exists('sigco_cache'))
{
	function sigco_cache()
	{
		$CI =& get_instance();
		if ( ! isset($CI->cache))
		{
			$CI->load->driver('cache', array('adapter' => 'file'));
		}
		return $CI->cache;
	}

	/**
	 * @return array|NULL  array('donnees' => ..., 'calcule_le' => timestamp, 'a_jour' => bool)
	 */
	function sigco_cache_lire($cle, $duree = 300)
	{
		$item = sigco_cache()->get('sigco_'.$cle);
		if ( ! is_array($item) OR ! isset($item['calcule_le']))
		{
			return NULL;
		}
		$invalidation = (int) sigco_cache()->get('sigco_invalidation');
		$item['a_jour'] = ($item['calcule_le'] > $invalidation) && (time() - $item['calcule_le'] < $duree);
		return $item;
	}

	function sigco_cache_ecrire($cle, $donnees)
	{
		sigco_cache()->save('sigco_'.$cle, array('donnees' => $donnees, 'calcule_le' => time()), 86400);
	}

	/** Marque tous les calculs en cache comme perimes (appele a chaque ecriture). */
	function sigco_cache_invalider()
	{
		sigco_cache()->save('sigco_invalidation', time(), 86400 * 30);
	}
}

if ( ! function_exists('sigco_asset'))
{
	/**
	 * URL d'un fichier statique avec sa date de modification (?v=...) : le navigateur peut le
	 * garder en cache longtemps et recharge automatiquement la nouvelle version apres une mise a jour.
	 */
	function sigco_asset($chemin)
	{
		$fichier = FCPATH.str_replace('/', DIRECTORY_SEPARATOR, ltrim($chemin, '/'));
		return base_url($chemin).(is_file($fichier) ? '?v='.filemtime($fichier) : '');
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
	/** Choix proposes a l'utilisateur ; le premier est la valeur par defaut, le dernier le maximum. */
	function sigco_choix_par_page()
	{
		return array(100, 200, 500, 1000);
	}

	/**
	 * Lignes par page demandees : ?par_page=N, sinon le choix memorise (cookie sigco_par_page,
	 * partage avec la pagination des tableaux dans le navigateur), sinon 100.
	 */
	function sigco_par_page()
	{
		$CI =& get_instance();
		$choix = sigco_choix_par_page();
		$demande = (int) $CI->input->get('par_page');
		if ( ! in_array($demande, $choix, TRUE))
		{
			$demande = (int) $CI->input->cookie('sigco_par_page');
		}
		return in_array($demande, $choix, TRUE) ? $demande : $choix[0];
	}

	/**
	 * Pagination serveur par ?page=N (les autres parametres de l'URL sont conserves).
	 *
	 * @param  int      $total     nombre total de lignes
	 * @param  int|NULL $par_page  lignes par page (NULL = choix de l'utilisateur, 100 par defaut)
	 * @return array  offset, par_page, page, pages, total, liens (HTML des pages),
	 *                selecteur (HTML du choix 100/200/500/1000)
	 */
	function sigco_pagination($total, $par_page = NULL)
	{
		$CI =& get_instance();
		$CI->load->library('pagination');

		$total = max(0, (int) $total);
		$par_page = ($par_page === NULL) ? sigco_par_page() : max(1, (int) $par_page);
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

		// Selecteur "Afficher N lignes" : conserve les autres parametres, revient a la page 1
		$params = $CI->input->get();
		$params = is_array($params) ? $params : array();
		unset($params['page'], $params['par_page']);
		$options = '';
		foreach (sigco_choix_par_page() as $n)
		{
			$url = current_url().'?'.http_build_query(array_merge($params, array('par_page' => $n)));
			$options .= '<option value="'.html_escape($url).'"'.($n === $par_page ? ' selected' : '').'>'.$n
				.($n === max(sigco_choix_par_page()) ? ' (maximum)' : '').'</option>';
		}
		$selecteur = '<span class="sigco-par-page">Afficher <select class="input-sm" data-sigco-par-page="1"'
			.' onchange="document.cookie=\'sigco_par_page=\'+this.options[this.selectedIndex].text.replace(/\\D/g,\'\')+\';path=/;max-age=31536000;samesite=lax\'; window.location=this.value">'
			.$options.'</select> lignes par page</span>';

		return array(
			'offset'    => ($page - 1) * $par_page,
			'par_page'  => $par_page,
			'page'      => $page,
			'pages'     => $pages,
			'total'     => $total,
			'liens'     => $CI->pagination->create_links(),
			'selecteur' => $selecteur,
		);
	}
}

if ( ! function_exists('sigco_traceur'))
{
	/**
	 * Tracabilite (Bloc 03) : colonnes cree_* / modif_* a enregistrer sur un document
	 * (AWB, manifeste, warehouse) au moment de sa creation ou de sa modification.
	 * La station = entreprise + ville du compte connecte (decision client).
	 * Les valeurs sont figees a l'instant de l'action : un document garde le nom et la
	 * station d'origine meme si le compte est renomme plus tard.
	 *
	 * @param bool $modif  FALSE = creation (cree_*), TRUE = modification (modif_*).
	 * @return array  colonnes a fusionner dans le tableau d'insertion / de mise a jour.
	 */
	function sigco_traceur($modif = FALSE)
	{
		$compte = isset($_SESSION['account']) && is_array($_SESSION['account']) ? $_SESSION['account'] : array();
		$id     = isset($compte['id']) ? (string) $compte['id'] : '';
		$nom    = trim((isset($compte['nom']) ? $compte['nom'] : '').' '.(isset($compte['prenom']) ? $compte['prenom'] : ''));
		if ($nom === '')
		{
			$nom = isset($compte['code']) ? (string) $compte['code'] : '';
		}
		$entreprise = isset($compte['institution']) ? (string) $compte['institution'] : '';

		// Ville du compte (station) : une seule lecture par requete HTTP.
		static $villes = array();
		if ($id !== '' && ! array_key_exists($id, $villes))
		{
			$CI =& get_instance();
			$ligne = $CI->db->select('ville')->where('identreprise', $id)->limit(1)->get('entreprise')->row();
			$villes[$id] = $ligne ? (string) $ligne->ville : '';
		}
		$ville = $id !== '' && isset($villes[$id]) ? $villes[$id] : '';

		$maintenant = new DateTime('now', new DateTimeZone('America/Port-au-Prince'));
		$horodatage = $maintenant->format('Y-m-d H:i:s');

		if ($modif)
		{
			return array(
				'modif_par_id'  => $id,
				'modif_par_nom' => $nom,
				'modif_le'      => $horodatage,
			);
		}

		return array(
			'cree_par_id'     => $id,
			'cree_par_nom'    => $nom,
			'cree_entreprise' => $entreprise,
			'cree_ville'      => $ville,
			'cree_le'         => $horodatage,
		);
	}
}
