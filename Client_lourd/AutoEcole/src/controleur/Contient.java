package controleur;

public class Contient {
    private int numero_lecon;
    private int numero_formation;

    public Contient(int numero_lecon, int numero_formation) {
        this.numero_lecon = numero_lecon;
        this.numero_formation = numero_formation;
    }

	public int getNumero_lecon() {
		return numero_lecon;
	}

	public void setNumero_lecon(int numero_lecon) {
		this.numero_lecon = numero_lecon;
	}

	public int getNumero_formation() {
		return numero_formation;
	}

	public void setNumero_formation(int numero_formation) {
		this.numero_formation = numero_formation;
	}
}
