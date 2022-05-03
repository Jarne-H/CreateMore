<?php

abstract class DB {
        private static $conn;

        private static function getConfig(){
            //Hier vind je de config file waar de databank gegevens in staan
            return parse_ini_file(__DIR__ . "/../config/config.ini");
        }
        

        public static function getInstance() {
            if(self::$conn != null) {
                //Als er een connectie is dan wordt deze gebruikt en gaat er geen nieuwe telkens worden aangemaakt
            
                return self::$conn;
            }
            else {
                //Als er nog geen connectie is, dan wordt hier een nieuwe connecte aangemaakt met de gegevens vanuit de config file
                $config = self::getConfig();
                $database = $config['database'];
                $user = $config['user'];
                $password = $config['password'];

                //echo "💥";
                self::$conn = new PDO('mysql:host=localhost;dbname='.$database.';charset=utf8mb4', $user, $password);
                return self::$conn;
            }
        }
    }