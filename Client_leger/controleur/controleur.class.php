<?php
	require_once("modele/modele.class.php");

	class Controleur {
		private $unModele;

		public function __construct () {
			$this->unModele = new Modele();
		}

/****** Gestion des Clients ******/
		public function insert_client($tab){
			// controler les données de la client

			// on appelle le modele pour l'insertion
			$this->unModele->insert_client($tab);
		}

		public function selectAll_clients() {
			$lesClients = $this->unModele->selectAll_clients();

			return $lesClients;
		}

		public function selectLike_clients($filtre) {
			$lesClients = $this->unModele->selectLike_clients($filtre);

			return $lesClients;
		}

		public function delete_client($idclient) {
			// controle des données

			// appel du modele
			$this->unModele->delete_client($idclient);
		}

		public function update_client($tab) {
			// controle des données

			// appel du modele
			$this->unModele->update_client($tab);
		}

		public function selectWhere_client($idclient) {
			$unClient = $this->unModele->selectWhere_client($idclient);

			return $unClient;
		}

/****** Gestion des Moniteurs ******/
	    public function insert_moniteur($tab) {
	        $this->unModele->insert_moniteur($tab);
	    }

	    public function selectAll_moniteurs() {
	        return $this->unModele->selectAll_moniteurs();
	    }

	    public function selectLike_moniteurs($filtre) {
	        return $this->unModele->selectLike_moniteurs($filtre);
	    }

	    public function delete_moniteur($idmoniteur) {
	        $this->unModele->delete_moniteur($idmoniteur);
	    }

	    public function update_moniteur($tab) {
	        $this->unModele->update_moniteur($tab);
	    }

	    public function selectWhere_moniteur($idmoniteur) {
	        return $this->unModele->selectWhere_moniteur($idmoniteur);
	    }

	    public function select_moniteur($identifiant, $mdp) {
			$unMoniteur = $this->unModele->select_moniteur($identifiant, $mdp);

			return $unMoniteur;
		}


/****** Gestion des Leçons ******/
	    public function insert_lecon($tab) {
	        $this->unModele->insert_lecon($tab);
	    }

	    public function selectAll_lecons() {
	        return $this->unModele->selectAll_lecons();
	    }

	    public function selectLike_lecons($filtre) {
	        return $this->unModele->selectLike_lecons($filtre);
	    }

	    public function delete_lecon($idlecon) {
	        $this->unModele->delete_lecon($idlecon);
	    }

	    public function update_lecon($tab) {
	        $this->unModele->update_lecon($tab);
	    }

	     public function selectWhere_lecon($numero_lecon) {
	        return $this->unModele->selectWhere_lecon($numero_lecon);
	    }

	  	public function selectWhere_lecon_c($numero_client) {
	        return $this->unModele->selectWhere_lecon($numero_client);
	    }

	    public function selectLeconsAttente($numero_client) {
		    return $this->unModele->selectLeconsAttente($numero_client);
		}

		public function selectLeconsConfirmees($numero_client) {
		    return $this->unModele->selectLeconsConfirmees($numero_client);
		}

		public function selectLeconsRefusees($numero_client) {
		    return $this->unModele->selectLeconsRefusees($numero_client);
		}

		public function updateStatusLecon($numero_lecon, $statut) {
		    $this->unModele->updateStatusLecon($numero_lecon, $statut);
		}

		public function selectLeconsMoniteur($numero_moniteur) {
		    return $this->unModele->selectLeconsMoniteur($numero_moniteur);
		}


/****** Gestion des Voitures ******/
	    public function insert_voiture($tab) {
	        $this->unModele->insert_voiture($tab);
	    }

	    public function selectAll_voitures() {
	        return $this->unModele->selectAll_voitures();
	    }

	    public function selectLike_voitures($filtre) {
	        return $this->unModele->selectLike_voitures($filtre);
	    }

	    public function delete_voiture($numero_immatriculation) {
	        $this->unModele->delete_voiture($numero_immatriculation);
	    }

	    public function update_voiture($tab) {
	        $this->unModele->update_voiture($tab);
	    }

	    public function selectWhere_voiture($numero_immatriculation) {
	        return $this->unModele->selectWhere_voiture($numero_immatriculation);
	    }

/****** Gestion des Users ******/
		public function select_user($identifiant, $mdp) {
			$unUser = $this->unModele->select_user($identifiant, $mdp);

			return $unUser;
		}

		public function insert_user($tab){
			this->unModele->insert_user($tab);
		}

	    /****** Gestion des Formations ******/
	    
		public function insert_formation($tab) {
		    $this->unModele->insert_formation($tab);
		}

		public function selectAll_formation() {
		    return $this->unModele->selectAll_formation();
		}

		public function selectLike_formation($filtre) {
		    return $this->unModele->selectLike_formation($filtre);
		}

		public function delete_formation($idformation) {
		    $this->unModele->delete_formation($idformation);
		}

		public function update_formation($tab) {
		    $this->unModele->update_formation($tab);
		}

		public function selectWhere_formation($idformation) {
		    return $this->unModele->selectWhere_formation($idformation);
		}



		/****** Gestion des Achats de Formations ******/

		public function insert_achete($tab) {
		    // contrôle éventuel des données
		    $this->unModele->insert_achete($tab);
		}

		public function selectAll_achetes() {
		    $lesAchats = $this->unModele->selectAll_achetes();
		    return $lesAchats;
		}

		public function selectLike_achetes($filtre) {
		    $lesAchats = $this->unModele->selectLike_achetes($filtre);
		    return $lesAchats;
		}

		public function delete_achete($numero_formation, $numero_client) {
		    // contrôle éventuel
		    $this->unModele->delete_achete($numero_formation, $numero_client);
		}

		public function update_achete($tab) {
		    // contrôle éventuel
		    $this->unModele->update_achete($tab);
		}

		public function selectWhere_achete($numero_formation, $numero_client) {
		    $unAchat = $this->unModele->selectWhere_achete($numero_formation, $numero_client);
		    return $unAchat;
		}

		/****** Gestion des Formations ******/

		public function selectWhere_formation_nom($nom_formation) {
	    	return $this->unModele->selectWhere_formation_nom($nom_formation);
		}


		public function selectFormationsByClient($numero_client) {
		    return $this->unModele->selectFormationsByClient($numero_client);
		}


		public function selectNomFormation($id) {
		    return $this->unModele->selectNomFormation($id);
		}


/****** Gestion des Examens ******/
		public function selectExamensClient($numero_client) {
		    return $this->unModele->selectExamensClient($numero_client);
		}

		public function selectExamensMoniteur($numero_moniteur) {
		    return $this->unModele->selectExamensMoniteur($numero_moniteur);
		}


	}
?>