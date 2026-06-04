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

import controleur.Voiture;
import controleur.Controleur;
import controleur.Tableau;

public class PanelVoitures extends PanelPrincipal implements ActionListener
{
    private JPanel panelForm = new JPanel();
    private JTextField txtImmatriculation = new JTextField();
    private JTextField txtDateAchat = new JTextField();
    private JTextField txtNombreKm = new JTextField();

    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");
    private JButton btModifier = new JButton("Modifier");
    private JButton btSupprimer = new JButton("Supprimer");

    private JTable tableVoitures;
    private JScrollPane scrollVoitures;
    private Tableau unTableau;

    private JPanel panelFiltre = new JPanel();
    private JTextField txtFiltre = new JTextField();
    private JButton btFiltrer = new JButton("Filtrer");

    private JLabel lbNbVoitures = new JLabel();

    public PanelVoitures(String titre) {
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

        this.panelForm.add(VueGenerale.creeLabelBlanc("Immatriculation : "));
        this.panelForm.add(this.txtImmatriculation);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Date d'achat : "));
        this.panelForm.add(this.txtDateAchat);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Nombre de km : "));
        this.panelForm.add(this.txtNombreKm);

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

        // Placement de la ScrollVoitures
        String[] entetes = {"Immatriculation", "Date d'achat", "Nombre de km"};

        this.unTableau = new Tableau(this.obtenirDonnees(""), entetes);
        this.tableVoitures = new JTable(this.unTableau);

        this.scrollVoitures = new JScrollPane(this.tableVoitures);
        this.scrollVoitures.setBackground(Color.darkGray);
        this.scrollVoitures.setBounds(550, 120, 800, 300);
        this.add(this.scrollVoitures);

        // Sur clic de la souris, les champs seront remplis par la ligne sélectionnée
        this.tableVoitures.addMouseListener(new MouseListener() {
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
                int numLigne = tableVoitures.getSelectedRow();
                txtImmatriculation.setText(unTableau.getValueAt(numLigne, 0).toString());
                txtDateAchat.setText(unTableau.getValueAt(numLigne, 1).toString());
                txtNombreKm.setText(unTableau.getValueAt(numLigne, 2).toString());

                btSupprimer.setEnabled(true);
                btModifier.setEnabled(true);
            }
        });

        // Placement du JLabel
        this.lbNbVoitures.setBounds(600, 430, 400, 20);
        this.lbNbVoitures.setText("Le nombre de voitures est de : " + this.unTableau.getRowCount());
        this.lbNbVoitures.setForeground(Color.white);
        this.add(this.lbNbVoitures);
    }

    public Object[][] obtenirDonnees(String filtre) {
        ArrayList<Voiture> lesVoitures = Controleur.selectAllVoitures(filtre);
        Object[][] matrice = new Object[lesVoitures.size()][3];
        int i = 0;
        for (Voiture uneVoiture : lesVoitures) {
            matrice[i][0] = uneVoiture.getNumero_immatriculation();
            matrice[i][1] = uneVoiture.getDate_achat();
            matrice[i][2] = uneVoiture.getNombre_km();
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
            this.insertVoiture();
        }
        else if (e.getSource() == this.btModifier) {
            this.updateVoiture();
        }
        else if (e.getSource() == this.btSupprimer) {
            this.deleteVoiture();
        }
        else if (e.getSource() == this.btFiltrer || e.getSource() == this.txtFiltre) {
            String filtre = this.txtFiltre.getText();
            this.unTableau.setDonnees(this.obtenirDonnees(filtre));
        }
    }

    public void viderChamps() {
        this.txtImmatriculation.setText("");
        this.txtDateAchat.setText("");
        this.txtNombreKm.setText("");

        this.btModifier.setEnabled(false);
        this.btSupprimer.setEnabled(false);
    }

    public void insertVoiture() {
        String immatriculation = this.txtImmatriculation.getText();
        String dateAchat = this.txtDateAchat.getText();
        String nombreKmStr = this.txtNombreKm.getText();

        if (immatriculation.equals("") || dateAchat.equals("") || nombreKmStr.equals("")) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            int nombreKm = Integer.parseInt(nombreKmStr);

            Voiture uneVoiture = new Voiture(immatriculation, dateAchat, nombreKm);

            Controleur.insertVoiture(uneVoiture);

            JOptionPane.showMessageDialog(this, "Insertion réussie de la voiture.");

            this.unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbVoitures.setText("Le nombre de voitures est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }

    public void updateVoiture() {
        int numLigne = tableVoitures.getSelectedRow();
        String immatriculation = unTableau.getValueAt(numLigne, 0).toString();

        String dateAchat = this.txtDateAchat.getText();
        String nombreKmStr = this.txtNombreKm.getText();

        if (dateAchat.equals("") || nombreKmStr.equals("")) {
            JOptionPane.showMessageDialog(this, "Veuillez remplir tous les champs.");
        } else {
            int nombreKm = Integer.parseInt(nombreKmStr);

            Voiture uneVoiture = new Voiture(immatriculation, dateAchat, nombreKm);

            Controleur.updateVoiture(uneVoiture);
            JOptionPane.showMessageDialog(this, "Modification réussie de la voiture.");
            unTableau.setDonnees(this.obtenirDonnees(""));

            this.viderChamps();
        }
    }

    public void deleteVoiture() {
        int numLigne = tableVoitures.getSelectedRow();
        String immatriculation = unTableau.getValueAt(numLigne, 0).toString();

        int retour = JOptionPane.showConfirmDialog(this, "Voulez-vous supprimer cette voiture ?",
                "Suppression", JOptionPane.YES_NO_OPTION);
        if (retour == 0) {
            Controleur.deleteVoiture(immatriculation);
            unTableau.setDonnees(this.obtenirDonnees(""));
            this.lbNbVoitures.setText("Le nombre de voitures est de : " + this.unTableau.getRowCount());

            this.viderChamps();
        }
    }
}