# SIGCO 2.0 — Cartographie des droits a1 à a100

Généré le 27/11/2026 à partir du code (menu, règles `$acces` des contrôleurs) et de la base (`groupe_user`).
**À valider par l'IT Manager de MESDHASA** (rapport d'évaluation, AUDIT-002). Régénérer : `php outils-test/cartographie_droits.php`.

Le groupe spécial `001A` (Administration) reçoit tous les droits sans ligne en base. Un groupe absent de `groupe_user` ne donne aucun droit.

## Droits utilisés

| Droit | Menu | Actions protégées (contrôleur::méthode) | Groupes qui l'ont |
|---|---|---|---|
| a1 | Menu Import | aucune (menu seulement) | Admin, Administrateur, Notification, Caisse, Import Administration |
| a2 | Créer un vol | 7 : Import::index, Import::creer, Import::manifest, Import::xml, Import::add, Import::save, Import::supprimerVol | Admin, Administrateur, Import Administration |
| a3 | Notification | 10 : Import::precol, Import::prepaidcollect, Import::ajax_prepaidcollect, Import::notifbill, Import::notif_buill, Import::Set_memo, Import::add_memo, Import::recherche_notification1, Import::recherche_notification2, Import::set_notification3 | Admin, Administrateur, Notification, Import Administration |
| a4 | Recherche de vols | 11 : Import::awbl, Import::manifestxls, Import::manifestpdf, Import::recherchevol, Import::editcustum, Import::deletecustum, Import::updatebill, Import::updatecustum, Import::ajouterawbl, Import::newawbl, Import::add_awbl | Admin, Administrateur, Notification, Caisse, Import Administration |
| a5 | Pointage | 3 : Import::pointage, Import::add_pointage, Import::deletepointage | Admin, Administrateur, Livraison, Import Administration |
| a6 | Menu Export | aucune (menu seulement) | Admin, Administrateur, Notification, Caisse, Import Administration |
| a7 | Créer un manifeste | 14 : Export::index, Export::add_reservation, Export::ajouter_reservation, Export::modifier_reservation, Export::ajouter_un_manifeste, Export::add_manifeste, Export::edit_manifeste (ou a8), Export::edit_reservation, Export::supprimer_manifeste, Export::supprimer_reservation, Export::manifest_pdf (ou a8), Export::ExpManifestxls (ou a8), Export::recherche_reservation, Export::reservationpdf | Admin, Administrateur, Notification, Import Administration |
| a8 | Recherche un manifeste | 9 : Export::edit_manifeste (ou a7), Export::modifier_un_manifeste, Export::liste_awb, Export::add_awb_manifest, Export::remove_awb_manifest, Export::liste_awb_vol, Export::manifest_pdf (ou a7), Export::ExpManifestxls (ou a7), Export::rech_manifeste | Admin, Administrateur, Notification, Caisse, Import Administration |
| a9 | Warehouse Receipt | 12 : Export::ajouter_warehouse, Export::modifier_ajouter_warehouse, Export::edit_warehouse, Export::delete_warehouse_colis, Export::supprimer_warehouse, Export::antrepot, Export::add_wr, Export::add_wr2, Export::add_antrepot, Export::ajouter_pcs, Export::modifier_antrepot, Export::warehousepdf | Admin, Administrateur, Notification, Caisse, Import Administration |
| a10 | Airway Bill | 12 : Export::ajax_prepaidcollect, Export::Airway_Bill, Export::Airway_Bill2, Export::modifier_awb, Export::addawbl_export, Export::add_other_charges, Export::delete_other_charges, Export::awb_pdf, Export::tag4x6, Export::tag4x4, Export::edit_awbl_export, Export::deleteAwb | Admin, Administrateur, Notification, Caisse, Import Administration |
| a11 | Menu Livraison | aucune (menu seulement) | Admin, Administrateur, Livraison, Caisse, Import Administration |
| a12 | Livrer un colis ; POD Report ; W/H INVENTORY | 13 : Livraison::index, Livraison::index_degroup, Livraison::recherche, Livraison::vider_nolivraison, Livraison::livrer, Livraison::livrer2, Livraison::rap_livraison, Livraison::non_livraison, Livraison::pod_report, Livraison::pod_report_date, Livraison::non_livrer_date, Livraison::pod_report_total, Livraison::non_livrer_pdf | Admin, Administrateur, Livraison, Caisse, Import Administration |
| a13 | Recherche | 7 : Import::detail, Recherche::index, Recherche::larecherche, Recherche::detail, Recherche::detail_ex, Recherche::deleteFacture_detail, Recherche::deleteFacture_detail1 | Admin, Administrateur, Notification, Livraison, Caisse, Import Administration, Comptabilite, Gestion Clients |
| a14 | Menu Facturation | aucune (menu seulement) | Admin, Administrateur, Notification, Livraison, Caisse, Comptabilite |
| a15 | Rechercher un AWB | 38 : Facture::index, Facture::recherche, Facture::degrouper, Facture::update_degrouper, Facture::del_degrouper, Facture::facturerbill, Facture::ajouterMontant, Facture::ajouterMontant2, Facture::getclient, Facture::deleteFacture, Facture::validerfacture, Facture::update_buill, Facture::facturepdf, Facture::facturehtml, Facture::degroup, Facture::caissepdf_usd (ou a19), Facture::caissepdf_htg (ou a19), Facture::imprimerecu (ou a19), Facture::todo, Facture::rabais_off, Facture::lescca, Facture::add_awb_export, Facture::add_awb_export2, Facture::add_awb_ex, Facture::facturerbill_ex, Facture::facturerbill_mesdhasa, Facture::update_buill_exp, Facture::update_buill_mesdhasa, Facture::getclient_exp, Facture::ajouterMontant_exp, Facture::ajouterMontant_mesdhasa, Facture::rabais_off_mesdhasa, Facture::deleteFacture_exp, Facture::deleteFacture_mesdhasa, Facture::ajouterMontant2_exp, Facture::ajouterMontant2_mesdhasa, Facture::validerfacture_exp, Facture::validerfacture_mesdhasa | Admin, Administrateur, Notification, Livraison, Caisse, Comptabilite |
| a16 | Rapports impayées | 3 : Facture::rapport, Facture::recherche_no (ou a17), Facture::recherche_no2 (ou a17) | Admin, Administrateur, Caisse, Comptabilite |
| a17 | Rapports de caisse ; Details de Caisse ; Informatics Fees ; Import Fees ; Due agent ; Statistics Weight | 39 : Facture::rap_caisse, Facture::details_de_caisse, Facture::recherche_details_de_caisse, Facture::details_de_caisse_pdf, Facture::informatics_fees, Facture::recherche_informatics_fees, Facture::informatics_fees_pdf, Facture::import_fees, Facture::recherche_import_fees, Facture::import_fees_pdf, Facture::Freight, Facture::recherche_freight, Facture::freight_pdf, Facture::due_agent, Facture::recherche_due_agent, Facture::due_agent_pdf, Facture::statistics_weight, Facture::statistics_weight, Facture::recherche_statistics_weight, Facture::rap_caisse2, Facture::recherche_no (ou a16), Facture::recherche_no2 (ou a16), Rapports::weekly_search, Rapports::weekly_search2, Rapports::weekly_search_pdf, Rapports::weekly_search_pdf2, Rapports::commission_weight_search, Rapports::commission_weight_search2, Rapports::commission_weight_search_pdf1, Rapports::commission_weight_search_excel, Rapports::commission_weight_search_pdf2, Rapports::commission_weight_search_excel2, Rapports::commission_fees_search, Rapports::commission_fees_search2, Rapports::savecheck, Rapports::commission_handling_pdf1, Rapports::DueAgent, Rapports::RecherDueAgent, Rapports::RecherDueAgentPdf | Admin, Administrateur, Caisse, Comptabilite |
| a18 | Menu Paiement | aucune (menu seulement) | Admin, Administrateur, Caisse, Comptabilite |
| a19 | Rechercher une facture | 9 : Facture::searchFacture, Facture::searchFac, Facture::payerfacture, Facture::Rembourser_facture, Facture::deleteFacture_payer, Facture::caissepdf_usd (ou a15), Facture::caissepdf_htg (ou a15), Facture::description_pmt, Facture::imprimerecu (ou a15) | Admin, Administrateur, Livraison, Caisse, Comptabilite |
| a20 | Menu Clients | aucune (menu seulement) | Admin, Administrateur, Notification, Caisse, Import Administration, Comptabilite, Gestion Clients |
| a21 | Ajouter un client | 8 : Client::index, Client::lst, Client::ajouter, Client::modifier, Client::etat_compte, Client::updateclient, Client::supprimerclient, Client::addclient | Admin, Administrateur, Notification, Caisse, Import Administration, Comptabilite, Gestion Clients |
| a22 | Liste des clients | aucune (menu seulement) | Admin, Administrateur, Notification, Caisse, Import Administration, Comptabilite, Gestion Clients |
| a23 | Menu Utilisateurs | aucune (menu seulement) | Admin, Administrateur |
| a24 | Ajouter un utilisateur | 5 : Utilisateur::index, Utilisateur::ajouter, Utilisateur::mod_utilisateur, Utilisateur::reset_utilisateur, Utilisateur::modifier (ou a25) | Admin, Administrateur |
| a25 | Liste des utilisateurs | 2 : Utilisateur::lister, Utilisateur::modifier (ou a24) | Admin, Administrateur |
| a26 | Menu gestion groupes | aucune (menu seulement) | Admin, Administrateur |
| a27 | Ajouter des groupes | 2 : Groupe::ajouter, Groupe::ajouter_groupe | Admin, Administrateur |
| a28 | Lister les groupes | 5 : Utilisateur::groupe, Groupe::index, Groupe::view, Groupe::modifier, Groupe::supprimer_groupe | Admin, Administrateur |
| a29 | Menu Rapports | aucune (menu seulement) | Admin, Administrateur, Caisse, Comptabilite |
| a30 | Créer un numéro de rapport | 1 : Import::set_numRapport | Admin, Administrateur, Caisse, Comptabilite |
| a31 | WEEKLY REPORTS ; COMMISSION ON WEIGHT CHARGES ; COMMISSION (Handling FEES) ; Due Agent Report ; Storage Report | 4 : Rapports::depot, Rapports::larecherche, Rapports::droit_depot_awb_pdf, Rapports::droit_depot_pdf_total | Admin, Administrateur, Caisse, Comptabilite |
| a32 | (entree de menu en commentaire) | 3 : Rapports::revenue_report_pdf_total, Rapports::revenue_report, Rapports::rec_revenue_report | Admin |
| a33 | Menu Entreprise | aucune (menu seulement) | Admin, Administrateur |
| a34 | Configuration | 23 : Entreprise::index, Entreprise::conf, Entreprise::edit_entreprise, Entreprise::edit_frais, Entreprise::edit_charges_codes, Entreprise::edit_commodity, Entreprise::edit_taux, Entreprise::edit_currency, Entreprise::ajouter_comp, Entreprise::ajouter_currency, Entreprise::ajouter_charges_codes, Entreprise::ajouter_commodity, Entreprise::update_comp, Entreprise::update_taux, Entreprise::update_frais, Entreprise::update_charges_codes, Entreprise::update_commodity, Entreprise::update_currency, Entreprise::supprimerVol, Entreprise::ajouter_frais, Entreprise::addawbEntreprise, Entreprise::addAWB_comp, Entreprise::addAWB_comp_excel | Admin, Administrateur |
| a35 | (bouton dans une page) | 2 : Export::fermer_vol, Export::ouvrir_vol | Admin, Administrateur |
| a36 | (bouton dans une page) | 1 : Export::void_awb | Admin, Administrateur |

**Droits non utilisés par l'application** (64) : a37, a38, a39, a40, a41, a42, a43, a44, a45, a46, a47, a48, a49, a50, a51, a52, a53, a54, a55, a56, a57, a58, a59, a60, a61, a62, a63, a64, a65, a66, a67, a68, a69, a70, a71, a72, a73, a74, a75, a76, a77, a78, a79, a80, a81, a82, a83, a84, a85, a86, a87, a88, a89, a90, a91, a92, a93, a94, a95, a96, a97, a98, a99, a100.

## Groupes

| Identifiant | Nom | Comptes actifs | Nombre de droits |
|---|---|---|---|
| 0001 | Admin | 1 | 100 |
| 001001A | Administrateur | 3 | 35 |
| 002001A | Notification | 5 | 14 |
| 003001A | Livraison | 1 | 7 |
| 004001A | Caisse | 3 | 21 |
| 007001A | Import Administration | 2 | 16 |
| 008001A | Comptabilite | 1 | 13 |
| 009001A | Gestion Clients | 2 | 4 |

**Comptes rattachés à un groupe inexistant (aucun droit)** : 006001A (4 comptes), 005001A (12 comptes). À clarifier avec MESDHASA.

## Méthodes sans droit particulier

Session seule : tableau de bord (`Home`), changement de son mot de passe. Publiques : connexion, déconnexion, « mot de passe oublié ». Tâches planifiées (ligne de commande) : `Anniversaire`, `Outils`.

## Nouveaux droits — Bloc 03 (à valider par l'IT Manager)

Accordés par défaut aux groupes **Admin** et **Administrateur** uniquement (fonctions d'administration). Modifiables dans l'éditeur de groupe.

| Droit | Fonction | Actions protégées |
|---|---|---|
| a40 | Gérer les points de chargement (villes de départ) | `Export::points_chargement`, `Export::ajouter_point_chargement` |
| a41 | Archives AWB (archiver un numéro, consulter les archives) | `Export::archives_awb`, `Export::detail_archive_awb`, `Export::archiver_awb` |
| a42 | Journal de traçabilité (page d'audit des documents) | `Audit::index` |
