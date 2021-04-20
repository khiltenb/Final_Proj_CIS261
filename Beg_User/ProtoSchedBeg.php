<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - ProtoSchedBeg.html
-->
<?php $path ='../'?>
<?php include '../view/header.php';?>

<body>
    <h1>Proto-Schedule</h1>
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