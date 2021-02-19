       <div class="col-6 m-auto">
           <h4>Ajout de RDV</h4>
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

        <form action = "" method = "POST">
            <div class="mb-3">
            <label for="pet-select">Patient:</label>
                <select name="listPatients" id="pet-select" required>
                    <option value="">--Choisir un patient--</option>
                    <?php foreach($listPatient as $value): ?>
                    <option value="<?= htmlentities($value->id)?>"><?= htmlentities($value->lastname).' '.htmlentities($value->firstname).' //Mail: '.htmlentities($value->mail)?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="rdv" class="form-label">Veuillez saisir une date et une heure pour le rdv du patient:</label>
                <input id="rdv" type="datetime-local" name="rdvdate" value="2021-02-16T08:30" required>
                <div id="mail_error" class="form-text"><?=$errorsArray['rdvdate_error'] ?? '' ?></div>
            </div>
            <button type="submit" class="btn btn-primary ">Enregistrer</button>
        </form>
    </div> 