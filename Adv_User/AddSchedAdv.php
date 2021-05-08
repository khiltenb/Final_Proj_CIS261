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
    <p>
    Please add in your scheduled events i.e. your work schedule, sleep schedule, or other planned commitments.
    </p>

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
                <input type='hidden' name='EvID' value='<?php echo $event['EventNum'] ?>'>
                <input type='submit' value='Delete'>
            </form></td>
        </tr>
        <?php endforeach;?>
    </table>
    <p>I'd meant to get the php and html that lays out the schedule on screen, but the SQL scripts and issues with them 
    ended up being tougher than anticipated. I am actively looking into how I can do this specific part, as it's one of the few things I have left to figure out. 
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
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>
                <option value=9>9</option>
                <option value=10>10</option>
                <option value=11>11</option>
                <option value=12>12</option>
            </select>
            <a>:<a>
            <select name="min1">
                <option value=00>00</option>
                <option value=05>05</option>
                <option value=10>10</option>
                <option value=15>15</option>
                <option value=20>20</option>
                <option value=25>25</option>
                <option value=30>30</option>
                <option value=35>35</option>
                <option value=40>40</option>
                <option value=45>45</option>
                <option value=50>50</option>
                <option value=55>55</option>
            </select>
            <select name="meridian1">
                <option value=0>A.M.</option>
                <option value=1>P.M.</option>
            </select>
        <br><a>to</a><br>
            <select name="hour2">
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>
                <option value=9>9</option>
                <option value=10>10</option>
                <option value=11>11</option>
                <option value=12>12</option>
            </select>
            <a>:<a>
            <select name="min2">
                <option value=00>00</option>
                <option value=05>05</option>
                <option value=10>10</option>
                <option value=15>15</option>
                <option value=20>20</option>
                <option value=25>25</option>
                <option value=30>30</option>
                <option value=35>35</option>
                <option value=40>40</option>
                <option value=45>45</option>
                <option value=50>50</option>
                <option value=55>55</option>
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
    <?php if (!empty($errmessage)){ ?>
        <p><?php echo $errmessage; ?>
    <?php } ?>
<?php include '../view/footer.php'; ?>