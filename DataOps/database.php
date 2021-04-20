<?php
    
    $host = "localhost";
    $username = "root";
    $password = "";
    $success = FALSE;
    
    $dbInit = new mysqli($host, $username, $password);
    if ($dbInit->connect_error) {
        die("Connection failed: " . $dbInit->connect_error);
    } 

    $query = 'SHOW DATABASES LIKE :StudyTime';
    $results = $dbInit->prepare($query);
    


    if (empty($results)){
        $sql = "CREATE DATABASE StudyTime";
        if ($dbInit->query($sql) === TRUE) {
            echo "Database created successfully with the name StudyTime";
            $success = TRUE;
        } else {
            echo "Error creating database: " . $dbInit->error;
        }
    }   

    if ($success) {
        $query0 = 'USE `StudyTime`;';
        $dbInit->query($query0);

        $query1 = 'CREATE TABLE ClassInfo
                  (
                      CRN         INT         NOT NULL,
                      CourseID    VARCHAR(60) NOT NULL,
                      Professor   VARCHAR(60) NOT NULL REFERENCES ProfessorInfo,
                      CMON        VARCHAR(60) NOT NULL,
                      CTUE        VARCHAR(60) NOT NULL,
                      CWED        VARCHAR(60) NOT NULL,
                      CTHU        VARCHAR(60) NOT NULL,
                      CFRI        VARCHAR(60) NOT NULL,
                      CSAT        VARCHAR(60) NOT NULL,
                      CSUN        VARCHAR(60) NOT NULL,
                      PRIMARY KEY (CRN)
                  );';
        $statement1 = $dbInit->query($query1);
        //echo 'Tried to create table ClassInfo';

        $query2 = 'CREATE TABLE ProfessorInfo
                  (
                      Professor   VARCHAR(60) NOT NULL,
                      PMON        VARCHAR(60) NOT NULL,
                      PTUE        VARCHAR(60) NOT NULL,
                      PWED        VARCHAR(60) NOT NULL,
                      PTHU        VARCHAR(60) NOT NULL,
                      PFRI        VARCHAR(60) NOT NULL,
                      PSAT        VARCHAR(60) NOT NULL,
                      PSUN        VARCHAR(60) NOT NULL,
                      PRIMARY KEY (Professor)
                  );';
        $statement2 = $dbInit->query($query2);
        //echo 'Tried to create table ProfessorInfo';

        $query3 = 'CREATE TABLE PersonalSchedule
                   (
                       EventNum    VARCHAR(60) NOT NULL,
                       EventName   VARCHAR(60) NOT NULL,
                       EMON        VARCHAR(60) NOT NULL,
                       ETUE        VARCHAR(60) NOT NULL,
                       EWED        VARCHAR(60) NOT NULL,
                       ETHU        VARCHAR(60) NOT NULL,
                       EFRI        VARCHAR(60) NOT NULL,
                       ESAT        VARCHAR(60) NOT NULL,
                       ESUN        VARCHAR(60) NOT NULL,
                       PRIMARY KEY (EventNum)
                   );';
        
        $statement3 = $dbInit->query($query3);
        //echo 'Tried to create table PersonalSched';

        $query4 = "INSERT INTO `ClassInfo` (`CRN`, `CourseID`, `Professor`, `CMON`, `CTUE`, `CWED`, `CTHU`, `CFRI`, `CSAT`, `CSUN`) VALUES
                  (0, 'CIS230.120', 'Tim Moriarty', '1:30.pm-3.pm', 'None', '1:30.pm-3.pm', 'None', 'None', 'None', 'None'),
                  (1, 'CIS115.110', 'Tim Moriarty', 'None', '1:30.pm-3.pm', 'None', '1:30.pm-3.pm', 'None', 'None', 'None'),
                  (2, 'CIS261.980', 'Garry Daly', 'None', '6.pm-9:30.pm', 'None', 'None', 'None', 'None', 'None'),
                  (3, 'WEB1115.220', 'Garry Daly', '9.am-12.pm', 'None', '9.am-12.pm', 'None', 'None', 'None', 'None'),
                  (4, 'CIS130.420', 'Maya Tolappa', 'None', '8:30.am-11.am', 'None', '8:30.am-11.am', 'None', 'None', 'None');";
        $dbInit->query($query4);

        $query5 = "INSERT INTO `ProfessorInfo` (`Professor`, `PMON`, `PTUE`, `PWED`, `PTHU`, `PFRI`, `PSAT`, `PSUN`) VALUES
                  ('Garry Daly', '8.am-9.am;12:30.pm-2.pm', '4.pm-6.pm', '8.am-9.am;12:30.pm-2.pm', '11.am-4.pm', '11.am-4.pm', '11.am-2.pm', 'None'),
                  ('Maya Tolappa', '8.am-2.pm', '7.am-8:30.am;12.pm-2.pm', '8.am-2.pm', '7.am-8:30.am;12.pm-2.pm', '12.pm-3.pm', '11.am-2.pm', 'None'),
                  ('Tim Moriarty', '11.am-1:20.pm;3.pm-5.pm', '11.am-1:20.pm;3.pm-5.pm', '11.am-1:20.pm;3.pm-5.pm', '11.am-1:20.pm;3.pm-5.pm', '9.am-2.pm', '9.am-12.pm', 'None');";
        $dbInit->query($query5);
        }

    $dbInit->close();


// Need section that creates and populates database if not already present.
//  Use .txt file and a set of functions? Needs yet to be determined. 
    global $db;
    $dsn = 'mysql:host=localhost;dbname=StudyTime';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>