<?php

use Cake\Core\Configure;

$instituteName = Configure::read('Result.instituteName');
$instituteLogo = Configure::read('Result.instituteLogo');
$borderImage = Configure::read('Result.borderImage');
$headerFontFamily = Configure::read('Result.headerFontFamily');
$headerFontCDN = Configure::read('Result.headerFontCDN');
$watermarkLogo = Configure::read('Result.watermarkLogo');
$headSign = Configure::read('Result.headSign');



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <style>
        .ExRegNo,
        .ExRollNo {
            /* display: inline-block; */
            margin-right: 10px;
            /* Adjust this value to control the spacing between CLASS and SECTION */
        }
    </style>
</head>

<body>
    <div class="resHdr">

        <div class="schoolIdentity hdrInstitute">
            <p class="text-center mb-0" style="font-family: <?= $headerFontFamily ?>">
                <?= $instituteName ?>
            </p>

            <h4 class="text-center mb-0" style="margin-top: 44px;">
                <?php echo $vouchers[0]['purpose']; ?>
            </h4>
            <big>
                <span class="ExRegNo"> <?php echo $head1; ?></span>
                <span class="ExRollNo"><?php echo $head2; ?></span>
            </big>
        </div><!-- end of schoolIdentity -->
    </div><!-- end of resHdr -->
    <table class="table table-bordered table-striped">

        <thead class="thead-dark">
            <tr>
                <th>SL</th>
                <th>Roll</th>
                <th>Name Of Student</th>
                <th>SID</th>
                <?php foreach ($months as $month): ?>
                    <th><?= $month['month_name'] ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl = 1;
            $monthTotals = array_fill(0, count($months), 0); // Initialize month totals

            // Now, display the organized data
            foreach ($transformed_vouchers as $student): ?>
                <tr>
                    <td><?= $sl++ ?></td>
                    <td><?= $student['roll'] ?></td>
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['sid'] ?></td>
                    <?php foreach ($months as $month): ?>
                        <td>
                            <?php
                            $monthName = $month['month_name'];
                            $amount = isset($student['amounts'][$monthName]) ? $student['amounts'][$monthName] : '';
                            echo $amount;
                            if ($amount !== '') {
                                $monthTotals[array_search($monthName, array_column($months, 'month_name'))] += $amount;
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <?php foreach ($monthTotals as $total): ?>
                    <th><?= $total > 0 ? number_format($total) : '' ?></th>
                <?php endforeach; ?>
            </tr>
        </tfoot>
    </table>
</body>

</html>