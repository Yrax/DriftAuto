package controleur;

import javax.swing.table.AbstractTableModel;

public class Tableau extends AbstractTableModel {

	private Object [][] donnees; //matrice des données
	private String [] entetes; //noms des colonnes
	
	public Tableau(Object[][] donnees, String[] entetes) {
		this.donnees = donnees;
		this.entetes = entetes;
	}

	@Override
	public int getRowCount() {
		return this.donnees.length; //nombre de lignes de la matrice
	}

	@Override
	public int getColumnCount() {
		return this.entetes.length; //nombre de colonnes
	}

	@Override
	public Object getValueAt(int i, int j) {
		return this.donnees[i][j]; //retourner une valeur à la position i-j
	}

	@Override
	public String getColumnName(int j) {
		return this.entetes[j]; //retourner le nom de la colonne
	}

	public void setDonnees(Object[][] matrice) {
		this.donnees = matrice;
		//actualiser les données
		this.fireTableDataChanged();
	}
}
