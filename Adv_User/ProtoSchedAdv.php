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
    for ($col = 0; $col < count($day); $col++){// for each column of the day
        $overlap = false;
        for ($eventIndex = 0; $eventIndex < count($day[$col]); $eventIndex++){// scan the list of events for the column for an overlapping class time
            $colEvent = $day[$col][$eventIndex];
            if (isOverlap($class, $colEvent)) {
                $overlap = true;
                break; // This column won't do, go to the next one.
            } else if ($colEvent['sTime'] > $class['sTime']) {// if there is no overlap, and this event goes before index, insert.
                $day[$col] = array_splice($day[$col], $eventIndex, 0, $class);
                return;
            }
        }
        if (!$overlap) {
            // There was no overlap in this column.  We just hit the end, so insert at the end.
            $day[$col][] = $class;
                    return;
        }
    }
    //if there were overlaps in all of the columns, insert a new column
    $day[] = array($class);
}



// My data for the rendering.

$data = array();
for ($i = 0; $i < 7;$i++) {
    $data[] = array();          //  Array level 1 for the days of the week
    $data[$i][] = array();      //  Array level 2 for the column of the day always having at least one
}

$classData = getTemp();                 //  Set arrays to catch the data for the days
$days = array('CMON', 'CTUE', 'CWED', 'CTHU', 'CFRI', 'CSAT', 'CSUN');  //  Associative array to help with parsing through the data
for ($c = 0;$c < count($classData); $c++) {                             //  for each entry that was retrieved from the classInfoTemp Table, iterate the following
    for ($d = 0; $d < count($days); $d++) {                             //   for each day of the week, do the following
        if ($classData[$c][$days[$d]] != 'None') {                      //  if there is no class meeting time on this day, do the following
            $classTimeTemp = explode('-', $classData[$c][$days[$d]]);   //  separate the start and end time, and set the classTimeTemp variable to the given array
            $thisClass = array('sTime'=>(int)$classTimeTemp[0], 'eTime'=>(int)$classTimeTemp[1], 'desc'=>$classData[$c]['CourseID']);
            insertClassIntoDay($thisClass, $data[$d]);
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
                        $event['sTime'] = $event['sTime'] - ($event['sTime']%5);        // Rounding to nearest five minutes
                        $event['eTime'] = $event['eTime'] - ($event['eTime']%5);        // Rounding to nearest five minutes
                        if ($timeNow == $event['sTime']){
                            $foundEvent = true;
                            $startTimeH = intdiv($event['sTime'], 100);
                            $startTimeM = ($event['sTime']%100) / 5;
                            $endTimeH = intdiv($event['eTime'], 100);
                            $endTimeM = ($event['eTime']%100) / 5;
                            $durationSpan = (($endTimeH - $startTimeH) * 12) + ($endTimeM - $startTimeM);
                            echo '<td rowspan="'. $durationSpan .'">'. $event['desc'] .'</td>';
                            break;  // This event occurs at this row
                        } else if (($timeNow > $event['sTime']) && ($timeNow < $event['eTime'])){
                            $foundEvent = true;
                            break; // this event falls after this row
                        } else {
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