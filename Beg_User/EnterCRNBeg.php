<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - EnterCRNBeg.html
-->
<?php $path ='../'?>
<?php include '../view/header.php';?>

<body>
    <h1>Enter CRN</h1>
    <p>Please enter the CRN numbers (or course IDs, I haven't figured that part out yet) that were entered at the time
        of registration.</p>
    <p>If you are unsure what the CRN numbers were, please utilize Waubonsee's find-a-course search tool to find your
        course section.</p>
    <p>Placeholder for Entry of CRN numbers or Course IDs</p>
    <p>Lorem Ipsum</p>
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