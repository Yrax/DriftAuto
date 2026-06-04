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

import controleur.Achete;
import controleur.Client;
import controleur.Controleur;
import controleur.Formation;
import controleur.Tableau;

public class PanelAchete extends PanelPrincipal implements ActionListener
{
    private JPanel panelForm = new JPanel();
    private JComboBox<String> cmbFormation = new JComboBox<>();
    private JComboBox<String> cmbClient = new JComboBox<>();

    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");
    private JButton btModifier = new JButton("Modifier");
    private JButton btSupprimer = new JButton("Supprimer");

    private JTable tableAchete;
    private JScrollPane scrollAchete;
    private Tableau unTableau;

    private JPanel panelFiltre = new JPanel();
    private JTextField txtFiltre = new JTextField();
    private JButton btFiltrer = new JButton("Filtrer");

    private JLabel lbNbAchete = new JLabel();

    public PanelAchete(String titre) {
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
        this.chargerComboFormations();
        this.chargerComboClients();

        // Placement du formulaire dans la fenêtre
        this.panelForm.setBounds(120, 80, 380, 180);
        this.panelForm.setBackground(Color.darkGray);
        this.panelForm.setLayout(new GridLayout(5, 2, 10, 10));

        this.panelForm.add(VueGenerale.creeLabelBlanc("Formation : "));
        this.panelForm.add(this.cmbFormation);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Client : "));
        this.panelForm.add(this.cmbClient);

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

        // Placement de la ScrollAchete
        String[] entetes = {"ID formation", "ID client"};

        this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
        this.tableAchete = new JTable(this.unTableau);

        this.scrollAchete = new JScrollPane(this.tableAchete);
        this.scrollAchete.setBackground(Color.darkGray);
        this.scrollAchete.setBounds(550, 120, 800, 300);
        this.add(this.scrollAchete);

        // Sur clic de la souris, les champs seront remplis par la ligne sélectionnée
        this.tableAchete.addMouseListener(new MouseListener() {
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
                int numLigne = tableAchete.getSelectedRow();

                String formationVal = unTableau.getValueAt(numLigne, 0).toString();
                String clientVal = unTableau.getValueAt(numLigne, 1).toString();

                for (int i = 0; i < cmbFormation.getItemCount(); i++) {
                    if (cmbFormation.getItemAt(i).startsWith(formationVal + " -")) {
                        cmbFormation.setSelectedIndex(i);
                        break;
                    }
                }
                for (int i = 0; i < cmbClient.getItemCount(); i++) {
                    if (cmbClient.getItemAt(i).startsWith(clientVal + " -")) {
                        cmbClient.setSelectedIndex(i);
                        break;
                    }
                }

                btSupprimer.setEnabled(true);
                btModifier.setEnabled(true);
            }
        });

        // Placement du JLabel
        this.lbNbAchete.setBounds(600, 430, 400, 20);
        this.lbNbAchete.setText("Le nombre de liens formation-client est de : " + this.unTableau.getRowCount());
        this.lbNbAchete.setForeground(Color.white);
        this.add(this.lbNbAchete);
    }

    public void chargerComboFormations() {
        this.cmbFormation.removeAllItems();
        ArrayList<Formation> lesFormations = Controleur.selectAllFormations("");
        for (Formation uneFormation : lesFormations) {
            this.cmbFormation.addItem(uneFormation.getNumero_formation() + " - "
                    + uneFormation.getNom_formation());
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

    public int getIdDepuisCombo(JComboBox<String> combo) {
        String selection = combo.getSelectedItem().toString();
        return Integer.parseInt(selection.split(" - ")[0]);
    }

    public Object[][] obtenirDonnees(String filtre) {
        ArrayList<Achete> lesAchete = Controleur.selectAllAchete(filtre);
        Object[][] matrice = new Object[lesAchete.size()][2];
        int i = 0;
        for (Achete unAchete : lesAchete) {
            matrice[i][0] = unAchete.getNumero_formation();
            matrice[i][1] = unAchete.getNumero_client();
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
            this.insertAchete();
        }
        else if (e.getSource() == this.btModifier) {
            this.updateAchete();
        }
        else if (e.getSource() == this.btSupprimer) {
            this.deleteAchete();
        }
        else if (e.getSource() == this.btFiltrer || e.getSource() == this.txtFiltre) {
            String filtre = this.txtFiltre.getText();
            this.unTableau.setDonnees(this.obtenirDonnees(filtre));
        }
    }

    public void viderChamps() {
        this.cmbFormation.setSelectedIndex(0);
        this.cmbClient.setSelectedIndex(0);

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);
    }

    public void insertAchete() {
        if (this.cmbFormation.getSelectedItem() == null
                || this.cmbClient.getSelectedItem() == null) {
            JOptionPane.showMessageDialog(this, "Veuillez sélectionner tous les champs.");
        } else {
            int numeroFormation = this.getIdDepuisCombo(this.cmbFormation);
            int numeroClient = this.getIdDepuisCombo(this.cmbClient);

            Achete unAchete = new Achete(numeroFormation, numeroClient);

            Controleur.insertAchete(unAchete);

            JOptionPane.showMessageDialog(this, "Insertion réussie.");

            this.unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbAchete.setText("Le nombre de liens formation-client est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }

    public void updateAchete() {
        int numLigne = tableAchete.getSelectedRow();
        int ancienNumeroFormation = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
        int ancienNumeroClient = Integer.parseInt(unTableau.getValueAt(numLigne, 1).toString());

        if (this.cmbFormation.getSelectedItem() == null
                || this.cmbClient.getSelectedItem() == null) {
            JOptionPane.showMessageDialog(this, "Veuillez sélectionner tous les champs.");
        } else {
            int numeroFormation = this.getIdDepuisCombo(this.cmbFormation);
            int numeroClient = this.getIdDepuisCombo(this.cmbClient);

            Achete unAchete = new Achete(numeroFormation, numeroClient);

            Controleur.updateAchete(ancienNumeroFormation, ancienNumeroClient, unAchete);
            JOptionPane.showMessageDialog(this, "Modification réussie.");
            unTableau.setDonnees(this.obtenirDonnees(""));

            this.viderChamps();
        }
    }

    public void deleteAchete() {
        int numLigne = tableAchete.getSelectedRow();
        int numeroFormation = Integer.parseInt(unTableau.getValueAt(numLigne, 0).toString());
        int numeroClient = Integer.parseInt(unTableau.getValueAt(numLigne, 1).toString());

        int retour = JOptionPane.showConfirmDialog(this, "Voulez-vous supprimer ce lien formation-client ?",
                "Suppression", JOptionPane.YES_NO_OPTION);
        if (retour == 0) {
            Controleur.deleteAchete(numeroFormation, numeroClient);
            unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbAchete.setText("Le nombre de liens formation-client est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }
}
