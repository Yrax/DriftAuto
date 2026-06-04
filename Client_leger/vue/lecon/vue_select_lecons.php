<style>
/* ════════════════════════════
   CSS LISTE DES LEÇONS (DriftAuto)
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
    overflow-x: auto; 
    background: var(--bg-white);
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(27,49,96,.08);
    border: 1px solid var(--border);
}
.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px; 
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
    padding: 18px 20px;
    border: none;
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
    padding: 14px 20px;
    font-size: 0.95rem;
    color: var(--text-dark);
    border: none;
}

/* Zone des boutons d'action */
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
    filter: brightness(1.2); 
}
</style>

<div class="list-container">
    
    <h3> Liste des leçons </h3>

    <form method="post" class="filter-form">
        Filtrer par : 
        <input type="text" name="filtre" placeholder="Date, numéro...">
        <input type="submit" name="Filtrer" value="Rechercher">
    </form>

    <div class="table-responsive">
        <table class="data-table">
            <tr>
                <td> Numéro </td>
                <td> Date / Heure </td>
                <td> Moniteur </td>
                <td> Client </td>
                <td> Voiture </td>
                <td> Status </td>
                <td> Actions </td>
            </tr>

<?php
if (isset($lesLecons)) {
    foreach ($lesLecons as $uneLecon) {

        echo "<tr>";
        echo "<td>".$uneLecon['numero_lecon']."</td>";
        echo "<td>".$uneLecon['date_heure_lecon']."</td>";
        echo "<td>".$uneLecon['numero_moniteur']."</td>";
        echo "<td>".$uneLecon['numero_client']."</td>";
        echo "<td>".$uneLecon['numero_immatriculation']."</td>";
        echo "<td>".$uneLecon['statut']."</td>";
            
        echo "<td>";
            echo "<a href='admin_session.php?page=3&action=sup&numero_lecon=".$uneLecon['numero_lecon']."'>
                     <img src='assets/images/supprimer.png' width='30' height='30'>
                  </a>";

            echo "<a href='admin_session.php?page=3&action=edit&numero_lecon=".$uneLecon['numero_lecon']."'>
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