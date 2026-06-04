package controleur;

public class Possede {
    private int numero_examen;
    private int numero_formation;

    public Possede(int numero_examen, int numero_formation) {
        this.numero_examen = numero_examen;
        this.numero_formation = numero_formation;
    }

	public int getNumero_examen() {
		return numero_examen;
	}

	public void setNumero_examen(int numero_examen) {
		this.numero_examen = numero_examen;
	}

	public int getNumero_formation() {
		return numero_formation;
	}

	public void setNumero_formation(int numero_formation) {
		this.numero_formation = numero_formation;
	}
}


