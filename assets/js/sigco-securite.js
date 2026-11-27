/*
 * SIGCO - protection CSRF cote navigateur (Bloc 02 - AUDIT-007).
 * Charge juste apres jQuery. Le jeton est fourni par la page dans window.SIGCO_CSRF.
 *  - ajoute le jeton a tous les formulaires POST (y compris ceux soumis par JavaScript) ;
 *  - ajoute le jeton a toutes les requetes AJAX POST de jQuery ;
 *  - sigcoPost(url) : envoie une action (suppression, validation...) en POST avec le jeton.
 */
(function (window, $) {
	'use strict';

	var csrf = window.SIGCO_CSRF || null;

	function ajouterJeton(form) {
		if (!csrf || !form || !form.method || form.method.toLowerCase() !== 'post') {
			return;
		}
		var champ = form.querySelector('input[name="' + csrf.nom + '"]');
		if (!champ) {
			champ = document.createElement('input');
			champ.type = 'hidden';
			champ.name = csrf.nom;
			form.appendChild(champ);
		}
		champ.value = csrf.valeur;
	}

	function tousLesFormulaires() {
		var forms = document.getElementsByTagName('form');
		for (var i = 0; i < forms.length; i++) {
			ajouterJeton(forms[i]);
		}
	}

	// Formulaires deja presents, et formulaires ajoutes plus tard au moment de l'envoi
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', tousLesFormulaires);
	} else {
		tousLesFormulaires();
	}
	document.addEventListener('submit', function (e) { ajouterJeton(e.target); }, true);

	// form.submit() natif ne declenche pas l'evenement "submit"
	var submitNatif = HTMLFormElement.prototype.submit;
	HTMLFormElement.prototype.submit = function () {
		ajouterJeton(this);
		return submitNatif.apply(this, arguments);
	};

	// AJAX jQuery
	if ($ && csrf) {
		$.ajaxPrefilter(function (options) {
			var type = (options.type || options.method || 'GET').toUpperCase();
			if (type !== 'POST' || options.crossDomain) {
				return;
			}
			if (window.FormData && options.data instanceof window.FormData) {
				options.data.append(csrf.nom, csrf.valeur);
			} else if (typeof options.data === 'string' && options.data !== '') {
				options.data += '&' + encodeURIComponent(csrf.nom) + '=' + encodeURIComponent(csrf.valeur);
			} else if (!options.data) {
				options.data = encodeURIComponent(csrf.nom) + '=' + encodeURIComponent(csrf.valeur);
			}
		});
		// Note : jQuery transforme les objets {cle: valeur} en chaine avant les prefiltres,
		// le cas "string" ci-dessus couvre donc aussi data: {...}.
	}

	// Envoi d'une action en POST (remplace la navigation GET des liens de suppression)
	window.sigcoPost = function (url) {
		var form = document.createElement('form');
		form.method = 'post';
		form.action = url;
		form.style.display = 'none';
		document.body.appendChild(form);
		ajouterJeton(form);
		submitNatif.call(form);
	};
})(window, window.jQuery);
