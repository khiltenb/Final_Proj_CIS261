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

function isOverlap($class1, &$class2) {
    //echo 'isOverlap class1 is ';
    //print_r($class1);
    //echo ' class2 is ';
    //print_r($class2);
    //echo '<br>';
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
    //echo 'Inserting class ' ;
    //print_r($class);
    //echo ' into day ';
    //print_r($day);
    //echo '<br><br>';
    for ($col = 0; $col < count($day); $col++){// for each column of the day
        $overlap = false;
        for ($eventIndex = 0; $eventIndex < count($day[$col]); $eventIndex++){// scan the list of events for the column for an overlapping class time
            $colEvent = $day[$col][$eventIndex];
            //echo 'Comparing class ';
            //print_r($class);
            //echo ' to colEvent ';
            //print_r($colEvent);
            //echo '<br><br>';
            if (isOverlap($class, $colEvent)) {
                $overlap = true;
                break; // This column won't do, go to the next one.
            } else if ($colEvent['sTime'] > $class['sTime']) {// if there is no overlap, and this event goes before index, insert.
                $day[$col] = array_splice($day[$col], $eventIndex, 0, $class);
                //echo ' day (col insert) is now ';
                //print_r($day);
                //echo '<br><br>';
                return;
            }
        }
        if (!$overlap) {
            // There was no overlap in this column.  We just hit the end, so insert at the end.
            $day[$col][] = $class;
            //echo ' Day (col end insert) is now ';
            //print_r($day);
            //echo '<br>';
                    return;
        }
    }
    //if there were overlaps in all of the columns, insert a new column
    $day[] = array($class);
    //echo ' Day (new column) is now ';
    //print_r($day);
    //echo '<br>';
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
$days = array('CMON', 'CTUE', 'CWED', 'CTHU', 'CFRI', 'CSAT', 'CSUN');  //  Associative array to help with parsing through the data
for ($c = 0;$c < count($classData); $c++) {                             //  for each entry that was retrieved from the classInfoTemp Table, iterate the following
    for ($d = 0; $d < count($days); $d++) {                             //   for each day of the week, do the following
        if ($classData[$c][$days[$d]] != 'None') {                      //  if there is no class meeting time on this day, do the following
            $classTimeTemp = explode('-', $classData[$c][$days[$d]]);   //  separate the start and end time, and set the classTimeTemp variable to the given array
            // $data[$d][0][] = array((int)$classTimeTemp[0], (int)$classTimeTemp[1], $classData[$c]['CourseID']); //  set data[$d][0][] equal to a new array comprised of the start time, end time and the course ID
            $thisClass = array('sTime'=>(int)$classTimeTemp[0], 'eTime'=>(int)$classTimeTemp[1], 'desc'=>$classData[$c]['CourseID']);
            insertClassIntoDay($thisClass, $data[$d]);
        }
    }
}
//echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
//echo 'Classes on Monday<br>';
// for ($cow = 0; $cow < count($data[0]); $cow++) {
//     print_r($data[0][$cow]);
//     echo "<br>";
// }
//print_r($data[0]);


//  Sort array by start time.
// for ($f = 0; $f < count($data);$f++) {  //  Bubble sort for each day of the week.
//     // bubble sort pseudocode
//     for ($s = 0; $s < count($data[$f]) - 1;$s++){
//         for($a = 0; $a < count($data[$f]) - $s - 1; $s++) {
//             if($data[$f][0][$a][0] > $data[$f][0][$a + 1][0]) {
//                 $temp = array();
//                 $temp = $data[$f][0][$a][0];
//                 $data[$f][0][$a][0] = $data[$f][0][$a + 1][0];
//                 $data[$f][0][$a+1][0] = $temp;
//             }
//         }
//     }
// }

// $daystemp = array('M', 'T', 'W', 'Th', 'F', 'Sa', 'Su');
// for ($day = 0; $day < count($data); $day++) {                                                    //  Sort the array
//     for ($col = 0; $col < count($data[$day]); $col++) {
//         for ($r = 0; $r < count($data[$day][$col]); $r++){
//             echo implode(', ', $data[$day][$col][$r]) . ' on day ' . $daystemp[$day] . '<br>';
//         }
//     }
// }

//  Detection of overlapping entries and resolution
// for ($day = 0; $day < count($data); $day++) {                                                    //  Sort the array
//     for ($col = 0; $col < count($data[$day]); $col++) {
//         $overlap = false;
//         for ($eventIndex = 0; $eventIndex < count($data[$day][$col]); $eventIndex++) {
//             if ($class1[0] < $class2[0]) {      //
//                 if ($class2[0] < $class1[1]) {
//                     return true;
//                 }
//             } else if ($class1[0] == $class2[0]) {
//                 return true;
//             } else {
//                 // class one starts before class two
//                 if ($class2[1] > $class1[0]) {
//                     return true;
//                 }
//             }
//         }
//         if ($overlap) {
//             //$data[$day] = ;
//         }
//     }
// }





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