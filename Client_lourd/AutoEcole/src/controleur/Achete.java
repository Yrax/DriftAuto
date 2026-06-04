package controleur;

public class Achete {
    private int numero_formation;
    private int numero_client;

    public Achete(int numero_formation, int numero_client) {
        this.numero_formation = numero_formation;
        this.numero_client = numero_client;
    }

	public int getNumero_formation() {
		return numero_formation;
	}

	public void setNumero_formation(int numero_formation) {
		this.numero_formation = numero_formation;
	}

	public int getNumero_client() {
		return numero_client;
	}

	public void setNumero_client(int numero_client) {
		this.numero_client = numero_client;
	}
}