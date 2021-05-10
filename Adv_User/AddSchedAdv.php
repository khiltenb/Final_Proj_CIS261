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
<?php
    function isOverlap($class1, &$class2) {
    echo 'isOverlap class1 is ';
    print_r($class1);
    echo ' class2 is ';
    print_r($class2);
    echo '<br>';
    if ($class1['sTime'] < $class2['sTime']) {      //
        if ($class2['sTime'] < $class1['eTime']) {
            return true;
        }
    } else if ($class1['sTime'] == $class2['sTime']) {
        return true;
    } else {
        // class one starts before class two
        if ($class2['eTime'] > $class1['sTime']) {
            return true;
        }
    }

}

function insertClassIntoDay($class, &$day) {
    echo 'Inserting class ' ;
    print_r($class);
    echo ' into day ';
    print_r($day);
    echo '<br><br>';
    for ($col = 0; $col < count($day); $col++){// for each column of the day
        $overlap = false;
        for ($eventIndex = 0; $eventIndex < count($day[$col]); $eventIndex++){// scan the list of events for the column for an overlapping class time
            $colEvent = $day[$col][$eventIndex];
            echo 'Comparing class ';
            print_r($class);
            echo ' to colEvent ';
            print_r($colEvent);
            echo '<br><br>';
            if (isOverlap($class, $colEvent)) {
                $overlap = true;
                break; // This column won't do, go to the next one.
            } else if ($colEvent['sTime'] > $class['sTime']) {// if there is no overlap, and this event goes before index, insert.
                $day[$col] = array_splice($day[$col], $eventIndex, 0, $class);
                echo ' day (col insert) is now ';
                print_r($day);
                echo '<br><br>';
                return;
            }
        }
        if (!$overlap) {
            // There was no overlap in this column.  We just hit the end, so insert at the end.
            $day[$col][] = $class;
            echo ' Day (col end insert) is now ';
            print_r($day);
            echo '<br>';
                    return;
        }
    }
    //if there were overlaps in all of the columns, insert a new column
    $day[] = array($class);
    echo ' Day (new column) is now ';
    print_r($day);
    echo '<br>';
}



// My data for the rendering.

$data = array();
for ($i = 0; $i < 7;$i++) {
    $data[] = array();          //  Array level 1 for the days of the week
    $data[$i][] = array();      //  Array level 2 for the column of the day always having at least one
}

// $data[0][0][] = array(900, 1000, "This is an event at 9am");
// $data[0][0][] = array(1100, 1200, "This is an event at 11am");
// $data[0][] = array();
// $data[0][1][] = array(1130, 1300, 'Overlapping Event at 1130');

//echo $data[0][0][1][2];

$classData = getTemp();                 //  Set arrays to catch the data for the days
$cDays = array('CMON', 'CTUE', 'CWED', 'CTHU', 'CFRI', 'CSAT', 'CSUN');  //  Associative array to help with parsing through the data
for ($c = 0;$c < count($classData); $c++) {                             //  for each entry that was retrieved from the classInfoTemp Table, iterate the following
    for ($d = 0; $d < count($cDays); $d++) {                             //   for each day of the week, do the following
        if ($classData[$c][$cDays[$d]] != 'None') {                      //  if there is no class meeting time on this day, do the following
            $classTimeTemp = explode('-', $classData[$c][$cDays[$d]]);   //  separate the start and end time, and set the classTimeTemp variable to the given array
            // $data[$d][0][] = array((int)$classTimeTemp[0], (int)$classTimeTemp[1], $classData[$c]['CourseID']); //  set data[$d][0][] equal to a new array comprised of the start time, end time and the course ID
            $thisClass = array('sTime'=>(int)$classTimeTemp[0], 'eTime'=>(int)$classTimeTemp[1], 'desc'=>$classData[$c]['CourseID']);
            insertClassIntoDay($thisClass, $data[$d]);
        }
    }
}

$events = array();
echo '<br><br><br>' . count($events) . '<br><br><br>';
$events = getEvents();
$eDays = array('EMON', 'ETUE', 'EWED', 'ETHU', 'EFRI', 'ESAT', 'ESUN');     //  Associative array to help with parsing through the data
for ($c = 0;$c < count($events); $c++) {                                    //  for each entry that was retrieved from the classInfoTemp Table, iterate the following
    for ($d = 0; $d < count($eDays); $d++) {                                //   for each day of the week, do the following
        if ($events[$c][$eDays[$d]] != 'None') {                            //  if there is no class meeting time on this day, do the following
            $eventTimeTemp = explode('-', $events[$c][$eDays[$d]]);         //  separate the start and end time, and set the classTimeTemp variable to the given array
            $thisEvent = array('sTime'=>(int)$eventTimeTemp[0], 'eTime'=>(int)$eventTimeTemp[1], 'desc'=>$eventData[$c]['EventName']);
            insertClassIntoDay($thisEvent, $data[$d]);
            echo '<br><br>';
            print_r($events);
        }
    }
}
echo $events['EventName'];

echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
echo 'Classes on Monday<br>';
for ($cow = 0; $cow < count($data[0]); $cow++) {
    print_r($data[0][$cow]);
    echo "<br>";
}

?>

<body>
    <h1>Proto-Schedule</h1>
    <table cellspacing=0>
      <tbody>
        <tr>
            <th class="unique"></th>
            <th colspan="<?php echo count($data[0]); ?>">Monday</th>
            <th colspan="<?php echo count($data[1]); ?>">Tuesday</th>
            <th colspan="<?php echo count($data[2]); ?>">Wednesday</th>
            <th colspan="<?php echo count($data[3]); ?>">Thursday</th>
            <th colspan="<?php echo count($data[4]); ?>">Friday</th>
            <th colspan="<?php echo count($data[5]); ?>">Saturday</th>
            <th colspan="<?php echo count($data[6]); ?>">Sunday</th>
        </tr>
        <?php for($o = 0; $o < 288; $o++): ?>
            <tr>
            <?php if(($o)%12 == 0):?>
                <td class="whole_hour"><?php echo ($o)/12 ?>&nbsp;am</td>
            <?php else: ?>
                <td class=<?php if($o%3 == 0){ echo 'major_hour';} else {echo 'minor_hour';} ?>>:<?php echo ((($o)%12) * 5)?> </td>
            <?php endif;?>
            <?php 
            for($dow = 0; $dow < count($data); $dow++){
                for($cow = 0; $cow < count($data[$dow]); $cow++){
                    $foundEvent = false;
                
                    $timeNow = (intdiv($o, 12) * 100) + (($o%12)*5);
                    for($e = 0; $e < count($data[$dow][$cow]); $e++) {
                        // scan the event for this day to find an entry for this time slot
                        $event = $data[$dow][$cow][$e];
                        $event['sTime'] = $event['sTime'] - ($event['sTime']%5);        // Rounding to nearest five minutes
                        $event['eTime'] = $event['eTime'] - ($event['eTime']%5);        // Rounding to nearest five minutes
                        if ($timeNow == $event['sTime']){
                            //echo '<td>' . $event[2] . '</td>';
                            $foundEvent = true;
                            $startTimeH = intdiv($event['sTime'], 100);
                            $startTimeM = ($event['sTime']%100) / 5;
                            $endTimeH = intdiv($event['eTime'], 100);
                            $endTimeM = ($event['eTime']%100) / 5;
                            $durationSpan = (($endTimeH - $startTimeH) * 12) + ($endTimeM - $startTimeM);
                            echo '<td rowspan="'. $durationSpan .'">'. $event['desc'] .'</td>';
                            break;  // This event occurs at this row
                        } else if (($timeNow > $event['sTime']) && ($timeNow < $event['eTime'])){
                            //echo '<td>' . $dow . '-' . $cow . '</td>';
                            $foundEvent = true;
                            break; // this event falls after this row
                        } else {
                            //echo '<td></td>';
                        }
                        // if the event starts now, output the event
                        // else if the event spans over now but doesn't start now don't output a td
                    }
                    if (!$foundEvent) {
                        echo '<td></td>';
                    }
                }
            } ?>
            </tr>
        <?php endfor; ?>
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
            <option value=24>00</option>
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
                <option value=13>13</option>
                <option value=14>14</option>
                <option value=15>15</option>
                <option value=16>16</option>
                <option value=17>17</option>
                <option value=18>18</option>
                <option value=19>19</option>
                <option value=20>20</option>
                <option value=21>21</option>
                <option value=22>22</option>
                <option value=23>23</option>
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
        <br><a>to</a><br>
            <select name="hour2">
                <option value=24>00</option>
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
                <option value=13>13</option>
                <option value=14>14</option>
                <option value=15>15</option>
                <option value=16>16</option>
                <option value=17>17</option>
                <option value=18>18</option>
                <option value=19>19</option>
                <option value=20>20</option>
                <option value=21>21</option>
                <option value=22>22</option>
                <option value=23>23</option>
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