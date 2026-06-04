package controleur;

public class Moniteur {
    private int numero_moniteur;
    private String nom_moniteur, prenom_moniteur, date_naissance_moniteur;
    private String telephone_moniteur, adresse_moniteur, code_postal_moniteur, ville_moniteur;
    private String email_moniteur, date_embauche, mdp_moniteur;
    private boolean administrateur;

    // Constructeur avec ID (pour les SELECT)
    public Moniteur(int numero_moniteur, String nom_moniteur, String prenom_moniteur,
                    String date_naissance_moniteur, String telephone_moniteur, String adresse_moniteur,
                    String code_postal_moniteur, String ville_moniteur, String email_moniteur,
                    String date_embauche, boolean administrateur, String mdp_moniteur) {
        this.numero_moniteur = numero_moniteur;
        this.nom_moniteur = nom_moniteur;
        this.prenom_moniteur = prenom_moniteur;
        this.date_naissance_moniteur = date_naissance_moniteur;
        this.telephone_moniteur = telephone_moniteur;
        this.adresse_moniteur = adresse_moniteur;
        this.code_postal_moniteur = code_postal_moniteur;
        this.ville_moniteur = ville_moniteur;
        this.email_moniteur = email_moniteur;
        this.date_embauche = date_embauche;
        this.administrateur = administrateur;
        this.mdp_moniteur = mdp_moniteur;
    }

    // Constructeur sans ID (pour les INSERT)
    public Moniteur(String nom_moniteur, String prenom_moniteur, String date_naissance_moniteur,
                    String telephone_moniteur, String adresse_moniteur, String code_postal_moniteur,
                    String ville_moniteur, String email_moniteur, String date_embauche,
                    boolean administrateur, String mdp_moniteur) {
        this.numero_moniteur = 0;
        this.nom_moniteur = nom_moniteur;
        this.prenom_moniteur = prenom_moniteur;
        this.date_naissance_moniteur = date_naissance_moniteur;
        this.telephone_moniteur = telephone_moniteur;
        this.adresse_moniteur = adresse_moniteur;
        this.code_postal_moniteur = code_postal_moniteur;
        this.ville_moniteur = ville_moniteur;
        this.email_moniteur = email_moniteur;
        this.date_embauche = date_embauche;
        this.administrateur = administrateur;
        this.mdp_moniteur = mdp_moniteur;
    }

    public int getNumero_moniteur() {
        return numero_moniteur;
    }

    public void setNumero_moniteur(int numero_moniteur) {
        this.numero_moniteur = numero_moniteur;
    }

    public String getNom_moniteur() {
        return nom_moniteur;
    }

    public void setNom_moniteur(String nom_moniteur) {
        this.nom_moniteur = nom_moniteur;
    }

    public String getPrenom_moniteur() {
        return prenom_moniteur;
    }

    public void setPrenom_moniteur(String prenom_moniteur) {
        this.prenom_moniteur = prenom_moniteur;
    }

    public String getDate_naissance_moniteur() {
        return date_naissance_moniteur;
    }

    public void setDate_naissance_moniteur(String date_naissance_moniteur) {
        this.date_naissance_moniteur = date_naissance_moniteur;
    }

    public String getTelephone_moniteur() {
        return telephone_moniteur;
    }

    public void setTelephone_moniteur(String telephone_moniteur) {
        this.telephone_moniteur = telephone_moniteur;
    }

    public String getAdresse_moniteur() {
        return adresse_moniteur;
    }

    public void setAdresse_moniteur(String adresse_moniteur) {
        this.adresse_moniteur = adresse_moniteur;
    }

    public String getCode_postal_moniteur() {
        return code_postal_moniteur;
    }

    public void setCode_postal_moniteur(String code_postal_moniteur) {
        this.code_postal_moniteur = code_postal_moniteur;
    }

    public String getVille_moniteur() {
        return ville_moniteur;
    }

    public void setVille_moniteur(String ville_moniteur) {
        this.ville_moniteur = ville_moniteur;
    }

    public String getEmail_moniteur() {
        return email_moniteur;
    }

    public void setEmail_moniteur(String email_moniteur) {
        this.email_moniteur = email_moniteur;
    }

    public String getDate_embauche() {
        return date_embauche;
    }

    public void setDate_embauche(String date_embauche) {
        this.date_embauche = date_embauche;
    }

    public boolean isAdministrateur() {
        return administrateur;
    }

    public void setAdministrateur(boolean administrateur) {
        this.administrateur = administrateur;
    }

    public String getMdp_moniteur() {
        return mdp_moniteur;
    }

    public void setMdp_moniteur(String mdp_moniteur) {
        this.mdp_moniteur = mdp_moniteur;
    }
}