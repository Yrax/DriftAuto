<style>
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
    --red:         #ef4444;
    --font-display:'Bebas Neue', sans-serif;
    --font-body:   'Outfit', sans-serif;
}

.edit-page {
    font-family: var(--font-body);
    background: var(--bg-cream);
    padding: 40px 5vw 80px;
    color: var(--text-dark);
}

.edit-container {
    max-width: 680px;
    margin: 0 auto; 
    width: 100%;
}

.edit-page h3 {
    font-family: var(--font-display);
    font-size: 2.4rem;
    letter-spacing: .05em;
    color: var(--text-dark);
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.edit-page h3::before {
    content: '';
    display: inline-block;
    width: 5px;
    height: 2rem;
    background: var(--blue);
    border-radius: 3px;
}

.edit-page form {
    background: var(--bg-white);
    border: 1.5px solid var(--border);
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(27,49,96,.10);
    overflow: hidden;
    width: 100%; 
}

.edit-page table {
    width: 100%;
    border-collapse: collapse;
}

.edit-page table tr {
    border-bottom: 1.5px solid var(--border);
    transition: background .15s;
}

.edit-page table tr:last-child { 
    border-bottom: none; 
}

.edit-page table tr:not(:last-child):hover { 
    background: var(--bg-light); 
}

.edit-page table td:first-child {
    padding: 16px 24px;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--text-muted);
    white-space: nowrap;
    width: 180px;
    background: transparent;
}

.edit-page table td:last-child {
    padding: 12px 20px 12px 0;
}

/* On inclut le datetime-local et le select dans le style global */
.edit-page input[type="datetime-local"],
.edit-page select {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: var(--font-body);
    font-size: .92rem;
    color: var(--text-dark);
    background: var(--bg-white);
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    box-sizing: border-box; 
    cursor: pointer;
}

.edit-page input[type="datetime-local"]:focus,
.edit-page select:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
}

.edit-page table tr:last-child td {
    padding: 20px 24px;
    background: var(--bg-light);
}

.edit-page table tr:last-child td:first-child {
    text-transform: none;
    letter-spacing: 0;
    width: auto;
}

.edit-page input[type="reset"] {
    padding: 11px 24px;
    background: transparent;
    color: var(--text-muted);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: var(--font-body);
    font-size: .9rem;
    font-weight: 600;
    cursor: pointer;
    transition: border-color .2s, color .2s;
}

.edit-page input[type="reset"]:hover {
    border-color: var(--red);
    color: var(--red);
}

.edit-page input[type="submit"] {
    padding: 11px 28px;
    background: var(--navy);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-family: var(--font-body);
    font-size: .9rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 3px 14px rgba(27,49,96,.22);
    transition: background .25s, transform .2s, box-shadow .25s;
}

.edit-page input[type="submit"]:hover {
    background: var(--blue);
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(37,99,235,.35);
}

@media (max-width: 540px) {
    .edit-page table td:first-child { width: 120px; padding: 14px 14px; }
    .edit-page table td:last-child  { padding: 10px 14px 10px 0; }
}
</style>

<div class="edit-page">
    <div class="edit-container">

        <h3> Ajout d'une leçon </h3>

        <form method="post">
            <table>

                <tr>
                    <td> Date et heure de la leçon </td>
                    <td>
                        <input type="datetime-local" name="date_heure_lecon"
                        value="<?= ($laLecon == null) ? '' : str_replace(' ', 'T', $laLecon['date_heure_lecon']) ?>">
                    </td>
                </tr>

                <tr>
                    <td> Moniteur </td>
                    <td>
                        <select name="numero_moniteur">
                            <option value="">-- Choisir --</option>
                            <?php
                            foreach ($lesMoniteurs as $unMoniteur) {
                                echo "<option value='".$unMoniteur['numero_moniteur']."'"
                                . (($laLecon != null && $unMoniteur['numero_moniteur'] == $laLecon['numero_moniteur']) ? ' selected' : '')
                                . ">";
                                echo $unMoniteur['numero_moniteur']." - ".$unMoniteur['nom_moniteur'];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td> Client </td>
                    <td>
                        <select name="numero_client">
                            <option value="">-- Choisir --</option>
                            <?php
                            foreach ($lesClients as $unClient) {
                                echo "<option value='".$unClient['numero_client']."'"
                                . (($laLecon != null && $unClient['numero_client'] == $laLecon['numero_client']) ? ' selected' : '')
                                . ">";
                                echo $unClient['numero_client']." - ".$unClient['nom_client'];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td> Voiture </td>
                    <td>
                        <select name="numero_immatriculation">
                            <option value="">-- Choisir --</option>
                            <?php
                            foreach ($lesVoitures as $uneVoiture) {
                                $selected = ($laVoiture != null && 
                                             $uneVoiture['numero_immatriculation'] == $laVoiture['numero_immatriculation'])
                                            ? ' selected' 
                                            : '';

                                echo "<option value='".$uneVoiture['numero_immatriculation']."' $selected>";
                                echo $uneVoiture['numero_immatriculation'];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>


                <tr>
                    <td><input type="reset" value="Annuler"></td>
                    <td>
                        <input type="submit"
                        <?= ($laLecon == null)
                            ? ' name="Valider" value="Valider" '
                            : ' name="Modifier" value="Modifier" ' ?>
                        >
                    </td>
                </tr>

            </table>

            <?= ($laLecon == null) ? '' :
                '<input type="hidden" name="numero_lecon"
                value="'.$laLecon['numero_lecon'].'">' ?>
        </form>
        </div>
</div>