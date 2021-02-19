<div class=" justify-content-center m-auto col-6">
            <h1 >RDV du patient <?=htmlentities($patient->lastname).' '.htmlentities($patient->firstname) ?> </h1>
        </div> 

<div class=" col-10 m-auto">   
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Mail</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Téléphone</th>
                <th scope="col">RDV</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>    
                <td><?= htmlentities($patient->lastname) ?></td>
                <td><?= htmlentities($patient->firstname) ?></td>
                <td><?= htmlentities($patient->mail) ?></td>
                <td><?= htmlentities($patient->birthdate) ?></td>
                <td><?= htmlentities($patient->phone) ?></td>
                <td><?= htmlentities($patient->dateHour) ?></td>
                <td><a href="../controllers/update-rdvCtrl.php?id=<?= $id ?>">Modifier</a></td>
                <td>Supprimer</td>               
            </tr>     
        </tbody>
    </table>