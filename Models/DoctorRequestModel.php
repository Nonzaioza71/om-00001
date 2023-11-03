<?php
    require_once(__DIR__.'/BaseModel.php');
    class DoctorRequestModel extends BaseModel
    {
        public $connection;

        public function __construct() {
            $this->connection = BaseModel::Connect();
        }

        public function getDoctorRequests($user_id, $doctor_id = "") {
            $condition = ($doctor_id != "") 
            ? " AND doctor_id = '".$doctor_id."'"
            : "";

            $sql = "SELECT * FROM `tb_doctor_request` WHERE user_id = $user_id AND is_del = 0".$condition;

            $res = $this->connection->query($sql);
            $data = [];
            if($res->num_rows > 0){
                while ($row = $res->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        public function insertDoctorRequest($user_id) {
            $sql = "
                INSERT INTO `tb_doctor_request` (
                    `id`, 
                    `user_id`, 
                    `doctor_id`, 
                    `status`, 
                    `sign_date`, 
                    `remark`
                    ) VALUES (
                        NULL, 
                        '$user_id', 
                        '0', 
                        'waiting', 
                        NOW(), 
                        ''
                    )
            ";
            // return $sql;
            return $this->connection->query($sql);
        }

        public function cancelDoctorRequestByID($id) {
            $sql = "
                UPDATE `tb_doctor_request` SET `is_del` = 1 WHERE `tb_doctor_request`.`id` = $id;
            ";
            return $this->connection->query($sql);
        }
    }
    