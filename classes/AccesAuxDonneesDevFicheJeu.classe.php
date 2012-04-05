<?php
/**
* Classe de gestion de l'accès à la base de donnée
*
*/

// Inclusions
require_once("classes/AccesAuxDonnees.classe.php");

//Constantes - paramètre du système
define("BASE_DEV","mdjtufjjpdev");

// Constantes - Definition des Tables SQL
define("TABLE_CATEGORIE", TABLE_PREFIX . "CATEGORIE");
define("TABLE_CATEGORIE_JEUX", TABLE_PREFIX . "CATEGORIE_JEUX");
define("TABLE_EMPRUNT", TABLE_PREFIX . "EMPRUNT");
define("TABLE_ETAT_EXEMPLAIRE", TABLE_PREFIX . "ETAT_EXEMPLAIRE");
define("TABLE_EXEMPLAIRE", TABLE_PREFIX . "EXEMPLAIRE");
define("TABLE_EXTENSION", TABLE_PREFIX . "EXTENSION");
define("TABLE_FAIRE_PARTIE_KIT", TABLE_PREFIX . "FAIRE_PARTIE_KIT");
define("TABLE_INVENTAIRE", TABLE_PREFIX . "INVENTAIRE");
define("TABLE_JEUX", TABLE_PREFIX . "JEUX");
define("TABLE_KIT_JEUX", TABLE_PREFIX . "KIT_JEUX");
define("TABLE_LANGUE", TABLE_PREFIX . "LANGUE");
define("TABLE_LANGUE_REGLE", TABLE_PREFIX . "LANGUE_REGLE");
define("TABLE_LIEU", TABLE_PREFIX . "LIEU");
define("TABLE_NB_JOUEUR", TABLE_PREFIX . "NB_JOUEUR");
define("TABLE_NB_JOUEUR_VERSION_JEU", TABLE_PREFIX . "NB_JOUEUR_VERSION_JEU");
define("TABLE_NOM_JEU", TABLE_PREFIX . "NOM_JEU");
define("TABLE_NOTE_VERSION", TABLE_PREFIX . "NOTE_VERSION");
define("TABLE_PAYS", TABLE_PREFIX . "PAYS");
define("TABLE_PHOTO", TABLE_PREFIX . "PHOTO");
define("TABLE_PHOTO_VERSION", TABLE_PREFIX . "PHOTO_VERSION");
define("TABLE_RESERVATION", TABLE_PREFIX . "RESERVATION");
define("TABLE_SUGGESTION", TABLE_PREFIX . "SUGGESTION");
define("TABLE_VERSION", TABLE_PREFIX . "VERSION");

// Définition des champs de la table TABLE_CATEGORIE
define("ID_CATEGORIE", "idCategorie");
define("NOM_CATEGORIE", "nomCategorie");
define("DESCRIPTION_CATEGORIE", "descriptionCategorie");

// Définition des champs de la table TABLE_CATEGORIE_JEU
define("ID_CATEGORIE_JEU", "idCategorieJeu");

// Définition des champs de la table TABLE_EMPRUNT
define("ID_EMPRUNT", "idEmprunt");
define("DATE_EMPRUNT", "dateEmprunt");
define("DATE_RETOUR_SOUHAITE", "dateRetourSouhaite");
define("DATE_RETOUR_REEL", "dateRetourReel");

// Définition des champs de la table TABLE_ETAT_EXEMPLAIRE
define("ID_ETAT_EXEMPLAIRE", "idEtatExemplaire");
define("NOM_ETAT", "nomEtat");

// Définition des champs de la table TABLE_EXEMPLAIRE
define("ID_EXEMPLAIRE", "idExemplaire");
define("DESCRIPTION_EXEMPLAIRE", "descriptionExemplaire");
define("PRIX_MDJT", "prixMJDT");
define("DATE_ACHAT", "dateAchat");
define("DATE_FIN_VIE", "dateFinVie");
define("ID_LIEU_REEL", "idLieuReel");
define("ID_LIEU_TEMPO", "idLieuTempo");

// Définition des champs de la table TABLE_EXTENSION
define("ID_EXTENSION", "idExtension");
define("NATURE", "nature");
define("ID_VERSION_BASE", "idVesionBase");
define("ID_VERSION_EXTENSION", "idVersionExtension");

// Définition des champs de la table TABLE_FAIRE_PARTIE_KIT
define("ID_FAIRE_PARTIE_KIT", "idFairePartieKit");

// Définition des champs de la table TABLE_INVENTAIRE
define("ID_INVENTAIRE", "idInventaire");
define("DATE_INVENTAIRE", "dateInventaire");
define("COMMENTAIRE_INVENTAIRE", "commentaireInventaire");

// Définition des champs de la table TABLE_JEUX
define("ID_JEU", "idJeu");
define("DESCRIPTION_JEU", "descriptionJeu");
define("AUTEUR", "auteur");

// Définition des champs de la table TABLE_KIT_JEUX
define("ID_KIT_JEU", "idKitJeu");
define("NOM_KIT", "nomKit");
define("DESCRIPTIOIN_KIT", "descriptionKit");

// Définition des champs de la table TABLE_LANGUE
define("ID_LANGUE", "idLangue");
define("NOM_LANGUE", "nomLangue");

// Définition des champs de la table TABLE_LANGUE_REGLE
define("ID_LANGUE_REGLE", "idLangueRegle");

// Définition des champs de la table TABLE_LIEU
define("ID_LIEU", "idLieu");
define("NOM_LIEU", "nomLieu");

// Définition des champs de la table TABLE_NB_JOUEUR
define("ID_NB_JOUEUR", "idNbJoueur");
define("NB_JOUEUR", "nbJoueur");

// Définition des champs de la table TABLE_NB_JOUEUR_VERSION_JEU
define("ID_NB_JOUEUR_JEU", "idNbJoueurJeu");

// Définition des champs de la table TABLE_NOM_JEU
define("ID_NOM_JEU", "idNomJeu");
define("NOM_JEU", "nomJeu");

// Définition des champs de la table TABLE_NOTE_VERSION
define("ID_NOTE_VERSION", "idNoteVersion");
define("NOTE_VERSION", "noteVersion");
define("COMMENTAIRE_NOTE_VERSION", "commentaireNoteVersion");

// Définition des champs de la table TABLE_PAYS
define("ID_PAYS", "idPays");
define("NOM_PAYS", "nomPays");

// Définition des champs de la table TABLE_PHOTO
define("ID_PHOTO", "idPhoto");
define("NOM_PHOTO", "nomPhoto");
define("TEXTE_ALTERNATIF", "texteAlternatif");

// Définition des champs de la table TABLE_PHOTO_VERSION
define("ID_PHOTO_VERSION", "idPhotoVERSION");

// Définition des champs de la table TABLE_RESERVATION
define("ID_RESERVATION", "idReversation");
define("DATE_SOUHAITE_EMPRUNT", "dateSouhaiteEmprunt");

// Définition des champs de la table TABLE_SUGGESTION
define("ID_SUGGESTION", "idSuggestion");
define("COMMENTAIRE_SUGGESTION", "commentaireSugeestion");
define("ETAT_SUGGESTION", "etatSuggestion");

// Définition des champs de la table TABLE_VERSION
define("ID_VERSION", "idVersion");
define("NOM_VERSION", "nomVersion");
define("DESCRIPTION_VERSION", "descriptionVersion");
define("AGE_MINIMUM", "ageMinimum");
define("NB_JOUEUR_RECOMMANDE", "nbJoueurRecommande");
define("DUREE_PARTIE", "dureePartie");
define("PRIX_ACHAT", "prixAchat");
define("ANNEE_SORTIE", "anneeSortie");
define("ILLUSTRATEUR", "illustrateur");
define("DISTRIBUTEUR", "distributeur");
define("EDITEUR", "editeur");





class AccesAuxDonneesDevFicheJeu
{

// Attributs
	// Variable de classe stockant le premier objet créé
	// Sert à garantir qu'on ne créera qu'un seul objet
	private static $connexionBaseDev = NULL;
	// Objet d'acces a la base
	private $maBase = NULL;
	// Est-on déjà connecté à la base - sert à éviter les connexions multiples
	private $estConnecte = NULL;

// Methodes

	/*
	* Le constructeur d'une connexion à la base
	*/
	public function __construct()
	{
		// A la création de l'objet, on est pas connecté à la base
		$this->estConnecte = FALSE;
	}

	// On interdit le clonage de cet objet	
        public function __clone()
        {
            trigger_error("Clonage d'accès aux données interdit.", E_USER_ERROR);
        }

	// On interdit de reveiller un objet AccesAuxDonnees sérialisé
        public function __wakeup()
        {
            trigger_error("Unserializing is not allowed.", E_USER_ERROR);
        }
	
	//
	// Outils à usage externe
	//
	
	/** Les trois fonctions qui suivent gérent la base dev */
	
	/**
	* Fonction statique de création d'un accès aux données
	* Cette fonction vérifie qu'un accès aux données n'existe pas avant
	* Elle renvoi l'accès pré-existant, ou un nouvel accès
	*
	* C'est cette fonction qui doit être utilisée 
	* chaque fois qu'on veut avoir accès aux données
	*/
	public static function recupAccesDonneesDev()
	{
		// Initialisation de l'accès à la Base de Donnees
		// Si on a pas encore d'objet d'accès aux donnees
		if ( self::$connexionBaseDev == NULL )
		{
			// On en crée un et on stocke cette connexion dans la variable de classe
			self::$connexionBaseDev = new AccesAuxDonneesDevFicheJeu();
			return self::$connexionBaseDev;
		}
		else
		{
			// Sinon, on récupère celle qui existe déjà
			return self::$connexionBaseDev;
		}
	}
	/**
        * Fonction de connexion à la base de donnée "dev"
        * Cette fonction initie la connexion à la base de données
        * Uniquement si ce n'est pas déjà fait.
        * On l'utilise donc au début de chaque requête dev
        */
        private function connecteBaseDev()
        {
            // On initie la connexion uniquement si elle n'est pas déjà faite
            if ($this->estConnecte == FALSE)
            {
                try 
                {
                    // Connexion en mode debug
                    $option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $this->maBase = new PDO("mysql:host=" . SERVEUR . ";dbname=" . BASE_DEV, LOGIN, MDP,$option);
                    // Connexion normale
                    // $this->maBase = new PDO("mysql:host=" . SERVEUR . ";dbname=" . BASE_DEV, LOGIN, MDP);
                } 
                catch (PDOException $e)
                {
                        // Accès à la base impossible
                        print "Connexion a la base de donnee dev impossible <br/>";
                        die();
                }
                $this->estConnecte = TRUE;
            }
	}
	
        
	/**
	* Fonction générique de requête type sélection dans la base
	*/
	private function requeteSelectDev($uneRequeteSQL)
	{
		// On initie la connexion à la base, si ce n'est déjà fait
		$this->connecteBaseDev();	
		// Si on a bien une connexion à la base
		if ($this->estConnecte)
		{
			// On récupère les résultats sous forme d'un objet PDOStatement
			$resultat = $this->maBase->query($uneRequeteSQL);
			if ($resultat == false)
			{
				// La requete a échoué
				return false;
			}
			else 
			{
				// On récupère le resultat de la requete sous la forme d'un tableau
				$tableauResultat = $resultat->fetchAll();
				// On ferme l'objet PDOStatement
				$resultat->closeCursor();
				// On renvoie le tableau avec les résultats de la requête
				return $tableauResultat;
			}
		}
		else 
		{ // Sinon, pas de connexion à la base
			// La requete a échoué
			return false;
		}
	}
	
	//
	// Requêtes accessibles au reste du site
	//
	
	/**
	* Fonction de récupération des informations d'un jeu
	* Entrée : l'id de ce jeu
	* Sortie : le tableau correspondant à ce jeu
	* Si le jeu n'existe pas en base, renvoi false
	*/
	public function recupInfoJeu($uneID)
	{
		// Protection contre injection SQL
		if ( intval($uneID) )
		{			
			// construction de la requete SQL permettant de recuperer les info de 
			// la version et le jeu associés à l'idJeu 
			$requete = 	"SELECT v.".ID_JEU.",".DESCRIPTION_JEU.",".AUTEUR.",".ID_PAYS.","
										.NOM_VERSION.",".DESCRIPTION_VERSION.",".AGE_MINIMUM.","
											.NB_JOUEUR_RECOMMANDE.",".DUREE_PARTIE.",".PRIX_ACHAT.","
											.ANNEE_SORTIE.",".ILLUSTRATEUR.",".DISTRIBUTEUR.",".EDITEUR."
								FROM ".TABLE_JEUX." j 
								INNER JOIN ".TABLE_VERSION." v
								ON v.".ID_JEU." = j.".ID_JEU."
								WHERE ".ID_VERSION." = ".$uneID . " ";

			// Execution 
			$monJeu = $this->requeteSelectDev($requete);
			
			// Si l'utilisateur n'existe pas dans la base
			if (count($monJeu) == 0)
			{
				return false;
			}
			else // L'utilisateur existe dans la base
			{
				// On renvoie juste la ligne le concernant
				// Il ne doit pas exister 2 utilisateurs de même id 
				// donc le tableau fait toujours 1 ligne
				return $monJeu[0];
			}
		}
		else
		{
			return false;
		}
	}
	
	
	/**
	* Fonction de récupération du nom du jeu
	* Entrée : l'id du jeu
	* Sortie : le(s) nom(s) du jeu
	* Si le jeu n'existe pas en base, renvoi false
	*/
	public function recupJeuLangue($uneID)
	{
		// Protection contre injection SQL
		if ( intval($uneID) )
		{			
			// construction de la requete SQL permettant de recuperer les langues associées au jeu
			$requete = 	"SELECT ".NOM_JEU."
						FROM ".TABLE_NOM_JEU." j 
						WHERE ".ID_JEU." = ".$uneID . " ";

			// Execution 
			$monJeuLangue = $this->requeteSelectDev($requete);
			
			// Si l'utilisateur n'existe pas dans la base
			if (count($monJeuLangue) == 0)
			{
				return false;
			}
			else // L'utilisateur existe dans la base
			{
				// On renvoie juste la ligne le concernant
				// Il ne doit pas exister 2 utilisateurs de même id 
				// donc le tableau fait toujours 1 ligne
				return $monJeuLangue;
			}
		}
		else
		{
			return false;
		}
	}
	
	/**
	* Fonction de récupération de la photo de la version
	* Entrée : l'id de la version
	* Sortie : le chemin de l'image (type "image.xxx")
	*/
	public function recupPhotoVersion($uneID)
	{
		// Protection contre injection SQL
		if ( intval($uneID) )
		{			
			// construction de la requete SQL permettant de recuperer la photo associée a la version du jeu
			$requete = 	"SELECT ".NOM_PHOTO."
						FROM ".TABLE_PHOTO." p ,".TABLE_PHOTO_VERSION." pv, ".TABLE_VERSION." v 
						WHERE v.".ID_VERSION." = ".$uneID."
						AND	v.".ID_VERSION."=pv.".ID_VERSION."
						AND	pv.".ID_PHOTO."=p.".ID_PHOTO."" ;

			// Execution 
			$maPhotoVersion = $this->requeteSelectDev($requete);
			
			// Si l'utilisateur n'existe pas dans la base
			if (count($maPhotoVersion) == 0)
			{
				return false;
			}
			else // L'utilisateur existe dans la base
			{
				// On renvoie juste la ligne le concernant
				// Il ne doit pas exister 2 utilisateurs de même id 
				// donc le tableau fait toujours 1 ligne
				return $maPhotoVersion;
			}
		}
		else
		{
			return false;
		}
	}

        
    /**
	* Fonction de mise à jour des informations d'un utilisateur
	* Entrée : l'id de cet utilisateur et toutes les informations associées
	* Sortie : true si la mise à jour s'est bien passée, sinon false
	*/
	public function miseAJourInfoUtilisateur($uneID,$unTitre,$unNom,$unPrenom,$unEmail,$actif,$uneAdresse,$unCodePostal,$unTelephone,$unPortable,$dateDeNaissance,$uneProfession,$dateAdhesion,$dateCotisation,$exemptCotisation,$commentaires)
	{
		// Protection contre injection SQL
		if ( intval($uneID) )
		{
                    // On initie la connexion à la base, si ce n'est déjà fait
                    $this->connecteBase();
                    // Création de la requete
                    $requete = $this->maBase->prepare("UPDATE " .
				TABLE_UTILISATEURS .
				" SET " .
                                TITRE .
                                "=?," .
                                NOM .
                                "=?," .
                                PRENOM .
                                "=?," .
                                EMAIL .
                                "=?," .
                                ACTIF .
                                "=?," .
                                ADRESSE .
                                "=?," .
                                TELEPHONE .
                                "=?," .
                                PORTABLE .
                                "=?," .
                                DATE_NAISSANCE .
                                "=?," .
                                PROFESSION .
                                "=?," .
                                DATE_ADHESION .
                                "=?," .
                                DATE_COTISATION .
                                "=?," .
                                EXEMPT_COTISATION .
                                "=?," .
                                COMMENTAIRES .
                                "=? WHERE " .
                                ID_UTILISATEUR .
                                "=?;");
                    $requete->bindValue(1, $unTitre, PDO::PARAM_STR);
                    $requete->bindValue(2, $unNom, PDO::PARAM_STR);
                    $requete->bindValue(3, $unPrenom, PDO::PARAM_STR);
                    $requete->bindValue(4, $unEmail, PDO::PARAM_STR);
                    $requete->bindValue(5, $actif, PDO::PARAM_BOOL);
                    $requete->bindValue(6, $uneAdresse, PDO::PARAM_STR);
                    $requete->bindValue(7, $unTelephone, PDO::PARAM_STR);
                    $requete->bindValue(8, $unPortable, PDO::PARAM_STR);
                    $requete->bindValue(9, $dateDeNaissance, PDO::PARAM_STR);
                    $requete->bindValue(10, $uneProfession, PDO::PARAM_STR);
                    $requete->bindValue(11, $dateAdhesion, PDO::PARAM_STR);
                    $requete->bindValue(12, $dateCotisation, PDO::PARAM_STR);
                    $requete->bindValue(13, $exemptCotisation, PDO::PARAM_BOOL);
                    $requete->bindValue(14, $commentaires, PDO::PARAM_STR);
                    $requete->bindValue(15, $uneID, PDO::PARAM_INT);
                    $resultat = $requete->execute();

                    // On termine l'utilisation de la requete
                    $requete->closeCursor();
		}
		else
		{
			return false;
		}
	}
        
        
	/**
	* Fonction de récupération de la liste des types d'adhérents disponibles
	* Sortie : le tableau contenant cette liste
	*/
	public function recupTypesAdherent()
	{
		$laListe = $this->requeteSelect(
			"SELECT " .
			TYPE_ADHERENT .
			" FROM " .
			TABLE_TYPE_ADHERENT
			);
		return $laListe;
	}
        
    
        
        
        /**
         * Fonction permettant de convertir les données stockées en base vers les données réelles
         * notamment en supprimant les caractères d'échappement.
         * @param type $uneVariable 
         */
        public function conversionDepuisBase($uneVariable)
        {
            return stripslashes($uneVariable);
        }

}

?>
