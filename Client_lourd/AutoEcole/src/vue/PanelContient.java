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

import controleur.Contient;
import controleur.Controleur;
import controleur.Formation;
import controleur.Lecon;
import controleur.Tableau;

public class PanelContient extends PanelPrincipal implements ActionListener
{
    private JPanel panelForm = new JPanel();
    private JComboBox<String> cmbLecon = new JComboBox<>();
    private JComboBox<String> cmbFormation = new JComboBox<>();

    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");
    private JButton btModifier = new JButton("Modifier");
    private JButton btSupprimer = new JButton("Supprimer");

    private JTable tableContient;
    private JScrollPane scrollContient;
    private Tableau unTableau;

    private JPanel panelFiltre = new JPanel();
    private JTextField txtFiltre = new JTextField();
    private JButton btFiltrer = new JButton("Filtrer");

    private JLabel lbNbContient = new JLabel();

    public PanelContient(String titre) {
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
        this.chargerComboLecons();
        this.chargerComboFormations();

        // Placement du formulaire dans la fenêtre
        this.panelForm.setBounds(120, 80, 380, 180);
        this.panelForm.setBackground(Color.darkGray);
        this.panelForm.setLayout(new GridLayout(5, 2, 10, 10));

        this.panelForm.add(VueGenerale.creeLabelBlanc("Leçon : "));
        this.panelForm.add(this.cmbLecon);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Formation : "));
        this.panelForm.add(this.cmbFormation);

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

        // Placement de la ScrollContient
        String[] entetes = {"ID leçon", "ID formation"};

        this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
        this.tableContient = new JTable(this.unTableau);

        this.scrollContient = new JScrollPane(this.tableContient);
        this.scrollContient.setBackground(Color.darkGray);
        this.scrollContient.setBounds(550, 120, 800, 300);
        this.add(this.scrollContient);

        // Sur clic de la souris, les champs seront remplis par la ligne sélectionnée
        this.tableContient.addMouseListener(new MouseListener() {
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
                int numLigne = tableContient.getSelectedRow();

                String leconVal = unTableau.getValueAt(numLigne, 0).toString();
                String formationVal = unTableau.getValueAt(numLigne, 1).toString();

                for (int i = 0; i < cmbLecon.getItemCount(); i++) {
                    if (cmbLecon.getItemAt(i).startsWith(leconVal + " -")) {
                        cmbLecon.setSelectedIndex(i);
                        break;
                    }
                }
                for (int i = 0; i < cmbFormation.getItemCount(); i++) {
                    if (cmbFormation.getItemAt(i).startsWith(formationVal + " -")) {
                        cmbFormation.setSelectedIndex(i);
                        break;
                    }
                }

                btSupprimer.setEnabled(true);
                btModifier.setEnabled(true);
            }
        });

        // Placement du JLabel
        this.lbNbContient.setBounds(600, 430, 400, 20);
        this.lbNbContient.setText("Le nombre de liens leçon-formation est de : " + this.unTableau.getRowCount());
        this.lbNbContient.setForeground(Color.white);
        this.add(this.lbNbContient);
    }

    public void chargerComboLecons() {
        this.cmbLecon.removeAllItems();
        ArrayList<Lecon> lesLecons = Controleur.selectAllLecons("");
        for (Lecon uneLecon : lesLecons) {
            this.cmbLecon.addItem(uneLecon.getNumero_lecon() + " - "
                    + uneLecon.getDate_heure_lecon());
        }
    }

    public void chargerComboFormations() {
        this.cmbFormation.removeAllItems();
        ArrayList<Formation> lesFormations = Controleur.selectAllFormations("");
        for (Formation uneFormation : lesFormations) {
            this.cmbFormation.addItem(uneFormation.getNumero_formation() + " - "
                    + uneFormation.getNom_formation());
        }
    }

    public int getIdDepuisCombo(JComboBox<String> combo) {
        String selection = combo.getSelectedItem().toString();
        return Integer.parseInt(selection.split(" - ")[0]);
    }

    public Object[][] obtenirDonnees(String filtre) {
        ArrayList<Contient> lesContient = Controleur.selectAllContient(filtre);
        Object[][] matrice = new Object[lesContient.size()][2];
        int i = 0;
        for (Contient unContient : lesContient) {
            matrice[i][0] = unContient.getNumero_lecon();
            matrice[i][1] = unContient.getNumero_formation();
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
            this.insertContient();
        }
        else if (e.getSource() == this.btModifier) {
            this.updateContient();
        }
        else if (e.getSource() == this.btSupprimer) {
            this.deleteContient();
        }
        else if (e.getSource() == this.btFiltrer || e.getSource() == this.txtFiltre) {
            String filtre = this.txtFiltre.getText();
            this.unTableau.setDonnees(this.obtenirDonnees(filtre));
        }
    }

    public void viderChamps() {
        this.cmbLecon.setSelectedIndex(0);
        this.cmbFormation.setSelectedIndex(0);

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);
    }

    public void insertContient() {
        if (this.cmbLecon.getSelectedItem() == null
                || this.cmbFormation.getSelectedItem() == null) {
            JOptionPane.showMessageDialog(this, "Veuillez sélectionner tous les champs.");
        } else {
            int numeroLecon = this.getIdDepuisCombo(this.cmbLecon);
            int numeroFormation = this.getIdDepuisCombo(this.cmbFormation);

            Contient unContient = new Contient(numeroLecon, numeroFormation);

            Controleur.insertContient(unContient);

            JOptionPane.showMessageDialog(this, "Insertion réussie.");

            this.unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbContient.setText("Le nombre de liens leçon-formation est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }

    public void updateContient() {
        int numLigne = tableContient.getSelectedRow();
        int ancienNumeroLecon = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
        int ancienNumeroFormation = Integer.parseInt(unTableau.getValueAt(numLigne, 1).toString());

        if (this.cmbLecon.getSelectedItem() == null
                || this.cmbFormation.getSelectedItem() == null) {
            JOptionPane.showMessageDialog(this, "Veuillez sélectionner tous les champs.");
        } else {
            int numeroLecon = this.getIdDepuisCombo(this.cmbLecon);
            int numeroFormation = this.getIdDepuisCombo(this.cmbFormation);

            Contient unContient = new Contient(numeroLecon, numeroFormation);

            Controleur.updateContient(ancienNumeroLecon, ancienNumeroFormation, unContient);
            JOptionPane.showMessageDialog(this, "Modification réussie.");
            unTableau.setDonnees(this.obtenirDonnees(""));

            this.viderChamps();
        }
    }

    public void deleteContient() {
        int numLigne = tableContient.getSelectedRow();
        int numeroLecon = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
        int numeroFormation = Integer.parseInt(unTableau.getValueAt(numLigne, 1).toString());

        int retour = JOptionPane.showConfirmDialog(this, "Voulez-vous supprimer ce lien leçon-formation ?",
                "Suppression", JOptionPane.YES_NO_OPTION);
        if (retour == 0) {
            Controleur.deleteContient(numeroLecon, numeroFormation);
            unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbContient.setText("Le nombre de liens leçon-formation est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }
}
