<?php
//require("database.php");

function get_ClassInfo($crn) {
    global $db;
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

function setTemp($crn, $courseID, $professor, $cmon, $ctue, $cwed, $cthu, $cfri, $csat, $csun, $user) {
    global $db;
    $query = "INSERT INTO ClassInfoTemp
                    (CRN, CourseID, Professor, CMON, CTUE, CWED, CTHU, CFRI, CSAT, CSUN)
                Values
                    (:crn, :course, :prof, :mon, :tue, :wed, :thu, :fri, :sat, :sun)";
    $statement = $db->prepare($query);
    $statement ->bindValue(':crn', $crn);
    $statement ->bindValue(':course', $courseID);
    $statement ->bindValue(':prof', $professor);
    $statement ->bindValue(':mon', $cmon);
    $statement ->bindValue(':tue', $ctue);
    $statement ->bindValue(':wed', $cwed);
    $statement ->bindValue(':thu', $cthu);
    $statement ->bindValue(':fri', $cfri);
    $statement ->bindValue(':sat', $csat);
    $statement ->bindValue(':sun', $csun);
    $statement->execute();
    
    /*
    try {
        $statement->execute();
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        $path = $user.'_User/EnterCRN'.$user.'.php';
        include('../errors/database_error.php');
        exit();
    }    */
}

function getTemp() {
    global $db;
    $query = "SELECT * FROM ClassInfoTemp";
    $statement = $db->prepare($query);
    $statement->execute();
    $classInfo = $statement->fetchAll();
    $statement->closeCursor();
    return $classInfo;
}

function tempRecordsCheck($crnNum) {
    global $db;
    $query = "SELECT * FROM ClassInfoTemp
              WHERE CRN = :crn";
    $statement = $db->prepare($query);
    $statement ->bindValue(':crn',$crnNum);
    $statement->execute();
    $record = $statement->fetch();
    $statement->closeCursor();
    return $record;
}

function remove_temp($crn) {
    global $db;

    $query = 'DELETE FROM ClassInfoTemp
              WHERE CRN = :crn';
    $statement = $db->prepare($query);
    $statement->bindValue(':crn', $crn);
    $statement->execute();
 }

/*
function get_OH($prof) {
    global $db;

    $query = 'SELECT * FROM ProfessorInfo
              WHERE Professor = :prof';
        $statement = $db->prepare($query);
        $statement->bindValue(':prof', $prof);
        $statement->execute();
        $profInfo = $statement->fetch();
        $statement->closeCursor();
        return $profInfo;
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
*/

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
    $query = 'SELECT * FROM PersonalSchedule';
    $statement = $db->prepare($query);
    $statement->execute();
    $Events = $statement->fetchAll();
    $statement->closeCursor();
    return $Events;
}

function delete_Event($eventNum) {
    global $db;

    $query = 'DELETE FROM PersonalSchedule
              WHERE EventNum = :eventNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventNum', $eventNum);
    $statement->execute();
}

function add_class($crn, $courseID, $professor, $cmon, $ctue, $cwed, $cthu, $cfri, $csat, $csun) {
    global $db;
    $query = "INSERT INTO ClassInfo
                    (CRN, CourseID, Professor, CMON, CTUE, CWED, CTHU, CFRI, CSAT, CSUN)
                Values
                    (:crn, :course, :prof, :mon, :tue, :wed, :thu, :fri, :sat, :sun)";
    $statement = $db->prepare($query);
    $statement->bind_Value(':crn', $crn);
    $statement->bind_Value(':course', $courseID);
    $statement->bind_Value(':prof', $professor);
    $statement->bind_Value(':mon', $cmon);
    $statement->bind_Value(':tue', $ctue);
    $statement->bind_Value(':wed', $cwed);
    $statement->bind_Value(':thu', $cthu);
    $statement->bind_Value(':fri', $cfri);
    $statement->bind_Value(':sat', $csat);
    $statement->bind_Value(':sun', $csun);
    $statement->execute();

}
?>
