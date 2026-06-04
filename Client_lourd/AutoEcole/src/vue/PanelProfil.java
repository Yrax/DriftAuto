package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextArea;
import javax.swing.JTextField;

import controleur.Controleur;
import controleur.AutoEcole;
import controleur.Moniteur;

public class PanelProfil extends PanelPrincipal implements ActionListener
{
    private static Moniteur admin;

    private static JTextArea txtInfos = new JTextArea();

    private JButton btModifier = new JButton("Modifier");
    private JButton btAnnuler = new JButton("Annuler");
    private JButton btValider = new JButton("Valider");

    private JPanel panelForm = new JPanel();

    private JTextField txtNom = new JTextField();
    private JTextField txtPrenom = new JTextField();
    private JTextField txtEmail = new JTextField();
    private JPasswordField txtMdp = new JPasswordField();


    public PanelProfil (String titre) {
        super(titre);

        this.txtInfos.setBounds(440, 100, 250, 180);
        this.txtInfos.setBackground(Color.darkGray);
        this.txtInfos.setForeground(Color.white);
        this.add(this.txtInfos);

        actualiserInfosUser();

        this.btModifier.setBounds(520, 320, 100, 30);
        this.add(btModifier);

        this.panelForm.setBounds(750, 100, 320, 220);
        this.panelForm.setBackground(Color.darkGray);
        this.panelForm.setLayout(new GridLayout(5, 2, 10, 10));

        this.panelForm.add(VueGenerale.creeLabelBlanc("Nom Moniteur : "));
        this.panelForm.add(this.txtNom);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Prénom Moniteur : "));
        this.panelForm.add(this.txtPrenom);

        this.panelForm.add(VueGenerale.creeLabelBlanc("Email Moniteur : "));
        this.panelForm.add(this.txtEmail);

        this.panelForm.add(VueGenerale.creeLabelBlanc("MDP Moniteur : "));
        this.panelForm.add(this.txtMdp);

        this.panelForm.add(btAnnuler);
        this.panelForm.add(btValider);

        this.add(panelForm);

        this.panelForm.setVisible(false);

        this.btAnnuler.addActionListener(this);
        this.btValider.addActionListener(this);
        this.btModifier.addActionListener(this);
    }

    public static void actualiserInfosUser() {
        admin = AutoEcole.getMoniteurConnecte();
        if (admin != null) {
            txtInfos.setText("\n ----- Infos du profil ------\n"
                    + "\n\n Nom Moniteur    : " + admin.getNom_moniteur()
                    + "\n\n Prénom Moniteur : " + admin.getPrenom_moniteur()
                    + "\n\n Email Moniteur  : " + admin.getEmail_moniteur()
                    + "\n\n ____________________________________");
        }
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == this.btModifier) {
            this.panelForm.setVisible(true);
            if (admin != null) {
                this.txtNom.setText(admin.getNom_moniteur());
                this.txtPrenom.setText(admin.getPrenom_moniteur());
                this.txtEmail.setText(admin.getEmail_moniteur());
                this.txtMdp.setText(admin.getMdp_moniteur());
            }
        }
        else if (e.getSource() == this.btAnnuler) {
            viderChamps();
        }
        else if (e.getSource() == this.btValider) {
            updateUser();
        }
    }

    public void viderChamps() {
        this.txtNom.setText("");
        this.txtPrenom.setText("");
        this.txtEmail.setText("");
        this.txtMdp.setText("");
    }

    public void updateUser() {
        admin.setNom_moniteur(this.txtNom.getText());
        admin.setPrenom_moniteur(this.txtPrenom.getText());
        admin.setEmail_moniteur(this.txtEmail.getText());
        admin.setMdp_moniteur(new String(this.txtMdp.getPassword()));

        Controleur.updateMoniteur(admin);

        JOptionPane.showMessageDialog(this, "Profil Modifié");
        this.panelForm.setVisible(false);
        actualiserInfosUser();
    }
}