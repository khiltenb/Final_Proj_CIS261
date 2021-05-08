<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - InfoVerificationBeg.php
-->
<?php $path ='../'?>
<?php include '../view/header.php';?>

<body>
    <h1>Please Verify the Information Presented</h1>
    <p>This page is meant to let you verify the information gathered based on the Course Registration Numbers (CRNs) 
        that you entered on the previous page. If you see an entry in the table has been entered in error, please 
        select the "Delete" button on the screen and it will be omitted. When you have verified that all of the courses
        present are correct, please select "Continue to Prototype Schedule" and a prototype schedule will be presented to you.
     </p>
    <table>
        <tr>
            <th>CRN</th>
            <th>Course ID</th>
            <th>Prof.</th>
            <th>Mon</th>
            <th>Tues</th>
            <th>Weds</th>
            <th>Thur</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
        </tr>

        <?php foreach($classInformation as $class): ?>
        <tr>
            <td><?php echo $class['CRN']; ?></td>
            <td><?php echo $class['CourseID']; ?></td>
            <td><?php echo $class['Professor']; ?></td>
            <td><?php echo $class['CMON']; ?></td>
            <td><?php echo $class['CTUE']; ?></td>
            <td><?php echo $class['CWED']; ?></td>
            <td><?php echo $class['CTHU']; ?></td>
            <td><?php echo $class['CFRI']; ?></td>
            <td><?php echo $class['CSAT']; ?></td>
            <td><?php echo $class['CSUN']; ?></td>
            <td><form action='.' method='POST'>
                <input type='hidden' name='action' value='Remove Class'>
                <input type='hidden' name='recordNum' value='<?php echo $i ?>'>
                <input type='submit' value='Delete'>
            </form></tr>
        </tr>
        <?php endforeach;?>

    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Enter Other CRNs">
    </form>
    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Continue to the Prototype Schedule">
    </form>
<?php include '../view/footer.php'; ?>