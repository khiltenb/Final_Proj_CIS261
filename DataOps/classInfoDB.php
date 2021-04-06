<?php
//require("database.php");

function get_ClassInfo($crn) {
    global $db;

    // $dsn = 'mysql:host=localhost;dbname=StudyTime';
    // $username = 'mgs_user';
    // $password = 'pa55word';

    // try {
    //     $db = new PDO($dsn, $username, $password);
    // } catch (PDOException $e) {
    //     $error_message = $e->getMessage();
    //     include('../errors/database_error.php');
    //     exit();
    // }

    $query = 'SELECT * FROM ClassInfo
              WHERE CRN = :crn';
    $statement = $db->prepare($query);
    $statement->bindValue(':crn', $crn);
    $statement->execute();
    $classInfo = $statement->fetch();
    //echo "classInfo =".count($classInfo)."<br>\n";
    //echo "classInfo[Professor] =".$classInfo["Professor"]."<br>\n";
    $statement->closeCursor();
    return $classInfo;
}


function getProf($crn) {
    global $db;
    $query = 'SELECT Professor FROM ClassInfo
              WHERE CRN = :crn';
    $statement = $db->prepare($query);
    $statement ->bindValue(':crn', $crn);
    $statement->execute();
    $statement->closeCursor();
    return $statement;
}

function addEvent($eventNum, $eventName, $mon, $tue, $wed, $thu, $fri, $sat, $sun){
    global $db;

    $query = 'INSERT INTO PersonalSchedule
                (EventNum, EventName, EMON, ETUE, EWED, ETHU, EFRI, ESAT, ESUN)
              VALUES
                (:eventnum, :eventname, :mon, :tue, :wed, :thu, :fri, :sat, :sun)';
        $statement = $db->prepare($query);
        $statement ->bindValue(':eventnum', $eventNum);
        $statement ->bindValue(':eventname', $eventName);
        $statement ->bindValue(':mon', $mon);
        $statement ->bindValue(':tue', $tue);
        $statement ->bindValue(':wed', $wed);
        $statement ->bindValue(':thu', $thu);
        $statement ->bindValue(':fri', $fri);
        $statement ->bindValue(':sat', $sat);
        $statement ->bindValue(':sun', $sun);
        $statement->execute();
        $statement->closeCursor();
}

function getEvents(){
    global $db;
    $query = 'SELECT * FROM PersonalSchedule WHERE 1';
    $statement = $db->prepare($query);
    $statement->execute();
    $Events = $statement->fetchAll();
    $statement->closeCursor();
    return $Events;
}
?>
