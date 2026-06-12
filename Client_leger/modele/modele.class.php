<?php
	class Modele {
		private $unPdo;

		public function __construct(){
			$url = "mysql:host=localhost;dbname=auto_ecole";
			$user = "root";
			$mdp = "";

			try {
				$this->unPdo = new PDO($url, $user, $mdp);
			}
			catch (PDOException $exp){
				echo "<br> Erreur de connexion a ".$url;
				echo $exp->getMessage();
			}
		}

/****** Gestion des clients ******/
        public function insert_client($tab){
            $requete = "insert into Client values 
                (null, :pseudo_client, :nom_client, :prenom_client, :date_naissance_client, :telephone_client, :adresse_client, :code_postal_client, :ville_client, :email_client, :mdp_client);";
            $exec = $this->unPdo->prepare($requete);
            $donnees = array(
                ":pseudo_client"=>$tab["pseudo_client"],
                ":nom_client"=>$tab['nom_client'],
                ":prenom_client"=>$tab['prenom_client'],
                ":date_naissance_client"=>$tab['date_naissance_client'],
                ":telephone_client"=>$tab['telephone_client'],
                ":adresse_client"=>$tab['adresse_client'],
                ":code_postal_client"=>$tab['code_postal_client'],
                ":ville_client"=>$tab['ville_client'],
                ":email_client"=>$tab['email_client'],
                ":mdp_client"=>$tab['mdp_client']
            );
            $exec->execute($donnees);
        }


        public function delete_client($numero_client){
            $requete = "delete from Client where numero_client = :numero_client;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_client"=>$numero_client));
        }

        public function update_client($tab){

            $requete = " update Client SET 
                pseudo_client = :pseudo_client, 
                nom_client = :nom_client,
                prenom_client = :prenom_client,
                date_naissance_client = :date_naissance_client,
                telephone_client = :telephone_client,
                adresse_client = :adresse_client,
                code_postal_client = :code_postal_client,
                ville_client = :ville_client,
                email_client = :email_client,
                mdp_client = :mdp_client
                WHERE numero_client = :numero_client;";

            $exec = $this->unPdo->prepare($requete);

            $exec->execute(array(
                "pseudo_client"        => $tab["pseudo_client"],
                "nom_client"           => $tab["nom_client"],
                "prenom_client"        => $tab["prenom_client"],
                "date_naissance_client"=> $tab["date_naissance_client"],
                "telephone_client"     => $tab["telephone_client"],
                "adresse_client"       => $tab["adresse_client"],
                "code_postal_client"   => $tab["code_postal_client"],
                "ville_client"         => $tab["ville_client"],
                "email_client"         => $tab["email_client"],
                "mdp_client"           => $tab["mdp_client"],
                "numero_client"        => $tab["numero_client"]
            ));
        }


        public function selectWhere_client($numero_client){
            $requete = "select * from Client where numero_client = :numero_client;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_client"=>$numero_client));
            return $exec->fetch();
        }


        public function selectLike_clients($filtre){
            $requete = "select * from Client where 
                nom_client like :filtre or prenom_client like :filtre or
                adresse_client like :filtre or telephone_client like :filtre 
                or pseudo_client like :filtre;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":filtre"=>"%".$filtre."%"));
            return $exec->fetchAll();
        }


        public function selectAll_clients(){
            $requete = "select * from Client;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
            return $exec->fetchAll();
        }

/****** Gestion des Lecons ******/
public function insert_lecon($tab){
    $requete = "insert into Lecon (date_heure_lecon, numero_moniteur, numero_client, numero_immatriculation, statut)
                VALUES (:date_heure_lecon, :numero_moniteur, :numero_client, :numero_immatriculation, 'en attente')";

    try {
        $exec = $this->unPdo->prepare($requete);
        $exec->execute(array(
            ":date_heure_lecon" => $tab['date_heure_lecon'],
            ":numero_moniteur" => $tab['numero_moniteur'],
            ":numero_client" => $tab['numero_client'],
            ":numero_immatriculation" => $tab['numero_immatriculation']
        ));
        return true; // insertion OK

    } catch (PDOException $e) {

    return "Erreur lors de l’ajout de la leçon.";
}

}

public function selectLeconsByClient($numero_client){
    $requete = "select L.*, M.nom_moniteur, M.prenom_moniteur
                FROM Lecon L
                INNER JOIN Moniteur M ON L.numero_moniteur = M.numero_moniteur
                WHERE L.numero_client = :numero_client
                ORDER BY L.date_heure_lecon ASC";

    $stmt = $this->unPdo->prepare($requete);
    $stmt->execute([":numero_client" => $numero_client]);
    return $stmt->fetchAll();
}


        public function selectAll_lecons(){
            $requete = "select * from Lecon;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
            return $exec->fetchAll();
        }

        public function selectLike_lecons($filtre){
            $requete = "select * from Lecon where 
                date_heure_lecon like :filtre or
                numero_moniteur like :filtre or
                numero_client like :filtre;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":filtre"=>"%".$filtre."%"));
            return $exec->fetchAll();
        }

        public function delete_lecon($numero_lecon){
            $requete = "delete from Lecon where numero_lecon = :numero_lecon;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_lecon"=>$numero_lecon));
        }

        public function update_lecon($tab){
            $requete = "update Lecon set 
                date_heure_lecon = :date_heure_lecon,
                numero_moniteur = :numero_moniteur,
                numero_client = :numero_client,
                numero_immatriculation = :numero_immatriculation,
                where numero_lecon = :numero_lecon;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(
                ":numero_lecon"=>$tab['numero_lecon'],
                ":date_heure_lecon"=>$tab['date_heure_lecon'],
                ":numero_moniteur"=>$tab['numero_moniteur'],
                ":numero_client"=>$tab['numero_client'],
                ":numero_immatriculation" => $tab['numero_immatriculation']
            ));
        }

        public function selectWhere_lecon($numero_lecon){
            $requete = "select * from Lecon where numero_lecon = :numero_lecon;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_lecon"=>$numero_lecon));
            return $exec->fetch();
        }



        public function selectWhere_lecon_c($numero_client){
            $requete = "select * from Lecon where numero_client = :numero_client;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_client"=>$numero_client));
            return $exec->fetch();
        }

        public function selectLeconsAttente($numero_client) {
            $requete = "SELECT L.*, M.nom_moniteur, V.numero_immatriculation
                FROM Lecon L
                JOIN Moniteur M ON L.numero_moniteur = M.numero_moniteur
                JOIN Voiture V ON L.numero_immatriculation = V.numero_immatriculation
                WHERE L.numero_client = :numero_client
                AND L.statut = 'en attente';";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute([":numero_client" => $numero_client]);
            return $exec->fetchAll();
        }

       public function selectLeconsConfirmees($numero_client) {
            $requete = "SELECT L.*, M.nom_moniteur, V.numero_immatriculation
                        FROM Lecon L
                        JOIN Moniteur M ON L.numero_moniteur = M.numero_moniteur
                        JOIN Voiture V ON L.numero_immatriculation = V.numero_immatriculation
                        WHERE L.numero_client = :numero_client
                        AND L.statut = 'Confirmer';";

            $exec = $this->unPdo->prepare($requete);
            $exec->execute([":numero_client" => $numero_client]);
            return $exec->fetchAll();
        }

public function selectLeconsMoniteur($numero_moniteur) {
    $requete = "SELECT L.*, C.nom_client, V.numero_immatriculation
                FROM Lecon L
                JOIN Client C ON L.numero_client = C.numero_client
                JOIN Voiture V ON L.numero_immatriculation = V.numero_immatriculation
                WHERE L.numero_moniteur = :numero_moniteur
                AND L.statut = 'Confirmer';";

    $exec = $this->unPdo->prepare($requete);
    $exec->execute([":numero_moniteur" => $numero_moniteur]);
    return $exec->fetchAll();
}

        public function selectLeconsRefusees($numero_client) {
            $requete = "SELECT L.*, M.nom_moniteur, V.numero_immatriculation
                        FROM Lecon L
                        JOIN Moniteur M ON L.numero_moniteur = M.numero_moniteur
                        JOIN Voiture V ON L.numero_immatriculation = V.numero_immatriculation
                        WHERE L.numero_client = :numero_client
                        AND L.statut = 'Annuler';";

            $exec = $this->unPdo->prepare($requete);
            $exec->execute([":numero_client" => $numero_client]);
            return $exec->fetchAll();
        }


        public function updateStatusLecon($numero_lecon, $statut) {
            $requete = "update Lecon set statut = :statut where numero_lecon = :numero_lecon;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(
                ":statut" => $statut,
                ":numero_lecon" => $numero_lecon
            ));
        }

/****** Gestion des Moniteurs ******/
        public function insert_moniteur($tab){
            $requete = "insert into Moniteur values 
                (null, :nom_moniteur, :prenom_moniteur, :date_naissance_moniteur, :telephone_moniteur, :adresse_moniteur, :code_postal_moniteur, :ville_moniteur, :email_moniteur, curdate(),  :administateur, :mdp_moniteur);";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(
                ":nom_moniteur"=>$tab['nom_moniteur'],
                ":prenom_moniteur"=>$tab['prenom_moniteur'],
                ":date_naissance_moniteur"=>$tab['date_naissance_moniteur'],
                ":telephone_moniteur"=>$tab['telephone_moniteur'],
                ":adresse_moniteur"=>$tab['adresse_moniteur'],
                ":code_postal_moniteur"=>$tab['code_postal_moniteur'],
                ":ville_moniteur"=>$tab['ville_moniteur'],
                ":email_moniteur"          => $tab['email_moniteur'],
                ":administateur"=>$tab['administateur'],
                ":mdp_moniteur"=>$tab['mdp_moniteur'] 
            ));
        }

        public function selectAll_moniteurs(){
            $requete = "select * from Moniteur;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
            return $exec->fetchAll();
        }

        public function selectLike_moniteurs($filtre){
            $requete = "select * from Moniteur where 
                nom_moniteur like :filtre or
                prenom_moniteur like :filtre;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":filtre"=>"%".$filtre."%"));
            return $exec->fetchAll();
        }

        public function delete_moniteur($numero_moniteur){
            $requete = "delete from Moniteur where numero_moniteur = :numero_moniteur;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_moniteur"=>$numero_moniteur));
        }

        public function update_moniteur($tab){
            $requete = "update Moniteur set 
                nom_moniteur = :nom_moniteur,
                prenom_moniteur = :prenom_moniteur,
                date_naissance_moniteur = :date_naissance_moniteur,
                telephone_moniteur = :telephone_moniteur,
                adresse_moniteur = :adresse_moniteur,
                code_postal_moniteur = :code_postal_moniteur,
                ville_moniteur = :ville_moniteur,
                mdp_moniteur = :mdp_moniteur
                where numero_moniteur = :numero_moniteur;";
            $exec = $this->unPdo->prepare($requete);

            $exec->execute(array(
                ":numero_moniteur"=>$tab['numero_moniteur'],
                ":nom_moniteur"=>$tab['nom_moniteur'],
                ":prenom_moniteur"=>$tab['prenom_moniteur'],
                ":date_naissance_moniteur"=>$tab['date_naissance_moniteur'],
                ":telephone_moniteur"=>$tab['telephone_moniteur'],
                ":adresse_moniteur"=>$tab['adresse_moniteur'],
                ":code_postal_moniteur"=>$tab['code_postal_moniteur'],
                ":ville_moniteur"=>$tab['ville_moniteur'],
           //     ":date_embauche"=>$tab['date_embauche'],
             //   ":administrateur"=>$tab['administrateur'],
                ":mdp_moniteur"=>$tab['mdp_moniteur']  

            ));
        }

        public function selectWhere_moniteur($numero_moniteur){
            $requete = "select * from Moniteur where numero_moniteur = :numero_moniteur;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_moniteur"=>$numero_moniteur));
            return $exec->fetch();
        }


        public function select_moniteur($identifiant, $mdp){
        $requete = "select * from Moniteur 
                    WHERE email_moniteur = :email_moniteur 
                    AND mdp_moniteur = :mdp_moniteur;";

        $donnees = array(":email_moniteur" => $identifiant, ":mdp_moniteur"   => $mdp);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
        $unMoniteur =  $exec->fetch();          
            return $unMoniteur;
        }

/****** Gestion des Voitures ******/
        public function insert_voiture($tab){
            $requete = "insert into Voiture (numero_immatriculation, date_achat, nombre_km)
                        VALUES (:numero_immatriculation, :date_achat, :nombre_km)";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(
                ":numero_immatriculation"=>$tab['numero_immatriculation'],
                ":date_achat"=>$tab['date_achat'],
                ":nombre_km"=>$tab['nombre_km']
            ));
        }

        public function selectAll_voitures(){
            $requete = "select * from Voiture";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
            return $exec->fetchAll();
        }

        public function selectLike_voitures($filtre){
            $requete = "select * from Voiture 
                        WHERE numero_immatriculation LIKE :filtre
                        OR nombre_km LIKE :filtre";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":filtre"=>"%".$filtre."%"));
            return $exec->fetchAll();
        }

        public function delete_voiture($numero_immatriculation){
            $requete = "delete from Voiture where numero_immatriculation = :numero_immatriculation";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_immatriculation"=>$numero_immatriculation));
        }

        public function update_voiture($tab){
            $requete = "update Voiture set 
                        date_achat = :date_achat,
                        nombre_km = :nombre_km
                        WHERE numero_immatriculation = :numero_immatriculation";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(
                ":numero_immatriculation"=>$tab['numero_immatriculation'],
                ":date_achat"=>$tab['date_achat'],
                ":nombre_km"=>$tab['nombre_km']
            ));
        }

        public function selectWhere_voiture($numero_immatriculation){
            $requete = "select * FROM Voiture where (numero_immatriculation = :numero_immatriculation);";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_immatriculation"=>$numero_immatriculation));
            return $exec->fetch();
        }


/****** Gestion des Achats (Achete) ******/
        public function insert_achete($tab) {
            $requete = "INSERT INTO Achete VALUES (:numero_formation, :numero_client);";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(
                ":numero_formation" => $tab["numero_formation"],
                ":numero_client"    => $tab["numero_client"]
            ));
        }

        public function delete_achete($numero_formation, $numero_client) {
            $requete = "DELETE FROM Achete 
                        WHERE numero_formation = :numero_formation 
                        AND numero_client = :numero_client;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(
                ":numero_formation" => $numero_formation,
                ":numero_client"    => $numero_client
            ));
        }

        public function update_achete($tab) {

            $requete = "UPDATE Achete SET 
                            numero_formation = :new_numero_formation,
                            numero_client    = :new_numero_client
                        WHERE numero_formation = :old_numero_formation
                        AND numero_client      = :old_numero_client;";

            $exec = $this->unPdo->prepare($requete);

            $exec->execute(array(
                ":new_numero_formation" => $tab["new_numero_formation"],
                ":new_numero_client"    => $tab["new_numero_client"],
                ":old_numero_formation" => $tab["old_numero_formation"],
                ":old_numero_client"    => $tab["old_numero_client"]
            ));
        }

        public function selectWhere_achete($numero_formation, $numero_client) {
            $requete = "SELECT * FROM Achete 
                        WHERE numero_formation = :numero_formation
                        AND numero_client = :numero_client;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(
                ":numero_formation" => $numero_formation,
                ":numero_client"    => $numero_client
            ));
            return $exec->fetch();
        }

        public function selectLike_achetes($filtre) {
            // On cherche dans les noms/prénoms/formation via jointure
            $requete = "SELECT A.*, C.nom_client, C.prenom_client, F.nom_formation
                        FROM Achete A
                        JOIN Client C ON A.numero_client = C.numero_client
                        JOIN Formation F ON A.numero_formation = F.numero_formation
                        WHERE C.nom_client LIKE :filtre
                        OR C.prenom_client LIKE :filtre
                        OR F.nom_formation LIKE :filtre;";

            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":filtre" => "%".$filtre."%"));
            return $exec->fetchAll();
        }

        public function selectAll_achetes() {
            $requete = "SELECT A.*, C.nom_client, C.prenom_client, F.nom_formation
                        FROM Achete A
                        JOIN Client C ON A.numero_client = C.numero_client
                        JOIN Formation F ON A.numero_formation = F.numero_formation;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
            return $exec->fetchAll();
        }


        public function selectFormationsByClient($numero_client) {
            $requete = "SELECT numero_formation FROM Achete WHERE numero_client = :id;";
            $exec = $this->unPdo->prepare($requete);   
            $exec->execute([":id" => $numero_client]);
            return $exec->fetchAll(PDO::FETCH_COLUMN);
        }


/****** Gestion des Formations ******/

        public function selectWhere_formation_nom($nom_formation) {
            $requete = "SELECT * FROM Formation WHERE nom_formation = :nom_formation;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute([":nom_formation" => $nom_formation]);
            return $exec->fetch();
        }


        public function selectNomFormation($id) {
            
            $requete = "SELECT nom_formation FROM Formation WHERE numero_formation = :id;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute([":id" => $id]);
            return $exec->fetchColumn();
        }



/****** Gestion des Examens ******/

        public function selectExamensClient($numero_client) {
            $requete = "SELECT E.numero_examen, E.date_heure_examen, M.nom_moniteur
                        FROM Examen E
                        JOIN Moniteur M ON E.numero_moniteur = M.numero_moniteur
                        WHERE E.numero_client = :numero_client
                        ORDER BY E.date_heure_examen ASC;";
                        
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_client" => $numero_client));
            return $exec->fetchAll();
        }

        public function selectExamensMoniteur($numero_moniteur) {
            $requete = "SELECT E.numero_examen, E.date_heure_examen, C.nom_client, C.prenom_client
                        FROM Examen E
                        JOIN Client C ON E.numero_client = C.numero_client
                        WHERE E.numero_moniteur = :numero_moniteur
                        ORDER BY E.date_heure_examen ASC;";
                        
            $exec = $this->unPdo->prepare($requete);
            $exec->execute(array(":numero_moniteur" => $numero_moniteur));
            return $exec->fetchAll();
        }

/****** Gestion des Users ******/
		public function select_user($identifiant, $mdp){
			// requête paramétré
			$requete = "select * from Client where (email_client = :identifiant OR pseudo_client = :identifiant) and mdp_client= :mdp_client;";

			$donnees = array(":identifiant" => $identifiant, ":mdp_client" => $mdp);
			// préparation de la requête
			$select = $this->unPdo->prepare($requete);

			//execution de la requête
			$select->execute($donnees);

			//extraction du résultat
			$unUser = $select->fetch(); //un seul résultat

			//retourner le résultat user
			return $unUser;
		}
	}
?>