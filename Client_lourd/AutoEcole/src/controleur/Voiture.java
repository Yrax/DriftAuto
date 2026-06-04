package controleur;

public class Voiture {
    private String numero_immatriculation;
    private String date_achat;
    private int nombre_km;

    public Voiture(String numero_immatriculation, String date_achat, int nombre_km) {
        this.numero_immatriculation = numero_immatriculation;
        this.date_achat = date_achat;
        this.nombre_km = nombre_km;
    }

	public String getNumero_immatriculation() {
		return numero_immatriculation;
	}

	public void setNumero_immatriculation(String numero_immatriculation) {
		this.numero_immatriculation = numero_immatriculation;
	}

	public String getDate_achat() {
		return date_achat;
	}

	public void setDate_achat(String date_achat) {
		this.date_achat = date_achat;
	}

	public int getNombre_km() {
		return nombre_km;
	}

	public void setNombre_km(int nombre_km) {
		this.nombre_km = nombre_km;
	}
}