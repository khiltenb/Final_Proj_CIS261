<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - AddSchedAdv.php
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
            <th>Time</th>
            <th>Mon</th>
            <th>Tues</th>
            <th>Weds</th>
            <th>Thur</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
            <th><th>
        </tr>
        <!--
            okedoke, so my idea here is to have a huge array (8x288) that contains a color marker
                corresponding to a css tag dealing only with color. I'm not totally sure if this
                will work, but I'm 99% sure that it could. Then the event name would somehow be 
                implemented to show in the html and batta bing batta boom we got ourselves a 
                way of storing the event data. Only problem comes into play when we have 
                conflicting times. I'm assuming that a hierarchy of precedence will be formed with
                classes taking priority and then following up with office hours or something like
                that. Or, I could just have multiple arrays. That might make more sense. Then 
                somehow pull a rabbit out of nowhere and have the table format used to display it
                split cells for conflicting events. That or conflicting events could be shaded red
                where they overlap. So many ideas and not enough time. Still waiting on data as of
                the time of my writing this. -  4/16/2021
         -->

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
            <td><form action='.' method='POST'>
                <input type='hidden' name='action' value='Remove Event'>
                <input type='hidden' name='EvID' value='<?php echo $class['EventNum'] ?>'>
                <input type='submit' value='Delete'>
            </form></td>
        </tr>
        <?php endforeach;?>
    </table>
    <div class="addsched">
        <form action="." method="POST">
            <label>Add: </label>
            <input type="text" name="EventName" value="" class="textbox"><br>                                        
            <input type="checkbox" name="mon"> Monday <br>
            <input type="checkbox" name="tue"> Tuesday <br>
            <input type="checkbox" name="wed"> Wednesday <br>
            <input type="checkbox" name="thu"> Thursday <br>
            <input type="checkbox" name="fri"> Friday <br>
            <input type="checkbox" name="sat"> Saturday <br>
            <input type="checkbox" name="sun"> Sunday <br>
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
        <br><a>to</a><br>
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