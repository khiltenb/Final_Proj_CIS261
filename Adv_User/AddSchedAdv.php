<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - AddSchedAdv.html
-->
<!DOCTYPE html>
<!--php header inclusion -->
<html>

<?php $path ='../'?>
<?php include '../view/header.php';?>

<body>
    <h1>Schedule Customization Page</h1>
    <!--
    <p>
        Here is what is supposed to be the schedule and a tool that lets you add events to the schedule. It will entail
        a text box for the name of the event added, a series of check boxes to signify what days this event will occur,
        and drop-down sections to select the times. There will be an add button, which when pressed will refresh the
        page
        showing the new page with the event added into the schedule on the selected days within the selected time frame.
    </p>
    -->
    <p>
        Feel free to add your own scheduled events
    </p>
<!--
    <p>
        <img src="../ScheduleEx.png" />
    </p>
-->
<table>
        <tr>
            <th>Event Name</th>
            <th>Mon</th>
            <th>Tues</th>
            <th>Weds</th>
            <th>Thur</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
        </tr>

        <?php foreach($events as $event): ?>
        <tr>
            <td><?php echo $event['EventName']; ?></td>
            <td><?php echo $event['EMON']; ?></td>
            <td><?php echo $event['ETUE']; ?></td>
            <td><?php echo $event['EWED']; ?></td>
            <td><?php echo $event['ETHU']; ?></td>
            <td><?php echo $event['EFRI']; ?></td>
            <td><?php echo $event['ESAT']; ?></td>
            <td><?php echo $event['ESUN']; ?></td>
            <td><input action="index.php" type="submit" name="action" id=<?php echo $i;?> value="remove"></td>
        </tr>
        <?php endforeach;?>
    </table>
    <div class="addsched">
        <form action="." method="POST">
            <label>Add: </label>
            <input type="text" size=15 name="EventName">
            <input type="checkbox" name="mon" value="None"> Monday <br>
            <input type="checkbox" name="tue" value="None"> Tuesday <br>
            <input type="checkbox" name="wed" value="None"> Wednesday <br>
            <input type="checkbox" name="thu" value="None"> Thursday <br>
            <input type="checkbox" name="fri" value="None"> Friday <br>
            <input type="checkbox" name="sat" value="None"> Saturday <br>
            <input type="checkbox" name="sun" value="None"> Sunday <br>
        </form>
        <form action="." method="POST" style="display:inline">
            <select name="hour1">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <a>:<a>
            <select name="min1">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
            </select>
            <select name="meridian1">
                <option value=0>A.M.</option>
                <option value=1>P.M.</option>
            </select>
        </form>
        <br><p>to</p>
        <form action="." method="POST" style="display:inline">
            <select name="hour2">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <a>:<a>
            <select name="min2">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
            </select>
            <select name="meridian2">
                <option value=0>A.M.</option>
                <option value=1>P.M.</option>
            </select>
            <input type="submit" name='action' value="Add Event">
        </form>
    </div>

    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Download">
    </form>

    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Exit">
    </form>
<?php include '../view/footer.php'; ?>