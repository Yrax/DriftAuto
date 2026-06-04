package controleur;

public class Examen {
    private int numero_examen;
    private String date_heure_examen;
    private int numero_moniteur;
    private int numero_client;

    // Constructeur avec ID (pour les SELECT)
    public Examen(int numero_examen, String date_heure_examen, int numero_moniteur, int numero_client) {
        this.numero_examen = numero_examen;
        this.date_heure_examen = date_heure_examen;
        this.numero_moniteur = numero_moniteur;
        this.numero_client = numero_client;
    }

    // Constructeur sans ID (pour les INSERT)
    public Examen(String date_heure_examen, int numero_moniteur, int numero_client) {
        this.numero_examen = 0;
        this.date_heure_examen = date_heure_examen;
        this.numero_moniteur = numero_moniteur;
        this.numero_client = numero_client;
    }

    public int getNumero_examen() {
        return numero_examen;
    }

    public void setNumero_examen(int numero_examen) {
        this.numero_examen = numero_examen;
    }

    public String getDate_heure_examen() {
        return date_heure_examen;
    }

    public void setDate_heure_examen(String date_heure_examen) {
        this.date_heure_examen = date_heure_examen;
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
}