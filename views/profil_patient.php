

<?php if($error):?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php else: ?>
        <div class="m-auto col-3 justify-content-center">
            <h1> <?= htmlentities($patient->firstname).' '.htmlentities($patient->lastname) ?></h1>
        </div>
<div class=" col-8 m-auto">   
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Mail</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Téléphone</th>
            </tr>
        </thead>
        <tbody>
            <tr>    
                <td><?= htmlentities($patient->lastname) ?></td>
                <td><?= htmlentities($patient->firstname) ?></td>
                <td><?= htmlentities($patient->mail) ?></td>
                <td><?= htmlentities($patient->birthdate) ?></td>
                <td><?= htmlentities($patient->phone) ?></td>
                <td><a href="../controllers/modif-patientCtrl.php?id=<?= $id ?>">Modifier</a></td>
                <td><input type="submit" value="supprimer"></td>               
            </tr>     
        </tbody>
    </table>
    <?php endif; ?>

      <?php if($app): ?>
    <div class=" col-8 m-auto">   
    <table class="table">
        <thead>
            <tr>
                <th scope="col">RDV</th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($app as $value): ?>
            <tr>    
                <td><?= htmlentities($value->dateHour) ?></td>
                <!-- <td><a href="../controllers/modif-patientCtrl.php?id=<?= $id ?>">Modifier"></a></td>
                <td><input type="submit" value="supprimer"></td>                -->
            </tr>   
            <?php endforeach ?>  
        </tbody>
    </table>
    <?php endif ?>