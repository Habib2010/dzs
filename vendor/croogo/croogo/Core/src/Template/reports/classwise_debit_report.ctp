<?php
$totals = array_fill_keys($purposes, 0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Wise Fees Credit Report</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 0;
        background-color: #f8f9fa;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #17a2b8;
        color: white;
        font-weight: bold;
    }

    .total-row {
        font-weight: bold;
        background-color: #ffc107;
    }

    .total-row td {
        color: #000;
    }

    .text-right {
        text-align: right;
    }
    </style>
</head>

<body>

    <h2>Class Wise Fees Credit Report</h2>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <?php foreach ($purposes as $purpose) : ?>
                <th><?php echo htmlspecialchars($purpose); ?></th>
                <?php endforeach; ?>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($finalData as $date => $records) : ?>
            <tr>
                <td><?php echo htmlspecialchars($date); ?></td>
                <?php
                    $row_totals = array_fill_keys($purposes, 0);
                    $row_sum = 0;

                    foreach ($records as $record) {
                        if (isset($row_totals[$record["purpose"]])) {
                            $row_totals[$record["purpose"]] += abs($record["amount"]); // Convert to positive
                        }
                    }

                    foreach ($purposes as $purpose) {
                        $amount = abs($row_totals[$purpose]); // Convert to positive
                        echo "<td>" . ($amount ? number_format($amount, 2) : "-") . "</td>";
                        $totals[$purpose] += $amount;
                        $row_sum += $amount;
                    }
                    ?>
                <td><strong><?php echo number_format($row_sum, 2); ?></strong></td>
            </tr>
            <?php endforeach; ?>

            <!-- Grand Total Row -->
            <tr class="total-row">
                <td><strong>Total</strong></td>
                <?php
                $grand_total = 0;
                foreach ($purposes as $purpose) {
                    $totals[$purpose] = abs($totals[$purpose]); // Convert to positive
                    echo "<td><strong>" . ($totals[$purpose] ? number_format($totals[$purpose], 2) : "-") . "</strong></td>";
                    $grand_total += $totals[$purpose];
                }
                ?>
                <td><strong><?php echo number_format($grand_total, 2); ?></strong></td>
            </tr>
        </tbody>
    </table>

</body>

</html>