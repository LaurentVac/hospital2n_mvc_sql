<div class="col-6 m-auto">
           <h4>Modification de RDV</h4>
        </div> 
    <div class="col-6 m-auto"> 
        <?php if($_SERVER['REQUEST_METHOD'] == 'POST'){ ?> 
            <?php if($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif ?>
            <?php if($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif ?>
        <?php } ?>
        <form action="" method = "POST">
            <div class="mb-3">
            <label for="pet-select">Patient:</label>
                <select name="listPatients" id="pet-select" required>
                    <!--  --><?= var_dump($listPatient); ?>
                    <option selected value="<?= htmlentities($listPatient->id) ?>"><?= htmlentities($listPatient->firstname) .' '. htmlentities($listPatient->lastname) ?></option> 
                    <!--  -->
                </select>
            </div>
            <div class="mb-3">
            <!-- -->
            <?='Le rendez-vous du patient est prévu le :<strong> '.  htmlentities($listPatient->dateHour).'</strong><br>'?>
                <label for="rdv" class="form-label">Veuillez saisir une date et une heure pour modifier le rdv du patient:</label>
                <input id="rdv" type="datetime-local" name="rdvdate" value="" required>
                <div id="mail_error" class="form-text"><?=$errorsArray['rdvdate_error'] ?? '' ?></div>
            </div>
            <button type="submit" class="btn btn-primary ">Enregistrer</button>
        </form>
    </div> 