<?php  
    $error = null;
    require_once(dirname(__FILE__).'/../models/Appointment.php');
    
    $appointments = new Appointment();
    $listA = $appointments->listAppointment();

    include(dirname(__FILE__).'/../views/templates/header.php');

    include(dirname(__FILE__).'/../views/list_rdv.php');

    include(dirname(__FILE__).'/../views//templates/footer.php');
?>
