<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - InfoVerificationAdv.html
-->
<?php $path ='../'?>
<?php include '../view/header.php'; ?>

<body>
    <h1>Please Verify the Information Presented</h1>
    <p>The SQL should run here showing the added details about the class to let the
        student confirm the data shown. I've added a "delete" button, but it doesn't
        work as intended just yet (issues with scope). This is just proof that the SQL for the class time and
        office hours works, and the proof for the schedule personalization will work
        much the same as this.
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

        <?php $class = array(); ?>
        <?php //for($i = 0; $i <= $_SESSION['count']; $i++): ?>
        <?php //$class = $classinformation[$i] ?>
        <?php foreach($classinformation as $class):?>
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
                <input type='hidden' name='recordNum' value='<?php echo $class['CRN'] ?>'>
                <input type='submit' value='Delete'>
            </form></td>
        </tr>
        <?php endforeach;?>
    </table>

    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Enter Other CRNs">
    </form>
    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Continue to the Prototype Schedule">
    </form>
<?php include '../view/footer.php'; ?>