<?php  
    $error = null;
    require_once(dirname(__FILE__).'/../models/Appointment.php');
   
    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
  
       
    $appointments = new Appointment();
    $delete = $appointments->deleteApp($id);
     var_dump($delete);
        
    // var_dump($listA);
    include(dirname(__FILE__).'/../views/templates/header.php');
    if($delete){       
        include(dirname(__FILE__).'/../views/delete_rdv.php');      
    }else{
       header('location: /controllers/list-rdvCtrl.php');
    }
    include(dirname(__FILE__).'/../views//templates/footer.php');
?>