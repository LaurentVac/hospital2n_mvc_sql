<!-- Créer une page liste-patients.php et y afficher la liste des patients.
 Inclure dans la page, un lien vers la création de patients. -->


<?php if($error):?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else: ?>
    <div class=" justify-content-center m-auto col-3">
            <h1 >Liste de Patients</h1>
    </div>  
    <div class="col-8 m-auto">
    <form class="form-inline" method = "GET">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0"  type="submit">Rechercher</button>
    </form>
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
                <?php foreach($listPatient as $value): ?>
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
<?php endif ?> 
<!-- }; ?>   -->

