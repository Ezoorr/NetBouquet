<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoBouquet qui contiendra l'unique instance de la classe
 
 * @package default
 * @author PG
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoBouquet{   		
      	private static $serveur='mysql:host=localhost';
        private static $bdd='dbname=netbouqueet';  
      	private static $user='root' ;    		
      	private static $mdp='' ;	
	private static $monPdo;                
	private static $monPdoBouquet=null;     
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
            PdoBouquet::$monPdo = new PDO(PdoBouquet::$serveur.';'.PdoBouquet::$bdd, PdoBouquet::$user, PdoBouquet::$mdp); 
            PdoBouquet::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
            PdoBouquet::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe 
 * Appel : $instancePdoBouquet = PdoBouquet::getPdoBouquet();
 * @return l'unique objet de la classe PdoBouquet
 */
    public static function getPdoBouquet(){
	if(PdoBouquet::$monPdoBouquet==null){
		PdoBouquet::$monPdoBouquet= new PdoBouquet();
	}
	return PdoBouquet::$monPdoBouquet;  
    }
   
//================PARTIE PUBLIQUE ==============================================
/** 
 * Retourne tous les id et libellé de la table Categorie
 * @return un tableau associatif
 */   
    public function getLesCategories()
    {
        $res = PdoBouquet::$monPdo->query("select * from categorie");   //la requête
        $lesLignes = array();           // déclare un tableau vide
        $lesLignes =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecthAll
        return $lesLignes;    
    }      
    
 /**
 * Retourne la liste de tous les produits sous la forme d'un tableau associatif 
 * @return un tableau associatif
 */  
    
    public function getTousLesProduits()
    {
        $res = PdoBouquet::$monPdo->query("select * from produit");   //la requête
        $lesLignes = array();           // déclare un tableau vide
        $lesLignes =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecthAll
        return $lesLignes;    
    }
    /**
     * Retourne la liste des produits d'une categorie sous la forme d'un tableau associatif 
     * @param la categorie souhaitée $idCategorie
     * @return un tableau associatif 
     */
    public function getLesProduitsCategorie($idCategorie)
    {
        $res = PdoBouquet::$monPdo->query("select * from produit where idCategorie='$idCategorie'");   //la requête
        $lesLignes = array();           // déclare un tableau vide
        $lesLignes =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecthAll
        return $lesLignes;    
    }   
    
//================CONNEXION ==============================================

 /**
 * Retourne le nom et le statut d'un utilisateur
 * @param $login 
 * @param $mdp
 * @return le nom et le statut sous la forme d'un tableau associatif
*/
    public function getInfosUtilisateur($login, $mdp){
        
        $mdp = $mdp;
        $req = "select utilisateur.nom as nom, utilisateur.statut as statut from utilisateur
        where login='$login' and mdp='$mdp'";
        $res = PdoBouquet::$monPdo->query($req);
        $ligne = $res->fetch();
        return $ligne;
    } 
        
//================PARTIE 3 ADMIN GERER PRODUIT ==============================      
        
/**
 * Supprime le produit id dans la base de données
 * @param $id
 * @return le nombre de ligne affectée (0 ou 1)
 */
        public function supprimerProduit($id)
        {
            $req = "delete from produit where id=$id" ;
           // echo $req; die();
            $nbLigne = PdoBouquet::$monPdo->exec($req);
            return $nbLigne;  
        }

  /**
  *Ajoute un produit dans la base de données
  * @param  $nom
  * @param  $image
  * @param  $description
  * @param  $prix
  * @param  $idCategorie
  * @return le nombre de ligne affectée par la requête
  */              
     public function ajouterProduit($nom, $image, $description, $prix, $idCategorie)
     {
         $req = "insert into produit values (NULL, '$nom', '$image', '$description', '$prix', '$idCategorie')";
         $nbLigne = PdoBouquet::$monPdo->exec($req);
         return $nbLigne;  
     }
     
   /**
  *Modifie dans la base de données le produit passé en arguement
  * @param  $id
  * @param  $nom
  * @param  $image
  * @param  $description
  * @param  $prix
  * @param  $idCategorie
  * @return le nombre de ligne affectée par la requête
  */      
   public function modifierProduit($id, $nom, $image, $description, $prix, $idCategorie)
   {
        $req = "update produit set nom='$nom', image='$image', description='$description', prix='$prix', idCategorie='$idCategorie' where id='$id'";
        //echo $req;
        $nbLigne = PdoBouquet::$monPdo->exec($req);
        //echo "<<<".$nbLigne;
        return $nbLigne;       
    }  
    
   /**
    *Récupère l'identifiant du dernier produit inséré
    * @return le dernier id inséré 
    */
     public function getLastId()
     {
         return PdoBouquet::$monPdo->lastInsertId();
     }
    
 /**
 * Retourne les informations du produit passé en argument sous la forme d'un tableau associatif
 * @return un tableau associatif d'une ligne
 */ 
    public function getProduit($id)
    {
        $res = PdoBouquet::$monPdo->query("select * from produit where id=$id");   //la requête
        $laLigne = array();           // déclare un tableau vide
        $laLigne =  $res->fetch();  //rempli le tableau à l'aide de la methode fecth
        return $laLigne;   
    }
 //================TRAVAIL ENTRAINEMENT ==========================================================


    public function getCommandesTrieParDate()
    {
        // Écrire la requête SQL
        $res = PdoBouquet::$monPdo->query("select * from commande order by dateCommande");
        
        $laLigne = array();           // déclare un tableau vide
        $laLigne =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecth
        return $laLigne;  
       
    }
    public function getCommandesTrieParNom()
    {
        // Écrire la requête SQL
        $res = PdoBouquet::$monPdo->query("select * from commande order by loginUtilisateur");
        
        $laLigne = array();           // déclare un tableau vide
        $laLigne =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecth
        return $laLigne;  
       
    }
    public function RechercheNom($nom)
    {
        // Écrire la requête SQL
        $res = PdoBouquet::$monPdo->query("select * from utilisateur where nom LIKE '$nom%' and statut = 'client'");
        
        
        $laLigne = array();           // déclare un tableau vide
        $laLigne =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecth
        return $laLigne;  
       
    }

    public function AfficherLesNoms()
    {
        // Écrire la requête SQL
        $res = PdoBouquet::$monPdo->query("select * from utilisateur WHERE statut = 'client' Order by nom ");
        
        
        $laLigne = array();           // déclare un tableau vide
        $laLigne =  $res->fetchAll();  //rempli le tableau à l'aide de la methode fecth
        return $laLigne;  
       
    }

    
    
           
}//fin classe
?>
