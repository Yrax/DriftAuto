<style>
/* ════════════════════════════
   CSS LISTE DES CLIENTS (DriftAuto)
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
    max-width: 1250px;
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
.list-container h3::before {
    content: '';
    display: inline-block;
    width: 5px;
    height: 2.2rem;
    background: var(--blue);
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
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
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
    overflow-x: auto; /* Permet de scroller horizontalement sur petit écran */
    background: var(--bg-white);
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(27,49,96,.08);
    border: 1px solid var(--border);
}
.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1050px; /* Force le tableau à garder une belle taille */
}

/* En-tête du tableau (Ta première ligne de <td>) */
.data-table tr:first-child {
    background: var(--navy);
}
.data-table tr:first-child td {
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.08em;
    padding: 18px 20px;
    border: none;
}

/* Lignes de données (Générées par le PHP) */
.data-table tr:not(:first-child) {
    border-bottom: 1px solid var(--border);
    transition: background 0.2s;
}
.data-table tr:not(:first-child):last-child {
    border-bottom: none;
}
.data-table tr:not(:first-child):hover {
    background: var(--bg-light); /* Ligne en surbrillance au survol */
}
.data-table td {
    padding: 14px 20px;
    font-size: 0.95rem;
    color: var(--text-dark);
    border: none;
}

/* Zone des boutons d'action (Supprimer/Modifier) */
.data-table tr:not(:first-child) td:last-child {
    display: flex;
    gap: 14px;
    align-items: center;
}
.data-table td a {
    display: inline-block;
    transition: transform 0.2s, filter 0.2s;
}
.data-table td a:hover {
    transform: scale(1.15) translateY(-2px);
    filter: brightness(1.2); /* Fait légèrement briller l'icône */
}
</style>

<div class="list-container">
    
    <h3> Liste des clients </h3>

    <form method="post" class="filter-form">
        Filtrer par : 
        <input type="text" name="filtre" placeholder="Nom, Prénom, Ville...">
        <input type="submit" name="Filtrer" value="Rechercher">
    </form>

    <div class="table-responsive">
        <table class="data-table">
            <tr>
                <td> Numéro du Client </td>
                <td> Pseudo </td>
                <td> Nom </td>
                <td> Prénom </td>
                <td> Date naissance </td>
                <td> Adresse </td>
                <td> Code Postal </td>
                <td> Ville </td>
                <td> Téléphone </td>
                <td> Actions </td>
            </tr>

            <?php
            if (isset($lesClients)) {
                foreach ($lesClients as $unClient) {
                    echo "<tr>";
                    echo "<td>".$unClient['numero_client']."</td>";
                    echo "<td>".$unClient['pseudo_client']."</td>";
                    echo "<td>".$unClient['nom_client']."</td>";
                    echo "<td>".$unClient['prenom_client']."</td>";
                    echo "<td>".$unClient['date_naissance_client']."</td>";
                    echo "<td>".$unClient['adresse_client']."</td>";
                    echo "<td>".$unClient['code_postal_client']."</td>";
                    echo "<td>".$unClient['ville_client']."</td>";
                    echo "<td>".$unClient['telephone_client']."</td>";
                   // echo "<td>".$unClient['numero_moniteur']."</td>";
                    

                    echo "<td>";
                    echo "<a href='admin_session.php?page=2&action=sup&numero_client=".$unClient['numero_client']."'>
                            <img src='assets/images/supprimer.png' width='30' height='30'>
                          </a>";

                    echo "<a href='admin_session.php?page=2&action=edit&numero_client=".$unClient['numero_client']."'>
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