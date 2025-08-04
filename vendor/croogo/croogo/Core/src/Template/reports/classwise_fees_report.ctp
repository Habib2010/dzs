<div class="rows">
    <h3 class="text-center"><?= __d('accounts', 'Class Wise Fees Credit Report') ?></h3>

</div>

<?php
// Extract all unique purposes
$purposes = [];
foreach ($finalData as $level => $purposeData) {
    foreach ($purposeData as $purpose => $amount) {
        if (!in_array($purpose, $purposes)) {
            $purposes[] = $purpose;
        }
    }
}
sort($purposes); // Sorting purposes for consistent order

// Initialize column totals
$columnTotals = array_fill_keys($purposes, 0);
$grandTotal = 0;
?>

<div class="leftblock ovScroll" style="width:100%;">
    <table class="table table-bordered table-striped table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th width="10%">Level</th>
                <?php foreach ($purposes as $purpose): ?>
                <th class="text-center"><?php echo htmlspecialchars($purpose); ?></th>
                <?php endforeach; ?>
                <th class="text-center" width="12%">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($finalData as $level => $purposeData): ?>
            <tr>
                <td><strong><?php echo htmlspecialchars($level); ?></strong></td>
                <?php
                    $rowTotal = 0;
                    foreach ($purposes as $purpose) {
                        $amount = $purposeData[$purpose] ?? 0;
                        $rowTotal += $amount;
                        $columnTotals[$purpose] += $amount;
                        echo '<td class="text-end">' . ($amount > 0 ? number_format($amount, 2) : '<span class="text-muted">--</span>') . '</td>';
                    }
                    $grandTotal += $rowTotal;
                    ?>
                <td class="text-end"><strong><?php echo number_format($rowTotal, 2); ?></strong></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot class="table-dark text-white">
            <tr>
                <td><strong>Total</strong></td>
                <?php foreach ($purposes as $purpose): ?>
                <td class="text-end"><strong><?php echo number_format($columnTotals[$purpose], 2); ?></strong></td>
                <?php endforeach; ?>
                <td class="text-end"><strong><?php echo number_format($grandTotal, 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div> <!-- end of leftblock -->