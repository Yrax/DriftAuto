package vue;

import java.awt.Color;
import java.awt.Font;

import javax.swing.JLabel;
import javax.swing.JPanel;

public abstract class PanelPrincipal extends JPanel {
	
	public PanelPrincipal(String titre) {
		//les caractéristiques communs à tous les panels
		
		this.setBounds(10, 80, 1460, 700);
		this.setBackground(Color.darkGray);
		this.setLayout(null);
		
		JLabel lbTitre = new JLabel(titre, JLabel.CENTER);
		lbTitre.setBounds(0, 10, 1460, 20);
		Font unePolice = new Font("Arial", Font.BOLD, 18);
		lbTitre.setFont(unePolice);
		lbTitre.setForeground(Color.white);
		
		this.add(lbTitre);
		
		this.setVisible(false);
	}
}
