<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - index.html
-->

<?php global $ClassInformation;     // I know that globals are not good practice, but I think it's
                                    //      appropriate for this case.
    
    if ($slassInformation == NULL || $classInformation == '') {
        $classInformation = array();
    }

      global $count;

    if ($count = NULL || $count == '') {
        $count = 0; 
    }
?>

<?php $path ='';?>
<?php include 'view/header.php'; ?>
    <h1>StudyTime Management Tool</h1>
    <p>
        Welcome to the StudyTime management tool!
    </p>
    <p>
        This tool was developed to help students effectively manage their time throughout the semester.
    </p>
    <p>
        If you're new, please select the "tutorial" link, and you'll be given a guided experience, otherwise select the
        "I know what I'm doing link."
    </p>
    <p>
        Please don't hesitate to give feedback at the end. It is greatly appreciated.
    </p>
    <h1>Menu</h1>
    <form action="Adv_User" method="GET" style="display:inline">
        <input type="submit" name="action" value="Advanced Mode">
    </form>
    <form action="Beg_User" method="GET" style="display:inline">
        <input type="submit" name="acton" value="Beginner Mode">
    </form>
<?php include 'view/footer.php'; ?>