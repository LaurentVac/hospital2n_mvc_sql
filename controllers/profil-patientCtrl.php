<?php  



    $error = null;
    require_once(dirname(__FILE__).'/../models/Patient.php');
    require_once(dirname(__FILE__).'/../models/Appointment.php');
    $profilPatient = new Patient ();
    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    $patient = $profilPatient->profilPatient($id);
        if(!$patient){
            header('location: /index.php'); 
        } 
    $patientApp = new Appointment();
    $app = $patientApp->patientApp($id);
    var_dump($app);
    include(dirname(__FILE__).'/../views/templates/header.php');

    include(dirname(__FILE__).'/../views/profil_patient.php');

    include(dirname(__FILE__).'/../views/templates/footer.php');
?>