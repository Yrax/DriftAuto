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
    background: var(--blue); /* Bleu pour le client */
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

.edit-page input[type="text"],
.edit-page input[type="email"],
.edit-page input[type="date"],
.edit-page input[type="password"],
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
}

.edit-page input:not([readonly]):focus,
.edit-page select:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
}

/* Style pour les champs en lecture seule (readonly) */
.edit-page input[readonly] {
    background-color: #f1f5f9;
    color: #94a3b8;
    cursor: not-allowed;
    border-color: #e2e8f0;
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
        
        <h3> Ajout d'un client </h3>

        <form method="post">
            <table>

                <tr>
                    <td> Pseudo </td>
                    <td>
                        <input type="text" name="pseudo_client"
                        value="<?= ($leClient == null) ? '' : $leClient['pseudo_client'] ?>">
                    </td>
                </tr>

                <tr>
                    <td> Nom </td>
                    <td>
                        <input type="text" name="nom_client"
                        value="<?= ($leClient == null) ? '' : $leClient['nom_client'] ?>">
                    </td>
                </tr>

                <tr>
                    <td> Prénom </td>
                    <td>
                        <input type="text" name="prenom_client"
                        value="<?= ($leClient == null) ? '' : $leClient['prenom_client'] ?>">
                    </td>
                </tr>

                <tr>
                    <td> Date de naissance </td>
                    <td>
                        <input type="date" name="date_naissance_client"
                        value="<?= ($leClient == null) ? '' : $leClient['date_naissance_client'] ?>">
                    </td>
                </tr>

                <tr>
                    <td> Téléphone </td>
                    <td>
                        <input type="text" name="telephone_client"
                        value="<?= ($leClient == null) ? '' : $leClient['telephone_client'] ?>">
                    </td>
                </tr>

                <tr>
                    <td> Adresse </td>
                    <td>
                        <input type="text" name="adresse_client"
                        value="<?= ($leClient == null) ? '' : $leClient['adresse_client'] ?>">
                    </td>
                </tr>

                <tr>
                    <td> Code Postal </td>
                    <td>
                        <input type="text" name="code_postal_client"
                        value="<?= ($leClient == null) ? '' : $leClient['code_postal_client'] ?>">
                    </td>
                </tr>
                
                <tr>
                    <td> Ville </td>
                    <td>
                        <input type="text" name="ville_client"
                        value="<?= ($leClient == null) ? '' : $leClient['ville_client'] ?>">
                    </td>
                </tr>

                <tr>
                    <td> Email </td>
                    <td>
                        <input type="text" name="email_client" 
                        value="<?= ($leClient == null) ? '' : $leClient['email_client'] ?>" 
                        readonly>
                    </td>
                </tr>

                <tr>
                    <td> MDP </td>
                    <td>
                        <input type="password" name="mdp_client" 
                        value="<?= ($leClient == null) ? '' : $leClient['mdp_client'] ?>" 
                        readonly>
                    </td>
                </tr>

        <tr>
                    <td>
                        <input type="reset" name="Annuler" value="Annuler">
                    </td>
                    <td>
                        <input type="submit"
                        <?= ($leClient == null)
                            ? ' name="Valider" value="Valider" '
                            : ' name="Modifier" value="Modifier" ' ?>
                        >
                    </td>
                </tr>

            </table>

            <?= ($leClient == null) ? '' :
                '<input type="hidden" name="numero_client"
                value="'.$leClient['numero_client'].'">' ?>

        </form>
    </div>
</div>