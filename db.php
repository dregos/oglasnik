<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "online_oglasnik";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }


    function fetchSQLData($connection, $query){
         //echo ($sql);

        $statement = $connection->prepare($query);

        // execute statement
        $statement->execute();

        // set the resulting array to associative
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        // gets data from DB
        return $statement->fetchAll();
    }
?>