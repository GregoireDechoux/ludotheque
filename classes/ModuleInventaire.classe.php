<?php
/**
* Classe du module "AjoutVersions"
* Le module AjoutVersions permet la gestion des verions, c'est à dire :
*   - La création des occurences des Versions
*/

// Inclusions
require_once("classes/Module.classe.php");

//Constantes
define("MODULE_INVENTAIRE", RACINE_SITE . "module.php?idModule=Inventaire");


								



class ModuleInventaire extends Module
{



// Attributs

	// A-t-on fait un traitement sur le formulaire
	private $traitementFormulaire = false;
	// On stocke la base de données
	private $mabase = null;
	
	private $erreurLoadExemplaire = false;
	private $erreurLoadCodeBarre = false;
	
	private $codeBarre = "";
	private $idExemplaire = 0;
	private $description = "";
	private $prixMDJT;
	private $dateAchat;
	private $dateFinVie;
	private $etatExemplaire = 0;
	private $lieuReel;
	private $lieuTempo = null;
	
	private $idVersion = 0;
	private $nomVersion = "";
	private $idJeu = 0;
	private $nomJeu = "";
	


	
// Methodes
	
    /**
    * Le constructeur du module Mon Profil
    */
    public function __construct($codeBarre)
    {
        // On utilise le constructeur de la classe mère
		parent::__construct();
					
		// On a besoin d'un accès à la base - On utilise la fonction statique prévue
		$this->maBase = AccesAuxDonneesDev::recupAccesDonneesDev();
		
		// On traite le formulaire, le cas échéant
		$this->traiteFormulaire();
				
		
		if($codeBarre != null)
		{
			$ExId = $this->maBase->recupIdExemplaire($codeBarre);
			$this->codeBarre = $codeBarre;

			if($ExId == null)
				$this->erreurLoadExemplaire = true;
			else
				$this->idExemplaire = $ExId;

		}

		if($this->idExemplaire != null)// && intval($idExemplaire))
		{
			$myExemplaire = $this->maBase->recupExemplaire($this->idExemplaire);
			
			if($myExemplaire[0] == null)
				$this->erreurLoadExemplaire = true;
			else
			{
				$this->description = $myExemplaire[0][DESCRIPTION_EXEMPLAIRE];
				$this->prixMDJT = $myExemplaire[0][PRIX_MDJT];
				$this->dateFinVie = $myExemplaire[0][DATE_FIN_VIE];				
				$this->dateAchat = $myExemplaire[0][DATE_ACHAT];
				$this->etatExemplaire = $myExemplaire[0][ID_ETAT_EXEMPLAIRE];
				$this->lieuReel = $myExemplaire[0][ID_LIEU_REEL];
				$this->lieuTempo = $myExemplaire[0][ID_LIEU_TEMPO];
								
				$maVersion = $this->maBase->recupVersion($myExemplaire[0][ID_VERSION]);
				$this->idVersion = $maVersion[0][ID_VERSION];
				$this->nomVersion = $maVersion[0][NOM_VERSION];
				
				$this->idJeu = $maVersion[0][ID_JEU];
				$jeu = $this->maBase->recupNomJeu($this->idJeu);
				
				//var_dump($dateAchat);
				//var_dump($myExemplaire);
	
						
			}
		}
			
		$this->afficheFormulaire();
    }
	
	
	 /**
	 * Fonction de nettoyage des chaine de caractères
     * Prends en paramètre la chaine à filtrer, et la taille max de cette chaine
	 */
	private function filtreChaine($uneChaine,$uneTaille)
	{
		// On supprime les \ rajouté par les Magic Quotes. Si il y a lieu
		if (get_magic_quotes_gpc() == 1)
		{
			$uneChaine = stripslashes($uneChaine);
		}
		// On supprime les balises HTML s'il y en avait
		$resultat = strip_tags($uneChaine);
		// On vérifie sa taille
		$resultat = substr($resultat,0,$uneTaille);
		return $resultat;
	}
    	/**
	* Fonction de conversion des dates
	* Converti les dates stockée en date affichable
	* AAAA-MM-JJ -> jj/mm/aaaa
	*/
	private function dateBaseToAffichage($uneDate)
	{
		$annee = substr($uneDate,0,4);
		$mois = substr($uneDate,5,2);
		$jour = substr($uneDate,8,2);
		$date = $jour . "/" . $mois . "/" . $annee;
		
		if($uneDate == null)
			return "";
		else
			return $date;
	}
	
	/**
	* Fonction de conversion des dates
	* Converti les dates affichée en date stockable en base
	* jj/mm/aaaa -> AAAA-MM-JJ
	*/
	private function dateAffichageToBase($uneDate)
	{
		$jour = substr($uneDate,0,2);
		$mois = substr($uneDate,3,2);
		$annee = substr($uneDate,6,4);
		$date = $annee . "-" . $mois . "-" . $jour;
		
		if($uneDate == null)
			return "";
		else
			return $date;
	}
	
	/**
	* Fonction de vérification d'une date au format d'affichage
	*/
	private function verifDateAffichee($uneDate)
	{
		if (preg_match('#^([0-9]{2})([/-])([0-9]{2})\2([0-9]{4})$#', $uneDate))
		{
			return checkdate(substr($uneDate,3,2), substr($uneDate,0,2), substr($uneDate,6,4));
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Fonction récupérant les informations des jeux dans la requête POST
	 */
	private function recuperationInformationsFormulaire()
	{
	var_dump($_POST);
		// Nettoyage des variables POST récupérées
			
		// Nettoyage de l'id de la version du jeu
		$this->idVersion = $this->filtreChaine($_POST[ID_VERSION], TAILLE_CHAMPS_COURT);		
		
		// Contre injection de code		
		$this->idExemplaire = $this->filtreChaine($_POST[ID_EXEMPLAIRE], TAILLE_CHAMPS_COURT);	
	
		// Nettoyage de code Barre
		$this->codeBarre = $this->filtreChaine($_POST[CODE_BARRE], TAILLE_CHAMPS_LONG);		
				
		// Nettoyage de la Description
		$this->description = $this->filtreChaine($_POST[DESCRIPTION_EXEMPLAIRE], TAILLE_CHAMPS_LONG);
		
		// Nettoyage du Prix MDJT
		$this->prixMDJT = floatval($this->filtreChaine($_POST[PRIX_MDJT], TAILLE_CHAMPS_COURT));
		
		// Vérification de la date achat
		if ($this->verifDateAffichee($_POST[DATE_ACHAT]))
			$this->dateAchat = $this->dateAffichageToBase($_POST[DATE_ACHAT]);
				
		// Vérification de la date de fin de vie
		if ($this->verifDateAffichee($_POST[DATE_FIN_VIE]))
			$this->dateFinVie = $this->dateAffichageToBase($_POST[DATE_FIN_VIE]);
		

		
	}
	
    public function afficheFormulaire()
    {
		//if($this->erreurVersion)
			//$this->ajouteLigne("<p class='erreurForm'>" . $this->convertiTexte("Une erreur est survenue lors de l'ajout de votre version, veuillez réessayer ou contacter l'administrateur") . "</p>");
			
		$this->ouvreBloc("<form method='post' action='" . MODULE_INVENTAIRE . "' id='formProfil'  enctype='multipart/form-data'>");
		
		$this->ajouteLigne("<input type='hidden' name='idExemplaire' value='" . $this->idExemplaire . "' />");
		
		$this->ajouteLigne("<input type='hidden' name='" . ID_VERSION . "' value='" . $this->idVersion . "' />");
		
		$this->ajouteLigne("<input type='hidden' id='". CODE_BARRE."' name='" . CODE_BARRE . "' value='" . $this->convertiTexte($this->codeBarre) ."' />" );
		
		$this->ajouteLigne("<input type='hidden' id='". DATE_ACHAT."' name='" . DATE_ACHAT . "' value='" . $this->convertiTexte($this->dateBaseToAffichage($this->dateAchat)) ."' />" );


		// fieldset : Informations sur l'exemplaire
		$this->ouvreBloc("<fieldset>");
		$this->ajouteLigne("<legend>" . $this->convertiTexte("Informations sur l'exemplaire") . "</legend>");
		$this->ouvreBloc("<ol>");
		
				
		/*$this->ouvreBloc("<li>");
		$this->ajouteLigne("<label for='" . CODE_BARRE . "'>" . $this->convertiTexte("code barre") . "</label>");
		
		$this->fermeBloc("</li>");	*/
				
		// Description
		$this->ouvreBloc("<li>");
		$this->ajouteLigne("<label for='" . DESCRIPTION_EXEMPLAIRE . "'>" . $this->convertiTexte("Description") . "</label>");
		$this->ajouteLigne("<textarea rows='3' id='" . DESCRIPTION_EXEMPLAIRE ."' name='" . DESCRIPTION_EXEMPLAIRE . "'>" . $this->convertiTexte($this->description) . "</textarea>");
		$this->fermeBloc("</li>");
		
		// Prix mdjt
		$this->ouvreBloc("<li>");
		$this->ajouteLigne("<label for='" . PRIX_MDJT . "'>" . $this->convertiTexte("Prix actuel") . "</label>");
		$this->ajouteLigne("<input type='text' id='" . PRIX_MDJT ."' name='"  . PRIX_MDJT . "' value='" . $this->convertiTexte($this->prixMDJT) . "' required='required' />");
		$this->fermeBloc("</li>");

		
		// Data fin de vie
		$this->ouvreBloc("<li>");
		$this->ajouteLigne("<label for='" . DATE_FIN_VIE . "'>" . $this->convertiTexte("Date fin de vie") . "</label>");
		$this->ajouteLigne("<input type='text' id='" . DATE_FIN_VIE . "' maxlength='10' name='" . DATE_FIN_VIE . "' value='" . $this->convertiTexte($this->dateBaseToAffichage($this->dateFinVie)) . "' />");
		$this->fermeBloc("</li>");		
				
		
		$this->fermeBloc("</ol>");
		$this->fermeBloc("</fieldset>");
		
		
		$this->ouvreBloc("<fieldset>");	
		$this->ajouteLigne("<input type='hidden' name='validerInventaire' value='true' />");
		$this->ajouteLigne("<button type='submit' name='ValiderInventaire' value='true'>" . $this->convertiTexte("Valider") . "</button>");
		$this->fermeBloc("</fieldset>");
		
		
		$this->fermeBloc("</form>");
    }
	
	/*
	* Traitement formulaire
	*/
	
	private function traiteFormulaire()
	{

		
		if ($_POST["ValiderInventaire"])
		{
			// Traitement du formulaire
			$this->traitementFormulaire = true;
			
			$this->recuperationInformationsFormulaire();
			
			var_dump($this->dateAchat);
				
			//Il faut récuperer tous les champs
			//if(!$this->maBase->UpdateTableExemplaire($this->idExemplaire, $this->codeBarre, $this->description, $this->prixMDJT, $this->dateAchat, $this->dateFinVie, $this->idVersion, $this->etatExemplaire, $this->lieuReel, $this->lieuTempo))
				//$this->erreurUpdate = true;
						
		}
		
	
	}
	
	

    
}

?>
