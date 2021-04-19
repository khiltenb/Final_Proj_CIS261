<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - ExitScreen.html
-->
<?php $path ='';?>
<?php include 'view/header.php'; ?>
    <h1>Exit Screen</h1>
    <p>
        The End! Well done! You have successfully traversed this tool and utilized it to put together an academic schedule
        and/or full schedule. Please feel free to use it again to build on top of your schedule in the future!
    </p>
    <form action="../index.php" method="POST">
        <input type="submit" value="Return to Home Page">
    </form>
<?php include('view/footer.php'); ?>
