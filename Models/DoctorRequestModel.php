<?php
require_once(__DIR__ . '/BaseModel.php');
class DoctorRequestModel extends BaseModel
{
    public $connection;

    public function __construct()
    {
        $this->connection = BaseModel::Connect();
    }

    public function getDoctorRequests($user_id, $doctor_id = "", $status = "", $role = "user")
    {
        $condition = "";
        if ($doctor_id != ""){
            $condition = " AND doctor_id = '" . $doctor_id . "'";
        }

        if ($status != ""){
            $condition .= " AND status = '" . $status . "'";
        }

        if ($role == 'doctor') {
            $sql = "SELECT * FROM `tb_doctor_request` 
                LEFT JOIN tb_users ON tb_users.user_id = tb_doctor_request.user_id OR tb_users.user_id = tb_doctor_request.doctor_id
                LEFT JOIN tb_gender ON tb_gender.gender_name = tb_users.user_gender
                WHERE is_del = 0 AND tb_users.user_role = 'user'" . $condition;
        } else {
            $sql = "SELECT * FROM tb_doctor_request 
            LEFT JOIN tb_users ON tb_users.user_id = tb_doctor_request.user_id OR tb_users.user_id = tb_doctor_request.doctor_id
            LEFT JOIN tb_gender ON tb_gender.gender_name = tb_users.user_gender
            WHERE tb_doctor_request.user_id = $user_id AND is_del = 0 AND tb_users.user_role = 'user'" . $condition;
        }

        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getDoctorRequestsByDoctorID($doctor_id)
    {
        $sql = "SELECT * FROM `tb_doctor_request` 
        LEFT JOIN tb_users ON tb_users.user_id = tb_doctor_request.user_id
        LEFT JOIN tb_gender ON tb_gender.gender_name = tb_users.user_gender
        WHERE is_del = 0 AND tb_doctor_request.doctor_id = $doctor_id AND status = 'approve';";

        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getDoctorRequestByID($id)
    {
        $sql = "SELECT * FROM `tb_doctor_request` 
            LEFT JOIN tb_users ON tb_users.user_id = tb_doctor_request.user_id OR tb_users.user_id = tb_doctor_request.doctor_id
            LEFT JOIN tb_gender ON tb_gender.gender_name = tb_users.user_gender
            WHERE is_del = 0 AND id = $id;";

        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function insertDoctorRequest($user_id, $detail)
    {
        $sql = "
                INSERT INTO `tb_doctor_request` (
                    `id`, 
                    `user_id`, 
                    `doctor_id`, 
                    `detail`, 
                    `reply`, 
                    `status`, 
                    `reply_date`, 
                    `sign_date`, 
                    `remark`
                    ) VALUES (
                        NULL, 
                        '$user_id', 
                        '0', 
                        '$detail', 
                        '', 
                        'waiting', 
                        '', 
                        NOW(), 
                        ''
                    )
            ";
        // return $sql;
        return $this->connection->query($sql);
    }

    public function acceptDoctorRequestByID($id, $doctor_id, $reply, $reply_date)
    {
        $sql = "
                UPDATE `tb_doctor_request` SET 
                `doctor_id` = '$doctor_id', 
                `reply` = '$reply', 
                `status` = 'approve',
                `status_th` = 'ได้รับการตอบรับจากหมอแล้ว',
                `reply_date` = '$reply_date' 
                WHERE `tb_doctor_request`.`id` = $id
            ";
        // return $sql;
        return $this->connection->query($sql);
    }

    public function cancelDoctorRequestByID($id)
    {
        $sql = "
                UPDATE `tb_doctor_request` SET `is_del` = 1 WHERE `tb_doctor_request`.`id` = $id;
            ";
            // return $sql;
        return $this->connection->query($sql);
    }
}
