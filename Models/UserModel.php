<?php
    require_once(__DIR__.'/BaseModel.php');
    class UserModel extends BaseModel
    {
        public $connection;

        public function __construct() {
            $this->connection = BaseModel::Connect();
        }

        public function getUserLoginBy($card = "", $birthday = "") {
            $sql = "SELECT * FROM tb_users WHERE user_national_card = '".$card."' AND user_birthday = '".$birthday."'";
            $res = $this->connection->query($sql);
            $data = [];
            if($res->num_rows > 0){
                while ($row = $res->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        public function getUserByID($id) {
            $sql = "SELECT * FROM tb_users WHERE user_id = $id";
            $res = $this->connection->query($sql);
            $data = [];
            if($res->num_rows > 0){
                while ($row = $res->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        public function getUserByCard($card = "") {
            $sql = "SELECT * FROM tb_users WHERE user_national_card = '".$card."'";
            $res = $this->connection->query($sql);
            $data = [];
            if($res->num_rows > 0){
                while ($row = $res->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        public function userConnected() {
            $sql = "INSERT INTO `tb_rating` (`id`, `view_date`) VALUES ('', NOW())";
            return $this->connection->query($sql);
        }

        public function updateUserByID($user_prefix, $user_name, $user_lastname, $user_national_card, $user_birthday, $user_id) {
            $sql = "
                UPDATE `tb_users` SET 
                `user_prefix` = '$user_prefix', 
                `user_name` = '$user_name', 
                `user_lastname` = '$user_lastname', 
                `user_national_card` = '$user_national_card', 
                `user_birthday` = '$user_birthday' 
                WHERE `tb_users`.`user_id` = $user_id
            ";
            // return $sql;
            return $this->connection->query($sql);
        }

        public function insertUserBy($user_prefix, $user_name, $user_lastname, $user_national_card, $user_birthday) {
            $sql = "
                INSERT INTO `tb_users` (
                    `user_id`, 
                    `user_prefix`, 
                    `user_name`, 
                    `user_lastname`, 
                    `user_national_card`, 
                    `user_birthday`, 
                    `user_role`, 
                    `add_date`, 
                    `update_date`
                    ) VALUES (
                        NULL, 
                        '$user_prefix', 
                        '$user_name', 
                        '$user_lastname', 
                        '$user_national_card', 
                        '$user_birthday', 
                        'user', 
                        NOW(), 
                        NOW()
                    )
            ";
            // return $sql;
            $this->connection->query($sql);
            return $this->getUserByCard($user_national_card);
        }
    }
    