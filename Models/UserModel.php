<?php
require_once(__DIR__ . '/BaseModel.php');
class UserModel extends BaseModel
{
    public $connection;

    public function __construct()
    {
        $this->connection = BaseModel::Connect();
    }

    public function getUserLoginBy($card = "", $birthday = "")
    {
        $sql = "SELECT * FROM tb_users 
        LEFT JOIN tb_users_pin ON tb_users_pin.user_id = tb_users.user_id WHERE 
        user_national_card = '$card' AND user_birthday = '$birthday';
        ";
        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getUserBannedByID($user_id) {
        $sql = "SELECT * FROM `tb_user_banned_list` WHERE user_id = $user_id;";
        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getUserByID($id)
    {
        $sql = "SELECT * FROM tb_users LEFT JOIN tb_users_pin ON tb_users_pin.user_id = tb_users.user_id WHERE tb_users.user_id = $id";
        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getUserByCard($card = "")
    {
        $sql = "SELECT * FROM tb_users LEFT JOIN tb_users_pin ON tb_users_pin.user_id = tb_users.user_id WHERE user_national_card = '" . $card . "'";
        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function userConnected()
    {
        $sql = "INSERT INTO `tb_rating` (`id`, `view_date`) VALUES ('', NOW())";
        return $this->connection->query($sql);
    }

    public function updateUserByID($user_prefix, $user_name, $user_lastname, $user_national_card, $user_birthday, $user_id)
    {
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

    public function updateUserPINByID($user_id, $user_pin)
    {
        $sql = "
            UPDATE `tb_users_pin` SET `user_pin` = '$user_pin' WHERE `tb_users_pin`.`user_id` = $user_id;
            ";
        // return $sql;
        return $this->connection->query($sql);
    }

    public function getUserPINByID($user_id) {
        $sql = "SELECT * FROM tb_users_pin WHERE user_id = $user_id";
        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function userLoginByPIN($user_pin, $user_id) {
        $sql = "SELECT * FROM tb_users_pin WHERE user_id = $user_id AND user_pin = $user_pin";
        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getUserPINBy() {
        $sql = "SELECT * FROM tb_users_pin WHERE TRUE";
        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function insertUserPINBy($user_id, $user_pin)
    {
        $sql = "
            INSERT INTO `tb_users_pin` (
                `id`, 
                `user_id`, 
                `user_pin`
                ) VALUES (
                    NULL, 
                    '$user_id', 
                    '$user_pin'
                )
            ";
        return $this->connection->query($sql);
    }

    public function insertUserBy($user_prefix, $user_name, $user_lastname, $user_national_card, $user_birthday)
    {
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
        return $this->connection->query($sql);
        // return $this->getUserByCard($user_national_card);
    }
}
