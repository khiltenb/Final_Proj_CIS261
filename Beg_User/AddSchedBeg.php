<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - AddSchedBeg.html
-->
<?php $path ='../'?>
<?php include '../view/header.php';?>

<body>
    <h1>Schedule Customization Page</h1>
    <p>
        Here is what is supposed to be the schedule and a tool that lets you add events to the schedule. It will entail 
        a text box for the name of the event added, a series of check boxes to signify what days this event will occur, 
        and drop-down sections to select the times. There will be an add button, which when pressed will refresh the page
        showing the new page with the event added into the schedule on the selected days within the selected time frame. 
    </p>
    <p>
        <img src="../ScheduleEx.png" />
    </p>
    <form action="Download.php" method="GET" style="display:inline">
        <input type="submit" value="Download">
    </form>
    <form action="ExitScreen.html" method="GET" style="display:inline">
        <input type="submit" value="Exit">
    </form>
<?php include '../view/footer.php'; ?>