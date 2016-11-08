<?php

namespace App\Http\Controllers;

use App\Models\Assistance_equipe_informatique;
use App\Models\Autres;
use App\Models\Bugs_par_domaines_metier;
use App\Models\Bugs_par_domaines_tech;
use App\Models\Ergonomie_interface;
use App\Models\Nouveaute;
use App\Models\Performance_temp_reponse;
use App\Models\User;
use Illuminate\Http\Request;

use League\Flysystem\Exception;
use PDF;


class EnqueteSatisfaction extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = $request->get('user');
        // recuperer l'id de l'utilisateur inserer
        $user_id = $this->insertUser($user);
        // verifier si l'utilisateur est bien crée
        if($user_id == -1) {
            $message = "Erreur Serveur";
            return compact('message');
        }

        try{

            // Inserer Les notes Ergonomie
            $this->insertErgonomie($request, $user_id);

            // inserer les notes performance & temp reponse
            $this->insertPerformance($request, $user_id);

            // inserer les notes sur assistance info
            $this->insertAassistance_info($request, $user_id);

            //inserer les notes sur les nouveautés
            $this->insertNouveaute($request, $user_id);

            //inserer les notes sur bug techniques
            $this->insertBug_technique($request, $user_id);

            //inserer les notes sur bug metier
            $this->insertBug_metier($request, $user_id);

            //inserer les notes sur autres
            $this->insertAutres($request, $user_id);

            // generer le pdf
            //dd($request->get('form'));

        } catch(Exception $e) {
            $message ='Erreur est Servenu lors de l\'insertion des notes';
            return compact('message');
        }

        //return compact("message");
        return compact('message');
        /**/
    }

    // inserer un user et renvoyer son ID
    public function insertUser($user) {
        try{
            User::create($user);
            return User::lists('id')->last();
        } catch(Exception $e) {
            return -1;
        }
    }

    // inserer les notes ergonomie
    public function insertErgonomie($request, $user_id) {
        // recupper les note ergonomie
        $ergonomie = $request->get('ergonomie');
        $ergonomie['user_id'] = $user_id;
        Ergonomie_interface::create($ergonomie);
    }

    // inserer les notes performance & temp reponse
    public function insertPerformance($request, $user_id) {
        $input = $request->get('perfermence');
        $input['user_id'] = $user_id;
        Performance_temp_reponse::create($input);
    }

    // inserer les notes assistance_info
    public function insertAassistance_info($request, $user_id){
        $input = $request->get('assistance_info');
        $input['user_id'] = $user_id;
        Assistance_equipe_informatique::create($input);
    }

    //inserer les notes sur nouveaute
    public function insertNouveaute($request, $user_id) {
        $input = $request->get('nouveaute');
        $input['user_id'] = $user_id;
        Nouveaute::create($input);
    }

    //inserer les notes sur bug_technique
    public function insertBug_technique($request, $user_id) {
        $input = $request->get('bug_technique');
        $input['user_id'] = $user_id;
        Bugs_par_domaines_tech::create($input);
    }

    //inserer les notes sur bug_technique
    public function insertBug_metier($request, $user_id) {
        $input = $request->get('bug_metier');
        $input['user_id'] = $user_id;
        Bugs_par_domaines_metier::create($input);
    }

    //inserer les notes sur autres
    public function insertAutres($request, $user_id) {
        $input = $request->get('autres');
        $input['user_id'] = $user_id;
        Autres::create($input);
    }

    // creer un fichier pdf pour notre formulaire
    public function createPDF($filePath) {
        $pdf = new Pdf($filePath);
        $pdf->send('enquete_satisfaction.pdf');
    }

    // public get html form
    public function getForm($request) {

        $form = '<div id="page"><div class="header">
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
                                        <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="'.$request->get("user")['nom_prenom'].'">
                                    </div>
                                    <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="'.$request->get("user")['email'].'">
                                    </div>

                                    <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6">
                                        <label for="poste_occupe">Poste Occupé</label>
                                        <input type="text" class="form-control" id="poste_occupe" name="poste_occupe" value="'.$request->get("user")['poste_occupe'].'">
                                    </div>

                                    <div class="form-group col-xs-12 col-ms-6 col-md-6 col-lg-6">
                                        <label for="num_poste">N° de Poste</label>
                                        <input type="number" class="form-control" id="num_poste" name="num_poste" value="'.$request->get('user')['num_poste'].'">
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
                                        <td align="center">';
            if($request->get("ergonomie")['polices_caracteres'] == '1') {
                $form .= '<input type="radio" name="polices_caracteres" value="1" checked="checked">
                                        </td><td align="center">';
            }else {
                $form .= '<input type="radio" name="polices_caracteres" value="1">
                                        </td><td align="center">';
            }

            if($request->get("ergonomie")['polices_caracteres'] == '2'){
                $form .= '<input type="radio" name="polices_caracteres" value="2" checked="checked">
                                        </td><td align="center">';
            }else {
                $form .= '<input type="radio" name="polices_caracteres" value="2">
                                        </td><td align="center">';
            }
            if($request->get("ergonomie")['polices_caracteres'] == '3'){
                $form .= '<input type="radio" name="polices_caracteres" value="3" checked="checked">
                                        </td><td align="center">';
            }else {
                $form .= '<input type="radio" name="polices_caracteres" value="3">
                                        </td><td align="center">';
            }

            if($request->get("ergonomie")['polices_caracteres'] == '4'){
                $form .= '<input type="radio" name="polices_caracteres" value="4" checked="checked">
                                        </td><td align="center">';
            }else {
                $form .= '<input type="radio" name="polices_caracteres" value="4">
                                        </td><td align="center">';
            }
            $form .= '<td>
                                       </td>
                                    </tr>
                                    <tr>
                                        <td>Les couleurs</td>
                                        <td  align="center" >';
        if($request->get("ergonomie")['couleurs'] == '1') {
            $form .= '<input type="radio" name="couleurs" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="couleurs" value="1"  >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['couleurs'] == '2') {
            $form .= '<input type="radio" name="couleurs" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="couleurs" value="2"  >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['couleurs'] == '3') {
            $form .= '<input type="radio" name="couleurs" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="couleurs" value="3"  >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['couleurs'] == '4') {
            $form .= '<input type="radio" name="couleurs" value="4" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="couleurs" value="4"  >
                                        </td>
                                        <td align="center">';
        }
        $form .= '</tr>
                                    <tr>
                                        <td>Les icônes</td>
                                        
                                        <td align="center">';
        if($request->get("ergonomie")['icones'] == '1') {
            $form .= '<input type="radio" name="icones" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="icones" value="1">
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['icones'] == '2') {
            $form .= '<input type="radio" name="icones" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="icones" value="2">
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['icones'] == '3') {
            $form .= '<input type="radio" name="icones" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="icones" value="3">
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['icones'] == '4') {
            $form .= '<input type="radio" name="icones" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="icones" value="4">
                                        </td>';
        }
                                            $form .='
                                    </tr>
                                    <tr>
                                        <td>L’organisation de l’information (Menu, Module, titres…)</td>
                                        
                                        <td align="center">';
        if($request->get("ergonomie")['organisation_information'] == '1') {
            $form .= '<input type="radio" name="organisation_information" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="organisation_information" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['organisation_information'] == '2') {
            $form .= '<input type="radio" name="organisation_information" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="organisation_information" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['organisation_information'] == '3') {
            $form .= '<input type="radio" name="organisation_information" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="organisation_information" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['organisation_information'] == '4') {
            $form .= '<input type="radio" name="organisation_information" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="organisation_information" value="4" >
                                        </td>';
        }
        $form .= '</tr>
                                    <tr>
                                        <td>La terminologie et les codes (code opération,…)</td>
                                        <!-- ngRepeat: note in first -->
                                        <td align="center" >
                                            ';
        if($request->get("ergonomie")['terminologie_codes'] == '1') {
            $form .= '<input type="radio" name="terminologie_codes" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="terminologie_codes" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['terminologie_codes'] == '2') {
            $form .= '<input type="radio" name="terminologie_codes" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="terminologie_codes" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['terminologie_codes'] == '3') {
            $form .= '<input type="radio" name="terminologie_codes" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="terminologie_codes" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['terminologie_codes'] == '4') {
            $form .= '<input type="radio" name="terminologie_codes" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="terminologie_codes" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                    <tr>
                                        <td>Facilité de navigation</td>
                                        
                                        <td align="center" >';
        if($request->get("ergonomie")['facilite_navigation'] == '1') {
            $form .= '<input type="radio" name="facilite_navigation" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="facilite_navigation" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['facilite_navigation'] == '2') {
            $form .= '<input type="radio" name="facilite_navigation" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="facilite_navigation" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['facilite_navigation'] == '3') {
            $form .= '<input type="radio" name="facilite_navigation" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="facilite_navigation" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("ergonomie")['facilite_navigation'] == '4') {
            $form .= '<input type="radio" name="facilite_navigation" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="facilite_navigation" value="4">
                                        </td>';
        }
        $form .= '</tr>
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
                                    <td align="center" >';
        if($request->get("perfermence")['delais_lancement_application'] == '5') {
            $form .= '<input type="radio" name="delais_lancement_application" value="5" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_lancement_application" value="5" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_lancement_application'] == '6') {
            $form .= '<input type="radio" name="delais_lancement_application" value="6" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_lancement_application" value="6" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_lancement_application'] == '7') {
            $form .= '<input type="radio" name="delais_lancement_application" value="7" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_lancement_application" value="7" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_lancement_application'] == '8') {
            $form .= '<input type="radio" name="delais_lancement_application" value="8" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="delais_lancement_application" value="8">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Délais de navigation</td>
                                    <!-- ngRepeat: note in second -->
                                    <td  align="center" >';
        if($request->get("perfermence")['delais_navigation'] == '5') {
            $form .= '<input type="radio" name="delais_navigation" value="5" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_navigation" value="5" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_navigation'] == '6') {
            $form .= '<input type="radio" name="delais_navigation" value="6" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_navigation" value="6" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_navigation'] == '7') {
            $form .= '<input type="radio" name="delais_navigation" value="7" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_navigation" value="7" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_navigation'] == '8') {
            $form .= '<input type="radio" name="delais_navigation" value="8" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="delais_navigation" value="8">
                                        </td>';
        }

        $form .= '</tr>
                                <tr>
                                    <td>Délais d’affichage des masques</td>
                                    <!-- ngRepeat: note in second -->
                                    <td align="center" >';
        if($request->get("perfermence")['delais_affichage_masques'] == '5') {
            $form .= '<input type="radio" name="delais_affichage_masques" value="5" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_affichage_masques" value="5" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_affichage_masques'] == '6') {
            $form .= '<input type="radio" name="delais_affichage_masques" value="6" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_affichage_masques" value="6" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_affichage_masques'] == '7') {
            $form .= '<input type="radio" name="delais_affichage_masques" value="7" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_affichage_masques" value="7" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_affichage_masques'] == '8') {
            $form .= '<input type="radio" name="delais_affichage_masques" value="8" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="delais_affichage_masques" value="8">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Délais d’exécution d’une opération</td>
                                    <!-- ngRepeat: note in second -->
                                    <td align="center" >';
        if($request->get("perfermence")['delais_execution_operation'] == '5') {
            $form .= '<input type="radio" name="delais_execution_operation" value="5" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_execution_operation" value="5" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_execution_operation'] == '6') {
            $form .= '<input type="radio" name="delais_execution_operation" value="6" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_execution_operation" value="6" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_execution_operation'] == '7') {
            $form .= '<input type="radio" name="delais_execution_operation" value="7" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_execution_operation" value="7" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_execution_operation'] == '8') {
            $form .= '<input type="radio" name="delais_execution_operation" value="8" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="delais_execution_operation" value="8">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Délais d’impression des états de sortie</td>
                                    <!-- ngRepeat: note in second -->
                                    <td align="center" >';
        if($request->get("perfermence")['delais_impression_etat_sortie'] == '5') {
            $form .= '<input type="radio" name="delais_impression_etat_sortie" value="5" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_impression_etat_sortie" value="5" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_impression_etat_sortie'] == '6') {
            $form .= '<input type="radio" name="delais_impression_etat_sortie" value="6" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_impression_etat_sortie" value="6" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_impression_etat_sortie'] == '7') {
            $form .= '<input type="radio" name="delais_impression_etat_sortie" value="7" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="delais_impression_etat_sortie" value="7" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("perfermence")['delais_impression_etat_sortie'] == '8') {
            $form .= '<input type="radio" name="delais_impression_etat_sortie" value="8" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="delais_impression_etat_sortie" value="8">
                                        </td>';
        }
        $form .= '</tr>
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
                                    <td align="center" >';
        if($request->get("assistance_info")['volet_formation'] == '1') {
            $form .= '<input type="radio" name="volet_formation" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="volet_formation" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['volet_formation'] == '2') {
            $form .= '<input type="radio" name="volet_formation" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="volet_formation" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['volet_formation'] == '3') {
            $form .= '<input type="radio" name="volet_formation" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="volet_formation" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['volet_formation'] == '4') {
            $form .= '<input type="radio" name="volet_formation" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="volet_formation" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Volet information</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center">';
        if($request->get("assistance_info")['volet_information'] == '1') {
            $form .= '<input type="radio" name="volet_information" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="volet_information" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['volet_information'] == '2') {
            $form .= '<input type="radio" name="volet_information" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="volet_information" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['volet_information'] == '3') {
            $form .= '<input type="radio" name="volet_information" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="volet_information" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['volet_information'] == '4') {
            $form .= '<input type="radio" name="volet_information" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="volet_information" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Assistance lors du passage de l’ancien au nouveau SGB</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center" >';
        if($request->get("assistance_info")['assistance_passage_ancien_nouveau'] == '1') {
            $form .= '<input type="radio" name="assistance_passage_ancien_nouveau" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="assistance_passage_ancien_nouveau" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['assistance_passage_ancien_nouveau'] == '2') {
            $form .= '<input type="radio" name="assistance_passage_ancien_nouveau" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="assistance_passage_ancien_nouveau" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['assistance_passage_ancien_nouveau'] == '3') {
            $form .= '<input type="radio" name="assistance_passage_ancien_nouveau" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="assistance_passage_ancien_nouveau" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['assistance_passage_ancien_nouveau'] == '4') {
            $form .= '<input type="radio" name="assistance_passage_ancien_nouveau" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="assistance_passage_ancien_nouveau" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Réactivité & délais de prise en charge</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center">';
        if($request->get("assistance_info")['reactivite_delais_prise_en_charge'] == '1') {
            $form .= '<input type="radio" name="reactivite_delais_prise_en_charge" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="reactivite_delais_prise_en_charge" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['reactivite_delais_prise_en_charge'] == '2') {
            $form .= '<input type="radio" name="reactivite_delais_prise_en_charge" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="reactivite_delais_prise_en_charge" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['reactivite_delais_prise_en_charge'] == '3') {
            $form .= '<input type="radio" name="reactivite_delais_prise_en_charge" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="reactivite_delais_prise_en_charge" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['reactivite_delais_prise_en_charge'] == '4') {
            $form .= '<input type="radio" name="reactivite_delais_prise_en_charge" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="reactivite_delais_prise_en_charge" value="4">
                                        </td>';
        }

        $form .= '</tr>
                                <tr>
                                    <td>Qualité de prise en charge</td>
                                    <!-- ngRepeat: note in first -->
                                    <td align="center">';
        if($request->get("assistance_info")['qualite_prise_en_charge'] == '1') {
            $form .= '<input type="radio" name="qualite_prise_en_charge" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="qualite_prise_en_charge" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['qualite_prise_en_charge'] == '2') {
            $form .= '<input type="radio" name="qualite_prise_en_charge" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="qualite_prise_en_charge" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['qualite_prise_en_charge'] == '3') {
            $form .= '<input type="radio" name="qualite_prise_en_charge" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="qualite_prise_en_charge" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['qualite_prise_en_charge'] == '4') {
            $form .= '<input type="radio" name="qualite_prise_en_charge" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="qualite_prise_en_charge" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Redondance des incidents</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("assistance_info")['redondance_incidents'] == '1') {
            $form .= '<input type="radio" name="redondance_incidents" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="redondance_incidents" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['qualite_prise_en_charge'] == '2') {
            $form .= '<input type="radio" name="redondance_incidents" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="redondance_incidents" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['qualite_prise_en_charge'] == '3') {
            $form .= '<input type="radio" name="redondance_incidents" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="redondance_incidents" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("assistance_info")['qualite_prise_en_charge'] == '4') {
            $form .= '<input type="radio" name="redondance_incidents" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="redondance_incidents" value="4">
                                        </td>';
        }
        $form .= '</tr>
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
                                    <td  align="center" >';
        if($request->get("nouveaute")['f7'] == '1') {
            $form .= '<input type="radio" name="f7" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f7" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f7'] == '2') {
            $form .= '<input type="radio" name="f7" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f7" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f7'] == '3') {
            $form .= '<input type="radio" name="f7" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f7" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f7'] == '4') {
            $form .= '<input type="radio" name="f7" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="f7" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>F11 (10 derniers mouvements)</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("nouveaute")['f11'] == '1') {
            $form .= '<input type="radio" name="f11" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f11" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f11'] == '2') {
            $form .= '<input type="radio" name="f11" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f11" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f11'] == '3') {
            $form .= '<input type="radio" name="f11" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f11" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f11'] == '4') {
            $form .= '<input type="radio" name="f11" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="f11" value="4">
                                        </td>';
        }
        $form.='</tr>
                                <tr>
                                    <td>F8 (Le solde actuel)</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("nouveaute")['f8'] == '1') {
            $form .= '<input type="radio" name="f8" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f8" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f8'] == '2') {
            $form .= '<input type="radio" name="f8" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f8" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f8'] == '3') {
            $form .= '<input type="radio" name="f8" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="f8" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['f8'] == '4') {
            $form .= '<input type="radio" name="f8" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="f8" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Opérations Favorites</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("nouveaute")['operation_favorite'] == '1') {
            $form .= '<input type="radio" name="operation_favorite" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operation_favorite" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operation_favorite'] == '2') {
            $form .= '<input type="radio" name="operation_favorite" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operation_favorite" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operation_favorite'] == '3') {
            $form .= '<input type="radio" name="operation_favorite" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operation_favorite" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operation_favorite'] == '4') {
            $form .= '<input type="radio" name="operation_favorite" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="operation_favorite" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Journal des transactions</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("nouveaute")['journal_transaction'] == '1') {
            $form .= '<input type="radio" name="journal_transaction" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="journal_transaction" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['journal_transaction'] == '2') {
            $form .= '<input type="radio" name="journal_transaction" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="journal_transaction" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['journal_transaction'] == '3') {
            $form .= '<input type="radio" name="journal_transaction" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="journal_transaction" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['journal_transaction'] == '4') {
            $form .= '<input type="radio" name="journal_transaction" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="journal_transaction" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Opérations récentes (5 dernières)</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("nouveaute")['operation_favorite'] == '1') {
            $form .= '<input type="radio" name="operation_favorite" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operation_favorite" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operation_favorite'] == '2') {
            $form .= '<input type="radio" name="operation_favorite" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operation_favorite" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operation_favorite'] == '3') {
            $form .= '<input type="radio" name="operation_favorite" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operation_favorite" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operation_favorite'] == '4') {
            $form .= '<input type="radio" name="operation_favorite" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="operation_favorite" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Journal des transactions</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("nouveaute")['operations_recentes'] == '1') {
            $form .= '<input type="radio" name="operations_recentes" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operations_recentes" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operations_recentes'] == '2') {
            $form .= '<input type="radio" name="operations_recentes" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operations_recentes" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operations_recentes'] == '3') {
            $form .= '<input type="radio" name="operations_recentes" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="operations_recentes" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['operations_recentes'] == '4') {
            $form .= '<input type="radio" name="operations_recentes" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="operations_recentes" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Notifications</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("nouveaute")['notifications'] == '1') {
            $form .= '<input type="radio" name="notifications" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="notifications" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['notifications'] == '2') {
            $form .= '<input type="radio" name="notifications" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="notifications" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['notifications'] == '3') {
            $form .= '<input type="radio" name="notifications" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="notifications" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['notifications'] == '4') {
            $form .= '<input type="radio" name="notifications" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="notifications" value="4">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Recherche client dans la page d’accueil</td>
                                    <!-- ngRepeat: note in first -->
                                    <td  align="center" >';
        if($request->get("nouveaute")['recherche_client_page_accueil'] == '1') {
            $form .= '<input type="radio" name="recherche_client_page_accueil" value="1" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="recherche_client_page_accueil" value="1" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['recherche_client_page_accueil'] == '2') {
            $form .= '<input type="radio" name="recherche_client_page_accueil" value="2" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="recherche_client_page_accueil" value="2" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['recherche_client_page_accueil'] == '3') {
            $form .= '<input type="radio" name="recherche_client_page_accueil" value="3" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="recherche_client_page_accueil" value="3" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("nouveaute")['recherche_client_page_accueil'] == '4') {
            $form .= '<input type="radio" name="recherche_client_page_accueil" value="4" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="recherche_client_page_accueil" value="4">
                                        </td>';
        }
        $form .= '</tr>
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
                                    <td  align="center" >';
        if($request->get("bug_technique")['execution_op'] == '9') {
            $form .= '<input type="radio" name="execution_op" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="execution_op" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['execution_op'] == '10') {
            $form .= '<input type="radio" name="execution_op" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="execution_op" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['execution_op'] == '11') {
            $form .= '<input type="radio" name="execution_op" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="execution_op" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['execution_op'] == '12') {
            $form .= '<input type="radio" name="execution_op" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="execution_op" value="12">
                                        </td>';
        }
        $form .='</tr>
                                <tr>
                                    <td>Saisie et validation</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_technique")['saisie_validation'] == '9') {
            $form .= '<input type="radio" name="saisie_validation" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="saisie_validation" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['saisie_validation'] == '10') {
            $form .= '<input type="radio" name="saisie_validation" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="saisie_validation" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['saisie_validation'] == '11') {
            $form .= '<input type="radio" name="saisie_validation" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="saisie_validation" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['saisie_validation'] == '12') {
            $form .= '<input type="radio" name="saisie_validation" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="saisie_validation" value="12">
                                        </td>';
        }
        $form.='</tr>
                                <tr>
                                    <td>Impression</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_technique")['impression'] == '9') {
            $form .= '<input type="radio" name="impression" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="impression" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['impression'] == '10') {
            $form .= '<input type="radio" name="impression" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="impression" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['impression'] == '11') {
            $form .= '<input type="radio" name="impression" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="impression" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['impression'] == '12') {
            $form .= '<input type="radio" name="impression" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="impression" value="12">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Numérisation</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_technique")['numerisation'] == '9') {
            $form .= '<input type="radio" name="numerisation" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="numerisation" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['numerisation'] == '10') {
            $form .= '<input type="radio" name="numerisation" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="numerisation" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['numerisation'] == '11') {
            $form .= '<input type="radio" name="numerisation" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="numerisation" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['numerisation'] == '12') {
            $form .= '<input type="radio" name="numerisation" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="numerisation" value="12">
                                        </td>';
        }
        $form .='</tr>
                                <tr>
                                    <td>Utilisation du matériel (PC, SIGNOTEC, imprimante…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_technique")['utilisation_materiel'] == '9') {
            $form .= '<input type="radio" name="utilisation_materiel" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="utilisation_materiel" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['utilisation_materiel'] == '10') {
            $form .= '<input type="radio" name="utilisation_materiel" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="utilisation_materiel" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['utilisation_materiel'] == '11') {
            $form .= '<input type="radio" name="utilisation_materiel" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="utilisation_materiel" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_technique")['utilisation_materiel'] == '12') {
            $form .= '<input type="radio" name="utilisation_materiel" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="utilisation_materiel" value="12">
                                        </td>';
        }
        $form .= '</tr>
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
                                    <td  align="center" >';
        if($request->get("bug_metier")['op_caisse'] == '9') {
            $form .= '<input type="radio" name="op_caisse" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_caisse" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_caisse'] == '10') {
            $form .= '<input type="radio" name="op_caisse" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_caisse" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_caisse'] == '11') {
            $form .= '<input type="radio" name="op_caisse" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_caisse" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_caisse'] == '12') {
            $form .= '<input type="radio" name="op_caisse" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="op_caisse" value="12">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Opérations CREDIT (saisie, remboursement,…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_metier")['op_credits'] == '9') {
            $form .= '<input type="radio" name="op_credits" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_credits" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_credits'] == '10') {
            $form .= '<input type="radio" name="op_credits" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_credits" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_credits'] == '11') {
            $form .= '<input type="radio" name="op_credits" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_credits" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_credits'] == '12') {
            $form .= '<input type="radio" name="op_credits" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="op_credits" value="12">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Opérations MONETIQUES (octroi, rechargement,…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_metier")['op_monetique'] == '9') {
            $form .= '<input type="radio" name="op_monetique" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_monetique" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_monetique'] == '10') {
            $form .= '<input type="radio" name="op_monetique" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_monetique" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_monetique'] == '11') {
            $form .= '<input type="radio" name="op_monetique" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_monetique" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_monetique'] == '12') {
            $form .= '<input type="radio" name="op_monetique" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="op_monetique" value="12">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Opérations COMEX</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_metier")['op_comex'] == '9') {
            $form .= '<input type="radio" name="op_comex" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_comex" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_comex'] == '10') {
            $form .= '<input type="radio" name="op_comex" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_comex" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_comex'] == '11') {
            $form .= '<input type="radio" name="op_comex" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_comex" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_comex'] == '12') {
            $form .= '<input type="radio" name="op_comex" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="op_comex" value="12">
                                        </td>';
        }
        $form .= '</tr>
                                <tr>
                                    <td>Gestion des CLIENTS/COMPTES (fiche client, ouverture,…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_metier")['gestion_client_comptes'] == '9') {
            $form .= '<input type="radio" name="gestion_client_comptes" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="gestion_client_comptes" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['gestion_client_comptes'] == '10') {
            $form .= '<input type="radio" name="gestion_client_comptes" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="gestion_client_comptes" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['gestion_client_comptes'] == '11') {
            $form .= '<input type="radio" name="gestion_client_comptes" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="gestion_client_comptes" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['gestion_client_comptes'] == '12') {
            $form .= '<input type="radio" name="gestion_client_comptes" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="gestion_client_comptes" value="12">
                                        </td>';
        }
        $form .='</tr>
                                <tr>
                                    <td>Opération de télécompensation (chèques, effets,…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_metier")['op_telecompence'] == '9') {
            $form .= '<input type="radio" name="op_telecompence" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_telecompence" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_telecompence'] == '10') {
            $form .= '<input type="radio" name="op_telecompence" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_telecompence" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_telecompence'] == '11') {
            $form .= '<input type="radio" name="op_telecompence" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="op_telecompence" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['op_telecompence'] == '12') {
            $form .= '<input type="radio" name="op_telecompence" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="op_telecompence" value="12">
                                        </td>';
        }
        $form .='</tr>
                                <tr>
                                    <td>Reporting et consultation (relevé, état des crédits…)</td>
                                    <!-- ngRepeat: note in third -->
                                    <td  align="center" >';
        if($request->get("bug_metier")['reporting_consultation'] == '9') {
            $form .= '<input type="radio" name="reporting_consultation" value="9" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="reporting_consultation" value="9" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['reporting_consultation'] == '10') {
            $form .= '<input type="radio" name="reporting_consultation" value="10" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="reporting_consultation" value="10" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['reporting_consultation'] == '11') {
            $form .= '<input type="radio" name="reporting_consultation" value="11" checked="checked">
                                        </td>
                                        <td align="center">';
        }else {
            $form .= '<input type="radio" name="reporting_consultation" value="11" >
                                        </td>
                                        <td align="center">';
        }

        if($request->get("bug_metier")['reporting_consultation'] == '12') {
            $form .= '<input type="radio" name="reporting_consultation" value="12" checked="checked">
                                        </td>';
        }else {
            $form .= '<input type="radio" name="reporting_consultation" value="12">
                                        </td>';
        }
        $form .= '</tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <br><br><br><br><br><br><br><br><br>
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
                                    name="general" required="" >'.$request->get("autres")['general'].'</textarea>
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
                            <textarea class="text_area form-control" name="particuler">'.$request->get("autres")['general'].'</textarea>
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
</div>';
        return $form;
    }
}
