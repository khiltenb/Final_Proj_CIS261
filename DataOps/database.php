<?php
    // THIS MAY ALL NEED TO BE CHANGED!! NOT FINAL YET!!!

    //Commenting out section from HERE***
    /*
    $host = "localhost";
    $username = "cis261_04";
    $password = "X00371971";
    $success = FALSE;
    
    $dbInit = new mysqli($host, $username, $password);
    if ($dbInit->connect_error) {
        die("Connection failed: " . $dbInit->connect_error);
    } 

    $query = 'SHOW DATABASES LIKE cis261_04';
    $results = $dbInit->prepare($query);
    


    if (empty($results)){
        $sql = "CREATE DATABASE IF NOT EXISTS cis261_04";
        if ($dbInit->query($sql) === TRUE) {
            //echo "Database created successfully with the name cis261_04";
            $success = TRUE;
        } else {
            echo "Error creating database: " . $dbInit->error;
        }
    }   

    if ($success) {
        $query0 = 'USE `cis261_04`;';
        $dbInit->query($query0);

        $query1 = 'CREATE TABLE IF NOT EXISTS ClassInfo
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

        $query2 = 'CREATE TABLE IF NOT EXISTS ProfessorInfo
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
        if ($statement2) {
            echo "Statement two is true";
        } else {
            echo "Statement two is false";
        }
        //echo 'Tried to create table ProfessorInfo';

        $query3 = 'CREATE TABLE IF NOT EXISTS PersonalSchedule
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
        
        $query6 = "CREATE TABLE ClassInfoTemp
                   (
                      CRN         INT         NOT NULL,
                      CourseID    VARCHAR(60) NOT NULL,
                      Professor   VARCHAR(60) NOT NULL,
                      CMON        VARCHAR(60) NOT NULL,
                      CTUE        VARCHAR(60) NOT NULL,
                      CWED        VARCHAR(60) NOT NULL,
                      CTHU        VARCHAR(60) NOT NULL,
                      CFRI        VARCHAR(60) NOT NULL,
                      CSAT        VARCHAR(60) NOT NULL,
                      CSUN        VARCHAR(60) NOT NULL,
                      PRIMARY KEY (CRN)
                   )";
        $dbInit->query($query6);
        }

    $dbInit->close();
    // TO HERE*** Once the table creating and population code.
    */


//  This section assumes that the cis261_04 is already present, but may not have all the tables. Since I didn't have the 
//      professor information (office hours mainly) I decided that the professorInfo table was unnecessary and didn't need
//      to be included. Further database management may be used here, but it is more likely that I'll do it in the first or
//      second index.php file.
    global $db;
    $dsn = 'mysql:host=localhost;dbname=cis261_04';
    $username = 'cis261_04';
    $password = 'X00371971';

    try {                                               
        $db = new PDO($dsn, $username, $password);      
    } catch (PDOException $e) {                         
        $error_message = $e->getMessage();              
        include('../errors/database_error.php');        
        exit();                                         
    }

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
    try {
        $statement1 = $db->query($query1);
    } catch (PDOException $e) {
        $statement1 = false;
    }

    $query2 = 'CREATE TABLE IF NOT EXISTS PersonalSchedule
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
    try {
        $statement2 = $db->query($query2);
    } catch (PDOException $e) {
        $statement2 = false;
    }

    $query3 = "CREATE TABLE ClassInfoTemp
              (
                  CRN         INT         NOT NULL,
                  CourseID    VARCHAR(60) NOT NULL,
                  Professor   VARCHAR(60) NOT NULL,
                  CMON        VARCHAR(60) NOT NULL,
                  CTUE        VARCHAR(60) NOT NULL,
                  CWED        VARCHAR(60) NOT NULL,
                  CTHU        VARCHAR(60) NOT NULL,
                  CFRI        VARCHAR(60) NOT NULL,
                  CSAT        VARCHAR(60) NOT NULL,
                  CSUN        VARCHAR(60) NOT NULL,
                  PRIMARY KEY (CRN)
               )";
        try {
            $statement3 = $db->query($query3);
        } catch (PDOException $e) {
            $statement3 = false;
        }

        if ($statement1) { //
            // Maybe make while loop that takes from a csv and populates the classInfo table?
            // Need to test pulling data from .csv file. Will research this and test it.
            if (($handle = fopen("../DataOps/Data.csv", "r")) !== FALSE) {
                //echo "Past the if statement";
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (is_numeric($data[1])) {     //  Checks for a numeric value (CRN), then proceeds with the following
                        //  function here to add for making the insert statements. Won't be a function, but could be.
                        
                        //  Plan: searching the days of the week section of the csv file, and then constructing the data 
                        //      to feed to the function. Starting with thursday, then moving along the week as normal.
                        $dataDays = $data[15];                                                                                              //  placeHolder
                        $days = array('Th', 'M', 'T', 'W', 'F', 'Sa', 'Su');                                                                //  Order of how I'm going through the days
                        $classDays = array('M'=>'None', 'T'=>'None', 'W'=>'None', "Th"=>'None', 'F'=>'None', 'Sa'=>'None', 'Su'=>'None');   //  Setting up for entering data in the database
                        for ($i = 0; $i < 6; $i++) {                                                                                        //  looping through all the days
                            $pos = strpos($dataDays, $days[$i]);                                                                            //  proof of (non)existence within the string $dataDays
                            if ($pos != false) {                                                                                            //  if its there, do the following
                                $classDays[$days[$i]] = $data[13] . '-' .$data[14];                                                         //  put the times in the placeholder spot for the data entry
                                $dataDays = str_replace($days[$i], '', $dataDays);                                                          //  remove the day from the string, allowing for Th not to interfere with T
                            }
                        }
                        // function call to enter data into database
                    }
                }
            }
        fclose($handle);
        

            //  For now and for testing purposes, I'm populating the database with the test entries
            $query4 = "INSERT INTO `ClassInfo` (`CRN`, `CourseID`, `Professor`, `CMON`, `CTUE`, `CWED`, `CTHU`, `CFRI`, `CSAT`, `CSUN`) VALUES
                  (0, 'CIS230.120', 'Tim Moriarty', '1330-1500', 'None', '1330-1500', 'None', 'None', 'None', 'None'),
                  (1, 'CIS115.110', 'Tim Moriarty', 'None', '1330-1500', 'None', '11330-1500', 'None', 'None', 'None'),
                  (2, 'CIS261.980', 'Garry Daly', 'None', '1800-2130', 'None', 'None', 'None', 'None', 'None'),
                  (3, 'WEB1115.220', 'Garry Daly', '0900-1200', 'None', '0900-1200', 'None', 'None', 'None', 'None'),
                  (4, 'CIS130.420', 'Maya Tolappa', 'None', '0830-1100', 'None', '0830-1100', 'None', 'None', 'None');";
            $statement4 = $db->query($query4);

        }
?>