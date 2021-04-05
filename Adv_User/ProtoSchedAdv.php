<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - ProtoSchedAdv.html
-->
<!DOCTYPE html>
<!--php header inclusion -->
<html>
<?php $path ='../'?>
<?php include '../view/header.php'?>

<body>
    <h1>Proto-Schedule</h1>
    <!--
    <p>Here a schedule showing only class times and professor office hours will be presented. No opportunity has been
        given to enter any other scheduling data. I'm not totally sure what I'll use to show the schedule, but an overlay 
        of some kind may work well enough for our purposes, but creating a printable method may be the issue. There, the 
        involvement of something like a spreadsheet program operating off of copies of a base file may work, but it is 
        a solution that I'll have to find over the course of the semester. For the time-being, I've inserted a picture of
        a graph based schedule representation.
    </p>
    -->
    <p>
        I still have yet to make the HTML/PHP that will make the schedule block, but I'll have a solution figured out soon enough.
    </p>
    <p>
        <img src="../ScheduleEx.png" />
    </p>

    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Download">
    </form>
    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Exit">
    </form>
    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Continue to Modified Schedule">
    </form>
<?php include '../view/footer.php'; ?>