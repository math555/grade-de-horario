<?php

class Conexao {
    
    function conexaoPDO(){
        try {
        $servername = "localhost";
        $database = "bd_poupa";
        $username = "root";
        $password = "";    
        $conn = new PDO('mysql:host=localhost;dbname=bd_poupa', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        return $conn;
    }
}


?>