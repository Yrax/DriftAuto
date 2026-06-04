package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.ArrayList;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextField;

import controleur.Controleur;
import controleur.Formation;
import controleur.Tableau;

public class PanelFormations extends PanelPrincipal implements ActionListener
{
    private JPanel panelForm = new JPanel();
    private JTextField txtNom = new JTextField();
    private JTextField txtPrix = new JTextField();
    private JTextField txtTotalHeures = new JTextField();

    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");
    private JButton btModifier = new JButton("Modifier");
    private JButton btSupprimer = new JButton("Supprimer");

    private JTable tableFormations;
    private JScrollPane scrollFormations;
    private Tableau unTableau;

    private JPanel panelFiltre = new JPanel();
    private JTextField txtFiltre = new JTextField();
    private JButton btFiltrer = new JButton("Filtrer");

    private JLabel lbNbFormations = new JLabel();

    public PanelFormations(String titre) {
        super(titre);

        // Placement du Panel Filtre
        this.panelFiltre.setBounds(550, 80, 450, 30);
        this.panelFiltre.setBackground(Color.darkGray);
        this.panelFiltre.setLayout(new GridLayout(1, 3, 10, 10));

        this.panelFiltre.add(VueGenerale.creeLabelBlanc("Filtrer par : "));
        this.panelFiltre.add(this.txtFiltre);
        this.panelFiltre.add(btFiltrer);
        this.add(this.panelFiltre);

        // Placement du formulaire dans la fenêtre
        this.panelForm.setBounds(120, 80, 380, 200);
        this.panelForm.setBackground(Color.darkGray);
        this.panelForm.setLayout(new GridLayout(6, 2, 10, 10));

        this.panelForm.add(VueGenerale.creeLabelBlanc("Nom : "));
        this.panelForm.add(this.txtNom);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Prix : "));
        this.panelForm.add(this.txtPrix);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Total heures : "));
        this.panelForm.add(this.txtTotalHeures);

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

        // Placement de la ScrollFormations
        String[] entetes = {"ID formation", "Nom", "Prix", "Total heures"};

        this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
        this.tableFormations = new JTable(this.unTableau);

        this.scrollFormations = new JScrollPane(this.tableFormations);
        this.scrollFormations.setBackground(Color.darkGray);
        this.scrollFormations.setBounds(550, 120, 800, 300);
        this.add(this.scrollFormations);

        // Sur clic de la souris, les champs seront remplis par la ligne sélectionnée
        this.tableFormations.addMouseListener(new MouseListener() {
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
                int numLigne = tableFormations.getSelectedRow();
                txtNom.setText(unTableau.getValueAt(numLigne, 1).toString());
                txtPrix.setText(unTableau.getValueAt(numLigne, 2).toString());
                txtTotalHeures.setText(unTableau.getValueAt(numLigne, 3).toString());

                btSupprimer.setEnabled(true);
                btModifier.setEnabled(true);
            }
        });

        // Placement du JLabel
        this.lbNbFormations.setBounds(600, 430, 400, 20);
        this.lbNbFormations.setText("Le nombre de formations est de : " + this.unTableau.getRowCount());
        this.lbNbFormations.setForeground(Color.darkGray);
        this.add(this.lbNbFormations);
    }

    public Object[][] obtenirDonnees(String filtre) {
        ArrayList<Formation> lesFormations = Controleur.selectAllFormations(filtre);
        Object[][] matrice = new Object[lesFormations.size()][4];
        int i = 0;
        for (Formation uneFormation : lesFormations) {
            matrice[i][0] = uneFormation.getNumero_formation();
            matrice[i][1] = uneFormation.getNom_formation();
            matrice[i][2] = uneFormation.getPrix_formation();
            matrice[i][3] = uneFormation.getTotal_heures();
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
            this.insertFormation();
        }
        else if (e.getSource() == this.btModifier) {
            this.updateFormation();
        }
        else if (e.getSource() == this.btSupprimer) {
            this.deleteFormation();
        }
        else if (e.getSource() == this.btFiltrer || e.getSource() == this.txtFiltre) {
            String filtre = this.txtFiltre.getText();
            this.unTableau.setDonnees(this.obtenirDonnees(filtre));
        }
    }

    public void viderChamps() {
        this.txtNom.setText("");
        this.txtPrix.setText("");
        this.txtTotalHeures.setText("");

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);
    }

    public void insertFormation() {
        String nom = this.txtNom.getText();
        String prixStr = this.txtPrix.getText();
        String totalHeuresStr = this.txtTotalHeures.getText();

        if (nom.equals("") || prixStr.equals("") || totalHeuresStr.equals("")) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            double prix = Double.parseDouble(prixStr);
            int totalHeures = Integer.parseInt(totalHeuresStr);

            Formation uneFormation = new Formation(nom, prix, totalHeures);

            Controleur.insertFormation(uneFormation);

            JOptionPane.showMessageDialog(this, "Insertion réussie de la formation.");

            this.unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbFormations.setText("Le nombre de formations est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }

    public void updateFormation() {
        int numLigne = tableFormations.getSelectedRow();
        int numero_formation = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());

        String nom = this.txtNom.getText();
        String prixStr = this.txtPrix.getText();
        String totalHeuresStr = this.txtTotalHeures.getText();

        if (nom.equals("") || prixStr.equals("") || totalHeuresStr.equals("")) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            double prix = Double.parseDouble(prixStr);
            int totalHeures = Integer.parseInt(totalHeuresStr);

            Formation uneFormation = new Formation(numero_formation, nom, prix, totalHeures);

            Controleur.updateFormation(uneFormation);
            JOptionPane.showMessageDialog(this, "Modification réussie de la formation.");
            unTableau.setDonnees(this.obtenirDonnees(""));

            this.viderChamps();
        }
    }

    public void deleteFormation() {
        int numLigne = tableFormations.getSelectedRow();
        int numero_formation = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());

        int retour = JOptionPane.showConfirmDialog(this, "Voulez-vous supprimer cette formation ?",
                "Suppression", JOptionPane.YES_NO_OPTION);
        if (retour == 0) {
            Controleur.deleteFormation(numero_formation);
            unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbFormations.setText("Le nombre de formations est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }
}
