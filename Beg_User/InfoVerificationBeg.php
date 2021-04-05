<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - InfoVerificationBeg.html
-->
<?php $path ='../'?>
<?php include '../view/header.php';?>

<body>
    <h1>Please Verify the Information Presented</h1>
    <p>The information here will be displayed in a table showing the CRN entered, the Course ID, the name of the class,
        the name of the professor, and the class meeting time followed by a delete button shoud the information
        displayed be incorrect.
    </p>
    <table>
        <tr>
            <th>CRN</th>
            <th>Course Title</th>
            <th>Course ID</th>
            <th>Professor</th>
            <th>Meeting Time</th>
        </tr>
        <tr>
            <td>20107</td>
            <td>PHP Web Server Programming</td>
            <td>CIS261.980</td>
            <td>Professor Garry Daly</td>
            <td>Tuesdays 6:00-9:30 P.M.</td>
        </tr>
    </table>
    <form action="EnterCRNBeg.phhp" method="GET" style="display:inline">
        <input type="submit" value="Enter Other CRNs">
    </form>
    <form action="ProtoSchedBeg.php" method="GET" style="display:inline">
        <input type="submit" value="Continue">
    </form>
<?php include '../view/footer.php'; ?>