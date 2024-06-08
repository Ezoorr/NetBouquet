

<?php
include("vues/admin/v_sommaire.admin.html");
//pour récupérer l'action qui vient des liens, ou si n'existe pas on à tous produits
//Ajouter le login connecté
include("vues/admin/v_login.admin.php");

if(!isset($_REQUEST['action'])){
     $_REQUEST['action'] = 'listeCommandes';
}	 
$action = $_REQUEST['action'];	
    switch($action)  {
        case 'listeCommandes':
            
            $LesNoms = $pdo->getCommandesTrieParDate();	
           include("vues/admin/commandes_clients.admin.php");
            break;
        
        case 'TrierNom':
            
            $LesNoms = $pdo->getCommandesTrieParNom();	
           include("vues/admin/commandes_clients.admin.php");
            break;

            case 'RechercheClient' : 
            {
                 include("vues/admin/v_formClient.admin.php");      

                    if (isset($_POST["nom"]))
                    {
                        $nom=$_POST["nom"];
                        $LesNoms = $pdo->RechercheNom($nom);	
                        include("vues/admin/v_AfficheClient.admin.php");

                        if (empty($LesNoms))
                        {
                            echo "Aucun client trouvé";
                        }
                        if($nom == "")
                        {
                            $LesNoms = $pdo->AfficherLesNoms();
                            include("vues/admin/v_AfficheClient.admin.php");
                        }
                        

                    }

                    
                break;
            }
        }
        
    

    
?>
