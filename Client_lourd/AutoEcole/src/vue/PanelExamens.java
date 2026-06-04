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

import controleur.Examen;
import controleur.Moniteur;
import controleur.Client;
import controleur.Controleur;
import controleur.Tableau;

public class PanelExamens extends PanelPrincipal implements ActionListener
{
    private JPanel panelForm = new JPanel();
    private JTextField txtDateHeureExamen = new JTextField();
    private static JComboBox<String> txtNumeroMoniteur = new JComboBox<String>();
    private static JComboBox<String> txtNumeroClient = new JComboBox<String>();

    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");
    private JButton btModifier = new JButton("Modifier");
    private JButton btSupprimer = new JButton("Supprimer");

    private JTable tableExamens;
    private JScrollPane scrollExamens;
    private Tableau unTableau;

    private JPanel panelFiltre = new JPanel();
    private JTextField txtFiltre = new JTextField();
    private JButton btFiltrer = new JButton("Filtrer");

    private JLabel lbNbExamens = new JLabel();

    public PanelExamens(String titre) {
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
        this.panelForm.setBounds(120, 80, 380, 200);
        this.panelForm.setBackground(Color.darkGray);
        this.panelForm.setLayout(new GridLayout(5, 2, 10, 10));

        this.panelForm.add(VueGenerale.creeLabelBlanc("Date et heure de l'examen : "));
        this.panelForm.add(this.txtDateHeureExamen);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Moniteur : "));
        this.panelForm.add(this.txtNumeroMoniteur);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Client : "));
        this.panelForm.add(this.txtNumeroClient);

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

        //placement de la ScrollExamens
        String[] entetes = {"ID examen", "Date et heure", "ID moniteur", "ID client"};

        this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
        this.tableExamens = new JTable(this.unTableau);

        this.scrollExamens = new JScrollPane(this.tableExamens);
        this.scrollExamens.setBackground(Color.darkGray);
        this.scrollExamens.setBounds(550, 120, 800, 300);
        this.add(this.scrollExamens);

        //sur clic de la souris, les champs seront remplis par la ligne selectionnée
        this.tableExamens.addMouseListener(new MouseListener() {
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
                int numLigne = tableExamens.getSelectedRow();
                txtDateHeureExamen.setText(unTableau.getValueAt(numLigne, 1).toString());

                btSupprimer.setEnabled(true);
                btModifier.setEnabled(true);
            }
        });

        //placement du JLabel
        this.lbNbExamens.setBounds(600, 430, 400, 20);
        this.lbNbExamens.setText("Le nombre d'examens est de : " + this.unTableau.getRowCount());
        this.lbNbExamens.setForeground(Color.white);
        this.add(this.lbNbExamens);

        //remplir les id des moniteurs et des clients
        remplirNumeroMoniteurs();
        remplirNumeroClients();
    }

    public static void remplirNumeroMoniteurs() {
        ArrayList<Moniteur> lesMoniteurs = Controleur.selectAllMoniteurs("");
        txtNumeroMoniteur.removeAllItems();
        for (Moniteur unMoniteur : lesMoniteurs) {
            txtNumeroMoniteur.addItem(unMoniteur.getNumero_moniteur() + "-" + unMoniteur.getNom_moniteur());
        }
    }

    public static void remplirNumeroClients() {
        ArrayList<Client> lesClients = Controleur.selectAllClients("");
        txtNumeroClient.removeAllItems();
        for (Client unClient : lesClients) {
            txtNumeroClient.addItem(unClient.getNumero_client() + "-" + unClient.getNom_client());
        }
    }

    public Object[][] obtenirDonnees(String filtre) {
        ArrayList<Examen> lesExamens = Controleur.selectAllExamens(filtre);
        Object[][] matrice = new Object[lesExamens.size()][4];
        int i = 0;
        for (Examen unExamen : lesExamens) {
            matrice[i][0] = unExamen.getNumero_examen();
            matrice[i][1] = unExamen.getDate_heure_examen();
            matrice[i][2] = unExamen.getNumero_moniteur();
            matrice[i][3] = unExamen.getNumero_client();
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
            this.insertExamen();
        }
        else if (e.getSource() == this.btModifier) {
            this.updateExamen();
        }
        else if (e.getSource() == this.btSupprimer) {
            this.deleteExamen();
        }
        else if (e.getSource() == this.btFiltrer || e.getSource() == this.txtFiltre) {
            String filtre = this.txtFiltre.getText();
            this.unTableau.setDonnees(this.obtenirDonnees(filtre));
        }
    }

    public void viderChamps() {
        this.txtDateHeureExamen.setText("");

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);
    }

    public void insertExamen() {
        String dateHeureExamen = this.txtDateHeureExamen.getText();
        int numeroMoniteur = Integer.parseInt(this.txtNumeroMoniteur.getSelectedItem().toString().split("-")[0]);
        int numeroClient = Integer.parseInt(this.txtNumeroClient.getSelectedItem().toString().split("-")[0]);

        if (dateHeureExamen.equals("") || numeroMoniteur == 0 || numeroClient == 0) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            Examen unExamen = new Examen(dateHeureExamen, numeroMoniteur, numeroClient);

            Controleur.insertExamen(unExamen);

            JOptionPane.showMessageDialog(this, "Insertion réussie de l'examen.");

            this.unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbExamens.setText("Le nombre d'examens est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }

    public void updateExamen() {
        int numLigne = tableExamens.getSelectedRow();
        int numeroExamen = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());

        String dateHeureExamen = this.txtDateHeureExamen.getText();
        int numeroMoniteur = Integer.parseInt(this.txtNumeroMoniteur.getSelectedItem().toString().split("-")[0]);
        int numeroClient = Integer.parseInt(this.txtNumeroClient.getSelectedItem().toString().split("-")[0]);

        if (dateHeureExamen.equals("") || numeroMoniteur == 0 || numeroClient == 0) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            Examen unExamen = new Examen(numeroExamen, dateHeureExamen, numeroMoniteur, numeroClient);

            Controleur.updateExamen(unExamen);
            JOptionPane.showMessageDialog(this, "Modification réussie de l'examen.");
            unTableau.setDonnees(this.obtenirDonnees(""));

            this.viderChamps();
        }
    }

    public void deleteExamen() {
        int numLigne = tableExamens.getSelectedRow();
        int numeroExamen = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());

        int retour = JOptionPane.showConfirmDialog(this, "Voulez-vous supprimer cet examen ?",
                "Suppression", JOptionPane.YES_NO_OPTION);
        if (retour == 0) {
            Controleur.deleteExamen(numeroExamen);
            unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbExamens.setText("Le nombre d'examens est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }
}