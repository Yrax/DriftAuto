package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.*;
import java.util.ArrayList;

import javax.swing.*;

import controleur.Client;
import controleur.Controleur;
import controleur.Tableau;

public class PanelClients extends PanelPrincipal implements ActionListener {

	private JPanel panelForm = new JPanel();

	private JTextField txtPseudo = new JTextField();
	private JTextField txtNom = new JTextField();
	private JTextField txtPrenom = new JTextField();
	private JTextField txtDateNaissance = new JTextField();
	private JTextField txtTelephone = new JTextField();
	private JTextField txtAdresse = new JTextField();
	private JTextField txtCodePostal = new JTextField();
	private JTextField txtVille = new JTextField();
	private JTextField txtEmail = new JTextField();
	private JTextField txtMdp = new JTextField();

	private JButton btAnnuler = new JButton("Annuler");
	private JButton btValider = new JButton("Valider");
	private JButton btModifier = new JButton("Modifier");
	private JButton btSupprimer = new JButton("Supprimer");

	private JTable tableClients;
	private JScrollPane scrollClients;
	private Tableau unTableau;

	private JPanel panelFiltre = new JPanel();
	private JTextField txtFiltre = new JTextField();
	private JButton btFiltrer = new JButton("Filtrer");

	private JLabel lbNbClients = new JLabel();

	public PanelClients(String titre) {
		super(titre);

		// PANEL FILTRE
		this.panelFiltre.setBounds(550, 80, 450, 30);
		this.panelFiltre.setBackground(Color.darkGray);
		this.panelFiltre.setLayout(new GridLayout(1, 3, 10, 10));

		this.panelFiltre.add(VueGenerale.creeLabelBlanc("Filtrer par : "));
		this.panelFiltre.add(this.txtFiltre);
		this.panelFiltre.add(btFiltrer);
		this.add(this.panelFiltre);

		// FORMULAIRE
		this.panelForm.setBounds(120, 80, 380, 400);
		this.panelForm.setBackground(Color.darkGray);
		this.panelForm.setLayout(new GridLayout(12, 2, 10, 10));

		this.panelForm.add(VueGenerale.creeLabelBlanc("Pseudo : "));
		this.panelForm.add(this.txtPseudo);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Nom : "));
		this.panelForm.add(this.txtNom);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Prénom : "));
		this.panelForm.add(this.txtPrenom);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Date naissance : "));
		this.panelForm.add(this.txtDateNaissance);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Téléphone : "));
		this.panelForm.add(this.txtTelephone);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Adresse : "));
		this.panelForm.add(this.txtAdresse);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Code postal : "));
		this.panelForm.add(this.txtCodePostal);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Ville : "));
		this.panelForm.add(this.txtVille);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Email : "));
		this.panelForm.add(this.txtEmail);

		this.panelForm.add(VueGenerale.creeLabelBlanc("Mot de passe : "));
		this.panelForm.add(this.txtMdp);

		this.panelForm.add(btAnnuler);
		this.panelForm.add(btValider);

		this.panelForm.add(btModifier);
		this.panelForm.add(btSupprimer);

		this.add(this.panelForm);

		this.btModifier.setEnabled(false);
		this.btSupprimer.setEnabled(false);

		// LISTENERS
		btAnnuler.addActionListener(this);
		btValider.addActionListener(this);
		btModifier.addActionListener(this);
		btSupprimer.addActionListener(this);
		btFiltrer.addActionListener(this);
		txtFiltre.addActionListener(this);

		// TABLE
		String[] entetes = {
			"ID", "Pseudo", "Nom", "Prénom", "Naissance",
			"Téléphone", "Adresse", "CP", "Ville", "Email", "MDP"
		};

		this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
		this.tableClients = new JTable(this.unTableau);

		this.scrollClients = new JScrollPane(this.tableClients);
		this.scrollClients.setBounds(550, 120, 800, 300);
		this.add(this.scrollClients);

		// CLICK TABLE
		this.tableClients.addMouseListener(new MouseAdapter() {
			public void mouseClicked(MouseEvent e) {
				int ligne = tableClients.getSelectedRow();

				txtPseudo.setText(unTableau.getValueAt(ligne, 1).toString());
				txtNom.setText(unTableau.getValueAt(ligne, 2).toString());
				txtPrenom.setText(unTableau.getValueAt(ligne, 3).toString());
				txtDateNaissance.setText(unTableau.getValueAt(ligne, 4).toString());
				txtTelephone.setText(unTableau.getValueAt(ligne, 5).toString());
				txtAdresse.setText(unTableau.getValueAt(ligne, 6).toString());
				txtCodePostal.setText(unTableau.getValueAt(ligne, 7).toString());
				txtVille.setText(unTableau.getValueAt(ligne, 8).toString());
				txtEmail.setText(unTableau.getValueAt(ligne, 9).toString());
				txtMdp.setText(unTableau.getValueAt(ligne, 10).toString());

				btModifier.setEnabled(true);
				btSupprimer.setEnabled(true);
			}
		});

		// LABEL
		this.lbNbClients.setBounds(600, 430, 400, 20);
		this.lbNbClients.setForeground(Color.white);
		this.lbNbClients.setText("Le nombre de clients est de : " + this.unTableau.getRowCount());
		this.add(this.lbNbClients);
	}

	// ================== DONNEES ==================
	public Object[][] obtenirDonnees(String filtre) {
		ArrayList<Client> lesClients = Controleur.selectAllClients(filtre);
		Object[][] matrice = new Object[lesClients.size()][11];

		int i = 0;
		for (Client c : lesClients) {
			matrice[i][0] = c.getNumero_client();
			matrice[i][1] = c.getPseudo_client();
			matrice[i][2] = c.getNom_client();
			matrice[i][3] = c.getPrenom_client();
			matrice[i][4] = c.getDate_naissance_client();
			matrice[i][5] = c.getTelephone_client();
			matrice[i][6] = c.getAdresse_client();
			matrice[i][7] = c.getCode_postal_client();
			matrice[i][8] = c.getVille_client();
			matrice[i][9] = c.getEmail_client();
			matrice[i][10] = c.getMdp_client();
			i++;
		}
		return matrice;
	}

	// ================== ACTIONS ==================
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == btAnnuler) viderChamps();
		else if (e.getSource() == btValider) insertClient();
		else if (e.getSource() == btModifier) updateClient();
		else if (e.getSource() == btSupprimer) deleteClient();
		else if (e.getSource() == btFiltrer || e.getSource() == txtFiltre) {
			unTableau.setDonnees(obtenirDonnees(txtFiltre.getText()));
		}
	}

	public void viderChamps() {
		txtPseudo.setText("");
		txtNom.setText("");
		txtPrenom.setText("");
		txtDateNaissance.setText("");
		txtTelephone.setText("");
		txtAdresse.setText("");
		txtCodePostal.setText("");
		txtVille.setText("");
		txtEmail.setText("");
		txtMdp.setText("");

		btModifier.setEnabled(false);
		btSupprimer.setEnabled(false);
	}

	public void insertClient() {
		Client c = new Client(
			txtPseudo.getText(),
			txtNom.getText(),
			txtPrenom.getText(),
			txtDateNaissance.getText(),
			txtTelephone.getText(),
			txtAdresse.getText(),
			txtCodePostal.getText(),
			txtVille.getText(),
			txtEmail.getText(),
			txtMdp.getText()
		);

		Controleur.insertClient(c);
		JOptionPane.showMessageDialog(this, "Insertion réussie");

		unTableau.setDonnees(obtenirDonnees(""));
		lbNbClients.setText("Nombre de clients : " + unTableau.getRowCount());
		viderChamps();
	}

	public void updateClient() {
		int ligne = tableClients.getSelectedRow();
		int id = Integer.parseInt(unTableau.getValueAt(ligne, 0).toString());

		Client c = new Client(
			id,
			txtPseudo.getText(),
			txtNom.getText(),
			txtPrenom.getText(),
			txtDateNaissance.getText(),
			txtTelephone.getText(),
			txtAdresse.getText(),
			txtCodePostal.getText(),
			txtVille.getText(),
			txtEmail.getText(),
			txtMdp.getText()
		);

		Controleur.updateClient(c);
		JOptionPane.showMessageDialog(this, "Modification réussie");

		unTableau.setDonnees(obtenirDonnees(""));
		viderChamps();
	}

	public void deleteClient() {
		int ligne = tableClients.getSelectedRow();
		int id = Integer.parseInt(unTableau.getValueAt(ligne, 0).toString());

		int retour = JOptionPane.showConfirmDialog(this, "Supprimer ce client ?", "Suppression", JOptionPane.YES_NO_OPTION);

		if (retour == 0) {
			Controleur.deleteClient(id);
			unTableau.setDonnees(obtenirDonnees(""));
			lbNbClients.setText("Nombre de clients : " + unTableau.getRowCount());
			viderChamps();
		}
	}
}