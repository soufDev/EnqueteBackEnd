<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Laravel 5</div>
    </div>
</div>
</body>
</html>


<div id="page">
    <div class="header">
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <h2>Votre Avis Nous Intérèsse ...</h2>
                </div>

                <div class="collapse navbar-collapse" id="js-navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li id="logo"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- ngView: -->
        <div>
            <div id="formDiv"  >
                <form role="form" id="page2" name="evalForm">

                    <div>
                        <div class="starter-template" id="page1">
                            <p><strong>Madame, Monsieur,</strong></p>
                            <p>
                                Dans le cadre de notre démarche qualité, et à la suite de votre utilisation de notre
                                nouveau SGB Système de
                                Gestion Bancaire, nous vous prions de nous aider à améliorer la qualité de nos produits
                                et nos services, en
                                prenant quelques instants pour exprimer votre niveau de satisfaction :
                                L’équipe de la direction informatique vous en remercie par avance.
                            </p>
                        </div>
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="form-group" role="form" id="formulaire">
                                    <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6">
                                        <label for="nom_prenom">Nom &amp; Prénom</label>
                                        <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" >
                                    </div>
                                    <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>

                                    <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6">
                                        <label for="poste_occupe">Poste Occupé</label>
                                        <input type="text" class="form-control" id="poste_occupe" name="poste_occupe">
                                    </div>

                                    <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6">
                                        <label for="num_poste">N° de Poste</label>
                                        <input type="number" class="form-control" ng-model="eval.user.num_poste" id="num_poste"name="num_poste">
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <p>Indiquez votre niveau de satisfaction relatif aux points suivants :</p>
                        <div class="ergonomie">
                            <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <div class="navbar-brand">Ergonomie (les interfaces)</div>
                                    </div>
                                </div>
                            </nav>
                            <div class="panel-body table-responsive">
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8"></th>
                                        <th>Très Satisfait</th>
                                        <th>Satisfait</th>
                                        <th>Insatisfait</th>
                                        <th>Très Insatisfait</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Les polices de caractère</td>
                                        <!-- ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="polices_caracteres" value="1">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="polices_caracteres" value="2">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="polices_caracteres" value="3">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="polices_caracteres" value="4">
                                        </td><!-- end ngRepeat: note in first -->

                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Les couleurs</td>
                                        <!-- ngRepeat: note in first -->
                                        <td  align="center" >
                                            <input type="radio" name="couleurs" value="1">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="couleurs" value="2">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="couleurs" value="3">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="couleurs" value="4">
                                        </td><!-- end ngRepeat: note in first -->
                                    </tr>
                                    <tr>
                                        <td>Les icônes</td>
                                        <!-- ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="icones" value="1">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="icones" value="2">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="icones" value="3" >
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="icones" value="4">
                                        </td><!-- end ngRepeat: note in first -->
                                    </tr>
                                    <tr>
                                        <td>L’organisation de l’information (Menu, Module, titres…)</td>
                                        <!-- ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="organisation_information" value="1" >
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="organisation_information" value="2" >
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="organisation_information" value="3" >
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="organisation_information" value="4" >
                                        </td><!-- end ngRepeat: note in first -->
                                    </tr>
                                    <tr>
                                        <td>La terminologie et les codes (code opération,…)</td>
                                        <!-- ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="terminologie_code" value="1">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="terminologie_code" value="2">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center">
                                            <input type="radio" name="terminologie_code" value="3">
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="terminologie_code" value="4">
                                        </td><!-- end ngRepeat: note in first -->
                                    </tr>
                                    <tr>
                                        <td>Facilité de navigation</td>
                                        <!-- ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="facilite_navigation" value="1" >
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="facilite_navigation" value="2" >
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="facilite_navigation" value="3" >
                                        </td><!-- end ngRepeat: note in first -->
                                        <td align="center" >
                                            <input type="radio" name="facilite_navigation" value="4" >
                                        </td><!-- end ngRepeat: note in first -->
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>


                    <div id="perfermence">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <div class="navbar-brand">Performance &amp; temps de réponse</div>
                                </div>
                            </div>
                        </nav>
                        <div class="panel-body table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8"></th>
                                    <th>Très rapide</th>
                                    <th>Moyen</th>
                                    <th>Lent</th>
                                    <th>Très Lent</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Délais de lancement de l’application</td>
                                    <!-- ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_lancement" value="5"  >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_lancement" value="6">
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_lancement" value="7">
                                    </td><!-- end ngRepeat: note in second -->
                                    <td  align="center" >
                                        <input type="radio" name="delai_lancement" value="8">
                                    </td><!-- end ngRepeat: note in second -->
                                </tr>
                                <tr>
                                    <td>Délais de navigation</td>
                                    <!-- ngRepeat: note in second -->
                                    <td  align="center" >
                                        <input type="radio" name="delais_navigation" value="5">
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delais_navigation" value="6" >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delais_navigation" value="7">
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center">
                                        <input type="radio" name="delais_navigation" value="8">
                                    </td><!-- end ngRepeat: note in second -->
                                </tr>
                                <tr>
                                    <td>Délais d’affichage des masques</td>
                                    <!-- ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_affichage" value="5">
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center">
                                        <input type="radio" name="delai_affichage" value="6">
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center">
                                        <input type="radio" name="delai_affichage" value="7" >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_affichage" value="8" >
                                    </td><!-- end ngRepeat: note in second -->
                                </tr>
                                <tr>
                                    <td>Délais d’exécution d’une opération</td>
                                    <!-- ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_exec" value="5" >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_exec" value="6" >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_exec" value="7" >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delai_exec" value="8" >
                                    </td><!-- end ngRepeat: note in second -->
                                </tr>
                                <tr>
                                    <td>Délais d’impression des états de sortie</td>
                                    <!-- ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delais_impression_etat_sortie" value="5" >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delais_impression_etat_sortie" value="6" >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delais_impression_etat_sortie" value="7" >
                                    </td><!-- end ngRepeat: note in second -->
                                    <td align="center" >
                                        <input type="radio" name="delais_impression_etat_sortie" value="8" >
                                    </td><!-- end ngRepeat: note in second -->
                                </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="assistance_info">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <div class="navbar-brand">Assistance de l’équipe informatique</div>
                                </div>
                            </div>
                        </nav>
                        <div class="panel-body table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8"></th>
                                    <th>Très Satisfait</th>
                                    <th>Satisfait</th>
                                    <th>Insatisfait</th>
                                    <th>Très Insatisfait</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Volet formation</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="volet_formation" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="volet_formation" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="volet_formation" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="volet_formation" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Volet information</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center">
                                        <input type="radio" name="volet_information" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input name="volet_information" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="volet_information" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="volet_information" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Assistance lors du passage de l’ancien au nouveau SGB</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="assistance" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="assistance" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="assistance" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="assistance" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Réactivité &amp; délais de prise en charge</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="reactivite" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="reactivite" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center">
                                        <input type="radio" name="reactivite" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="reactivite" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Qualité de prise en charge</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center" >
                                        <input type="radio" name="qualite_prise_en_charge" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="qualite_prise_en_charge" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="qualite_prise_en_charge" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="qualite_prise_en_charge" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Redondance des incidents</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="redondance_incidents" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="redondance_incidents" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="redondance_incidents" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="redondance_incidents" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="nouveaute">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <div class="navbar-brand">Nouveauté</div>
                                </div>
                            </div>
                        </nav>
                        <div class="panel-body table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8"></th>
                                    <th>Très Satisfait</th>
                                    <th>Satisfait</th>
                                    <th>Insatisfait</th>
                                    <th>Très Insatisfait</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>F7 (Clé BA)</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f7" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f7" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f7" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f7" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>F11 (10 derniers mouvements)</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f11" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f11" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f11" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f11" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>F8 (Le solde actuel)</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f8" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f8" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f8" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="f8" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Opérations Favorites</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="op_favirites" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="op_favirites" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="op_favirites" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="op_favirites" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Journal des transactions</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="journal_transation" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="journal_transation" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="journal_transation" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="journal_transation" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Opérations récentes (5 dernières)</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="op_recente" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="op_recente" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="op_recente" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="op_recente" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Notifications</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="notif" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="notif" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="notif"  value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="notif" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                <tr>
                                    <td>Recherche client dans la page d’accueil</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="rech_client" value="1" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="rech_client" value="2" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="rech_client" value="3" >
                                    </td><!-- end ngRepeat: note in first -->
                                    <td  align="center" >
                                        <input type="radio" name="rech_client" value="4" >
                                    </td><!-- end ngRepeat: note in first -->
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="bug_technique">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <div class="navbar-brand">Problèmes &amp; bugs rencontrés par domaine technique
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <div class="panel-body table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8">Nombre de problèmes &amp; bugs (pour
                                        le mois d’Août 2016)
                                    </th>
                                    <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">0</th>
                                    <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Inférieur à 5</th>
                                    <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Inférieur à 10</th>
                                    <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Supèrieur à 10</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Exécution des opérations</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="exe_op" value="9">
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="exe_op" value="10">
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="exe_op" value="11">
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="exe_op" value="12">
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Saisie et validation</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="saisie_validation" value="9">
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="saisie_validation" value="10">
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="saisie_validation" value="11">
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="saisie_validation" value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Impression</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="impression" value="9" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="impression" value="10" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="impression" value="11" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="impression"  value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Numérisation</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="numerisation" value="9"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="numerisation" value="10"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="numerisation" value="11"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="numerisation" value="12"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Utilisation du matériel (PC, SIGNOTEC, imprimante…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="general_use" value="9"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="general_use" value="10"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="general_use" value="11"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="general_use" value="12"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="ergonomie">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <div class="navbar-brand">Problèmes &amp; bugs rencontrés par domaine métier</div>
                                </div>
                            </div>
                        </nav>
                        <div class="panel-body table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th class="col-lg-8 col-md-8 col-ms-8 col-xs-8">Nombre de problèmes &amp; bugs (pour
                                        le mois d’Août 2016)
                                    </th>
                                    <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">0</th>
                                    <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Inférieur à 5</th>
                                    <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Inférieur à 10</th>
                                    <th class="col-lg-1 col-md-1 col-ms-1 col-xs-1">Supèrieur à 10</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Opérations de caisse (Retraits, versement…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_caisse" value="9" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_caisse" value="10" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_caisse" value="11" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_caisse" value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Opérations CREDIT (saisie, remboursement,…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_credit" value="9" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_credit" value="10" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_credit" value="11" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_credit" value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Opérations MONETIQUES (octroi, rechargement,…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_monetique" value="9" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_monetique" value="10" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_monetique" value="11" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_monetique" value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Opérations COMEX</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_comex" value="9" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_comex" value="10" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_comex" value="11" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_comex" value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Gestion des CLIENTS/COMPTES (fiche client, ouverture,…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="clients_comptes" value="9" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="clients_comptes" value="10" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="clients_comptes" value="11"
                                               >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="clients_comptes" value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Opération de télécompensation (chèques, effets,…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_telecomp" value="9" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_telecomp" value="10" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_telecomp" value="11" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="op_telecomp" value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                <tr>
                                    <td>Reporting et consultation (relevé, état des crédits…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="reporting" value="9" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="reporting" value="10" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="reporting" value="11" >
                                    </td><!-- end ngRepeat: note in third -->
                                    <td  align="center" >
                                        <input type="radio" name="reporting" value="12" >
                                    </td><!-- end ngRepeat: note in third -->
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div id="particulier">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <div class="navbar-brand">En général :</div>
                                </div>
                            </div>
                        </nav>
                        <p>
                            Nombre moyen des problèmes rencontrés par jour :
                        </p>
                        <p>
                            Merci de détailler le/les problème(s) en quelques lignes :
                        </p>
                        <div class="form-group" >
                            <textarea
                                    class="text_area form-control"
                                    name="general" required="" ></textarea>
                        </div>
                    </div>

                    <div id="general">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <div class="navbar-brand">En particulier :</div>
                                </div>
                            </div>
                        </nav>
                        <p>
                            Nombre moyen des problèmes rencontrés par jour :
                        </p>
                        <p>
                            Merci de détailler le/les problème(s) en quelques lignes :
                        </p>
                        <div class="form-group">
                            <textarea class="text_area form-control" name="particuler"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <p>From Gulf Bank Algeria Team Developer</p>
        </div>
    </div>
</div>