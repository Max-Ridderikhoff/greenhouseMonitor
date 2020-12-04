<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
class CRUD
{
    public function conn() {
        static $conn;
        $host = "localhost";
        $user = "root";
        $password = "root";
        $dbname = "tempsensor";

        if(!isset($conn)) {
            $conn = new mysqli($host, $user, $password, $dbname);
        }
        return $conn;
    }

    public function getData() {
        $conn = $this->conn();
        $sql = "SELECT * FROM `data`";
        $data = [];
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return json_encode($data);
    }
    
    public function getLatestData() {
        $conn = $this->conn();
        $sql = "SELECT * FROM `data` ORDER BY id DESC LIMIT 1";
        $data = [];
        $stmt = $conn->prepare($sql);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return json_encode($data);
    }

    public function getHighestTemp() {
        $conn = $this->conn();
        $sql = "SELECT * FROM `data` ORDER BY temperature DESC LIMIT 1";
        $data = [];
        $stmt = $conn->prepare($sql);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return json_encode($data);
    }
    public function getHighestHumid() {
        $conn = $this->conn();
        $sql = "SELECT * FROM `data` ORDER BY humidity DESC LIMIT 1";
        $data = [];
        $stmt = $conn->prepare($sql);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return json_encode($data);
    }

    public function getLowestTemp() {
        $conn = $this->conn();
        $sql = "SELECT * FROM `data` ORDER BY temperature ASC LIMIT 1";
        $data = [];
        $stmt = $conn->prepare($sql);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return json_encode($data);
    }
    
    public function getLowestHumid() {
        $conn = $this->conn();
        $sql = "SELECT * FROM `data` ORDER BY humidity ASC LIMIT 1";
        $data = [];
        $stmt = $conn->prepare($sql);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return json_encode($data);
    }
    
}
?>