<?php 
    class Database{

        public static function connect(){
            $dsn = 'mysql:dbname=hospitale2n;host=localhost';
            $user = 'hositale2n';
            $password = 'ZJ9JcevORD8DEhOu';
            try {
                // connexion a la db 
                $pdo = new PDO($dsn, $user, $password);
                 //gestion des erreurs
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE ,PDO::FETCH_OBJ) ;
               
            } catch (PDOException $e){
               echo 'Connexion échouée : ' . $e->getMessage();
               
            };
            return $pdo;          
        }
    }

    ?>