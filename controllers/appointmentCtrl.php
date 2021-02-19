<?php  
    $error = null;
    require_once(dirname(__FILE__).'/../models/Appointment.php');
   
    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
  
       
    $appointments = new Appointment();
    $patient = $appointments->detailAppointment($id);
     var_dump($patient);
        if(!$patient){
            header('location: /controllers/list-rdvCtrl.php'); 
        } 
    // var_dump($listA);
    include(dirname(__FILE__).'/../views/templates/header.php');

    include(dirname(__FILE__).'/../views/appointment.php');

    include(dirname(__FILE__).'/../views//templates/footer.php');
?>