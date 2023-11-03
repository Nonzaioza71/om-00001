<?php
    class BaseModel
    {
        public function Connect(){
            $connection = new mysqli("localhost", "root", "", "om-00001");
            if ($connection->connect_error) {
                die("Error : ". $connection->connect_error);
            }
            return $connection;
        }
    }
    