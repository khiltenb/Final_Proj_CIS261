<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - ProtoSchedBeg.html
-->
<?php $path ='../'?>
<?php include '../view/header.php';?>

<body>
    <h1>Proto-Schedule</h1>
    <p>This is a prototype-schedule. You may download the schedule if you'd like and make further edits by hand, or you 
        may continue on to make edits within this program by pressing "Continue."</p>
    <p>Here a schedule showing only class times and professor office hours will be presented. No opportunity has been
        given to enter any other scheduling data. I'm not totally sure what I'll use to show the schedule, but an overlay 
        of some kind may work well enough for our purposes, but creating a printable method may be the issue. There, the 
        involvement of something like a spreadsheet program operating off of copies of a base file may work, but it is 
        a solution that I'll have to find over the course of the semester. For the time-being, I've inserted a picture of
        a graph based schedule representation.
    </p>
    <p>
        <img src="ScheduleEx.png" />
    </p>

    <form action="Download.html" method="GET" style="display:inline">
        <input type="submit" value="Download">
    </form>
    <form action="ExitScreen.html" method="GET" style="display:inline">
        <input type="submit" value="Exit">
    </form>
    <form action="AddSchedBeg.html" method="GET" style="display:inline">
        <input type="submit" value="Continue">
    </form>
<?php include '../view/footer.php'; ?>