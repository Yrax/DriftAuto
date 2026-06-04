package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

import controleur.AutoEcole;
import controleur.Controleur;
import controleur.Moniteur;

public class VueConnexion extends JFrame implements ActionListener {

	private JPanel panelForm = new JPanel(); //div en html
	private JTextField txtEmail = new JTextField("jean.dupond@driftauto.mo");
	private JPasswordField txtMdp = new JPasswordField("mdp123");
	private JButton btAnnuler = new JButton("Annuler");
	private JButton btValider = new JButton("Valider");
	
	public VueConnexion () {
		this.setTitle("CL Auto Ecole");
		this.setBounds(200, 10, 600, 500);
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setResizable(false);
		this.getContentPane().setBackground(Color.black);
		this.setLayout(null);
		
		//ajout du logo
		ImageIcon uneImageOriginale = new ImageIcon("src/images/logo.png");
		Image imageRedim = uneImageOriginale.getImage().getScaledInstance(300, 300, Image.SCALE_SMOOTH);
		ImageIcon uneImage = new ImageIcon(imageRedim);
		JLabel lbLogo = new JLabel(uneImage);
		lbLogo.setBounds(180, -30, 230, 350);
		this.add(lbLogo);
		
		//Placement du formulaire panelForm
		this.panelForm.setBounds(140, 305, 320, 140);
		this.panelForm.setBackground(Color.black);
		this.panelForm.setLayout(new GridLayout(3, 2));
		
		JLabel lblEmail = new JLabel("Email : ");
		lblEmail.setForeground(Color.white);

		JLabel lblMdp = new JLabel("MDP : ");
		lblMdp.setForeground(Color.white);

		this.panelForm.add(lblEmail);
		this.panelForm.add(this.txtEmail);

		this.panelForm.add(lblMdp);
		this.panelForm.add(this.txtMdp);

		this.panelForm.add(this.btAnnuler);
		this.panelForm.add(this.btValider);
	
		this.add(this.panelForm);
		
		//rendre les boutons écoutables
		this.btAnnuler.addActionListener(this);
		this.btValider.addActionListener(this);
		
		this.setVisible(true);
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == this.btAnnuler) {
			this.viderChamps();
		}
		else if (e.getSource() == this.btValider) {
			this.traitement();
		}
	}
	
	public void viderChamps() {
		this.txtEmail.setText("");
		this.txtMdp.setText("");
	}
	
	public void traitement() {
	    String email = this.txtEmail.getText();
	    String mdp = new String(this.txtMdp.getPassword());

	    if (email.equals("") || mdp.equals("")) {
	        JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs");
	    }
	    else {
	        //rechercher le moniteur dans la BDD
	        Moniteur leMoniteur = Controleur.selectWhereMoniteur(email, mdp);
	        if (leMoniteur == null) {
	            JOptionPane.showMessageDialog(this, "Veuillez vérifier les identifiants.");
	        }
	        else {
	            JOptionPane.showMessageDialog(this, "Bienvenue " + leMoniteur.getNom_moniteur() + " " + leMoniteur.getPrenom_moniteur());
	            //on ouvre la vue générale
	            AutoEcole.rendreVisibleVueConnexion(false);
	            AutoEcole.creerDetruireVueGenerale(true);

	            //save to userconnecte
	            AutoEcole.setUserConnecte(leMoniteur);

	            //actualiser les infos userConnecte
	            PanelProfil.actualiserInfosUser();
	        }
	    }
	}
}
