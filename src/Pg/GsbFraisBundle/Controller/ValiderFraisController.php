<?php

namespace Pg\GsbFraisBundle\Controller;

require_once("include/fct.inc.php");

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ValiderFraisController extends Controller {

    public function indexAction() {

        $request = $this->get('request');
        $pdo = $this->get('pg_gsb_frais.pdo');
        $ficheFrais_visiteur = false;
        $lesEtats = "";
        $visiteur_id= 0 ;
        $lesVisiteurs = $pdo->getLesVisiteurs();
        
        if ($request->isMethod('POST')) {
            $visiteur_id = $request->get('visiteur_id');
            
            if($request->get('change_ficheFrais')){
                $etat_id = $request->get('etat_id');
                $mois = $request->get('mois_ficheFrais');
                $pdo->setFicheFraisEtat($visiteur_id, $etat_id, $mois); 
//                return new Response($etat_id. $mois. $visiteur_id);
            }
            
            $ficheFrais_visiteur = $pdo->getFicheFraisVisiteur($visiteur_id);
            $lesEtats = $pdo->getLesEtats();
        }

        return $this->render('PgGsbFraisBundle:ValiderFrais:validerFrais.html.twig', array(
                    'lesVisiteurs' => $lesVisiteurs,
                    'ficheFrais_visiteur' => $ficheFrais_visiteur,
                    'lesEtats' => $lesEtats,
                    'visiteur_id' => $visiteur_id));
    } 

}
