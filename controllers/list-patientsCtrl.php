<?php  
require_once(dirname(__FILE__).'/../utils/regexp.php');
    $error = null;
    $errorsArray=[];
    include(dirname(__FILE__).'/../models/Patient.php');
    $patient = new Patient ();
    $listPatient = $patient->listPatient();


    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])){
            $search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING));
            if(!empty($search)){
                // On test la valeur
                $testRegex = preg_match(REGEXP_STR_NO_NUMBER,$search);

                if($testRegex == false){
                    $errorsArray['listPatient_error'] = 'Erreur de saisi';
                }
            }else{
                $errorsArray['listPatient_error'] = 'Le patient n\'est pas trouvé';
            }
            if(empty($errorsArray)){
                $patientS = new Patient ();
                $searchPatient = $patient->searchPatient($search);
               
            }else{
                echo 'Erreur';
            }
    }
   

    include(dirname(__FILE__).'/../views/templates/header.php');

    if(!empty($_GET['search'])&& empty($errorsArray) ){
        include(dirname(__FILE__).'/../views/list_searchPatient.php'); 
    }else{
        include(dirname(__FILE__).'/../views/list_patients.php'); 
    }

    include(dirname(__FILE__).'/../views//templates/footer.php');
?>




