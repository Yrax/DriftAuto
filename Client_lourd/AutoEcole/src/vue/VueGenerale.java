package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

import controleur.AutoEcole;

import javax.swing.JButton;

public class VueGenerale extends JFrame implements ActionListener {

	private JPanel panelMenu = new JPanel();
	private JButton btProfil = new JButton("Profil");
	private JButton btClients = new JButton("Clients");
	private JButton btMoniteurs = new JButton("Moniteurs");
	private JButton btLecons = new JButton("Lecons");
	private JButton btExamens = new JButton("Examens");
	private JButton btVoitures = new JButton("Voitures");
	private JButton btFormations = new JButton("Formations");
	private JButton btPossede = new JButton("Possede");
	private JButton btContient = new JButton("Contient");
	private JButton btAchete = new JButton("Achete");
	private JButton btQuitter = new JButton("Quitter");
	
	//creation des panels
	private PanelProfil unPanelProfil = new PanelProfil ("Gestion du Profil");
	private PanelClients unPanelClients = new PanelClients("Gestion des Clients");
	private PanelMoniteurs unPanelMoniteurs = new PanelMoniteurs("Gestion des Moniteurs");
	private PanelLecons unPanelLecons = new PanelLecons("Gestion des Lecons");
	private PanelExamens unPanelExamens = new PanelExamens("Gestion des Examens");
	private PanelVoitures unPanelVoitures = new PanelVoitures("Gestion des Voitures");
	private PanelFormations unPanelFormations = new PanelFormations("Gestion des Formations");
	private PanelPossede unPanelPossede = new PanelPossede("Gestion de Possede");
	private PanelContient unPanelContient = new PanelContient("Gestion de Contient");
	private PanelAchete unPanelAchete = new PanelAchete("Gestion d'Achete");

	public VueGenerale() { //constructeur
		this.setTitle("Drift_Auto");
		this.setBounds(10, 10, 1500, 800);
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setResizable(false);
		this.getContentPane().setBackground(Color.darkGray);
		this.setLayout(null);
		
		//placement du panel avec les boutons
		this.panelMenu.setBounds(92, 10, 1300, 30);
		this.panelMenu.setBackground(Color.darkGray);
		this.panelMenu.setLayout(new GridLayout(1, 6, 10, 10));
		this.panelMenu.add(this.btProfil);
		this.panelMenu.add(this.btClients);
		this.panelMenu.add(this.btMoniteurs);
		this.panelMenu.add(this.btLecons);
		this.panelMenu.add(this.btExamens);
		this.panelMenu.add(this.btVoitures);
		this.panelMenu.add(this.btFormations);
		this.panelMenu.add(this.btPossede);
		this.panelMenu.add(this.btContient);
		this.panelMenu.add(this.btAchete);
		this.panelMenu.add(this.btQuitter);
		this.add(this.panelMenu);
		
		//rendre les boutons écoutables
		this.btProfil.addActionListener(this);
		this.btClients.addActionListener(this);
		this.btLecons.addActionListener(this);
		this.btExamens.addActionListener(this);
		this.btVoitures.addActionListener(this);
		this.btMoniteurs.addActionListener(this);
		this.btFormations.addActionListener(this);
		this.btPossede.addActionListener(this);
		this.btContient.addActionListener(this);
		this.btAchete.addActionListener(this);
		this.btQuitter.addActionListener(this);
		
		//ajouter les panels dans la fenêtre
		this.add(this.unPanelProfil);
		this.add(this.unPanelClients);
		this.add(this.unPanelMoniteurs);
		this.add(this.unPanelLecons);
		this.add(this.unPanelExamens);
		this.add(this.unPanelVoitures);
		this.add(this.unPanelFormations);
		this.add(this.unPanelPossede);
		this.add(this.unPanelContient);
		this.add(this.unPanelAchete);
		
		this.setVisible(true);
	}
	
	public void afficherPanel (int choix) {
		this.unPanelProfil.setVisible(false);
		this.unPanelClients.setVisible(false);
		this.unPanelMoniteurs.setVisible(false);
		this.unPanelLecons.setVisible(false);
		this.unPanelExamens.setVisible(false);
		this.unPanelVoitures.setVisible(false);
		this.unPanelFormations.setVisible(false);
		this.unPanelPossede.setVisible(false);
		this.unPanelContient.setVisible(false);
		this.unPanelAchete.setVisible(false);
		switch (choix) {
			case 1 : this.unPanelProfil.setVisible(true); break;
			case 2 : this.unPanelClients.setVisible(true); break;
			case 3 : this.unPanelMoniteurs.setVisible(true);break;
			case 4 : this.unPanelLecons.setVisible(true);break;
			case 5 : this.unPanelExamens.setVisible(true);break;
			case 6 : this.unPanelVoitures.setVisible(true);break;
			case 7 : this.unPanelFormations.setVisible(true);break;
			case 8 : this.unPanelPossede.setVisible(true);break;
			case 9 : this.unPanelContient.setVisible(true);break;
			case 10 : this.unPanelAchete.setVisible(true);break;
		}
	}
	
    public static JLabel creeLabelBlanc(String texte) {
        JLabel lbl = new JLabel(texte);
        lbl.setForeground(Color.white);
        return lbl;
    }
    
	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == this.btQuitter) {
			int retour = JOptionPane.showConfirmDialog(this, 
					"Voulez-vous quitter l'application", "Quitter l'application",
					JOptionPane.YES_NO_OPTION);
			if (retour == 0) {
				AutoEcole.creerDetruireVueGenerale(false);
				AutoEcole.rendreVisibleVueConnexion(true);
			}
		}
		else if (e.getSource() == this.btProfil) {
			this.afficherPanel(1);
		}
		else if (e.getSource() == this.btClients) {
			this.afficherPanel(2);
		}
		else if (e.getSource() == this.btMoniteurs) {
			this.afficherPanel(3);
		}
		else if (e.getSource() == this.btLecons) {
			this.afficherPanel(4);
		}
		else if (e.getSource() == this.btExamens) {
			this.afficherPanel(5);
		}
		else if (e.getSource() == this.btVoitures) {
			this.afficherPanel(6);
		}
		else if (e.getSource() == this.btFormations) {
			this.afficherPanel(7);
		}
		else if (e.getSource() == this.btPossede) {
			this.afficherPanel(8);
		}
		else if (e.getSource() == this.btContient) {
			this.afficherPanel(9);
		}
		else if (e.getSource() == this.btAchete) {
			this.afficherPanel(10);
		}
	}
}
