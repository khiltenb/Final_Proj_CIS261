<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - index.html
-->

<?php global $count;     // I know that globals are not good practice, but I think it's
                                    //      appropriate for this case.
    $lifetime = 60 * 60 * 24 * 30 * 6; // about 6 months in seconds
    session_start();
    if (!isset($_SESSION['count'])) {
        $_SESSION['count'] = 0;
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
        If you're new, please select the "Beginner Mode" link, and you'll be given a guided experience, otherwise select the
        "Advanced Mode" link.
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