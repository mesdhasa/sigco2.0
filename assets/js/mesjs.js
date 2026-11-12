		 $(document).ajaxStop(function(){
            console.debug("ajaxStop");
            $("#ajax_loader").hide();
         });
         $(document).ajaxStart(function(){
             console.debug("ajaxStart");
             $("#ajax_loader").show();
         });


$( "#datecustum" ).datepicker({
	 altField: "#datecustum",
		monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin','Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun','Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        prevText: '&#x3c;Préc', prevStatus: 'Voir le mois précédent',
        prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: 'Voir l\'année précédent',
        nextText: 'Suiv&#x3e;', nextStatus: 'Voir le mois suivant',
        nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: 'Voir l\'année suivant',
        currentText: 'Courant', currentStatus: 'Voir le mois courant',
        todayText: 'Aujourd\'hui', todayStatus: 'Voir aujourd\'hui',
        clearText: 'Effacer', clearStatus: 'Effacer la date sélectionnée',
        closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
        yearStatus: 'Voir une autre année', monthStatus: 'Voir un autre mois',
        weekText: 'Sm', weekStatus: 'Semaine de l\'année',
        dayStatus: '\'Choisir\' le DD d MM',
        defaultStatus: 'Choisir la date',
        isRTL: false
    });
$( "#datecustum2" ).datepicker({
	 altField: "#datecustum2",
		monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin','Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun','Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        prevText: '&#x3c;Préc', prevStatus: 'Voir le mois précédent',
        prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: 'Voir l\'année précédent',
        nextText: 'Suiv&#x3e;', nextStatus: 'Voir le mois suivant',
        nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: 'Voir l\'année suivant',
        currentText: 'Courant', currentStatus: 'Voir le mois courant',
        todayText: 'Aujourd\'hui', todayStatus: 'Voir aujourd\'hui',
        clearText: 'Effacer', clearStatus: 'Effacer la date sélectionnée',
        closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
        yearStatus: 'Voir une autre année', monthStatus: 'Voir un autre mois',
        weekText: 'Sm', weekStatus: 'Semaine de l\'année',
        dayStatus: '\'Choisir\' le DD d MM',
        defaultStatus: 'Choisir la date',
        isRTL: false
    });

		var i;
		for (i = 0; i < 250; i++) {
		$( "#b11"+i ).datepicker({
		altField: "#b11"+i,
		monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin','Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
		monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun','Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
		dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
		dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
		dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		prevText: '&#x3c;Préc', prevStatus: 'Voir le mois précédent',
		prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: 'Voir l\'année précédent',
		nextText: 'Suiv&#x3e;', nextStatus: 'Voir le mois suivant',
		nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: 'Voir l\'année suivant',
		currentText: 'Courant', currentStatus: 'Voir le mois courant',
		todayText: 'Aujourd\'hui', todayStatus: 'Voir aujourd\'hui',
		clearText: 'Effacer', clearStatus: 'Effacer la date sélectionnée',
		closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
		yearStatus: 'Voir une autre année', monthStatus: 'Voir un autre mois',
		weekText: 'Sm', weekStatus: 'Semaine de l\'année',
		dayStatus: '\'Choisir\' le DD d MM',
		defaultStatus: 'Choisir la date',
		isRTL: false,
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
onClose: function( selectedDate ) {
$( "#a11" ).datepicker( "option", "maxDate", selectedDate );
}
		});
		}

		var i;
		for (i = 0; i < 250; i++) {
		$( "#a11"+i ).datepicker({
		altField: "#a11"+i,
		monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin','Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
		monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun','Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
		dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
		dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
		dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		prevText: '&#x3c;Préc', prevStatus: 'Voir le mois précédent',
		prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: 'Voir l\'année précédent',
		nextText: 'Suiv&#x3e;', nextStatus: 'Voir le mois suivant',
		nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: 'Voir l\'année suivant',
		currentText: 'Courant', currentStatus: 'Voir le mois courant',
		todayText: 'Aujourd\'hui', todayStatus: 'Voir aujourd\'hui',
		clearText: 'Effacer', clearStatus: 'Effacer la date sélectionnée',
		closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
		yearStatus: 'Voir une autre année', monthStatus: 'Voir un autre mois',
		weekText: 'Sm', weekStatus: 'Semaine de l\'année',
		dayStatus: '\'Choisir\' le DD d MM',
		defaultStatus: 'Choisir la date',
		isRTL: false,
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
onClose: function( selectedDate ) {
$( "#b11" ).datepicker( "option", "maxDate", selectedDate );
}
		});
		}
		$( "#du2" ).datepicker({
altField: "#du2",
monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin','Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun','Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        prevText: '&#x3c;Préc', prevStatus: 'Voir le mois précédent',
        prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: 'Voir l\'année précédent',
        nextText: 'Suiv&#x3e;', nextStatus: 'Voir le mois suivant',
        nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: 'Voir l\'année suivant',
        currentText: 'Courant', currentStatus: 'Voir le mois courant',
        todayText: 'Aujourd\'hui', todayStatus: 'Voir aujourd\'hui',
        clearText: 'Effacer', clearStatus: 'Effacer la date sélectionnée',
        closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
        yearStatus: 'Voir une autre année', monthStatus: 'Voir un autre mois',
        weekText: 'Sm', weekStatus: 'Semaine de l\'année',
        dayStatus: '\'Choisir\' le DD d MM',
        defaultStatus: 'Choisir la date',
        isRTL: false,
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 3,
 onClose: function( selectedDate ) {
$( "#au2" ).datepicker( "option", "minDate", selectedDate );
 }
    });

$( "#au2" ).datepicker({
altField: "#au2",
monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin','Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun','Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        prevText: '&#x3c;Préc', prevStatus: 'Voir le mois précédent',
        prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: 'Voir l\'année précédent',
        nextText: 'Suiv&#x3e;', nextStatus: 'Voir le mois suivant',
        nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: 'Voir l\'année suivant',
        currentText: 'Courant', currentStatus: 'Voir le mois courant',
        todayText: 'Aujourd\'hui', todayStatus: 'Voir aujourd\'hui',
        clearText: 'Effacer', clearStatus: 'Effacer la date sélectionnée',
        closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
        yearStatus: 'Voir une autre année', monthStatus: 'Voir un autre mois',
        weekText: 'Sm', weekStatus: 'Semaine de l\'année',
        dayStatus: '\'Choisir\' le DD d MM',
        defaultStatus: 'Choisir la date',
        isRTL: false,
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 3,
onClose: function( selectedDate ) {
$( "#du2" ).datepicker( "option", "maxDate", selectedDate );
}
    });
$( "#datepicker" ).datepicker({
					showOtherMonths: true,
					selectOtherMonths: false,
					//isRTL:true,


					/*
					changeMonth: true,
					changeYear: true,

					showButtonPanel: true,
					beforeShow: function() {
						//change button colors
						var datepicker = $(this).datepicker( "widget" );
						setTimeout(function(){
							var buttons = datepicker.find('.ui-datepicker-buttonpane')
							.find('button');
							buttons.eq(0).addClass('btn btn-xs');
							buttons.eq(1).addClass('btn btn-xs btn-success');
							buttons.wrapInner('<span class="bigger-110" />');
						}, 0);
					}
			*/
				});


				//override dialog's title function to allow for HTML titles
				$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
					_title: function(title) {
						var $title = this.options.title || '&nbsp;'
						if( ("title_html" in this.options) && this.options.title_html == true )
							title.html($title);
						else title.text($title);
					}
				}));
$( "#id-btn-dialog1" ).on('click', function(e) {
					e.preventDefault();

					var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
						modal: true,
						title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> jQuery UI Dialog</h4></div>",
						title_html: true,
						buttons: [
							{
								text: "Cancel",
								"class" : "btn btn-minier",
								click: function() {
									$( this ).dialog( "close" );
								}
							},
							{
								text: "OK",
								"class" : "btn btn-primary btn-minier",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});

					/**
					dialog.data( "uiDialog" )._title = function(title) {
						title.html( this.options.title );
					};
					**/
				});

function AlertMessa(titre){
					$("#title-message").html(titre);
					var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
						resizable: false,
						width: '320',
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Information</h4></div>",
						title_html: true,

						buttons: [
							{
								html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Fermer",
								"class" : "btn btn-minier",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});

}
function void_awb() {
	$("#title-message").html("Do you want to VOID ?");
									var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
											resizable: false,
											width: '320',
											modal: true,
											title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Confirmation</h4></div>",
											title_html: true,

											buttons: [
													{
															html: "<i class='ace-icon fa fa-check bigger-110'></i>&nbsp; Oui",
															"class" : "btn btn-success btn-minier",
															click: function() {

															$.ajax({
																	url : base_url+'export/export/void_awb',
																	type : 'POST', // Le type de la requête HTTP, ici devenu POST
																	data: {
																		'entered_by'   : $('#entered_by').val(),
																		'id_awbl'   : $('#id_awbl').val(),
																		'awb_number'   : $('#awb_number').val(),
																	  'entered_by'   : $('#entered_by').val()
																},

																 dataType : 'html', // On désire recevoir du HTML
																 success : function(code_html, statut){ // code_html contient le HTML renvoyé

																 }
															});

																	$( this ).dialog( "close" );
															}
													}
													,
													{
															html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Fermer",
															"class" : "btn btn-minier",
															click: function() {
																	$( this ).dialog( "close" );
															}
													}
											]
									});
}

function confirmation_lien(titre,lien){
					$("#title-message").html(titre);
					var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
						resizable: false,
						width: '320',
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Confirmation</h4></div>",
						title_html: true,

						buttons: [
							{
								html: "<i class='ace-icon fa fa-check bigger-110'></i>&nbsp; Oui",
								"class" : "btn btn-primary btn-minier",
								click: function() {
									window.location.replace(lien);
									$( this ).dialog( "close" );
								}
							}
							,
							{
								html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Fermer",
								"class" : "btn btn-minier",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});

}

function confirmation_action(titre){
					$("#title-message").html(titre);
					var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
						resizable: false,
						width: '320',
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Confirmation</h4></div>",
						title_html: true,

						buttons: [
							{
								html: "<i class='ace-icon fa fa-check bigger-110'></i>&nbsp; Oui",
								"class" : "btn btn-primary btn-minier",
								click: function() {
									$('#f1').submit();
									$( this ).dialog( "close" );
								}
							}
							,
							{
								html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Fermer",
								"class" : "btn btn-minier",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});

}

function confirmation_action_paiement(titre){
$("#title-message").html(titre);
var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
resizable: false,
width: '320',
modal: true,
title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Confirmation</h4></div>",
title_html: true,

buttons: [
{
html: "<i class='ace-icon fa fa-check bigger-110'></i>&nbsp; Oui",
"class" : "btn btn-primary btn-minier",
click: function() {

if( $('input[name=choice]').is(':checked') ){
if($('#type').val()==""){
alert('Type de paiement sélectionné');
}else{
 $('#f1').submit();
}
} else {
alert("Description non sélectionné");
}
$( this ).dialog( "close" );
}
}
,
{
html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Fermer",
"class" : "btn btn-minier",
click: function() {
$( this ).dialog( "close" );
}
}
]
});

}

function Clkppcl(id,w,z){

	$( "#"+id+w ).prop( "checked", false );
	$( "#"+id+z ).prop( "checked", false );

	if($('#'+id+"a").prop('checked')){

		$( "#"+id+"b" ).prop( "checked", false );
		$( "#"+id+"c" ).prop( "checked", false );
		PrepaidCollect(id,'1','0','0');
	}else{
		if($('#'+id+"b").prop('checked')){
			$( "#"+id+"a" ).prop( "checked", false );
			$( "#"+id+"c" ).prop( "checked", false );
		PrepaidCollect(id,'0','1','0');
		}else{
			PrepaidCollect(id,'0','0','1');
		}
	}

}
function Clkppcl_export(id,w,z){

	$( "#"+id+w ).prop( "checked", false );
	$( "#"+id+z ).prop( "checked", false );

	if($('#'+id+"a").prop('checked')){

		$( "#"+id+"b" ).prop( "checked", false );
		$( "#"+id+"c" ).prop( "checked", false );
		PrepaidCollect_export(id,'1','0','0');
	}else{
		if($('#'+id+"b").prop('checked')){
			$( "#"+id+"a" ).prop( "checked", false );
			$( "#"+id+"c" ).prop( "checked", false );
		PrepaidCollect_export(id,'0','1','0');
		}else{
			PrepaidCollect_export(id,'0','0','1');
		}
	}

}
function Clkppcl2(id,w){

	$( "#"+id+w ).prop( "checked", false );

	if($('#'+id+"a").prop('checked')){

		$( "#"+id+"b" ).prop( "checked", false );
	}else{
		if($('#'+id+"b").prop('checked')){
			$( "#"+id+"a" ).prop( "checked", false );
		}else{
		}
	}

}

function PrepaidCollect(id,v1,v2,v3){

			$.ajax({
			   url : base_url+'import/ajax_prepaidcollect',
			   type : 'POST', // Le type de la requête HTTP, ici devenu POST
			   data: {
				'id'	: id,
				'pp'	: v1,
				'cl'	: v2,
				'nc'	: v3
			  },

			   dataType : 'html', // On désire recevoir du HTML
			   success : function(code_html, statut){ // code_html contient le HTML renvoyé

			   }
			});
}
function PrepaidCollect_export(id,v1,v2,v3){

			$.ajax({
			   url : base_url+'export/export/ajax_prepaidcollect',
			   type : 'POST', // Le type de la requête HTTP, ici devenu POST
			   data: {
				'id'	: id,
				'pp'	: v1,
				'cl'	: v2,
				'nc'	: v3
			  },

			   dataType : 'html', // On désire recevoir du HTML
			   success : function(code_html, statut){ // code_html contient le HTML renvoyé

			   }
			});
}
