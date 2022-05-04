<?php

abstract class DB {
        private static $conn;

        private static function getConfig(){
            // get the config file
            return parse_ini_file(__DIR__ . "/../config/config.ini");
        }
        

        public static function getInstance() {
            if(self::$conn != null) {
                // REUSE our connection
                //echo "🚀";
                return self::$conn;
            }
            else {
                // CREATE a new connection

                // get the configuration for our connection from one central settings file
                $config = self::getConfig();
                $database = $config['database'];
                $user = $config['user'];
                $password = $config['password'];

                //echo "💥";
                self::$conn = new PDO('mysql:host=localhost:8889;dbname='.$database.';charset=utf8mb4', $user, $password);
                return self::$conn;
            }
        }
    }