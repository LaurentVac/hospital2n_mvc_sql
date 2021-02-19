<?php  
    $error = null;
    require_once(dirname(__FILE__).'/../models/Patient.php');
   
    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
  
       
    $appointments = new Patient();
    $delete = $appointments->deletePatient($id);
     var_dump($delete);
        
    // var_dump($listA);
    include(dirname(__FILE__).'/../views/templates/header.php');
    if($delete){       
        include(dirname(__FILE__).'/../views/delete_patient.php');      
    }else{
       header('location: /controllers/list-PatientsCtrl.php');
    }
    include(dirname(__FILE__).'/../views//templates/footer.php');
?>