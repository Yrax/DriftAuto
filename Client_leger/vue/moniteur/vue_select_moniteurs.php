<style>
/* ════════════════════════════
   CSS LISTE DES MONITEURS (DriftAuto Staff)
   ════════════════════════════ */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap');

:root {
    --navy:        #1b3160;
    --blue:        #2563eb;
    --gold:        #f59e0b;
    --bg-cream:    #f5f3ef;
    --bg-light:    #eef2f9;
    --bg-white:    #ffffff;
    --text-dark:   #0f1f3d;
    --text-muted:  #6b7280;
    --border:      #e2e8f5;
    --font-display:'Bebas Neue', sans-serif;
    --font-body:   'Outfit', sans-serif;
}

.list-container {
    font-family: var(--font-body);
    max-width: 1350px; /* Un peu plus large car il y a beaucoup de colonnes */
    margin: 40px auto;
    padding: 0 5vw;
    color: var(--text-dark);
}

/* Titre */
.list-container h3 {
    font-family: var(--font-display);
    font-size: 2.6rem;
    letter-spacing: .05em;
    color: var(--navy);
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 12px;
}

/* Petit trait Doré pour le Staff */
.list-container h3::before {
    content: '';
    display: inline-block;
    width: 5px;
    height: 2.2rem;
    background: var(--gold); 
    border-radius: 3px;
}

/* Barre de Filtre */
.filter-form {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 30px;
    background: var(--bg-white);
    padding: 18px 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(27,49,96,.05);
    border: 1.5px solid var(--border);
    flex-wrap: wrap;
    font-weight: 500;
}
.filter-form input[type="text"] {
    padding: 10px 16px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: var(--font-body);
    font-size: 0.95rem;
    outline: none;
    transition: border-color 0.2s;
    min-width: 250px;
}
.filter-form input[type="text"]:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(245,158,11,.12);
}
.filter-form input[type="submit"] {
    padding: 11px 26px;
    background: var(--navy);
    color: white;
    border: none;
    border-radius: 8px;
    font-family: var(--font-body);
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
}
.filter-form input[type="submit"]:hover {
    background: var(--blue);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,.25);
}

/* Tableau Responsive */
.table-responsive {
    overflow-x: auto; 
    background: var(--bg-white);
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(27,49,96,.08);
    border: 1px solid var(--border);
}
.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1200px; /* Force une largeur min pour éviter que le texte s'écrase */
}

/* En-tête du tableau */
.data-table tr:first-child {
    background: var(--navy);
}
.data-table tr:first-child td {
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.08em;
    padding: 18px 15px;
    border: none;
    white-space: nowrap;
}

/* Lignes de données */
.data-table tr:not(:first-child) {
    border-bottom: 1px solid var(--border);
    transition: background 0.2s;
}
.data-table tr:not(:first-child):last-child {
    border-bottom: none;
}
.data-table tr:not(:first-child):hover {
    background: var(--bg-light); 
}
.data-table td {
    padding: 14px 15px;
    font-size: 0.95rem;
    color: var(--text-dark);
    border: none;
}

/* Zone des boutons d'action */
.data-table tr:not(:first-child) td:last-child {
    display: flex;
    gap: 12px;
    align-items: center;
}
.data-table td a {
    display: inline-block;
    transition: transform 0.2s, filter 0.2s;
}
.data-table td a:hover {
    transform: scale(1.15) translateY(-2px);
    filter: brightness(1.2); 
}
</style>

<div class="list-container">
    
    <h3> Liste des moniteurs </h3>

    <form method="post" class="filter-form">
        Filtrer par : 
        <input type="text" name="filtre" placeholder="Nom, Email, Ville...">
        <input type="submit" name="Filtrer" value="Rechercher">
    </form>

    <div class="table-responsive">
        <table class="data-table">
            <tr>
                <td> Numéro </td>
                <td> Nom </td>
                <td> Prénom </td>
                <td> Date embauche </td>
                <td> Date naissance </td>
                <td> Adresse </td>
                <td> Code Postal </td>
                <td> Ville </td>
                <td> Téléphone </td>
                <td> Email </td>
                <td> Admins </td>
                <td> Actions </td>
            </tr>

            <?php
            if (isset($lesMoniteurs)) {
                foreach ($lesMoniteurs as $unMoniteur) {
                    echo "<tr>";
                    echo "<td>".$unMoniteur['numero_moniteur']."</td>";
                    echo "<td>".$unMoniteur['nom_moniteur']."</td>";
                    echo "<td>".$unMoniteur['prenom_moniteur']."</td>";
                    echo "<td>".$unMoniteur['date_embauche']."</td>";
                    echo "<td>".$unMoniteur['date_naissance_moniteur']."</td>";
                    echo "<td>".$unMoniteur['adresse_moniteur']."</td>";
                    echo "<td>".$unMoniteur['code_postal_moniteur']."</td>";
                    echo "<td>".$unMoniteur['ville_moniteur']."</td>";
                    echo "<td>".$unMoniteur['telephone_moniteur']."</td>";
                    echo "<td>".$unMoniteur['email_moniteur']."</td>";
                    echo "<td>" . ($unMoniteur['administrateur'] == 1 ? "Oui" : "Non") . "</td>";

                    echo "<td>";
                    echo "<a href='admin_session.php?page=4&action=sup&numero_moniteur=".$unMoniteur['numero_moniteur']."'>
                            <img src='assets/images/supprimer.png' width='30' height='30'>
                          </a>";

                    echo "<a href='admin_session.php?page=4&action=edit&numero_moniteur=".$unMoniteur['numero_moniteur']."'>
                            <img src='assets/images/modifier.png' width='30' height='30'>
                          </a>";
                    echo "</td>";

                    echo "</tr>";
                }
            }
            ?>
            </table>
    </div>

</div>