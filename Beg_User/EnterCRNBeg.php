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
    <form action="CRNHandler.php" method="POST" style="display:inline">
        <input type="text" name="crn1">
        <input type="text" name="crn2">
        <input type="text" name="crn3">
        <input type="text" name="crn4">
        <input type="text" name="crn5">
        <input type="text" name="crn6">
    </form>
    <form action="InfoVerificationBeg.html" method="GET">
        <input type="submit" value="continue">
    </form>
<?php include '../view/footer.php'; ?>