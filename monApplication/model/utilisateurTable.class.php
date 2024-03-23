<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

  public static function getUserByLoginAndPass($login,$pass)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$userRepository = $em->getRepository('utilisateur');
	$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => $pass));	
	
	if ($user == false){
		echo 'Erreur sql';
			   }
	return $user; 
	}


  public static function getUserById($id) 
  {
	
	// Récupération le référentiel (repository) pour l'entité 'utilisateur'
	$em = dbconnection::getInstance()->getEntityManager();
	$userRepository = $em->getRepository('utilisateur');

	// Recherche d'un utilisateur par son identifiant (id)
	$user = $userRepository->find($id);

	return $user;
	
  }

  public static function inscription($nom, $prenom, $dateNaissance, $pseudo, $pass,$avatar)
  {
      // Créez une instance de l'entité utilisateur
      $utilisateur = new utilisateur();
      $utilisateur->nom = $nom;
      $utilisateur->prenom = $prenom;
      $utilisateur->dateNaissance = $dateNaissance;
      $utilisateur->identifiant = $pseudo;
      $utilisateur->pass = $pass; 
      $utilisateur->avatar = $avatar;

      // Obtenez l'EntityManager de Doctrine
      $entityManager = dbconnection::getInstance()->getEntityManager();

      // Persistez l'entité dans la base de données
      $entityManager->persist($utilisateur);
      $entityManager->flush();
  }
  
}

?>
