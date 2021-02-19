        
        <div class=" justify-content-center m-auto col-3">
            <h1 >Liste de RDV</h1>
        </div> 
        <div class="col-8 m-auto">           
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>                     
                        <th scope="col">RDV</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listA as $value): ?>
                    <tr>           
                        <td><?= htmlentities($value->lastname) ?> </td>
                        <td><?= htmlentities($value->firstname) ?></td>    
                        <td><?= htmlentities($value->dateHour) ?></td>              
                        <td><a href="/controllers/appointmentCtrl.php?id=<?= $value->id ?>">Afficher</a></td>
                        <td><a href="/controllers/delete-rdvCtrl.php?id=<?= $value->id ?>" >Supprimer</a></td>                               
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>