package controleur;

public class Lecon {
    private int numero_lecon;
    private String date_heure_lecon;
    private String statut;
    private int numero_moniteur;
    private int numero_client;
    private String numero_immatriculation;

    // Constructeur avec ID (pour les SELECT)
    public Lecon(int numero_lecon, String date_heure_lecon, String statut,
                 int numero_moniteur, int numero_client, String numero_immatriculation) {
        this.numero_lecon = numero_lecon;
        this.date_heure_lecon = date_heure_lecon;
        this.statut = statut;
        this.numero_moniteur = numero_moniteur;
        this.numero_client = numero_client;
        this.numero_immatriculation = numero_immatriculation;
    }

    // Constructeur sans ID (pour les INSERT)
    public Lecon(String date_heure_lecon, String statut,
                 int numero_moniteur, int numero_client, String numero_immatriculation) {
        this.numero_lecon = 0;
        this.date_heure_lecon = date_heure_lecon;
        this.statut = statut;
        this.numero_moniteur = numero_moniteur;
        this.numero_client = numero_client;
        this.numero_immatriculation = numero_immatriculation;
    }

	public int getNumero_lecon() {
		return numero_lecon;
	}

	public void setNumero_lecon(int numero_lecon) {
		this.numero_lecon = numero_lecon;
	}

	public String getDate_heure_lecon() {
		return date_heure_lecon;
	}

	public void setDate_heure_lecon(String date_heure_lecon) {
		this.date_heure_lecon = date_heure_lecon;
	}

	public String getStatut() {
		return statut;
	}

	public void setStatut(String statut) {
		this.statut = statut;
	}

	public int getNumero_moniteur() {
		return numero_moniteur;
	}

	public void setNumero_moniteur(int numero_moniteur) {
		this.numero_moniteur = numero_moniteur;
	}

	public int getNumero_client() {
		return numero_client;
	}

	public void setNumero_client(int numero_client) {
		this.numero_client = numero_client;
	}

	public String getNumero_immatriculation() {
		return numero_immatriculation;
	}

	public void setNumero_immatriculation(String numero_immatriculation) {
		this.numero_immatriculation = numero_immatriculation;
	}
}