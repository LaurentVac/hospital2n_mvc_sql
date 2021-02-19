<?php
// 
     include(dirname(__FILE__).'/../utils/Database.php');
        class Patient {
            private $_id;
            private $_firstname;
            private $_lastname;
            private $_birthdate;
            private $_phone;
            private $_mail;
            private $_pdo;

            public function __construct($name = null, $firstname= null, $birthDate= null, $phone= null, $mail= null, $id= null){
                $this->_firstname = $firstname;
                $this->_lastname = $name;
                $this->_birthdate =  $birthDate;
                $this->_phone = $phone;
                $this->_mail = $mail;
                $this->_id = $id;
                $this->_pdo = Database::connect();
            }

            public function isExist($mail){         
               if(isset($mail)){
                    $sql = 'SELECT COUNT(*) AS `mail` FROM `patients` WHERE `mail` = ? ;';
                    $sth = $this->_pdo->prepare($sql);
                    $sth->execute([$mail]);
                    $mailExist = $sth->fetch(PDO::FETCH_ASSOC);
                    // var_dump($mailExist);
                    if($mailExist['mail'] == 0){
                        return true;
                    }else{
                        return false;
                    } 
                }           
            }
            public function addPatient(){     
                try{
                    $sql = "INSERT INTO `patients` (lastname, firstname, birthdate, phone, mail)
                        VALUES (:lastname, :firstname, :birthdate, :phone, :mail);";
            
                    // préparation de la requête
                    $sth = $this->_pdo->prepare($sql);

                    // association des marqueurs nominatif via méthode bindvalue
                    $sth->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
                    $sth->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
                    $sth->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
                    $sth->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
                    $sth->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
                    return($sth->execute());
                                
                }catch (PDOException $e) {
                    
                    return false;
                }           
            }
            //methode qui recupère et affiche liste client
            public function listPatient(){
                try{
                    $sql = 'SELECT * FROM `patients` ORDER BY `lastname`;';
                    // préparation de la requête
                    $sth = $this->_pdo->query($sql);
                    $listPatient = $sth->fetchAll(PDO::FETCH_OBJ);
                    return $listPatient;
                }catch (PDOException $e) {
                    echo 'Connexion échouée : '.$e->getMessage();
                    return false;
                }
            }
            // Methode qui affiche le profil selectionné
            public function profilPatient($id){
                try {
                    $sql='SELECT * FROM `patients` WHERE `id` = :id;';      
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindValue(':id', $id, PDO::PARAM_INT);
                    $sth->execute();
                    $profilPatient = $sth->fetch(PDO::FETCH_OBJ); 
                    var_dump($profilPatient);           
                    return $profilPatient;
                } catch (PDOException $e) {
                   echo 'Connexion échouée : ' . $e->getMessage();
                   return false ;
                }
            }
            //methode de misze a jour du patient sélectionné
            public function updatePatient(){
                try{
                    $sql = "UPDATE `patients` SET `lastname`= :lastname,
                                                  `firstname` = :firstname,
                                                  `birthdate` = :birthdate,
                                                  `phone` = :phone,
                                                  `mail` = :mail
                                                  WHERE `id` = :id ;";
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindValue(':id',$this->_id, PDO::PARAM_INT);
                    $sth->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
                    $sth->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
                    $sth->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
                    $sth->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
                    $sth->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
                    return($sth->execute());
                }catch(PDOException $e) {
                    // echo 'Connexion échouée : ' . $e->getMessage();
                    return false;
                }
            }
            
            public function getIdPatient($id){
                try{
                    $sql = "SELECT `id` FROM `patients` WHERE `id` = :id ;";
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindvalue(':id',$id,PDO::PARAM_INT);
                     $sth->execute();
                     $appoint = $sth->fetch(PDO::FETCH_OBJ); 
                    //  var_dump($appoint);
                    return $appoint;

                }catch(PDOException $e) {
                    echo 'Connexion échouée : ' . $e->getMessage();
                }
            }

            public function deletePatient($id){
                try {
                    $sql = 'DELETE FROM `patients` WHERE `id`= :id;';
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindValue(':id',$id,PDO::PARAM_INT);
                    return($sth->execute());

                } catch (PDOException $e)  {
                   return false;
                }
            }

            public function searchPatient($search){
                try {
                    $sql = 'SELECT * FROM `patients` WHERE `lastname`  LIKE :search ;';
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindValue(':search','%'.$search.'%', PDO::PARAM_STR);
                    // $sth->execute([.$terme."%"]);
                    $sth->execute();
                    return($sth->fetchAll(PDO::FETCH_OBJ));
                    
                } catch (PDOException $e) {
                    return false ;
                }
            }
        }
                
                
          