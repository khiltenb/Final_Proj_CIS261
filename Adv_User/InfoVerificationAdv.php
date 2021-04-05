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
        student confirm the data shown. I'll add a "delete" button later on so that mis-entering 
        information doesn't result in having to start over.
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
        <?php for($i = 0;$i < $count; $i++): ?>
        <?php foreach($classInformation[$i] as $class):?>
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
        </tr>
        <?php endforeach; ?>
        <?php endfor;?>
        <!--
        <tr>
            <td>20107</td>
            <td>PHP Web Server Programming</td>
            <td>CIS261.980</td>
            <td>Professor Garry Daly</td>
            <td>Tuesdays 6:00-9:30 P.M.</td>
        </tr>
        -->
    </table>
    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Enter Other CRNs">
    </form>
    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Continue to the Prototype Schedule">
    </form>
<?php include '../view/footer.php'; ?>