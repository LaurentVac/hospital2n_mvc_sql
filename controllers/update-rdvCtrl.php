<?php
        require_once(dirname(__FILE__).'/../utils/regexp.php');
       
        $success= null;
        $error = null;
  
        require_once(dirname(__FILE__).'/../models/Appointment.php');
        $errorsArray = array();
        
            

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // EMAIL
            // On verifie l'existance et on nettoie
            $selectPatient = trim(filter_input(INPUT_POST, 'listPatients',FILTER_SANITIZE_NUMBER_INT));

            //On test si le champ n'est pas vide
            if(!empty($selectPatient)){
                // On test la valeur
                $testRegex = preg_match('/^[0-9]{1,5}$/',$selectPatient);

                if($testRegex == false){
                    $errorsArray['listPatient_error'] = 'Le mail n\'est pas valide';
                }
            }else{
                $errorsArray['listPatient_error'] = 'Le champ n\'est pas rempli';
            }

            
            // On verifie l'existance et on nettoie
            $dateHour = trim(filter_input(INPUT_POST, 'rdvdate', FILTER_SANITIZE_STRING));
            

            //On test si le champ n'est pas vide
            if(!empty($dateHour)){
                // On test la valeur
                $testRegex = preg_match(REGEXP_DATETIME, $dateHour);

                // On peut aller plus loin sur le test de la date à cet endroit

                if($testRegex == false){
                    $errorsArray['rdvdate_error'] = 'Le date n\'est pas valide, le format attendu est YYYY-MM-JJ';
                }
            }
        }

    
    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    $select = new Appointment();
        $listPatient = $select->detailAppointment($id);
        // var_dump($listPatient);
        if(!$listPatient){
            header('location: /controllers/list-rdvCtrl.php');
        }
        var_dump($errorsArray);
        if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errorsArray)){
            $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
            $idPatients = $selectPatient;
            $patient = new Appointment ($dateHour, $idPatients,$id);
            $listPatient1 = $patient->updateAppointment();
            var_dump($listPatient);   
            if($listPatient1){
               header('location: /controllers/list-rdvCtrl.php');
            }else{
                 $error = 'RDV non enregistrer';
            }
        }
        
    include(dirname(__FILE__).'/../views/templates/header.php');
   
    include(dirname(__FILE__).'/../views/update_rdv.php');

    include(dirname(__FILE__).'/../views//templates/footer.php');
?>