<div class=" justify-content-center m-auto col-3">
            <h1 >Liste de Patients</h1>
    </div> 
    
    <div class= "col-8 m-auto">  
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <!-- <th scope="col">Mail</th>
                    <th scope="col">Date de naissance</th>
                    <th scope="col">Téléphone</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($searchPatient as $value): ?>
                <tr>           
                    <td><?= htmlentities($value->lastname) ?> </td>
                    <td><?= htmlentities($value->firstname) ?></td>                  
                    <td><a href="/controllers/profil-patientCtrl.php?id=<?= $value->id ?>">Afficher</a></td>   
                    <td><a href="/controllers/delete-patientCtrl.php?id=<?= $value->id ?>">Supprimer</a></td>                               
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>