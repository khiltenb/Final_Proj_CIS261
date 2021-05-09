<!--
    Ken Hiltenbrand
    CIS261 Professor Daly
    Final Project - ProtoSchedAdv.php
-->
<!DOCTYPE html>
<!--php header inclusion -->
<html>
<?php $path ='../'?>
<?php include '../view/header.php'?>

<?php 
//Need logic for table here

//Pseudo code here
/*
get all data from classInfoTemp as an array
for each (for loop maybe) day
    count the number of events on that day
    check for conflicts
    if conflicts exist, check what overlaps what and increase the colspan number for that day and the column number for the week
    this is gonna be pretty hard.
*/






// My data for the rendering.

$data = array();
for ($i = 0; $i < 7;$i++) {
    $data[] = array();          //  Array level 1 for the days of the week
    $data[$i][] = array();      //  Array level 2 for the column of the day always having at least one
}

$data[0][0][] = array(900, 1000, "This is an event at 9am");
$data[0][0][] = array(1100, 1200, "This is an event at 11am");
// $data[0][] = array();
// $data[0][1][] = array(1130, 1300, 'Overlapping Event at 1130');

//echo $data[0][0][1][2];

$classData = getTemp();                 //  Set arrays to catch the data for the days
$days = array('CMON', 'CTUE', 'CWED', 'CTHU', 'CFRI', 'CSAT', 'CSUN');
for ($c = 0;$c < count($classData); $c++) {
    for ($d = 0; $d < 7; $d++) {
        if ($classData[$c][$days[$d]] != 'None') {
            $classTimeTemp = explode('-', $classData[$c][$days[$d]]);
            $data[$d][0][] = array((int)$classTimeTemp[0], (int)$classTimeTemp[1], $classData[$c]['CourseID']);
        }
    }
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
                        if ($timeNow == $event[0]){
                            //echo '<td>' . $event[2] . '</td>';
                            $foundEvent = true;
                            $startTimeH = intdiv($event[0], 100);
                            $startTimeM = ($event[0]%100) / 5;
                            $endTimeH = intdiv($event[1], 100);
                            $endTimeM = ($event[1]%100) / 5;
                            $durationSpan = (($endTimeH - $startTimeH) * 12) + ($endTimeM - $startTimeM);
                            echo '<td rowspan="'. $durationSpan .'">'. $event[2] .'</td>';
                            break;  // This event occurs at this row
                        } else if (($timeNow > $event[0]) && ($timeNow < $event[1])){
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
        <?php /*?>
        <!--
        <tr>
            <td class="whole_hour">8&nbsp;am</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:05</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:10</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:15</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:20</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:25</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:30</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:35</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:40</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:45<d>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:50</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:55</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="whole_hour">9&nbsp;am</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:05</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:10</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:15</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:20</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:25</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:30</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:35</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:40</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:45<d>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:50</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:55</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="whole_hour">10&nbsp;am</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:05</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:10</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:15</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:20</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:25</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:30</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:35</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:40</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:45<d>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:50</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:55</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="whole_hour">11&nbsp;am</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:05</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:10</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:15</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:20</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:25</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:30</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:35</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:40</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="major_hour">:45<d>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:50</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td class="minor_hour">:55</td>
            <?php for($i = 0; $i < $columns; $i++): ?>
            <td></td>
            <?php endfor; ?>
        </tr>
      </tbody>
    </table>
    
    <?php */ ?>

    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Download">
    </form>
    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Exit">
    </form>
    <form action="." method="POST" style="display:inline">
        <input type="submit" name='action' value="Continue to Modified Schedule">
    </form>
<?php include '../view/footer.php';?>