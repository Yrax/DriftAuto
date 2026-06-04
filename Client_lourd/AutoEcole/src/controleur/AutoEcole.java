package controleur;

import vue.VueConnexion;
import vue.VueGenerale;

public class AutoEcole {

	private static VueConnexion uneVueConnexion;
	private static VueGenerale uneVueGenerale;
	
	private static Moniteur moniteurConnecte = null;
	
	public static void main(String[] args) {
		uneVueConnexion = new VueConnexion();
	}

	public static Moniteur getMoniteurConnecte() {
		return moniteurConnecte;
	}

	public static void setUserConnecte(Moniteur moniteurConnecte) {
		AutoEcole.moniteurConnecte = moniteurConnecte;
	}

	public static void rendreVisibleVueConnexion(boolean action) {
		uneVueConnexion.setVisible(action);
	}
	
	public static void creerDetruireVueGenerale(boolean action) {
		if (action == true) {
			uneVueGenerale = new VueGenerale();
		} else {
			uneVueGenerale.dispose();
		}
	}
}
