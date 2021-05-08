<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - ProtoSchedBeg.php
-->
<!DOCTYPE html>
<!--php header inclusion -->
<html>
<?php $path ='../'?>
<?php include '../view/header.php'?>

<body>
    <h1>Proto-Schedule</h1>
    <p>Here a schedule showing only class times is presented. If you are satisfied with the current schedule, you may select "Download" 
        download a PDF version of what you're seeing on screen and select "Exit" if you so choose. Please note that if you exit the 
        program now, you will be redirected to the initial page and all of the data you entered will be lost. 
    </p>
    <p>
        If you would like to continue on to enter in your own personal scheduled events, please do so by selecting "Continue to Modified 
        Schedule" and follow further instructions.
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