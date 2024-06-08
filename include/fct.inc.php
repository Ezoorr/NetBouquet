<?php
/** 
 * Fonctions pour l'application NetBouquet
 * @package default
 * @author  PG
 * @version    1.0
 */

/**
 * Ajoute le libellé d'une erreur au tableau des erreurs 
 * @param $msg : le libellé de l'erreur 
 */
function ajouterErreur($msg){
    if (! isset($_REQUEST['erreurs'])){
      $_REQUEST['erreurs']=array();
    } 
    $_REQUEST['erreurs'][]=$msg;
}

/**
 * Retoune le nombre de lignes du tableau des erreurs 
 * @return le nombre d'erreurs
 */
function nbErreurs(){
    if (!isset($_REQUEST['erreurs'])){
        return 0;
    }
    else{
        return count($_REQUEST['erreurs']);
    }
}

/**
 * Enregistre dans une variable session les infos d'un utilisateur
 * @param $login
 * @param $nom
 * @param $statut
 */
function connecter($login,$nom,$statut){
    $_SESSION['login']= $login; 
    $_SESSION['nom']= $nom;
    $_SESSION['statut']= $statut;
}

 /**
 * Teste si un quelconque utilisateur est connecté
 * @return vrai ou faux 
 */
function estConnecte(){
    return isset($_SESSION['login']);
}

/**
 * Détruit la session active
 */
function deconnecter(){
    session_destroy();
}


//===================================AJOUTER EN PARTIE 3 =============================
/**
 *Vérifie que l'extension passée en argument est bonne
 * @param  $extension
 * @return true si les extensions sont bonnes, false sinon 
 */
function estImageValide($extension)
{
    if ($extension=="image/jpg" || $extension=="image/png" || $extension=="image/gif" || $extension=="image/jpeg")
        return true;
    else 
        return false;
}

/**
 * Vérifie la validité des 4 arguments : le nom, l'image, la description, le prix 
 * des message d'erreurs sont ajoutés au tableau des erreurs
 * @param $nom 
 * @param $image 
 * @param $description
 * @param $prix
 * @param $extention
 */
function valideInfosProduit($nom, $image, $description, $prix, $extension){
	if($nom==""){
            ajouterErreur("Le champ nom ne peut pas être vide");
	}

        if($image==""){
            ajouterErreur("Le champ image ne peut pas être vide");
	}
       	else
            if (!estImageValide($extension)) 
                ajouterErreur("Le format de l'image n'est pas autorisé");
     	
        if($description==""){
            ajouterErreur("Le champ description ne peut pas être vide");
	}      
            
	if($prix==""){
            ajouterErreur("Le champ montant ne peut pas être vide");
	}
        //	else  //pas traité pour l’instant
       //      	if(!estValideMontant($prix)) //à faire
       //         	ajouterErreur("Le prix est invalide");
}
//======================== Partie 4 panier ===============================
/**
 * Initialise le panier
 * Crée une variable de type session nommée produits dans le cas où elle n'existe pas 
*/
function initPanier()
{
    if(!isset($_SESSION['produits']))
    {
	$_SESSION['produits']= array();
    }
}

/**
 * Supprime(détruit) le panier
 * Supprime la variable de type session 
 */
function supprimerPanier()
{
    unset($_SESSION['produits']);
}

/**
 * Ajoute un produit au panier
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 * @param $idProduit : identifiant de produit
 * @return vrai si le produit n'était pas dans la variable du panier, faux sinon 
*/
function ajouterAuPanier($idProduit)
{
    $ok = true;
	if(in_array($idProduit,$_SESSION['produits']))
            $ok = false;
	else
            $_SESSION['produits'][]= $idProduit;
	return $ok;
}

/**
 * Retourne le nombre de produits du panier
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * @return : le nombre 
*/
function nbProduitsDuPanier()
{
    $n = 0;
	if(isset($_SESSION['produits']))
	{
            $n = count($_SESSION['produits']);
	}
    return $n;
}

/**
 * Vérifie si le produit est dans le panier
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * @param $idProduit : identifiant de produit
 * @return vrai si le produit est dans la variable du panier, faux sinon 
*/
function estDansLePanier($idProduit)
{
        if(in_array($idProduit,$_SESSION['produits']))
            $ok = true;
        else
            $ok = false;	
    return $ok;
}

/**
 * Retire un des produits du panier
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 * @param $idProduit : identifiant de produit
*/
function retirerDuPanier($idProduit)
{
    $index =array_search($idProduit,$_SESSION['produits']);
    unset($_SESSION['produits'][$index]);
}

?>
