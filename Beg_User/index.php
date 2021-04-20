<?php
/*
Ken Hiltenbrandj
CIS261.980 - Professor Garry Daly
Final Project index.php for the novice user path
*/

require('../DataOps/database.php');     //  Makes it so we can acces the database that we want
require('../DataOps/classInfoDB.php');  //

/*
Here's where things get a little messy. I had idead about how to organize the data and how I'd
     use MySQL/MariaDB to access/store the data efficiently, however, I didn't really give much
     thought to how I'd structure the application itself, so I took a look at the MVC model, the
     examples from the book and the homework we did and modeled a lot of the internal structure
     after that as it makes things less complicated. This will basically be copy-pasted and 
     modified to suit the needs of the other side. Utilizing only one index file and having two
     separate folders for each of the sides of the application just seemed a rather daunting
     task at the time I was doing this.
*/

//  This is a fallback in case something weird happens.
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL)
    {
        $action = 'Beginner Mode';
    }
}

//  This is where things get messy real quick. I'm planning to use this
if ($action == 'Beginner Mode')                                 //
{                                                               //
    include('EnterCRNBeg.php');                                 //
} else if ($action == 'Continue to Info Verification') {        //
    $crn = array();
    $crn[0] = filter_input(INPUT_POST, 'crn1');
    $crn[1] = filter_input(INPUT_POST, 'crn2');
    $crn[2] = filter_input(INPUT_POST, 'crn3');
    $crn[3] = filter_input(INPUT_POST, 'crn4');
    $crn[4] = filter_input(INPUT_POST, 'crn5');
    $crn[5] = filter_input(INPUT_POST, 'crn6');
    $count = 0;
    $classinformation = array();
    $profCount = 0;
    $professors = array();
    for ($i = 0; $i < 5; $i++)
    {
        if (!empty($crn[$i]))
        {
            $crn[$i] = intval($crn[$i]);
            //echo "looking up crn for crn[".$i."]=".$crn[$i]."<br>\n";
            $oneClassInfo = get_ClassInfo($crn[$i]);
            //echo "oneClassInfo[Professor]=".$oneClassInfo["Professor"]."<br>\n";
            $classinformation[$i] = $oneClassInfo;
            //echo "classinformation[".$i."][Professor]=".$classinformation[$i]["Professor"]."<br>\n";
            $count++;
            $classProf = $oneClassInfo['Professor'];

            if (count($professors) == 0 || $classProf != $professors[$profCount]) {
                $professors[$profCount] = get_OH($classProf);
                $profCount++;
                //echo $classinformation[$i]['Professor'] . 'should be returning "Tim Moriarty"';
            }
        }
    }
    
    include('InfoVerificationBeg.php');                         //
} else if ($action == 'Continue to the Prototype Schedule') {   //
    // stuff?
    include('ProtoSchedBeg.php');                               //
} else if ($action == 'Continue to Modified Schedule') {        //
    // stuff?
    include('AddSchedBeg.php');                                 //
} else if ($action == 'Enter Other CRNs') {                     //
    // stuff
    include('EnterCRNBef.php');                                 //
} else if ($action == 'Download') {                             //
    // stuff
    include('../Download.php');                                 //
} else if ($action == 'Exit') {                                 //
    // stuff
    include('../ExitScreen.php');                               //
} else if ($action == 'Add Event') {                            //
    $eventName = filter_input(INPUT_POST, 'EventName');
    $day = array();
    $day[0]= filter_input(INPUT_POST, 'mon');
    $day[1] = filter_input(INPUT_POST, 'tue');
    $day[2] = filter_input(INPUT_POST, 'wed');
    $day[3] = filter_input(INPUT_POST, 'thu');
    $day[4] = filter_input(INPUT_POST, 'fri');
    $day[5] = filter_input(INPUT_POST, 'sat');
    $day[6] = filter_input(INPUT_POST, 'sun');

    $timeH1 = filter_input(INPUT_POST, 'hour1');
    $timeM1 = filter_input(INPUT_POST, 'min1');
    $timeMer1 = filter_input(INPUT_POST, 'meridian1');
    $timeH2 = filter_input(INPUT_POST, 'hour2');
    $timeM2 = filter_input(INPUT_POST, 'min2');
    $timeMer2 = filter_input(INPUT_POST, 'meridian2');
    
    //  Converts 0 or 1 to A.M. or P.M.
    if ($timeMer1 == 0) {
        $timeMer1 = 'A.M.';
    } else {
        $timeMer1 = 'P.M.';
    }

    if ($timeMer2 == 0) {
        $timeMer2 = 'A.M.';
    } else {
        $timeMer2 = 'P.M.';
    }


    $time_formatted = $timeH1 . ":" . $timeM1 . " " . $timeMer1 . ";" . $timeH2 . ":" . $timeM2 . " " . $timeMer2;
    //  date/time object? (chatper 10 pg 294)

    for ($i = 0; $i < 7; $i++) {
        if (isset($day[$i])) {
            $day[$i] = $time_formatted;
        } else {
            $day[$i] = 'None';
        }
    }

        $key_generated = rand();    // Just uses a random number for the primary key. Might need a more intuitive soln to this later

        addEvent($key_generated, $eventName, $day[0], $day[1], $day[2], $day[3], $day[4], $day[5], $day[6]);
        $events = array();
        $events = getEvents();
        
    include('AddSchedBeg.php');                                 //
} else if ($action == 'Remove Event') {                         //
    $delID = filter_input(INPUT_POST, 'EvID');
    
    // Input Validation
    if ($delID != NULL || $delID != ''){
        delete_Event($delID);
        $events = array();
        $events = getEvents();
        include('AddSchedBeg.php');
    } else {
        $errmessage = 'The entry failed to terminate. Please try again or (for the developer) fix the code.';//  Trigger to display error message and return to the page
        include('AddSchedBeg.php');
    }
} else if ($action == 'Remove Class') {                         //
    //This is an array thing, but there's a scope issue, which I'm actively looking to solve.
} else if ($action == 'Remove OH') {
    //Similar issue to the preceding section.
}