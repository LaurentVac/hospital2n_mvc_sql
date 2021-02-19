<?php
    include(dirname(__FILE__).'/../utils/regexp.php');
$errorMailExist = null;
$success= null;
 $error = null;
    include(dirname(__FILE__).'/../models/Patient.php');
    $errorsArray = array();
    

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // NAME
    // On verifie l'existance et on nettoie
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($name)){
        // On test la valeur
        $testRegexName = preg_match(REGEXP_STR_NO_NUMBER,$name);

        if($testRegexName == false){
            $errorsArray['name_error'] = 'Le nom n\'est pas valide';
        }
    }else{
        $errorsArray['name_error'] = 'Le champ n\'est pas rempli';
    }

    // ***************************************************************

    // FIRSTNAME
    // On verifie l'existance et on nettoie
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($firstname)){
        // On test la valeur
        $testRegexFirstname = preg_match(REGEXP_STR_NO_NUMBER,$firstname);

        if($testRegexFirstname == false){
            $errorsArray['firstname_error'] = 'Le prénom n\'est pas valide';
        }
    }else{
        $errorsArray['firstname_error'] = 'Le champ n\'est pas rempli';
    }

    // ***************************************************************

    // DATE D'ANNIVERSAIRE 
    // On verifie l'existance et on nettoie
    $birthDate = trim(filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($birthDate)){
        // On test la valeur
        $testRegexBirthDate = preg_match(REGEXP_DATE,$birthDate);

        // On peut aller plus loin sur le test de la date à cet endroit

        if($testRegexBirthDate == false){
            $errorsArray['birthDate_error'] = 'Le date n\'est pas valide, le format attendu est YYYY-MM-JJ';
        }
    }

    // ***************************************************************
   
      
    // TELEPHONE
    // On verifie l'existance et on nettoie
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($phone)){
        // On test la valeur
        $testRegexPhone = preg_match(REGEXP_PHONE,$phone);

        if($testRegexPhone == false){
            $errorsArray['phone_error'] = 'Le numero n\'est pas valide, les séparateur sont - . /';
        }
    }

    // ***************************************************************
    
    // EMAIL
    // On verifie l'existance et on nettoie
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

    //On test si le champ n'est pas vide
    if(!empty($mail)){
        // On test la valeur
        $testMail = filter_var($mail, FILTER_VALIDATE_EMAIL);

        if($testMail == false){
            $errorsArray['mail_error'] = 'Le mail n\'est pas valide';
        }
    }else{
        $errorsArray['mail_error'] = 'Le champ n\'est pas rempli';
    }

    // ***************************************************************
    
        if(empty($errorsArray)){
                $patient = new Patient ($name, $firstname, $birthDate, $phone, $mail);
            
            if($patient->isExist($mail) == true){
                // var_dump($patient);
                
                $addPatient = $patient->addPatient();
                $success = 'Le patient est bien enregistré.';
            }else{
                $errorMailExist = 'Mail déjà connu, patient déja enregistrer ou entrer un nouveau mail.';
            }
         };

};

      
    include(dirname(__FILE__).'/../views/templates/header.php');
   
    include(dirname(__FILE__).'/../views/ajout_patient.php');

    include(dirname(__FILE__).'/../views//templates/footer.php');