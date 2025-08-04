<?php
if (!empty($attendances)) {

?>

    <?php
    //echo '<h1>'.'Attendance Report'.'</h1>';
    foreach ($attendances as $year => $attendanceYears) { # Get year wise data
        echo '<br>';
        echo '<h3  style="text-align: center"><i>Attendance Report For Year: ' . $year . '</i></h3>';

        foreach ($attendanceYears as $months => $attendanceMonths) { # Get month wise data
            if ($months == 1)
                $month = 'January';
            if ($months == 2)
                $month = 'February';
            if ($months == 3)
                $month = 'March';
            if ($months == 4)
                $month = 'April';
            if ($months == 5)
                $month = 'May';
            if ($months == 6)
                $month = 'June';
            if ($months == 7)
                $month = 'July';
            if ($months == 8)
                $month = 'August';
            if ($months == 9)
                $month = 'September';
            if ($months == 10)
                $month = 'Octeber';
            if ($months == 11)
                $month = 'November';
            if ($months == 12)
                $month = 'December';
            //            echo $key . '(month) : ';
            echo '<h4 ><i>Attendance Report For Month: ' . $month . '</i></h4>';
            //echo '<br>';
            if ($months == 1) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30', 31 => 'Day31');
            } else if ($months == 2) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28');
            } else if ($months == 3) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30', 31 => 'Day31');
            } else if ($months == 4) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30');
            } else if ($months == 5) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30', 31 => 'Day31');
            } else if ($months == 6) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30');
            } else if ($months == 7) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30', 31 => 'Day31');
            } else if ($months == 8) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30', 31 => 'Day31');
            } else if ($months == 9) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30');
            } else if ($months == 10) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30', 31 => 'Day31');
            } else if ($months == 11) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30');
            } else if ($months == 12) {
                $days = array(1 => 'Day1', 2 => 'Day2', 3 => 'Day3', 4 => 'Day4', 5 => 'Day5', 6 => 'Day6', 7 => 'Day7', 8 => 'Day8', 9 => 'Day 9', 10 => 'Day10', 11 => 'Day11', 12 => 'Day12', 13 => 'Day13', 14 => 'Day14', 15 => 'Day15', 16 => 'Day16', 17 => 'Day17', 18 => 'Day18', 19 => 'Day 19', 20 => 'Day20', 21 => 'Day21', 22 => 'Day22', 23 => 'Day23', 24 => 'Day24', 25 => 'Day25', 26 => 'Day26', 27 => 'Day27', 28 => 'Day28', 29 => 'Day29', 30 => 'Day30', 31 => 'Day31');
            }
    ?>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th id="thAlign"> Id </th>
                        <th id="thAlign"> Name </th>
                        <th id="thAlign"> Designation </th>
                        <?php foreach ($days as $d => $day) { ?>
                            <th id="thAlign">
                                <?php echo $d; ?>
                            </th>
                        <?php } ?>
                    </tr>
                </thead>
                <?php
                uksort($attendanceMonths, function ($x, $y) {
                    if ($x == $y) {
                        return 0;
                    } else if ($x == '') {
                        return 1;
                    } else if ($y == '') {
                        return -1;
                    }

                    return $x < $y ? -1 : 1;
                });
                foreach ($attendanceMonths as $id => $attendanceDatePersons) {

                    if (!empty($id)) {
                ?>
                        <tr>
                            <td id="vertical"> <?php echo $id; # print person id
                                                ?>
                            </td>
                            <td style="text-align: center;"> <?php echo $attendanceDatePersons['name']; # print person id 
                                                                ?> </td>
                            <td id="vertical"> <?php echo $attendanceDatePersons['designation']; # print person id 
                                                ?> </td>

                            <?php
                            foreach ($days as $d => $day) {
                            ?>
                                <td>
                                    <?php
                                    foreach ($attendanceDatePersons as $day => $attendanceDatesSingleDay) { # Get date wise data (a date may have multiple data)
                                        if ($d == $day) {
                                    ?>
                                            <?php
                                            foreach ($attendanceDatesSingleDay as $k => $attendanceDateSingleAttendance) {
                                            ?>
                                                <div id="<?php echo $attendanceDateSingleAttendance['css']; ?>">
                                                    <label><?php echo $attendanceDateSingleAttendance['status']; ?></label>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                    <?php
                                        }
                                    }
                                    ?>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>

                <?php
                    }
                }
                ?>
            </table>
<?php
        }
    }
}
?>

<style>
    table tr th {
        padding: 3px;
        background: #e5e5e5;
        color: #333;
        border-bottom: 0px;
        text-align: left;
        font-weight: bold;
    }

    table {
        width: 100%;
        border: 1px solid #fff;
        background-color: #fff;
        clear: both;
        border: 1px solid #ddd;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
    }

    .striped {
        background-color: #f8f8f8;
    }

    table tr td {
        padding: 10px;
        border-bottom: 1px solid #dfdfdf;
        vertical-align: middle;
    }

    table {
        display: table;
        border-collapse: separate;
        box-sizing: border-box;
        text-indent: initial;
        unicode-bidi: isolate;
        border-spacing: 2px;
        border-color: gray;
    }

    h4 i {
        font-size: 16px;
        font-weight: bold;
        font-style: italic;
    }
</style>