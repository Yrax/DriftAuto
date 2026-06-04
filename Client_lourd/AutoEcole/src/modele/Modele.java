package modele;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

import controleur.Achete;
import controleur.Client;
import controleur.Contient;
import controleur.Examen;
import controleur.Formation;
import controleur.Lecon;
import controleur.Moniteur;
import controleur.Possede;
import controleur.Voiture;

public class Modele {
	//liste des requetes SQL
	private static BDD uneBdd = new BDD("localhost", "auto_ecole", "root", "");
	
	//sur la plate forme 
	//private static BDD uneBdd = new BDD("172.20.1.110", "auto_ecole", "user", "user");
	
	/*********** __Requêtes__ Moniteur - Connexion **********/
	public static Moniteur selectWhereMoniteur(String email, String mdp) {
	    Moniteur unMoniteur = null;
	    String requete = "select * from Moniteur where email_moniteur = '" + email
	            + "' and mdp_moniteur = '" + mdp + "' and administrateur = true;";
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();
	        ResultSet unRes = unStat.executeQuery(requete);
	        if (unRes.next()) {
	            unMoniteur = new Moniteur(
	                    unRes.getInt("numero_moniteur"),
	                    unRes.getString("nom_moniteur"),
	                    unRes.getString("prenom_moniteur"),
	                    unRes.getString("date_naissance_moniteur"),
	                    unRes.getString("telephone_moniteur"),
	                    unRes.getString("adresse_moniteur"),
	                    unRes.getString("code_postal_moniteur"),
	                    unRes.getString("ville_moniteur"),
	                    unRes.getString("email_moniteur"),
	                    unRes.getString("date_embauche"),
	                    unRes.getBoolean("administrateur"),
	                    unRes.getString("mdp_moniteur"));
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + requete);
	    }
	    return unMoniteur;
	}

	/*********** __Requêtes__ __Client__ ********/
	public static void insertClient(Client unClient) {
	    String requete = "insert into Client values (null, '"
	            + unClient.getPseudo_client() + "', '"
	            + unClient.getNom_client() + "', '"
	            + unClient.getPrenom_client() + "', '"
	            + unClient.getDate_naissance_client() + "', '"
	            + unClient.getTelephone_client() + "', '"
	            + unClient.getAdresse_client() + "', '"
	            + unClient.getCode_postal_client() + "', '"
	            + unClient.getVille_client() + "', '"
	            + unClient.getEmail_client() + "', '"
	            + unClient.getMdp_client() + "');";
	    executerRequete(requete);
	}

	public static void deleteClient(int numero_client) {
	    String requete = "delete from Client where numero_client = " + numero_client + ";";
	    executerRequete(requete);
	}

	public static void updateClient(Client unClient) {
	    String requete = "update Client set "
	            + "pseudo_client = '" + unClient.getPseudo_client() + "', "
	            + "nom_client = '" + unClient.getNom_client() + "', "
	            + "prenom_client = '" + unClient.getPrenom_client() + "', "
	            + "date_naissance_client = '" + unClient.getDate_naissance_client() + "', "
	            + "telephone_client = '" + unClient.getTelephone_client() + "', "
	            + "adresse_client = '" + unClient.getAdresse_client() + "', "
	            + "code_postal_client = '" + unClient.getCode_postal_client() + "', "
	            + "ville_client = '" + unClient.getVille_client() + "', "
	            + "email_client = '" + unClient.getEmail_client() + "', "
	            + "mdp_client = '" + unClient.getMdp_client() + "' "
	            + "where numero_client = " + unClient.getNumero_client() + ";";
	    executerRequete(requete);
	}

	public static ArrayList<Client> selectAllClients(String filtre) {
	    ArrayList<Client> lesClients = new ArrayList<Client>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Client;";
	    } else {
	        requete = "select * from Client where pseudo_client like '%" + filtre + "%' or "
	                + "nom_client like '%" + filtre + "%' or "
	                + "prenom_client like '%" + filtre + "%' or "
	                + "date_naissance_client like '%" + filtre + "%' or "
	                + "telephone_client like '%" + filtre + "%' or "
	                + "adresse_client like '%" + filtre + "%' or "
	                + "code_postal_client like '%" + filtre + "%' or "
	                + "ville_client like '%" + filtre + "%' or "
	                + "email_client like '%" + filtre + "%' or "
	                + "mdp_client like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Client unClient = new Client(
	                    desResultats.getInt("numero_client"),
	                    desResultats.getString("pseudo_client"),
	                    desResultats.getString("nom_client"),
	                    desResultats.getString("prenom_client"),
	                    desResultats.getString("date_naissance_client"),
	                    desResultats.getString("telephone_client"),
	                    desResultats.getString("adresse_client"),
	                    desResultats.getString("code_postal_client"),
	                    desResultats.getString("ville_client"),
	                    desResultats.getString("email_client"),
	                    desResultats.getString("mdp_client"));
	            lesClients.add(unClient);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + requete);
	    }

	    return lesClients;
	}
	
	/*********** __Requêtes__ __Lecon__ ********/
	public static void insertLecon(Lecon uneLecon) {
	    String requete = "insert into Lecon values (null, '"
	            + uneLecon.getDate_heure_lecon() + "', "
	            + uneLecon.getNumero_moniteur() + ", "
	            + uneLecon.getNumero_client() + ", '"
	            + uneLecon.getNumero_immatriculation() + "', '"
	            + uneLecon.getStatut() + "');";
	    executerRequete(requete);
	}

	public static void updateLecon(Lecon uneLecon) {
	    String requete = "update Lecon set "
	            + "date_heure_lecon = '" + uneLecon.getDate_heure_lecon() + "', "
	            + "statut = '" + uneLecon.getStatut() + "', "
	            + "numero_moniteur = " + uneLecon.getNumero_moniteur() + ", "
	            + "numero_client = " + uneLecon.getNumero_client() + ", "
	            + "numero_immatriculation = '" + uneLecon.getNumero_immatriculation() + "' "
	            + "where numero_lecon = " + uneLecon.getNumero_lecon() + ";";
	    executerRequete(requete);
	}

	public static void deleteLecon(int numero_lecon) {
	    String requete = "delete from Lecon where numero_lecon = " + numero_lecon + ";";
	    executerRequete(requete);
	}

	public static ArrayList<Lecon> selectAllLecons(String filtre) {
	    ArrayList<Lecon> lesLecons = new ArrayList<Lecon>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Lecon;";
	    } else {
	        requete = "select * from Lecon where date_heure_lecon like '%" + filtre + "%' or "
	                + "statut like '%" + filtre + "%' or "
	                + "numero_moniteur like '%" + filtre + "%' or "
	                + "numero_client like '%" + filtre + "%' or "
	                + "numero_immatriculation like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Lecon uneLecon = new Lecon(
	                    desResultats.getInt("numero_lecon"),
	                    desResultats.getString("date_heure_lecon"),
	                    desResultats.getString("statut"),
	                    desResultats.getInt("numero_moniteur"),
	                    desResultats.getInt("numero_client"),
	                    desResultats.getString("numero_immatriculation"));
	            lesLecons.add(uneLecon);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + exp.getMessage());
	    }

	    return lesLecons;
	}
	
	/*********** __Requêtes__ __Moniteur__ ********/
	public static void insertMoniteur(Moniteur unMoniteur) {
	    String requete = "insert into Moniteur values (null, '"
	            + unMoniteur.getNom_moniteur() + "', '"
	            + unMoniteur.getPrenom_moniteur() + "', '"
	            + unMoniteur.getDate_naissance_moniteur() + "', '"
	            + unMoniteur.getTelephone_moniteur() + "', '"
	            + unMoniteur.getAdresse_moniteur() + "', '"
	            + unMoniteur.getCode_postal_moniteur() + "', '"
	            + unMoniteur.getVille_moniteur() + "', '"
	            + unMoniteur.getEmail_moniteur() + "', '"
	            + unMoniteur.getDate_embauche() + "', "
	            + unMoniteur.isAdministrateur() + ", '"
	            + unMoniteur.getMdp_moniteur() + "');";
	    executerRequete(requete);
	}

	public static void deleteMoniteur(int numero_moniteur) {
	    String requete = "delete from Moniteur where numero_moniteur = " + numero_moniteur + ";";
	    executerRequete(requete);
	}
	
	public static void updateMoniteur(Moniteur unMoniteur) {
	    String requete = "update Moniteur set "
	            + "nom_moniteur = '" + unMoniteur.getNom_moniteur() + "', "
	            + "prenom_moniteur = '" + unMoniteur.getPrenom_moniteur() + "', "
	            + "date_naissance_moniteur = '" + unMoniteur.getDate_naissance_moniteur() + "', "
	            + "telephone_moniteur = '" + unMoniteur.getTelephone_moniteur() + "', "
	            + "adresse_moniteur = '" + unMoniteur.getAdresse_moniteur() + "', "
	            + "code_postal_moniteur = '" + unMoniteur.getCode_postal_moniteur() + "', "
	            + "ville_moniteur = '" + unMoniteur.getVille_moniteur() + "', "
	            + "email_moniteur = '" + unMoniteur.getEmail_moniteur() + "', "
	            + "date_embauche = '" + unMoniteur.getDate_embauche() + "', "
	            + "administrateur = " + unMoniteur.isAdministrateur() + ", "
	            + "mdp_moniteur = '" + unMoniteur.getMdp_moniteur() + "' "
	            + "where numero_moniteur = " + unMoniteur.getNumero_moniteur() + ";";
	    executerRequete(requete);
	}

	public static ArrayList<Moniteur> selectAllMoniteurs(String filtre) {
	    ArrayList<Moniteur> lesMoniteurs = new ArrayList<Moniteur>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Moniteur;";
	    } else {
	        requete = "select * from Moniteur where nom_moniteur like '%" + filtre + "%' or "
	                + "prenom_moniteur like '%" + filtre + "%' or "
	                + "date_naissance_moniteur like '%" + filtre + "%' or "
	                + "telephone_moniteur like '%" + filtre + "%' or "
	                + "adresse_moniteur like '%" + filtre + "%' or "
	                + "code_postal_moniteur like '%" + filtre + "%' or "
	                + "ville_moniteur like '%" + filtre + "%' or "
	                + "email_moniteur like '%" + filtre + "%' or "
	                + "date_embauche like '%" + filtre + "%' or "
	                + "mdp_moniteur like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Moniteur unMoniteur = new Moniteur(
	                    desResultats.getInt("numero_moniteur"),
	                    desResultats.getString("nom_moniteur"),
	                    desResultats.getString("prenom_moniteur"),
	                    desResultats.getString("date_naissance_moniteur"),
	                    desResultats.getString("telephone_moniteur"),
	                    desResultats.getString("adresse_moniteur"),
	                    desResultats.getString("code_postal_moniteur"),
	                    desResultats.getString("ville_moniteur"),
	                    desResultats.getString("email_moniteur"),
	                    desResultats.getString("date_embauche"),
	                    desResultats.getBoolean("administrateur"),
	                    desResultats.getString("mdp_moniteur"));
	            lesMoniteurs.add(unMoniteur);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + requete);
	    }

	    return lesMoniteurs;
	}

	/*********** __Requêtes__ __Examen__ ********/
	public static void insertExamen(Examen unExamen) {
	    String requete = "insert into Examen values (null, '"
	            + unExamen.getDate_heure_examen() + "', "
	            + unExamen.getNumero_moniteur() + ", "
	            + unExamen.getNumero_client() + ");";
	    executerRequete(requete);
	}

	public static void deleteExamen(int numero_examen) {
	    String requete = "delete from Examen where numero_examen = " + numero_examen + ";";
	    executerRequete(requete);
	}

	public static void updateExamen(Examen unExamen) {
	    String requete = "update Examen set date_heure_examen = '"
	            + unExamen.getDate_heure_examen() + "', numero_moniteur = "
	            + unExamen.getNumero_moniteur() + ", numero_client = "
	            + unExamen.getNumero_client() + " "
	            + "where numero_examen = " + unExamen.getNumero_examen() + ";";
	    executerRequete(requete);
	}

	public static ArrayList<Examen> selectAllExamens(String filtre) {
	    ArrayList<Examen> lesExamens = new ArrayList<Examen>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Examen;";
	    } else {
	        requete = "select * from Examen where date_heure_examen like '%" + filtre + "%' or "
	                + "numero_moniteur like '%" + filtre + "%' or "
	                + "numero_client like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Examen unExamen = new Examen(
	                    desResultats.getInt("numero_examen"),
	                    desResultats.getString("date_heure_examen"),
	                    desResultats.getInt("numero_moniteur"),
	                    desResultats.getInt("numero_client"));
	            lesExamens.add(unExamen);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + requete);
	    }

	    return lesExamens;
	}
	
	/*********** __Requêtes__ __Voiture__ ********/
	public static void insertVoiture(Voiture uneVoiture) {
	    String requete = "insert into Voiture values (null, '"
	            + uneVoiture.getNumero_immatriculation() + "', '"
	            + uneVoiture.getDate_achat() + "', "
	            + uneVoiture.getNombre_km() + ");";
	    executerRequete(requete);
	}

	public static void updateVoiture(Voiture uneVoiture) {
	    String requete = "update Voiture set "
	            + "date_achat = '" + uneVoiture.getDate_achat() + "', "
	            + "nombre_km = " + uneVoiture.getNombre_km() + " "
	            + "where numero_immatriculation = '" + uneVoiture.getNumero_immatriculation() + "';";
	    executerRequete(requete);
	}

	public static void deleteVoiture(String numero_immatriculation) {
	    String requete = "delete from Voiture where numero_immatriculation = '" + numero_immatriculation + "';";
	    executerRequete(requete);
	}

	public static ArrayList<Voiture> selectAllVoitures(String filtre) {
	    ArrayList<Voiture> lesVoitures = new ArrayList<Voiture>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Voiture;";
	    } else {
	        requete = "select * from Voiture where numero_immatriculation like '%" + filtre + "%' or "
	                + "date_achat like '%" + filtre + "%' or "
	                + "nombre_km like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Voiture uneVoiture = new Voiture(
	                    desResultats.getString("numero_immatriculation"),
	                    desResultats.getString("date_achat"),
	                    desResultats.getInt("nombre_km"));
	            lesVoitures.add(uneVoiture);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + exp.getMessage());
	    }

	    return lesVoitures;
	}
	
	/*********** __Requêtes__ __Formation__ ********/
	public static void insertFormation(Formation uneFormation) {
	    String requete = "insert into Formation values (null, '"
	            + uneFormation.getNom_formation() + "', "
	            + uneFormation.getPrix_formation() + ", "
	            + uneFormation.getTotal_heures() + ");";
	    executerRequete(requete);
	}

	public static void deleteFormation(int numero_formation) {
	    String requete = "delete from Formation where numero_formation = " + numero_formation + ";";
	    executerRequete(requete);
	}
	
	public static void updateFormation(Formation uneFormation) {
	    String requete = "update Formation set "
	            + "nom_formation = '" + uneFormation.getNom_formation() + "', "
	            + "prix_formation = " + uneFormation.getPrix_formation() + ", "
	            + "total_heures = " + uneFormation.getTotal_heures() + " "
	            + "where numero_formation = " + uneFormation.getNumero_formation() + ";";
	    executerRequete(requete);
	}
	
	public static ArrayList<Formation> selectAllFormations(String filtre) {
	    ArrayList<Formation> lesFormations = new ArrayList<Formation>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Formation;";
	    } else {
	        requete = "select * from Formation where nom_formation like '%" + filtre + "%' or "
	                + "prix_formation like '%" + filtre + "%' or "
	                + "total_heures like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Formation uneFormation = new Formation(
	                    desResultats.getInt("numero_formation"),
	                    desResultats.getString("nom_formation"),
	                    desResultats.getDouble("prix_formation"),
	                    desResultats.getInt("total_heures"));
	            lesFormations.add(uneFormation);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + requete);
	    }

	    return lesFormations;
	}
	
	/*********** __Requêtes__ __Possede__ ********/
	public static void insertPossede(Possede unPossede) {
	    String requete = "insert into Possede values ("
	            + unPossede.getNumero_examen() + ", "
	            + unPossede.getNumero_formation() + ");";
	    executerRequete(requete);
	}

	public static void updatePossede(int ancienNumeroExamen, int ancienNumeroFormation, Possede unPossede) {
	    String requete = "update Possede set "
	            + "numero_examen = " + unPossede.getNumero_examen() + ", "
	            + "numero_formation = " + unPossede.getNumero_formation() + " "
	            + "where numero_examen = " + ancienNumeroExamen + " "
	            + "and numero_formation = " + ancienNumeroFormation + ";";
	    executerRequete(requete);
	}

	public static void deletePossede(int numero_examen, int numero_formation) {
	    String requete = "delete from Possede where numero_examen = " + numero_examen
	            + " and numero_formation = " + numero_formation + ";";
	    executerRequete(requete);
	}

	public static ArrayList<Possede> selectAllPossede(String filtre) {
	    ArrayList<Possede> lesPossede = new ArrayList<Possede>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Possede;";
	    } else {
	        requete = "select * from Possede where numero_examen like '%" + filtre + "%' or "
	                + "numero_formation like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Possede unPossede = new Possede(
	                    desResultats.getInt("numero_examen"),
	                    desResultats.getInt("numero_formation"));
	            lesPossede.add(unPossede);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + exp.getMessage());
	    }

	    return lesPossede;
	}
	
	/*********** __Requêtes__ __Contient__ ********/
	public static void insertContient(Contient unContient) {
	    String requete = "insert into Contient values ("
	            + unContient.getNumero_lecon() + ", "
	            + unContient.getNumero_formation() + ");";
	    executerRequete(requete);
	}

	public static void updateContient(int ancienNumeroLecon, int ancienNumeroFormation, Contient unContient) {
	    String requete = "update Contient set "
	            + "numero_lecon = " + unContient.getNumero_lecon() + ", "
	            + "numero_formation = " + unContient.getNumero_formation() + " "
	            + "where numero_lecon = " + ancienNumeroLecon + " "
	            + "and numero_formation = " + ancienNumeroFormation + ";";
	    executerRequete(requete);
	}

	public static void deleteContient(int numero_lecon, int numero_formation) {
	    String requete = "delete from Contient where numero_lecon = " + numero_lecon
	            + " and numero_formation = " + numero_formation + ";";
	    executerRequete(requete);
	}

	public static ArrayList<Contient> selectAllContient(String filtre) {
	    ArrayList<Contient> lesContient = new ArrayList<Contient>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Contient;";
	    } else {
	        requete = "select * from Contient where numero_lecon like '%" + filtre + "%' or "
	                + "numero_formation like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Contient unContient = new Contient(
	                    desResultats.getInt("numero_lecon"),
	                    desResultats.getInt("numero_formation"));
	            lesContient.add(unContient);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + exp.getMessage());
	    }

	    return lesContient;
	}
	
	/*********** __Requêtes__ __Achete__ ********/
	public static void insertAchete(Achete unAchete) {
	    String requete = "insert into Achete values ("
	            + unAchete.getNumero_formation() + ", "
	            + unAchete.getNumero_client() + ");";
	    executerRequete(requete);
	}

	public static void updateAchete(int ancienNumeroFormation, int ancienNumeroClient, Achete unAchete) {
	    String requete = "update Achete set "
	            + "numero_formation = " + unAchete.getNumero_formation() + ", "
	            + "numero_client = " + unAchete.getNumero_client() + " "
	            + "where numero_formation = " + ancienNumeroFormation + " "
	            + "and numero_client = " + ancienNumeroClient + ";";
	    executerRequete(requete);
	}

	public static void deleteAchete(int numero_formation, int numero_client) {
	    String requete = "delete from Achete where numero_formation = " + numero_formation
	            + " and numero_client = " + numero_client + ";";
	    executerRequete(requete);
	}

	public static ArrayList<Achete> selectAllAchete(String filtre) {
	    ArrayList<Achete> lesAchete = new ArrayList<Achete>();
	    String requete;
	    if (filtre.equals("")) {
	        requete = "select * from Achete;";
	    } else {
	        requete = "select * from Achete where numero_formation like '%" + filtre + "%' or "
	                + "numero_client like '%" + filtre + "%';";
	    }
	    try {
	        uneBdd.seConnecter();
	        Statement unStat = uneBdd.getMaConnexion().createStatement();

	        ResultSet desResultats = unStat.executeQuery(requete);
	        while (desResultats.next()) {
	            Achete unAchete = new Achete(
	                    desResultats.getInt("numero_formation"),
	                    desResultats.getInt("numero_client"));
	            lesAchete.add(unAchete);
	        }
	        unStat.close();
	        uneBdd.seDeConnecter();
	    }
	    catch (SQLException exp) {
	        System.out.println("Erreur d'exécution de la requête : " + exp.getMessage());
	    }

	    return lesAchete;
	}
	
	/*********** Autres Méthodes ********/
	public static void executerRequete(String requete) {
		try {
			uneBdd.seConnecter();
			Statement unStat = uneBdd.getMaConnexion().createStatement(); //prepare en PDO
			unStat.execute(requete);
			unStat.close();
			uneBdd.seDeConnecter();
		}
		catch (SQLException exp) {
			System.out.println("Erreur d'exécution de la requête : " + requete);
		}
	}
}
