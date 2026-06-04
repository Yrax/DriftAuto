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

import controleur.Possede;
import controleur.Controleur;
import controleur.Examen;
import controleur.Formation;
import controleur.Tableau;

public class PanelPossede extends PanelPrincipal implements ActionListener
{
    private JPanel panelForm = new JPanel();
    private JComboBox<String> cmbExamen = new JComboBox<>();
    private JComboBox<String> cmbFormation = new JComboBox<>();

    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");
    private JButton btModifier = new JButton("Modifier");
    private JButton btSupprimer = new JButton("Supprimer");

    private JTable tablePossede;
    private JScrollPane scrollPossede;
    private Tableau unTableau;

    private JPanel panelFiltre = new JPanel();
    private JTextField txtFiltre = new JTextField();
    private JButton btFiltrer = new JButton("Filtrer");

    private JLabel lbNbPossede = new JLabel();

    public PanelPossede(String titre) {
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
        this.chargerComboExamens();
        this.chargerComboFormations();

        // Placement du formulaire dans la fenêtre
        this.panelForm.setBounds(120, 80, 380, 180);
        this.panelForm.setBackground(Color.darkGray);
        this.panelForm.setLayout(new GridLayout(5, 2, 10, 10));

        this.panelForm.add(VueGenerale.creeLabelBlanc("Examen : "));
        this.panelForm.add(this.cmbExamen);

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

        // Placement de la ScrollPossede
        String[] entetes = {"ID examen", "ID formation"};

        this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
        this.tablePossede = new JTable(this.unTableau);

        this.scrollPossede = new JScrollPane(this.tablePossede);
        this.scrollPossede.setBackground(Color.darkGray);
        this.scrollPossede.setBounds(550, 120, 800, 300);
        this.add(this.scrollPossede);

        // Sur clic de la souris, les champs seront remplis par la ligne sélectionnée
        this.tablePossede.addMouseListener(new MouseListener() {
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
                int numLigne = tablePossede.getSelectedRow();

                String examenVal = unTableau.getValueAt(numLigne, 0).toString();
                String formationVal = unTableau.getValueAt(numLigne, 1).toString();

                for (int i = 0; i < cmbExamen.getItemCount(); i++) {
                    if (cmbExamen.getItemAt(i).startsWith(examenVal + " -")) {
                        cmbExamen.setSelectedIndex(i);
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
        this.lbNbPossede.setBounds(600, 430, 400, 20);
        this.lbNbPossede.setText("Le nombre de liens examen-formation est de : " + this.unTableau.getRowCount());
        this.lbNbPossede.setForeground(Color.white);
        this.add(this.lbNbPossede);
    }

    public void chargerComboExamens() {
        this.cmbExamen.removeAllItems();
        ArrayList<Examen> lesExamens = Controleur.selectAllExamens("");
        for (Examen unExamen : lesExamens) {
            this.cmbExamen.addItem(String.valueOf(unExamen.getNumero_examen()));
        }
    }

    public void chargerComboFormations() {
        this.cmbFormation.removeAllItems();
        ArrayList<Formation> lesFormations = Controleur.selectAllFormations("");
        for (Formation uneFormation : lesFormations) {
        	this.cmbFormation.addItem(String.valueOf(uneFormation.getNumero_formation()));
        }
    }

    public int getIdDepuisCombo(JComboBox<String> combo) {
        String selection = combo.getSelectedItem().toString();
        return Integer.parseInt(selection.split(" - ")[0]);
    }

    public Object[][] obtenirDonnees(String filtre) {
        ArrayList<Possede> lesPossede = Controleur.selectAllPossede(filtre);
        Object[][] matrice = new Object[lesPossede.size()][2];
        int i = 0;
        for (Possede unPossede : lesPossede) {
            matrice[i][0] = unPossede.getNumero_examen();
            matrice[i][1] = unPossede.getNumero_formation();
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
            this.insertPossede();
        }
        else if (e.getSource() == this.btModifier) {
            this.updatePossede();
        }
        else if (e.getSource() == this.btSupprimer) {
            this.deletePossede();
        }
        else if (e.getSource() == this.btFiltrer || e.getSource() == this.txtFiltre) {
            String filtre = this.txtFiltre.getText();
            this.unTableau.setDonnees(this.obtenirDonnees(filtre));
        }
    }

    public void viderChamps() {
        this.cmbExamen.setSelectedIndex(0);
        this.cmbFormation.setSelectedIndex(0);

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);
    }

    public void insertPossede() {
        if (this.cmbExamen.getSelectedItem() == null
                || this.cmbFormation.getSelectedItem() == null) {
            JOptionPane.showMessageDialog(this, "Veuillez sélectionner tous les champs.");
        } else {
            int numeroExamen = this.getIdDepuisCombo(this.cmbExamen);
            int numeroFormation = this.getIdDepuisCombo(this.cmbFormation);

            Possede unPossede = new Possede(numeroExamen, numeroFormation);

            Controleur.insertPossede(unPossede);

            JOptionPane.showMessageDialog(this, "Insertion réussie.");

            this.unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbPossede.setText("Le nombre de liens examen-formation est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }

    public void updatePossede() {
        int numLigne = tablePossede.getSelectedRow();
        int ancienNumeroExamen = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
        int ancienNumeroFormation = Integer.parseInt(unTableau.getValueAt(numLigne, 1).toString());

        if (this.cmbExamen.getSelectedItem() == null
                || this.cmbFormation.getSelectedItem() == null) {
            JOptionPane.showMessageDialog(this, "Veuillez sélectionner tous les champs.");
        } else {
            int numeroExamen = this.getIdDepuisCombo(this.cmbExamen);
            int numeroFormation = this.getIdDepuisCombo(this.cmbFormation);

            Possede unPossede = new Possede(numeroExamen, numeroFormation);

            Controleur.updatePossede(ancienNumeroExamen, ancienNumeroFormation, unPossede);
            JOptionPane.showMessageDialog(this, "Modification réussie.");
            unTableau.setDonnees(this.obtenirDonnees(""));

            this.viderChamps();
        }
    }

    public void deletePossede() {
        int numLigne = tablePossede.getSelectedRow();
        int numeroExamen = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
        int numeroFormation = Integer.parseInt(unTableau.getValueAt(numLigne, 1).toString());

        int retour = JOptionPane.showConfirmDialog(this, "Voulez-vous supprimer ce lien examen-formation ?",
                "Suppression", JOptionPane.YES_NO_OPTION);
        if (retour == 0) {
            Controleur.deletePossede(numeroExamen, numeroFormation);
            unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbPossede.setText("Le nombre de liens examen-formation est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }
}
