package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.ArrayList;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextField;

import controleur.Lecon;
import controleur.Moniteur;
import controleur.Client;
import controleur.Controleur;
import controleur.Tableau;
import controleur.Voiture;

public class PanelLecons extends PanelPrincipal implements ActionListener
{
    private JPanel panelForm = new JPanel();
    private JTextField txtDateHeure = new JTextField();
    private JTextField txtStatus = new JTextField();
    private JComboBox<String> cmbMoniteur = new JComboBox<>();
    private JComboBox<String> cmbClient = new JComboBox<>();
    private JComboBox<String> cmbVoiture = new JComboBox<>();

    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");
    private JButton btModifier = new JButton("Modifier");
    private JButton btSupprimer = new JButton("Supprimer");

    private JTable tableLecons;
    private JScrollPane scrollLecons;
    private Tableau unTableau;

    private JPanel panelFiltre = new JPanel();
    private JTextField txtFiltre = new JTextField();
    private JButton btFiltrer = new JButton("Filtrer");

    private JLabel lbNbLecons = new JLabel();

    public PanelLecons(String titre) {
        super(titre);

        // Placement du Panel Filtre
        this.panelFiltre.setBounds(550, 80, 450, 30);
        this.panelFiltre.setBackground(Color.darkGray);
        this.panelFiltre.setLayout(new GridLayout(1, 3, 10, 10));

        this.panelFiltre.add(VueGenerale.creeLabelBlanc("Filtrer par : "));
        this.panelFiltre.add(this.txtFiltre);
        this.panelFiltre.add(btFiltrer);
        this.add(this.panelFiltre);

        // Chargement des ComboBox
        this.chargerComboMoniteurs();
        this.chargerComboClients();
        this.chargerComboVoitures();

        // Placement du formulaire dans la fenêtre
        this.panelForm.setBounds(120, 80, 380, 250);
        this.panelForm.setBackground(Color.darkGray);
        this.panelForm.setLayout(new GridLayout(8, 2, 10, 10));

        this.panelForm.add(VueGenerale.creeLabelBlanc("Date et heure : "));
        this.panelForm.add(this.txtDateHeure);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Statut : "));
        this.panelForm.add(this.txtStatus);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Moniteur : "));
        this.panelForm.add(this.cmbMoniteur);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Client : "));
        this.panelForm.add(this.cmbClient);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Voiture : "));
        this.panelForm.add(this.cmbVoiture);

        this.panelForm.add(btAnnuler);
        this.panelForm.add(btValider);

        this.panelForm.add(btModifier);
        this.panelForm.add(btSupprimer);

        this.add(this.panelForm);

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);

        // Rendre les boutons écoutables
        this.btAnnuler.addActionListener(this);
        this.btValider.addActionListener(this);
        this.btModifier.addActionListener(this);
        this.btSupprimer.addActionListener(this);
        this.btFiltrer.addActionListener(this);
        this.txtFiltre.addActionListener(this);

        // Placement de la ScrollLecons
        String[] entetes = {"ID lecon", "Date et heure", "Status", "Moniteur", "Client", "Immatriculation"};

        this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
        this.tableLecons = new JTable(this.unTableau);

        this.scrollLecons = new JScrollPane(this.tableLecons);
        this.scrollLecons.setBackground(Color.darkGray);
        this.scrollLecons.setBounds(550, 120, 800, 300);
        this.add(this.scrollLecons);

        // Sur clic de la souris, les champs seront remplis par la ligne sélectionnée
        this.tableLecons.addMouseListener(new MouseListener() {
            @Override
            public void mouseReleased(MouseEvent e) {}
            @Override
            public void mousePressed(MouseEvent e) {}
            @Override
            public void mouseExited(MouseEvent e) {}
            @Override
            public void mouseEntered(MouseEvent e) {}
            @Override
            public void mouseClicked(MouseEvent e) {
                int numLigne = tableLecons.getSelectedRow();
                txtDateHeure.setText(unTableau.getValueAt(numLigne, 1).toString());
                txtStatus.setText(unTableau.getValueAt(numLigne, 2).toString());

                // Sélectionner la bonne valeur dans chaque ComboBox
                String moniteurVal = unTableau.getValueAt(numLigne, 3).toString();
                String clientVal = unTableau.getValueAt(numLigne, 4).toString();
                String voitureVal = unTableau.getValueAt(numLigne, 5).toString();

                for (int i = 0; i < cmbMoniteur.getItemCount(); i++) {
                    if (cmbMoniteur.getItemAt(i).startsWith(moniteurVal + " -")) {
                        cmbMoniteur.setSelectedIndex(i);
                        break;
                    }
                }
                for (int i = 0; i < cmbClient.getItemCount(); i++) {
                    if (cmbClient.getItemAt(i).startsWith(clientVal + " -")) {
                        cmbClient.setSelectedIndex(i);
                        break;
                    }
                }
                for (int i = 0; i < cmbVoiture.getItemCount(); i++) {
                    if (cmbVoiture.getItemAt(i).equals(voitureVal)) {
                        cmbVoiture.setSelectedIndex(i);
                        break;
                    }
                }

                btSupprimer.setEnabled(true);
                btModifier.setEnabled(true);
            }
        });

        // Placement du JLabel
        this.lbNbLecons.setBounds(600, 430, 400, 20);
        this.lbNbLecons.setText("Le nombre de leçons est de : " + this.unTableau.getRowCount());
        this.lbNbLecons.setForeground(Color.white);
        this.add(this.lbNbLecons);
    }

    public void chargerComboMoniteurs() {
        this.cmbMoniteur.removeAllItems();
        ArrayList<Moniteur> lesMoniteurs = Controleur.selectAllMoniteurs("");
        for (Moniteur unMoniteur : lesMoniteurs) {
            this.cmbMoniteur.addItem(unMoniteur.getNumero_moniteur() + " - "
                    + unMoniteur.getNom_moniteur() + " - "
                    + unMoniteur.getPrenom_moniteur());
        }
    }

    public void chargerComboClients() {
        this.cmbClient.removeAllItems();
        ArrayList<Client> lesClients = Controleur.selectAllClients("");
        for (Client unClient : lesClients) {
            this.cmbClient.addItem(unClient.getNumero_client() + " - "
                    + unClient.getNom_client() + " - "
                    + unClient.getPrenom_client());
        }
    }

    public void chargerComboVoitures() {
        this.cmbVoiture.removeAllItems();
        ArrayList<Voiture> lesVoitures = Controleur.selectAllVoitures("");
        for (Voiture uneVoiture : lesVoitures) {
            this.cmbVoiture.addItem(uneVoiture.getNumero_immatriculation());
        }
    }

    public int getIdDepuisCombo(JComboBox<String> combo) {
        String selection = combo.getSelectedItem().toString();
        return Integer.parseInt(selection.split(" - ")[0]);
    }

    public Object[][] obtenirDonnees(String filtre) {
        ArrayList<Lecon> lesLecons = Controleur.selectAllLecons(filtre);
        Object[][] matrice = new Object[lesLecons.size()][6];
        int i = 0;
        for (Lecon uneLecon : lesLecons) {
            matrice[i][0] = uneLecon.getNumero_lecon();
            matrice[i][1] = uneLecon.getDate_heure_lecon();
            matrice[i][2] = uneLecon.getStatut();
            matrice[i][3] = uneLecon.getNumero_moniteur();
            matrice[i][4] = uneLecon.getNumero_client();
            matrice[i][5] = uneLecon.getNumero_immatriculation();
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
            this.insertLecon();
        }
        else if (e.getSource() == this.btModifier) {
            this.updateLecon();
        }
        else if (e.getSource() == this.btSupprimer) {
            this.deleteLecon();
        }
        else if (e.getSource() == this.btFiltrer || e.getSource() == this.txtFiltre) {
            String filtre = this.txtFiltre.getText();
            this.unTableau.setDonnees(this.obtenirDonnees(filtre));
        }
    }

    public void viderChamps() {
        this.txtDateHeure.setText("");
        this.txtStatus.setText("");
        this.cmbMoniteur.setSelectedIndex(0);
        this.cmbClient.setSelectedIndex(0);
        this.cmbVoiture.setSelectedIndex(0);

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);
    }

    public void insertLecon() {
        String dateHeure = this.txtDateHeure.getText();
        String status = this.txtStatus.getText();

        if (dateHeure.equals("") || status.equals("") 
                || this.cmbMoniteur.getSelectedItem() == null
                || this.cmbClient.getSelectedItem() == null
                || this.cmbVoiture.getSelectedItem() == null) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            int numeroMoniteur = this.getIdDepuisCombo(this.cmbMoniteur);
            int numeroClient = this.getIdDepuisCombo(this.cmbClient);
            String numeroImmatriculation = this.cmbVoiture.getSelectedItem().toString();

            Lecon uneLecon = new Lecon(dateHeure, status, numeroMoniteur, numeroClient, numeroImmatriculation);

            Controleur.insertLecon(uneLecon);

            JOptionPane.showMessageDialog(this, "Insertion réussie de la leçon.");

            this.unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbLecons.setText("Le nombre de leçons est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }

    public void updateLecon() {
        int numLigne = tableLecons.getSelectedRow();
        int numero_lecon = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());

        String dateHeure = this.txtDateHeure.getText();
        String status = this.txtStatus.getText();

        if (dateHeure.equals("") || status.equals("")) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            int numeroMoniteur = this.getIdDepuisCombo(this.cmbMoniteur);
            int numeroClient = this.getIdDepuisCombo(this.cmbClient);
            String numeroImmatriculation = this.cmbVoiture.getSelectedItem().toString();

            Lecon uneLecon = new Lecon(numero_lecon, dateHeure, status,
                    numeroMoniteur, numeroClient, numeroImmatriculation);

            Controleur.updateLecon(uneLecon);
            JOptionPane.showMessageDialog(this, "Modification réussie de la leçon.");
            unTableau.setDonnees(this.obtenirDonnees(""));

            this.viderChamps();
        }
    }

    public void deleteLecon() {
        int numLigne = tableLecons.getSelectedRow();
        int numero_lecon = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());

        int retour = JOptionPane.showConfirmDialog(this, "Voulez-vous supprimer cette leçon ?",
                "Suppression", JOptionPane.YES_NO_OPTION);
        if (retour == 0) {
            Controleur.deleteLecon(numero_lecon);
            unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbLecons.setText("Le nombre de leçons est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }
}