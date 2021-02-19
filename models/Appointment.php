<?php
// 
    require_once(dirname(__FILE__).'/../utils/Database.php');

        class Appointment {
            private $_id;
            private $_dateHour;
            private $_idPatients;

            public function __construct($dateHour = null, $idPatients = null , $id = null){
                $this->_dateHour = $dateHour;
                $this->_idPatients = $idPatients;
                $this->_id = $id;
            
                $this->_pdo = Database::connect();
            }
            // INNER JOIN `appointments` ON   `appointments`.`idPatients` = `patients`.`id`  
            public function addAppointment($id){
                try{
                    
                   
                    $sql = 'INSERT INTO `appointments` (dateHour, idPatients) VALUE (:dateHour , :idPatients);';
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindValue(':idPatients',$id, PDO::PARAM_INT);
                    $sth->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
                    
                    $appoint = $sth->execute();
                    
                    return $appoint;

                }catch(PDOException $e) {
                    echo 'Connexion échouée : ' . $e->getMessage();
                    return false;
                }          
            }

            public function listAppointment(){
                try{
                    $sql = 'SELECT   `patients`.*,`appointments`.*   FROM `appointments` INNER JOIN `patients` ON `patients`.`id` = `appointments`.`idPatients` ORDER BY `lastname`; ';
                    $sth = $this->_pdo->query($sql);
                    $listAppointments = $sth->fetchAll(PDO::FETCH_OBJ);
                    return $listAppointments;
                }catch(PDOException $e) {
                    echo 'Connexion échouée : ' . $e->getMessage();
                    return false;
                }
            }
            public function detailAppointment($id){
                try {
                    // `lastname`, `firstname`, `mail`, `phone`, `birthdate`, `dateHour` 
                    $sql='SELECT  `patients`.*,`appointments`.*   FROM `appointments` INNER JOIN `patients`ON `patients`.`id` = `appointments`.`idPatients` WHERE `appointments`.`id` = :id ';
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindValue(':id', $id, PDO::PARAM_INT);
                    $sth->execute();
                    $detailA = $sth->fetch(PDO::FETCH_OBJ);        
                    return $detailA;
                } catch (PDOException $e) {
                   echo 'Connexion échouée : ' . $e->getMessage();
                   return false ;
                }
            }

            public function updateAppointment(){
                try {
                    $sql= 'UPDATE `appointments` SET `idPatients` = :idPatients,`dateHour` = :dateHour WHERE `id` = :id ;';
                    $sth = $this->_pdo->prepare($sql);    
                    $sth->bindValue(':id',$this->_id, PDO::PARAM_INT);
                    $sth->bindValue(':idPatients',$this->_idPatients, PDO::PARAM_INT);
                    $sth->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);                    
                    return($sth->execute());
                } catch (PDOException $e) {
                    echo 'Connexion échouée : ' . $e->getMessage();
                    return false ;
                }
            }
             public function profilAppointment($id){
                try {
                    $sql='SELECT * FROM `appointments` WHERE `id`= :id';
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindValue(':id', $id, PDO::PARAM_INT);
                    $sth->execute();
                    $detailA = $sth->fetch(PDO::FETCH_OBJ); 
                 
                    return $detailA;
                } catch (PDOException $e) {
                    echo 'Connexion échouée : ' . $e->getMessage();
                    return false ;
                }
             }

             public function patientApp($id){
                 try {
                     $sql = 'SELECT * FROM `appointments` WHERE `idPatients`= :id ';
                     $sth = $this->_pdo->prepare($sql);
                     $sth->bindvalue(':id', $id,PDO::PARAM_INT);
                     $sth->execute();
                     return($sth->fetchAll(PDO::FETCH_OBJ));
                 } catch (PDOException $e) {
                   return false;
                 }
             }

             public function deleteApp($id){
                try{
                    $sql = 'DELETE FROM `appointments` WHERE `id` = :id ;';
                   
                    $sth = $this->_pdo->prepare($sql);
                    $sth->bindvalue(':id', $id,PDO::PARAM_INT);
                    return($sth->execute());
                }catch (PDOException $e) {
                    return false;
                }
             }           
            // `patients`.:id
            // `appointments`.`idPatients`      
        }