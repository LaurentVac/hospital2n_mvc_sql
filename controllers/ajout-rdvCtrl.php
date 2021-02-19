<?php
        require_once(dirname(__FILE__).'/../utils/regexp.php');
        $errorMailExist = null;
        $success= null;
        $error = null;
        require_once(dirname(__FILE__).'/../models/Patient.php');
        require_once(dirname(__FILE__).'/../models/Appointment.php');
        $errorsArray = array();
        
            

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // EMAIL
            // On verifie l'existance et on nettoie
            $selectPatient = trim(filter_input(INPUT_POST, 'listPatients',FILTER_SANITIZE_NUMBER_INT));

            //On test si le champ n'est pas vide
            if(!empty($selectPatient)){
                // On test la valeur
                $testRegex = preg_match(REGEXP_STR_NO_NUMBER,$selectPatient);

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

        $patient = new Patient ();
        $listPatient = $patient->listPatient();
        $id = intval(trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)));
        // var_dump($listPatient);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           $id = $selectPatient;
            $patient = new Patient ();
            $appointment = new Appointment($dateHour, $id);
            $newAppointment = $appointment->addAppointment($id);
            if($newAppointment){
                $success = 'RDV bien enregistré !!';
            }else{
                 $error = 'RDV non enregistrer';
            }
        }
        
    include(dirname(__FILE__).'/../views/templates/header.php');
   
    include(dirname(__FILE__).'/../views/ajout_rdv.php');

    include(dirname(__FILE__).'/../views//templates/footer.php');
?>