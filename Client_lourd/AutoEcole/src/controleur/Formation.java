package controleur;

public class Formation {
    private int numero_formation;
    private String nom_formation;
    private double prix_formation;
    private int total_heures;

    // Constructeur avec ID (pour les SELECT)
    public Formation(int numero_formation, String nom_formation, double prix_formation, int total_heures) {
        this.numero_formation = numero_formation;
        this.nom_formation = nom_formation;
        this.prix_formation = prix_formation;
        this.total_heures = total_heures;
    }

    // Constructeur sans ID (pour les INSERT)
    public Formation(String nom_formation, double prix_formation, int total_heures) {
        this.numero_formation = 0;
        this.nom_formation = nom_formation;
        this.prix_formation = prix_formation;
        this.total_heures = total_heures;
    }

	public int getNumero_formation() {
		return numero_formation;
	}

	public void setNumero_formation(int numero_formation) {
		this.numero_formation = numero_formation;
	}

	public String getNom_formation() {
		return nom_formation;
	}

	public void setNom_formation(String nom_formation) {
		this.nom_formation = nom_formation;
	}

	public double getPrix_formation() {
		return prix_formation;
	}

	public void setPrix_formation(double prix_formation) {
		this.prix_formation = prix_formation;
	}

	public int getTotal_heures() {
		return total_heures;
	}

	public void setTotal_heures(int total_heures) {
		this.total_heures = total_heures;
	}
}
