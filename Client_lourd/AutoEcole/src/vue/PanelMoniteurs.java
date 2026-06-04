package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.ArrayList;

import javax.swing.JButton;
import javax.swing.JCheckBox;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextField;

import controleur.Moniteur;
import controleur.Controleur;
import controleur.Tableau;

public class PanelMoniteurs extends PanelPrincipal implements ActionListener
{
    private JPanel panelForm = new JPanel();
    private JTextField txtNom = new JTextField();
    private JTextField txtPrenom = new JTextField();
    private JTextField txtDateNaissance = new JTextField();
    private JTextField txtTelephone = new JTextField();
    private JTextField txtAdresse = new JTextField();
    private JTextField txtCodePostal = new JTextField();
    private JTextField txtVille = new JTextField();
    private JTextField txtEmail = new JTextField();
    private JTextField txtDateEmbauche = new JTextField();
    private JCheckBox chkAdministrateur = new JCheckBox();
    private JTextField txtMdp = new JTextField();

    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");
    private JButton btModifier = new JButton("Modifier");
    private JButton btSupprimer = new JButton("Supprimer");

    private JTable tableMoniteurs;
    private JScrollPane scrollMoniteurs;
    private Tableau unTableau;

    private JPanel panelFiltre = new JPanel();
    private JTextField txtFiltre = new JTextField();
    private JButton btFiltrer = new JButton("Filtrer");

    private JLabel lbNbMoniteurs = new JLabel();

    public PanelMoniteurs(String titre) {
        super(titre);

        //Placement du Panel Filtre
        this.panelFiltre.setBounds(550, 80, 450, 30);
        this.panelFiltre.setBackground(Color.darkGray);
        this.panelFiltre.setLayout(new GridLayout(1, 3, 10, 10));

        this.panelFiltre.add(VueGenerale.creeLabelBlanc("Filtrer par : "));
        this.panelFiltre.add(this.txtFiltre);
        this.panelFiltre.add(btFiltrer);
        this.add(this.panelFiltre);

        //Placement du formulaire dans la fenêtre
        this.panelForm.setBounds(120, 80, 380, 600);
        this.panelForm.setBackground(Color.darkGray);
        this.panelForm.setLayout(new GridLayout(16, 2, 10, 10));

        this.panelForm.add(VueGenerale.creeLabelBlanc("Nom : "));
        this.panelForm.add(this.txtNom);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Prénom : "));
        this.panelForm.add(this.txtPrenom);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Date de naissance : "));
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

        this.panelForm.add(VueGenerale.creeLabelBlanc("Date d'embauche : "));
        this.panelForm.add(this.txtDateEmbauche);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Administrateur : "));
        this.panelForm.add(this.chkAdministrateur);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Mot de passe : "));
        this.panelForm.add(this.txtMdp);

        this.panelForm.add(btAnnuler);
        this.panelForm.add(btValider);

        this.panelForm.add(btModifier);
        this.panelForm.add(btSupprimer);

        this.add(this.panelForm);

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);

        //rendre les boutons écoutables
        this.btAnnuler.addActionListener(this);
        this.btValider.addActionListener(this);
        this.btModifier.addActionListener(this);
        this.btSupprimer.addActionListener(this);
        this.btFiltrer.addActionListener(this);
        this.txtFiltre.addActionListener(this);

        //placement de la ScrollMoniteurs
        String[] entetes = {"ID moniteur", "Nom", "Prénom", "Date de naissance", "Téléphone",
                "Adresse", "Code postal", "Ville", "Email", "Date d'embauche", "Administrateur",
                "Mot de passe"};

        this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
        this.tableMoniteurs = new JTable(this.unTableau);

        this.scrollMoniteurs = new JScrollPane(this.tableMoniteurs);
        this.scrollMoniteurs.setBackground(Color.darkGray);
        this.scrollMoniteurs.setBounds(550, 120, 800, 300);
        this.add(this.scrollMoniteurs);

        //sur clic de la souris, les champs seront remplis par la ligne selectionnée
        this.tableMoniteurs.addMouseListener(new MouseListener() {
            @Override
            public void mouseReleased(MouseEvent e) {
            }
            @Override
            public void mousePressed(MouseEvent e) {
            }
            @Override
            public void mouseExited(MouseEvent e) {
            }
            @Override
            public void mouseEntered(MouseEvent e) {
            }
            @Override
            public void mouseClicked(MouseEvent e) {
                int numLigne = tableMoniteurs.getSelectedRow();
                txtNom.setText(unTableau.getValueAt(numLigne, 1).toString());
                txtPrenom.setText(unTableau.getValueAt(numLigne, 2).toString());
                txtDateNaissance.setText(unTableau.getValueAt(numLigne, 3).toString());
                txtTelephone.setText(unTableau.getValueAt(numLigne, 4).toString());
                txtAdresse.setText(unTableau.getValueAt(numLigne, 5).toString());
                txtCodePostal.setText(unTableau.getValueAt(numLigne, 6).toString());
                txtVille.setText(unTableau.getValueAt(numLigne, 7).toString());
                txtEmail.setText(unTableau.getValueAt(numLigne, 8).toString());
                txtDateEmbauche.setText(unTableau.getValueAt(numLigne, 9).toString());
                chkAdministrateur.setSelected(Boolean.parseBoolean(unTableau.getValueAt(numLigne, 10).toString()));
                txtMdp.setText(unTableau.getValueAt(numLigne, 11).toString());

                btSupprimer.setEnabled(true);
                btModifier.setEnabled(true);
            }
        });

        //placement du JLabel
		this.lbNbMoniteurs.setBounds(600, 430, 400, 20);
        this.lbNbMoniteurs.setText("Le nombre de moniteurs est de : " + this.unTableau.getRowCount());
        this.lbNbMoniteurs.setForeground(Color.white);
        this.add(this.lbNbMoniteurs);
    }

    public Object[][] obtenirDonnees(String filtre) {
        ArrayList<Moniteur> lesMoniteurs = Controleur.selectAllMoniteurs(filtre);
        Object[][] matrice = new Object[lesMoniteurs.size()][15];
        int i = 0;
        for (Moniteur unMoniteur : lesMoniteurs) {
            matrice[i][0] = unMoniteur.getNumero_moniteur();
            matrice[i][1] = unMoniteur.getNom_moniteur();
            matrice[i][2] = unMoniteur.getPrenom_moniteur();
            matrice[i][3] = unMoniteur.getDate_naissance_moniteur();
            matrice[i][4] = unMoniteur.getTelephone_moniteur();
            matrice[i][5] = unMoniteur.getAdresse_moniteur();
            matrice[i][6] = unMoniteur.getCode_postal_moniteur();
            matrice[i][7] = unMoniteur.getVille_moniteur();
            matrice[i][8] = unMoniteur.getEmail_moniteur();
            matrice[i][9] = unMoniteur.getDate_embauche();
            matrice[i][10] = unMoniteur.isAdministrateur();
            matrice[i][11] = unMoniteur.getMdp_moniteur();
            i++;
        }
        return matrice;
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == this.btAnnuler) {
            this.viderChamps();
        }
        else if (e.getSource() == this.btValider) {
            this.insertMoniteur();
        }
        else if (e.getSource() == this.btModifier) {
            this.updateMoniteur();
        }
        else if (e.getSource() == this.btSupprimer) {
            this.deleteMoniteur();
        }
        else if (e.getSource() == this.btFiltrer || e.getSource() == this.txtFiltre) {
            String filtre = this.txtFiltre.getText();
            this.unTableau.setDonnees(this.obtenirDonnees(filtre));
        }
    }

    public void viderChamps() {
        this.txtNom.setText("");
        this.txtPrenom.setText("");
        this.txtDateNaissance.setText("");
        this.txtTelephone.setText("");
        this.txtAdresse.setText("");
        this.txtCodePostal.setText("");
        this.txtVille.setText("");
        this.txtEmail.setText("");
        this.txtDateEmbauche.setText("");
        this.chkAdministrateur.setSelected(false);
        this.txtMdp.setText("");

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);
    }

    public void insertMoniteur() {
        String nom = this.txtNom.getText();
        String prenom = this.txtPrenom.getText();
        String dateNaissance = this.txtDateNaissance.getText();
        String telephone = this.txtTelephone.getText();
        String adresse = this.txtAdresse.getText();
        String codePostal = this.txtCodePostal.getText();
        String ville = this.txtVille.getText();
        String email = this.txtEmail.getText();
        String dateEmbauche = this.txtDateEmbauche.getText();
        boolean administrateur = this.chkAdministrateur.isSelected();
        String mdp = this.txtMdp.getText();

        if (nom.equals("") || prenom.equals("") || dateNaissance.equals("")
                || telephone.equals("") || adresse.equals("") || codePostal.equals("")
                || ville.equals("") || email.equals("") || dateEmbauche.equals("")
                || mdp.equals("")) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            Moniteur unMoniteur = new Moniteur(nom, prenom, dateNaissance, telephone, adresse,
                    codePostal, ville, email, dateEmbauche, administrateur, mdp);

            Controleur.insertMoniteur(unMoniteur);

            JOptionPane.showMessageDialog(this, "Insertion réussie du moniteur.");

            this.unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbMoniteurs.setText("Le nombre de moniteurs est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }

    public void updateMoniteur() {
        int numLigne = tableMoniteurs.getSelectedRow();
        int numero_moniteur = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());

        String nom = this.txtNom.getText();
        String prenom = this.txtPrenom.getText();
        String dateNaissance = this.txtDateNaissance.getText();
        String telephone = this.txtTelephone.getText();
        String adresse = this.txtAdresse.getText();
        String codePostal = this.txtCodePostal.getText();
        String ville = this.txtVille.getText();
        String email = this.txtEmail.getText();
        String dateEmbauche = this.txtDateEmbauche.getText();
        boolean administrateur = this.chkAdministrateur.isSelected();
        String mdp = this.txtMdp.getText();

        if (nom.equals("") || prenom.equals("") || dateNaissance.equals("")
                || telephone.equals("") || adresse.equals("") || codePostal.equals("")
                || ville.equals("") || email.equals("") || dateEmbauche.equals("") || mdp.equals("")) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            Moniteur unMoniteur = new Moniteur(numero_moniteur, nom, prenom, dateNaissance,
                    telephone, adresse, codePostal, ville, email, dateEmbauche, administrateur, mdp);

            Controleur.updateMoniteur(unMoniteur);
            JOptionPane.showMessageDialog(this, "Modification réussie du moniteur.");
            unTableau.setDonnees(this.obtenirDonnees(""));

            this.viderChamps();
        }
    }

    public void deleteMoniteur() {
        int numLigne = tableMoniteurs.getSelectedRow();
        int numero_moniteur = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());

        int retour = JOptionPane.showConfirmDialog(this, "Voulez-vous supprimer ce moniteur ?",
                "Suppression", JOptionPane.YES_NO_OPTION);
        if (retour == 0) {
            Controleur.deleteMoniteur(numero_moniteur);
            unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbMoniteurs.setText("Le nombre de moniteurs est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }
}