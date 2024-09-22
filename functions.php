<?php
    function createConnection() {
        $pdo = null;
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=lameute;charset=utf8', 'root', '');
        } catch (Exception $e) {
            echo ("Error".$e);
            exit();
        }
        return $pdo;
    }
?>