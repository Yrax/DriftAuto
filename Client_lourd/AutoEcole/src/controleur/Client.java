package controleur;

public class Client {
    private int numero_client;
    private String pseudo_client, nom_client, prenom_client, date_naissance_client;
    private String telephone_client, adresse_client, code_postal_client, ville_client;
    private String email_client, mdp_client;

    // Constructeur avec ID (pour les SELECT)
    public Client(int numero_client, String pseudo_client, String nom_client, String prenom_client,
                  String date_naissance_client, String telephone_client, String adresse_client,
                  String code_postal_client, String ville_client, String email_client, String mdp_client) {
        this.numero_client = numero_client;
        this.pseudo_client = pseudo_client;
        this.nom_client = nom_client;
        this.prenom_client = prenom_client;
        this.date_naissance_client = date_naissance_client;
        this.telephone_client = telephone_client;
        this.adresse_client = adresse_client;
        this.code_postal_client = code_postal_client;
        this.ville_client = ville_client;
        this.email_client = email_client;
        this.mdp_client = mdp_client;
    }

    // Constructeur sans ID (pour les INSERT)
    public Client(String pseudo_client, String nom_client, String prenom_client,
                  String date_naissance_client, String telephone_client, String adresse_client,
                  String code_postal_client, String ville_client, String email_client, String mdp_client) {
        this.numero_client = 0;
        this.pseudo_client = pseudo_client;
        this.nom_client = nom_client;
        this.prenom_client = prenom_client;
        this.date_naissance_client = date_naissance_client;
        this.telephone_client = telephone_client;
        this.adresse_client = adresse_client;
        this.code_postal_client = code_postal_client;
        this.ville_client = ville_client;
        this.email_client = email_client;
        this.mdp_client = mdp_client;
    }

    public int getNumero_client() {
        return numero_client;
    }

    public void setNumero_client(int numero_client) {
        this.numero_client = numero_client;
    }

    public String getPseudo_client() {
        return pseudo_client;
    }

    public void setPseudo_client(String pseudo_client) {
        this.pseudo_client = pseudo_client;
    }

    public String getNom_client() {
        return nom_client;
    }

    public void setNom_client(String nom_client) {
        this.nom_client = nom_client;
    }

    public String getPrenom_client() {
        return prenom_client;
    }

    public void setPrenom_client(String prenom_client) {
        this.prenom_client = prenom_client;
    }

    public String getDate_naissance_client() {
        return date_naissance_client;
    }

    public void setDate_naissance_client(String date_naissance_client) {
        this.date_naissance_client = date_naissance_client;
    }

    public String getTelephone_client() {
        return telephone_client;
    }

    public void setTelephone_client(String telephone_client) {
        this.telephone_client = telephone_client;
    }

    public String getAdresse_client() {
        return adresse_client;
    }

    public void setAdresse_client(String adresse_client) {
        this.adresse_client = adresse_client;
    }

    public String getCode_postal_client() {
        return code_postal_client;
    }

    public void setCode_postal_client(String code_postal_client) {
        this.code_postal_client = code_postal_client;
    }

    public String getVille_client() {
        return ville_client;
    }

    public void setVille_client(String ville_client) {
        this.ville_client = ville_client;
    }

    public String getEmail_client() {
        return email_client;
    }

    public void setEmail_client(String email_client) {
        this.email_client = email_client;
    }

    public String getMdp_client() {
        return mdp_client;
    }

    public void setMdp_client(String mdp_client) {
        this.mdp_client = mdp_client;
    }
}