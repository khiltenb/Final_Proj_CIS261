<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - EnterCRNAdv.html
-->
<?php $path = '../';
include '../view/header.php'; ?>

<body>
    <h1>Enter CRN</h1>
    <p>Please enter the CRNs entered at the time of registration.</p>
    <form action="index.php" method="POST" style="display:inline">
        <input type="text" size=4 name="crn1">
        <input type="text" size=4 name="crn2">
        <input type="text" size=4 name="crn3">
        <input type="text" size=4 name="crn4">
        <input type="text" size=4 name="crn5">
        <input type="text" size=4 name="crn6">
        <input type="submit" name='action' value="Continue to Info Verification">
    </form>
<?php include '../view/footer.php'; ?>