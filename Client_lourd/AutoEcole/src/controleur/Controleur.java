package controleur;

import java.util.ArrayList;

import modele.Modele;

public class Controleur {
	// User
	public static Moniteur selectWhereMoniteur(String email, String mdp) {
		//contrôler email, contrôler mdp
		
		return Modele.selectWhereMoniteur(email, mdp);
	}
	
	// Client

    public static void insertClient(Client unClient) {
        // contrôler les données
        Modele.insertClient(unClient);
    }

    public static void deleteClient(int numero_client) {
        // contrôler les données
        Modele.deleteClient(numero_client);
    }

    public static void updateClient(Client unClient) {
        // contrôler les données
        Modele.updateClient(unClient);
    }

    public static ArrayList<Client> selectAllClients(String filtre) {
        return Modele.selectAllClients(filtre);
    }

	// Leçon
    public static void insertLecon(Lecon uneLecon) {
        // contrôler les données
        Modele.insertLecon(uneLecon);
    }

    public static void deleteLecon(int numero_lecon) {
        // contrôler les données
        Modele.deleteLecon(numero_lecon);
    }

    public static void updateLecon(Lecon uneLecon) {
        // contrôler les données
        Modele.updateLecon(uneLecon);
    }

    public static ArrayList<Lecon> selectAllLecons(String filtre) {
        return Modele.selectAllLecons(filtre);
    }

	// Moniteur
    public static void insertMoniteur(Moniteur unMoniteur) {
        // contrôler les données
        Modele.insertMoniteur(unMoniteur);
    }

    public static void deleteMoniteur(int numero_moniteur) {
        // contrôler les données
        Modele.deleteMoniteur(numero_moniteur);
    }

    public static void updateMoniteur(Moniteur unMoniteur) {
        // contrôler les données
        Modele.updateMoniteur(unMoniteur);
    }

    public static ArrayList<Moniteur> selectAllMoniteurs(String filtre) {
        return Modele.selectAllMoniteurs(filtre);
    }
    
	// Examen
    public static void insertExamen(Examen unExamen) {
        // contrôler les données
        Modele.insertExamen(unExamen);
    }

    public static void deleteExamen(int numero_examen) {
        // contrôler les données
        Modele.deleteExamen(numero_examen);
    }

    public static void updateExamen(Examen unExamen) {
        // contrôler les données
        Modele.updateExamen(unExamen);
    }

    public static ArrayList<Examen> selectAllExamens(String filtre) {
        return Modele.selectAllExamens(filtre);
    }
    
	// Voiture
    public static void insertVoiture(Voiture uneVoiture) {
        // contrôler les données
        Modele.insertVoiture(uneVoiture);
    }

    public static void deleteVoiture(String immatriculation) {
        // contrôler les données
        Modele.deleteVoiture(immatriculation);
    }

    public static void updateVoiture(Voiture uneVoiture) {
        // contrôler les données
        Modele.updateVoiture(uneVoiture);
    }

    public static ArrayList<Voiture> selectAllVoitures(String filtre) {
        return Modele.selectAllVoitures(filtre);
    }
    
	// Formation
    public static void insertFormation(Formation uneFormation) {
        // contrôler les données
        Modele.insertFormation(uneFormation);
    }

    public static void deleteFormation(int numero_formation) {
        // contrôler les données
        Modele.deleteFormation(numero_formation);
    }

    public static void updateFormation(Formation uneFormation) {
        // contrôler les données
        Modele.updateFormation(uneFormation);
    }

    public static ArrayList<Formation> selectAllFormations(String filtre) {
        return Modele.selectAllFormations(filtre);
    }
    
	// Possede
    public static void insertPossede(Possede unPossede) {
        // contrôler les données
        Modele.insertPossede(unPossede);
    }

    public static void deletePossede(int ancienNumeroExamen, int ancienNumeroFormation) {
        // contrôler les données
        Modele.deletePossede(ancienNumeroExamen, ancienNumeroFormation);
    }

    public static void updatePossede(int ancienNumeroExamen, int ancienNumeroFormation, Possede unPossede) {
        // contrôler les données
        Modele.updatePossede(ancienNumeroExamen, ancienNumeroFormation, unPossede);
    }

    public static ArrayList<Possede> selectAllPossede(String filtre) {
        return Modele.selectAllPossede(filtre);
    }
    
	// Contient
    public static void insertContient(Contient unContient) {
        // contrôler les données
        Modele.insertContient(unContient);
    }

    public static void deleteContient(int ancienNumeroLecon, int ancienNumeroFormation) {
        // contrôler les données
        Modele.deletePossede(ancienNumeroLecon, ancienNumeroFormation);
    }

    public static void updateContient(int ancienNumeroLecon, int ancienNumeroFormation, Contient unContient) {
        // contrôler les données
        Modele.updateContient(ancienNumeroLecon, ancienNumeroFormation, unContient);
    }

    public static ArrayList<Contient> selectAllContient(String filtre) {
        return Modele.selectAllContient(filtre);
    }
    
	// Achete
    public static void insertAchete(Achete unAchete) {
        // contrôler les données
        Modele.insertAchete(unAchete);
    }

    public static void deleteAchete(int ancienNumeroFormation, int ancienNumeroClient) {
        // contrôler les données
        Modele.deleteAchete(ancienNumeroFormation, ancienNumeroClient);
    }

    public static void updateAchete(int ancienNumeroFormation, int ancienNumeroClient, Achete unAchete) {
        // contrôler les données
        Modele.updateAchete(ancienNumeroFormation, ancienNumeroClient, unAchete);
    }

    public static ArrayList<Achete> selectAllAchete(String filtre) {
        return Modele.selectAllAchete(filtre);
    }
}
