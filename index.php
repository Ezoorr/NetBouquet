<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdobouquet.inc.php");
session_start();
include("vues/v_entete.html") ;
//appel de la méthode statique pour se connecter à la BDD. Appel : $pdo->méthode
$pdo = PdoBouquet::getPdoBouquet();
if(!isset($_REQUEST['uc'])){
     $_REQUEST['uc'] = 'consulter';
}	 
$uc = $_REQUEST['uc'];
	switch($uc){
		case 'connexion':
                {
                    include("controleurs/c_connexion.php");
                    break;
		}
                case 'consulter' :
                {  //partie publique
                    include("vues/v_formConnexion.html") ;
                    include("vues/v_sommaireIndex.html") ;
                    include("controleurs/c_consulter.php");
                    break;
		}
                case 'gererProduit' :
                { //partie admin
                    include("controleurs/c_gererProduit.php");
                   
 
                    break; 
                }
                case 'commandeClient' :
                { //partie admin
                    include("controleurs/c_commandeClient.php");
                    break; 
                }
                
        

        }
include("vues/v_pied.html") ;
?>

