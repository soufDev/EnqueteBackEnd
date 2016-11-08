"use strict";var myApp=angular.module("enqueteSatisfactionApp",["ngAnimate","ngCookies","ngResource","ngRoute","ngSanitize","ngTouch"]).constant("url","http://localhost:8000/");myApp.config(["$routeProvider","$locationProvider",function(a,b){a.when("/",{templateUrl:"views/main.html",controller:"MainCtrl",controllerAs:"main"}).otherwise({redirectTo:"/"})}]),myApp.controller("MainCtrl",["$scope","$http","$location","$anchorScroll","emails","url","Notes",function(a,b,c,d,e,f,g){this.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"],a.eval={},a.loading=!0,g.getNotes().then(function(b){var c=b.notes;a.first=c.slice(0,4),a.second=c.slice(4,8),a.third=c.slice(8,12),a.loading=!1}),a.message="Veuillez vérifier toutes les informations saisies",a.info_error=!1,a.info_valid=!1,a.info_email=!1,a.afficher=function(a){console.log(a)},a.submitForm=function(b,c){b?(a.info_error=!0,a.info_valid=!1,a.info_email=!1,a.message="Veuillez vérifier toutes les informations saisies",d()):h(c)};var h=function(c){c.form=document.getElementById("page"),c.form=c.form.innerHTML,console.log(c),a.eval=c,e.list(function(b){a.emails=b.emails}),b.post(f+"evaluer",c).success(function(b){i(a.emails,c.user.email)===!0?(a.info_error=!1,a.info_valid=!1,a.info_email=!0,a.message="Cette email existe dejà dans la base de donnée.",d()):(a.eval="",a.evalForm.$setPristine(),a.message="Merci d'avoir participer a notre enquete",a.info_valid=!0,a.info_error=!1,a.info_email=!1,d())}).error(function(b){a.message="Il y'a une erreur au niveau du serveur",a.info_error=!0,a.info_valid=!1,a.info_email=!1,d()})};a.closeErrorMsg=function(){a.info_error=!1},a.closeSuccesMsg=function(){a.info_valid=!1};var i=function(a,b){return-1!==a.indexOf(b)?!0:!1}}]),angular.module("enqueteSatisfactionApp").controller("AboutCtrl",function(){this.awesomeThings=["HTML5 Boilerplate","AngularJS","Karma"]}),myApp.factory("Notes",["$http","$q","url",function(a,b,c){var d={notes:!1,getNotes:function(){var e=b.defer();return a.get(c+"/notes").success(function(a,b){d.notes=a,e.resolve(d.notes)}).error(function(a,b){e.reject("Impossible de récupérer les articles")}),e.promise}};return d}]),myApp.factory("emails",["$http","$q","url",function(a,b,c){return{list:function(b){a.get(c+"/emails").success(b)}}}]),angular.module("enqueteSatisfactionApp").run(["$templateCache",function(a){a.put("views/about.html","<p>This is the about view.</p>"),a.put("views/main.html",'<div ng-show="loading"> <h3>Chargement ...</h3> </div> <div ng-hide="loading" id="formDiv"> <div class="alert alert-danger" ng-show="info_error"> <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="closeErrorMsg()"> <span aria-hidden="true">&times;</span> </button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only">Erreur : </span> {{message}} </div> <div class="alert alert-danger" ng-show="info_email"> <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="closeErrorMsg()"> <span aria-hidden="true">&times;</span> </button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only">Erreur : </span> {{message}} </div> <div class="alert alert-success" ng-show="info_valid"> <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="closeSuccesMsg()"> <span aria-hidden="true">&times;</span> </button> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <span class="sr-only">Valid : </span> {{message}} </div> <form role="form" id="page2" name="evalForm" ng-submit="submitForm(evalForm.$invalid ,eval)" novalidate> <div> <div class="starter-template" id="page1"> <p><strong>Madame, Monsieur,</strong></p> <p> Dans le cadre de notre démarche qualité, et à la suite de votre utilisation de notre nouveau SGB Système de Gestion Bancaire, nous vous prions de nous aider à améliorer la qualité de nos produits et nos services, en prenant quelques instants pour exprimer votre niveau de satisfaction : L’équipe de la direction informatique vous en remercie par avance. </p> </div> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="form-group" role="form" id="formulaire"> <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6" ng-class="{ \'has-error\' : evalForm.nom_prenom.$invalid && !evalForm.nom_prenom.$pristine}"> <label for="nom_prenom">Nom & Prénom</label> <input type="text" class="form-control" ng-model="eval.user.nom_prenom" id="nom_prenom" ng-required="true" name="nom_prenom" required> <span ng-show="evalForm.nom_prenom.$invalid && !evalForm.nom_prenom.$pristine" class="help-block"> Veuillez Renseigner ce champ </span> </div> <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6" ng-class="{ \'has-error\' : evalForm.email.$invalid  && !evalForm.email.$pristine}"> <label for="email">Email</label> <input type="email" class="form-control" ng-model="eval.user.email" id="email" required name="email"> <span ng-show="evalForm.email.$invalid && !evalForm.email.$pristine" class="help-block"> Veuillez Entrer un email valide </span> </div> <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6" ng-class="{ \'has-error\' : evalForm.poste_occupe.$invalid && !evalForm.poste_occupe.$pristine}"> <label for="poste_occupe">Poste Occupé</label> <input type="text" class="form-control" ng-model="eval.user.poste_occupe" id="poste_occupe" name="poste_occupe" required> <span ng-show="evalForm.poste_occupe.$invalid && !evalForm.poste_occupe.$pristine" class="help-block"> Veuillez entrer le nom du poste que vous occupez </span> </div> <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6" ng-class="{\'has-error\' : evalForm.num_poste.$invalid && !evalForm.num_poste.$pristine}"> <label for="num_poste">N° de Poste</label> <input type="number" class="form-control" ng-model="eval.user.num_poste" id="num_poste" required name="num_poste"> <span ng-show="evalForm.num_poste.$invalid && !evalForm.num_poste.$pristine" class="help-block">Veuilez entrer le N° de votre poste</span> </div> </div> </div> </nav> <p>Indiquez votre niveau de satisfaction relatif aux points suivants :</p> <div class="ergonomie"> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="navbar-header"> <div class="navbar-brand">Ergonomie (les interfaces)</div> </div> </div> </nav> <div class="panel-body table-responsive"> <table class="table table-responsive"> <thead> <tr> <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8"></th> <th>Très Satisfait</th> <th>Satisfait</th> <th>Insatisfait</th> <th>Très Insatisfait</th> </tr> </thead> <tbody> <tr> <td>Les polices de caractère</td> <td ng-repeat="note in first" align="center" ng-class="{\'has-error\' : !evalForm.polices_caracteres.$dirty}"> <input type="radio" name="polices_caracteres" ng-value="note" class="polices_caracteres" ng-change="afficher(eval.ergonomie.polices_caracteres)" ng-model="eval.ergonomie.polices_caracteres" required> </td> <td> </td></tr> <tr> <td>Les couleurs</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="couleurs" ng-value="note" class="couleurs" ng-change="afficher(eval.ergonomie.couleurs)" ng-model="eval.ergonomie.couleurs" required> </td> </tr> <tr> <td>Les icônes</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="icones" ng-value="note" class="icones" ng-change="afficher(eval.ergonomie.icones)" ng-model="eval.ergonomie.icones" required> </td> </tr> <tr> <td>L’organisation de l’information (Menu, Module, titres…)</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="organisation_information" ng-value="note" class="organisation_information" ng-change="afficher(eval.ergonomie.organisation_information)" ng-model="eval.ergonomie.organisation_information" required> </td> </tr> <tr> <td>La terminologie et les codes (code opération,…)</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="terminologie_code" ng-value="note" class="terminologie_codes" ng-change="afficher(eval.ergonomie.terminologie_codes)" ng-model="eval.ergonomie.terminologie_codes" required> </td> </tr> <tr> <td>Facilité de navigation</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="facilite_navigation" ng-value="note" class="facilite_navigation" ng-change="afficher(eval.ergonomie.facilite_navigation)" ng-model="eval.ergonomie.facilite_navigation" required> </td> </tr> </tbody> </table> </div> </div> </div> <div id="perfermence"> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="navbar-header"> <div class="navbar-brand">Performance & temps de réponse</div> </div> </div> </nav> <div class="panel-body table-responsive"> <table class="table table-responsive"> <thead> <tr> <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8"></th> <th>Très rapide</th> <th>Moyen</th> <th>Lent</th> <th>Très Lent</th> </tr> </thead> <tbody> <tr> <td>Délais de lancement de l’application</td> <td ng-repeat="note in second" align="center"> <input type="radio" name="delai_lancement" ng-value="note" class="delais_lancement_application" ng-change="afficher(eval.perfermence.delais_lancement_application)" ng-model="eval.perfermence.delais_lancement_application" required> </td> </tr> <tr> <td>Délais de navigation</td> <td ng-repeat="note in second" align="center"> <input type="radio" name="delais_navigation" ng-value="note" class="delais_navigation" ng-change="afficher(eval.perfermence.delais_navigation)" ng-model="eval.perfermence.delais_navigation"> </td> </tr> <tr> <td>Délais d’affichage des masques</td> <td ng-repeat="note in second" align="center"> <input type="radio" name="delai_affichage" ng-value="note" class="delais_affichage_masques" ng-change="afficher(eval.perfermence.delais_affichage_masques)" ng-model="eval.perfermence.delais_affichage_masques" required> </td> </tr> <tr> <td>Délais d’exécution d’une opération</td> <td ng-repeat="note in second" align="center"> <input type="radio" name="delai_exec" ng-value="note" class="delais_execution_operation" ng-change="afficher(eval.perfermence.delais_execution_operation)" ng-model="eval.perfermence.delais_execution_operation" required> </td> </tr> <tr> <td>Délais d’impression des états de sortie</td> <td ng-repeat="note in second" align="center"> <input type="radio" name="delais_impression_etat_sortie" ng-value="note" class="delais_impression_etat_sortie" ng-change="afficher(eval.perfermence.delais_impression_etat_sortie)" ng-model="eval.perfermence.delais_impression_etat_sortie" required> </td> </tr> </tbody> </table> </div> </div> <div class="assistance_info"> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="navbar-header"> <div class="navbar-brand">Assistance de l’équipe informatique</div> </div> </div> </nav> <div class="panel-body table-responsive"> <table class="table table-responsive"> <thead> <tr> <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8"></th> <th>Très Satisfait</th> <th>Satisfait</th> <th>Insatisfait</th> <th>Très Insatisfait</th> </tr> </thead> <tbody> <tr> <td>Volet formation</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="volet_formation" ng-value="note" class="volet_formation" ng-change="afficher(eval.assistance_info.volet_formation)" ng-model="eval.assistance_info.volet_formation" required> </td> </tr> <tr> <td>Volet information</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="volet_information" ng-value="note" class="vole_information" ng-change="afficher(eval.assistance_info.volet_information)" ng-model="eval.assistance_info.volet_information" required> </td> </tr> <tr> <td>Assistance lors du passage de l’ancien au nouveau SGB</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="assistance" ng-value="note" class="assistance" ng-change="afficher(eval.assistance_info.assistance_passage_ancien_nouveau)" ng-model="eval.assistance_info.assistance_passage_ancien_nouveau" required> </td> </tr> <tr> <td>Réactivité & délais de prise en charge</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="reactivite" ng-value="note" class="reactivite" ng-change="afficher(eval.assistance_info.reactivite_delais_prise_en_charge)" ng-model="eval.assistance_info.reactivite_delais_prise_en_charge" required> </td> </tr> <tr> <td>Qualité de prise en charge</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="qualite_prise_en_charge" ng-value="note" class="qualite_prise_en_charge" ng-change="afficher(eval.assistance_info.qualite_prise_en_charge)" ng-model="eval.assistance_info.qualite_prise_en_charge" required> </td> </tr> <tr> <td>Redondance des incidents</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="redondance_incidents" ng-value="note" class="redondance_incidents" ng-change="afficher(eval.assistance_info.redondance_incidents)" ng-model="eval.assistance_info.redondance_incidents" required> </td> </tr> </tbody> </table> </div> </div> <div class="nouveaute"> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="navbar-header"> <div class="navbar-brand">Nouveauté</div> </div> </div> </nav> <div class="panel-body table-responsive"> <table class="table table-responsive"> <thead> <tr> <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8"></th> <th>Très Satisfait</th> <th>Satisfait</th> <th>Insatisfait</th> <th>Très Insatisfait</th> </tr> </thead> <tbody> <tr> <td>F7 (Clé BA)</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="f7" ng-value="note" class="f7" ng-change="afficher(eval.nouveaute.f7)" ng-model="eval.nouveaute.f7" required> </td> </tr> <tr> <td>F11 (10 derniers mouvements)</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="f11" ng-value="note" class="f11" ng-change="afficher(eval.nouveaute.f11)" ng-model="eval.nouveaute.f11" required> </td> </tr> <tr> <td>F8 (Le solde actuel)</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="f8" ng-value="note" class="f8" ng-change="afficher(eval.nouveaute.f8)" ng-model="eval.nouveaute.f8" required> </td> </tr> <tr> <td>Opérations Favorites</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="op_favirites" ng-value="note" class="op_favirites" ng-change="afficher(eval.nouveaute.operation_favorite)" required ng-model="eval.nouveaute.operation_favorite"> </td> </tr> <tr> <td>Journal des transactions</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="journal_transation" ng-value="note" class="journal_transation" ng-change="afficher(eval.nouveaute.journal_transaction)" ng-model="eval.nouveaute.journal_transaction" required> </td> </tr> <tr> <td>Opérations récentes (5 dernières)</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="op_recente" ng-value="note" class="op_recente" ng-change="afficher(eval.nouveaute.operations_recentes)" ng-model="eval.nouveaute.operations_recentes" required> </td> </tr> <tr> <td>Notifications</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="notif" ng-value="note" class="notif" ng-change="afficher(eval.nouveaute.notifications)" ng-model="eval.nouveaute.notifications" required> </td> </tr> <tr> <td>Recherche client dans la page d’accueil</td> <td ng-repeat="note in first" align="center"> <input type="radio" name="rech_client" ng-value="note" class="recherche_client_page_accueil" ng-change="afficher(eval.nouveaute.recherche_client_page_accueil)" ng-model="eval.nouveaute.recherche_client_page_accueil" required> </td> </tr> </tbody> </table> </div> </div> <div class="bug_technique"> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="navbar-header"> <div class="navbar-brand">Problèmes & bugs rencontrés par domaine technique</div> </div> </div> </nav> <div class="panel-body table-responsive"> <table class="table table-responsive"> <thead> <tr> <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8">Nombre de problèmes & bugs (pour le mois d’Août 2016) </th> <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">0</th> <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Inférieur à 5</th> <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Inférieur à 10</th> <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Supèrieur à 10</th> </tr> </thead> <tbody> <tr> <td>Exécution des opérations</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="exe_op" ng-value="note" class="execution_op" ng-change="afficher(eval.bug_technique.execution_op)" ng-model="eval.bug_technique.execution_op" required> </td> </tr> <tr> <td>Saisie et validation</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="saisie_validation" ng-value="note" class="saisie_validation" ng-change="afficher(eval.bug_technique.saisie_validation)" ng-model="eval.bug_technique.saisie_validation" required> </td> </tr> <tr> <td>Impression</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="impression" ng-value="note" class="impression" ng-change="afficher(eval.bug_technique.impression)" ng-model="eval.bug_technique.impression" required> </td> </tr> <tr> <td>Numérisation</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="numerisation" ng-value="note" class="numerisation" ng-change="afficher(eval.bug_technique.numerisation)" ng-model="eval.bug_technique.numerisation" required> </td> </tr> <tr> <td>Utilisation du matériel (PC, SIGNOTEC, imprimante…)</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="general_use" ng-value="note" class="utilisation_materiel" ng-change="afficher(eval.bug_technique.utilisation_materiel)" ng-model="eval.bug_technique.utilisation_materiel" required> </td> </tr> </tbody> </table> </div> </div> <div class="ergonomie"> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="navbar-header"> <div class="navbar-brand">Problèmes & bugs rencontrés par domaine métier</div> </div> </div> </nav> <div class="panel-body table-responsive"> <table class="table table-responsive"> <thead> <tr> <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8">Nombre de problèmes & bugs (pour le mois d’Août 2016) </th> <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">0</th> <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Inférieur à 5</th> <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Inférieur à 10</th> <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Supèrieur à 10</th> </tr> </thead> <tbody> <tr> <td>Opérations de caisse (Retraits, versement…)</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="op_caisse" ng-value="note" class="op_caisse" ng-change="afficher(eval.bug_metier.op_caisse)" ng-model="eval.bug_metier.op_caisse" required> </td> </tr> <tr> <td>Opérations CREDIT (saisie, remboursement,…)</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="op_credit" ng-value="note" class="op_credits" ng-change="afficher(eval.bug_metier.op_credits)" ng-model="eval.bug_metier.op_credits" required> </td> </tr> <tr> <td>Opérations MONETIQUES (octroi, rechargement,…)</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="op_monetique" ng-value="note" class="op_monetique" ng-change="afficher(eval.bug_metier.op_monetique)" ng-model="eval.bug_metier.op_monetique" required> </td> </tr> <tr> <td>Opérations COMEX</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="op_comex" ng-value="note" class="op_comex" ng-change="afficher(eval.bug_metier.op_comex)" ng-model="eval.bug_metier.op_comex" required> </td> </tr> <tr> <td>Gestion des CLIENTS/COMPTES (fiche client, ouverture,…)</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="clients_comptes" ng-value="note" class="gestion_client_comptes" ng-change="afficher(eval.bug_metier.gestion_client_comptes)" ng-model="eval.bug_metier.gestion_client_comptes" required> </td> </tr> <tr> <td>Opération de télécompensation (chèques, effets,…)</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="op_telecomp" ng-value="note" class="op_telecompence" ng-change="afficher(eval.bug_metier.op_telecompence)" ng-model="eval.bug_metier.op_telecompence" required> </td> </tr> <tr> <td>Reporting et consultation (relevé, état des crédits…)</td> <td ng-repeat="note in third" align="center"> <input type="radio" name="reporting" ng-value="note" class="reporting_consultation" ng-change="afficher(eval.bug_metier.reporting_consultation)" ng-model="eval.bug_metier.reporting_consultation" required> </td> </tr> </tbody> </table> </div> </div> <div id="particulier"> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="navbar-header"> <div class="navbar-brand">En général :</div> </div> </div> </nav> <p> Nombre moyen des problèmes rencontrés par jour : </p> <p> Merci de détailler le/les problème(s) en quelques lignes : </p> <div class="form-group" ng-class="{\'has-error\' : evalForm.general.$invalid && !evalForm.general.$pristine}"> <textarea class="text_area form-control" name="general" ng-model="eval.autres.general" required></textarea> <span ng-show="evalForm.general.$invalid && !evalForm.general.$pristine" class="help-block">Veuillez saisir des remarque</span> </div> </div> <div id="general"> <nav class="navbar navbar-default"> <div class="container-fluid"> <div class="navbar-header"> <div class="navbar-brand">En particulier :</div> </div> </div> </nav> <p> Nombre moyen des problèmes rencontrés par jour : </p> <p> Merci de détailler le/les problème(s) en quelques lignes : </p> <div class="form-group" ng-class="{\'has-error\' : evalForm.particuler.$invalid && !evalForm.particuler.$pristine}"> <textarea class="text_area form-control" name="particuler" ng-model="eval.autres.particuler" required></textarea> <span ng-show="evalForm.particuler.$invalid && !evalForm.particuler.$pristine" class="help-block">Veuillez saisir des remarque</span> </div> </div> <div class="form-group" id="submit_button"> <button type="submit" class="btn btn-primary pull-right col-xs-12 col-ms-1 col-md-1 col-lg-1" ng-required="true"> Envoyer </button> </div> </form> </div>')}]);