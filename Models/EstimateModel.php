<?php
require_once(__DIR__ . '/BaseModel.php');
class EstimateModel extends BaseModel
{
    public $connection;

    public function __construct()
    {
        $this->connection = BaseModel::Connect();
    }

    public function getEstimateBy()
    {
        $sql = "SELECT * FROM `tb_estimate_list` WHERE TRUE";

        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getEstimateByUser($user_id)
    {
        $sql = "SELECT * FROM `tb_estimate_score` WHERE user_id = '$user_id'";

        $res = $this->connection->query($sql);
        $data = [];
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function insertEstimateScoreBy($user_id, $arr)
    {
        $sql = "";
        for ($i = 0; $i < count($arr); $i++) {
            $item = $arr[$i];
            $sql .= "INSERT INTO `tb_estimate_score` (
                    `id`, 
                    `estimate_id`, 
                    `estimate_score`, 
                    `user_id`
                ) VALUES (
                    NULL, 
                    '" . $item['estimate_id'] . "', 
                    '" . $item['estimate_score'] . "', 
                    '$user_id'
                );
                ";
        }
        // return $sql;
        return $this->connection->multi_query($sql);
    }

    public function updateEstimateByID($user_id, $arr)
    {
        $sql = "";
        for ($i = 0; $i < count($arr); $i++) {
            $item = $arr[$i];
            $sql .= "UPDATE `tb_estimate_score` 
                    SET 
                    `estimate_score` = " . $item['estimate_score'] . " 
                    WHERE 
                    `tb_estimate_score`.`user_id` = $user_id 
                    AND 
                    `tb_estimate_score`.`estimate_id` = " . $item['estimate_id'] . ";
                ";
        }
        // return $sql;
        return $this->connection->multi_query($sql);
    }
}
