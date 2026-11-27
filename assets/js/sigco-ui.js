/*
 * SIGCO - confort d'utilisation (Bloc 02).
 * 1. Pagination des tableaux de donnees dans le navigateur : 100 lignes par defaut,
 *    choix 100 / 200 / 500 / 1000 (maximum) ; au-dela, les lignes sont reparties en pages.
 *    Les lignes de total restent toujours visibles. Le choix est memorise (cookie sigco_par_page,
 *    aussi lu par le serveur pour les listes paginees cote serveur).
 * 2. Retour immediat a chaque action : indicateur "Traitement en cours" des le clic.
 * 3. Protection contre le double envoi d'un formulaire (double clic sur "Enregistrer", "Payer"...).
 */
(function (window, document, $) {
	'use strict';
	if (!$) { return; }

	var CHOIX = [100, 200, 500, 1000];
	var SEUIL = CHOIX[0];

	var style = document.createElement('style');
	style.textContent =
		'#sigco-attente{position:fixed;inset:0;z-index:99999;display:none;align-items:center;justify-content:center;' +
		'background:rgba(255,255,255,.55);cursor:wait}' +
		'#sigco-attente>div{background:#fff;border:1px solid #c5d0dc;padding:16px 26px;text-align:center;' +
		'color:#2a6496;box-shadow:0 2px 8px rgba(0,0,0,.15)}' +
		'.sigco-pagination-barre{display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin:6px 0}' +
		'.sigco-pagination-barre .pagination{margin:0}' +
		'.sigco-par-page select{width:auto;display:inline-block;height:28px;padding:2px 4px}';
	document.head.appendChild(style);

	/* ------------------------------------------------------------ choix memorise */
	function parPageMemorise() {
		var m = document.cookie.match(/(?:^|;\s*)sigco_par_page=(\d+)/);
		var n = m ? parseInt(m[1], 10) : CHOIX[0];
		return CHOIX.indexOf(n) >= 0 ? n : CHOIX[0];
	}
	function memoriser(n) {
		document.cookie = 'sigco_par_page=' + n + ';path=/;max-age=31536000;samesite=lax';
	}

	/* ------------------------------------------------------------ pagination des tableaux */
	function estLigneTotal(tr) {
		if (tr.querySelector('th')) { return true; }
		if (/\b(total|totaux)\b/i.test(tr.className)) { return true; }
		var premiere = tr.cells.length ? (tr.cells[0].textContent || '') : '';
		var colspan = tr.cells.length && tr.cells[0].colSpan > 1;
		return /^\s*(sous[- ]?)?total/i.test(premiere) || (colspan && /total/i.test(tr.textContent || ''));
	}

	// Les lignes au-dela de la 100e sont masquees par CSS pendant le chargement (sigco-pre-pagination,
	// dans l'en-tete) : on fixe donc toujours l'affichage explicitement ('table-row' ou 'none').
	// Une ligne deja masquee par l'application elle-meme (style="display:none") le reste.
	function masqueeParApplication(tr) { return tr.style.display === 'none'; }

	function paginer(table) {
		if (table.getAttribute('data-sigco-pagination') || !table.tBodies.length) { return; }
		var lignes = [], autres = [];
		for (var b = 0; b < table.tBodies.length; b++) {
			var rows = table.tBodies[b].rows;
			for (var i = 0; i < rows.length; i++) {
				if (masqueeParApplication(rows[i])) { continue; }
				if (estLigneTotal(rows[i])) { autres.push(rows[i]); } else { lignes.push(rows[i]); }
			}
		}
		if (lignes.length <= SEUIL) {
			// pas de pagination : tout reafficher (y compris une ligne de total en 101e position)
			lignes.concat(autres).forEach(function (tr) { tr.style.display = 'table-row'; });
			return;
		}
		autres.forEach(function (tr) { tr.style.display = 'table-row'; });
		table.setAttribute('data-sigco-pagination', 'navigateur');

		var etat = { parPage: parPageMemorise(), page: 1 };
		var hautBarre = document.createElement('div');
		var basBarre = document.createElement('div');
		hautBarre.className = basBarre.className = 'sigco-pagination-barre';
		var conteneur = table.closest('.table-responsive') || table;
		conteneur.parentNode.insertBefore(hautBarre, conteneur);
		conteneur.parentNode.insertBefore(basBarre, conteneur.nextSibling);

		function lien(libelle, page, actif, inactif) {
			var li = document.createElement('li');
			if (actif) { li.className = 'active'; }
			if (inactif) { li.className = 'disabled'; }
			var a = document.createElement('a');
			a.href = 'javascript:void(0)';
			a.innerHTML = libelle;
			if (!inactif && !actif) {
				a.addEventListener('click', function () { afficher(page); });
			}
			li.appendChild(a);
			return li;
		}

		function barre(el, pages) {
			el.innerHTML = '';
			var choix = document.createElement('span');
			choix.className = 'sigco-par-page';
			var sel = document.createElement('select');
			sel.className = 'input-sm';
			CHOIX.forEach(function (n) {
				var o = document.createElement('option');
				o.value = n;
				o.textContent = n + (n === CHOIX[CHOIX.length - 1] ? ' (maximum)' : '');
				if (n === etat.parPage) { o.selected = true; }
				sel.appendChild(o);
			});
			sel.addEventListener('change', function () {
				etat.parPage = parseInt(this.value, 10);
				memoriser(etat.parPage);
				afficher(1);
			});
			choix.appendChild(document.createTextNode('Afficher '));
			choix.appendChild(sel);
			choix.appendChild(document.createTextNode(' lignes par page – ' + lignes.length + ' lignes, page ' + etat.page + ' / ' + pages + ' '));
			el.appendChild(choix);

			if (pages > 1) {
				var ul = document.createElement('ul');
				ul.className = 'pagination pagination-sm';
				ul.appendChild(lien('&laquo;', 1, false, etat.page === 1));
				ul.appendChild(lien('&lsaquo;', etat.page - 1, false, etat.page === 1));
				var debut = Math.max(1, etat.page - 3), fin = Math.min(pages, etat.page + 3);
				for (var p = debut; p <= fin; p++) { ul.appendChild(lien(String(p), p, p === etat.page, false)); }
				ul.appendChild(lien('&rsaquo;', etat.page + 1, false, etat.page === pages));
				ul.appendChild(lien('&raquo;', pages, false, etat.page === pages));
				el.appendChild(ul);
			}
		}

		function afficher(page) {
			var pages = Math.max(1, Math.ceil(lignes.length / etat.parPage));
			etat.page = Math.min(Math.max(1, page), pages);
			var debut = (etat.page - 1) * etat.parPage, fin = debut + etat.parPage;
			for (var i = 0; i < lignes.length; i++) {
				lignes[i].style.display = (i >= debut && i < fin) ? 'table-row' : 'none';
			}
			barre(hautBarre, pages);
			barre(basBarre, pages);
		}

		afficher(1);
	}

	function paginerTout() {
		var tables = document.querySelectorAll('.page-content table, .main-content table');
		for (var i = 0; i < tables.length; i++) { paginer(tables[i]); }
	}

	/* ------------------------------------------------------------ indicateur d'action */
	var voile = null, minuterie = null, securite = null;
	function montrerAttente() {
		if (minuterie) { return; }
		// petit delai : rien ne s'affiche si la reponse est quasi immediate
		minuterie = setTimeout(function () {
			if (!voile) {
				voile = document.createElement('div');
				voile.id = 'sigco-attente';
				voile.innerHTML = '<div><i class="fa fa-spinner fa-spin fa-2x"></i><br>Traitement en cours&hellip;</div>';
				document.body.appendChild(voile);
			}
			voile.style.display = 'flex';
		}, 150);
		// au cas ou l'action ne change pas de page (telechargement d'un fichier)
		securite = setTimeout(cacherAttente, 15000);
	}
	function cacherAttente() {
		clearTimeout(minuterie); clearTimeout(securite);
		minuterie = securite = null;
		if (voile) { voile.style.display = 'none'; }
		var f = document.querySelectorAll('form[data-sigco-envoye]');
		for (var i = 0; i < f.length; i++) { f[i].removeAttribute('data-sigco-envoye'); }
	}
	window.sigcoAttente = montrerAttente;

	function ouvreAilleurs(el) {
		var cible = (el.getAttribute('target') || '').toLowerCase();
		return cible === '_blank' || el.hasAttribute('download');
	}

	// Formulaires : un seul envoi, indicateur immediat
	document.addEventListener('submit', function (e) {
		var form = e.target;
		if (e.defaultPrevented || ouvreAilleurs(form)) { return; }
		if (form.getAttribute('data-sigco-envoye')) {
			e.preventDefault(); // double clic : le premier envoi est deja en cours
			return;
		}
		form.setAttribute('data-sigco-envoye', '1');
		montrerAttente();
	}, false);

	// Liens de navigation internes
	document.addEventListener('click', function (e) {
		if (e.defaultPrevented || e.button !== 0 || e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) { return; }
		var a = e.target.closest ? e.target.closest('a[href]') : null;
		if (!a || ouvreAilleurs(a)) { return; }
		var href = a.getAttribute('href') || '';
		if (href === '' || href.charAt(0) === '#' || /^(javascript|mailto|tel):/i.test(href)) { return; }
		if (a.host && a.host !== window.location.host) { return; }
		if (/(xls|excel|pdf)/i.test(href)) { return; } // fichiers : la page ne change pas
		montrerAttente();
	}, false);

	// Retour arriere (page restauree depuis le cache du navigateur)
	window.addEventListener('pageshow', cacherAttente);

	// Actions confirmees (suppressions...) envoyees en POST par sigcoPost
	if (window.sigcoPost) {
		var post = window.sigcoPost;
		window.sigcoPost = function (url) { montrerAttente(); post(url); };
	}

	$(paginerTout);
	window.sigcoPaginerTableaux = paginerTout;
})(window, document, window.jQuery);
