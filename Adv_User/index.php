<?php
/*
Ken Hiltenbrandj
CIS261.980 - Professor Garry Daly
Final Project index.php for the advanced user path
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

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL)
    {
        $action = 'Advanced Mode';
    }
}

if ($action == 'Advanced Mode')                                 //
{                                                               //
    include('EnterCRNAdv.php');                                 //
} else if ($action == 'Continue to Info Verification') {        //
    include('InfoVerificationAdv.php');                         //
} else if ($action == 'Continue to the Prototype Schedule') {   //
    include('ProtoSchedAdv.php');                               //
} else if ($action == 'Continue to Modified Schedule') {        //
    include('AddSchedAdv.php');                                 //
} else if ($action == 'Enter Other CRNs') {                     //
    include('EnterCRNAdv.php');                                 //
} else if ($action == 'Download') {
    include('../Download.php');
} else if ($action == 'Exit') {
    include('../ExitScreen.php');
}
