<?php

echo $this->Form->unlockField('level_id');
echo $this->Form->unlockField('session_id');
echo $this->Form->unlockField('month_id');
echo $this->Form->unlockField('purpose_id');
echo $this->Form->unlockField('shift_id');
echo $this->Form->unlockField('group_id');


$level_id = isset($level_id) ? $level_id : '';
$purpose_id = isset($purpose_id) ? $purpose_id : '';
$session_id = isset($session_id) ? $session_id : '';
$group_id = isset($group_id) ? $group_id : '';
$shift_id = isset($shift_id) ? $shift_id : '';

?>

<div class="container">
    <div class="header">
        <h3 class=" text-center" style="letter-spacing: 3px; word-spacing: 7px; text-transform:capitalize;">
            <?= __d('accounts', 'Multiple Fees-Khats Settings') ?>
        </h3>
    </div>

    <?php echo $this->Form->create('', ['type' => 'file']); ?>
    <div class="form ">
        <section class="bg-light mt-1 p-5 m-auto" action="#">
            <fieldset>
                <div class=" form_area p-4">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="label-font13">
                                        <?= __d('accounts', 'Session') ?>
                                    </p>
                                </div>
                                <div class="col-lg-9 row2Field">
                                    <select class="form-control" name="session_id" id="sessionSelect" required>
                                        <option value="">
                                            <?= __d('accounts', '-- Choose --') ?>
                                        </option>
                                        <?php foreach ($sessions as $session) { ?>
                                        <option value="<?= $session['session_id']; ?>" <?php if ($session_id == $session['session_id']) echo 'selected'; ?>><?= $session['session_name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="label-font13">
                                        <?= __d('accounts', 'Class') ?>
                                    </p>
                                </div>

                                <div class="col-lg-9 row2Field">
                                    <select class="form-control" name="level_id" id="levelSelect" required>
                                        <option value="">
                                            <?= __d('accounts', '-- Choose --') ?>
                                        </option>
                                        <?php foreach ($levels as $level) { ?>
                                        <option value="<?= $level['level_id']; ?>" <?php if ($level_id == $level['level_id']) echo 'selected'; ?>><?= $level['level_name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="label-font13">
                                        <?= __d('accounts', 'Fees Type') ?>
                                    </p>
                                </div>

                                <div class="col-lg-9 row2Field">
                                    <select class="form-control" name="purpose_id" id="feesSelect" required>

                                        <?php foreach ($purposes as $purpose) { ?>
                                        <option value="<?= $purpose['purpose_id']; ?>">
                                                <?= $purpose['purpose_name']; ?>
                                        </option>
                                        <?php } ?>
                                        <option value="">
                                            <?= __d('accounts', '-- Choose --') ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3 mt-3">
                                    <p class="label-font13">
                                        <?= __d('accounts', 'Months') ?>
                                    </p>
                                </div>
                                <div class="col-lg-9 mt-3 row2Field">
                                    <select class="form-control" name="month_id[]" id="monthSelect" multiple required>
                                              <?php foreach ($months as $month) { ?>
                                        <option value="<?= $month['id']; ?>" <?= $month['selected']; ?> > <?= $month['month_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="label-font13">
                                        <?= __d('accounts', 'Shift') ?>
                                    </p>
                                </div>

                                <div class="col-lg-9 row2Field">
                                    <select class="form-control" name="shift_id" id="shiftSelect">
                                        <option value="">
                                            <?= __d('accounts', '-- Choose --') ?>
                                        </option>
                                        <?php foreach ($shifts as $shift) { ?>
                                        <option value="<?= $shift->shift_id; ?>" <?php if ($shift_id == $shift->shift_id) echo 'selected'; ?>>
                                                <?= $shift->shift_name; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="label-font13">
                                        <?= __d('accounts', 'Group') ?>
                                    </p>
                                </div>

                                <div class="col-lg-9 row2Field">
                                    <select class="form-control" name="group_id" id="groupSelect">
                                        <option value="">
                                            <?= __d('accounts', '-- Choose --') ?>
                                        </option>
                                        <?php foreach ($groups as $group) { ?>
                                        <option value="<?= $group->group_id; ?>"  <?php if ($group_id == $group->group_id) echo 'selected'; ?> >
                                                <?= $group->group_name; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </section>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-success">
            <?= __d('setup', 'Search') ?>
        </button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>



<?php
if (isset($purposeChilds)) {
    $this->Form->unlockField('user_id');
    $this->Form->unlockField('session_id');
    $this->Form->unlockField('level_id');
    $this->Form->unlockField('month_id');
    $this->Form->unlockField('purpose_id');
    $this->Form->unlockField('group_id');
    $this->Form->unlockField('shift_id');
    $this->Form->unlockField('amount');
        $this->Form->unlockField('scholarship');
?>
<style>
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
    }

    input#perAmount ,#total{
        color: darkmagenta;
        font-size: large;
        font-weight: 600;
        text-align: right;

    }
</style>
    <?php echo $this->Form->create('', ['type' => 'file']); ?>
<input type="hidden" name="user_id" value="<?= $user_id ?>">
<input type="hidden" name="session_id" value="<?= $session_id ?>">
<input type="hidden" name="level_id" value="<?= $level_id ?>">
<input type="hidden" name="month_id" value='<?= $month_id ?>'>
<input type="hidden" name="purpose_id" value="<?= $purpose_id ?>">
<input type="hidden" name="group_id" value='<?= $group_id ?>'>
<input type="hidden" name="shift_id" value="<?= $shift_id ?>">
<div class="table-responsive-sm">
    <table class="table table-borderless table-dark table-striped mt-5">

        <tbody>
                <?php $i = 0;
                foreach ($purposeChilds as $pChild) { ?>
                    <?php if ($i % 2 === 0) {
                        echo '<tr>';
                    } ?>
        <td><?= $pChild['purpose_name']; ?></td>
        <td class="text-center"><input onchange=calculateTotal(); type="number" id="perAmount" step="any" name="amount[<?= $pChild['purpose_id'] ?>]"></td>
        <td class="text-center pt-3"><input type="checkbox" name="scholarship[<?= $pChild['purpose_id'] ?>]"></td>
                    <?php if ($i % 2 !== 0 || $i === count($purposeChilds) - 1) {
                        echo '</tr>';
                    } ?>
                    <?php $i++; ?>
                <?php } ?>
        <tr>
            <td>Total</td>
            <td class="text-center pt-3"><input id="total" type="number" step="any"  value=""  ></td>
        <tr>
            </tbody>
    </table>


</div>
<div class="mt-3 text-right">
    <button type="submit" class="btn btn-info">
            <?= __d('accounts', 'Save') ?>
    </button>
</div>
<?= $this->Form->end();
}
?>


<script>
    function fetchMonths() {
        var selectedSessionId = $('#sessionSelect').val();
        var levelId = $("#levelSelect").val();
        var shiftId = $('#shiftSelect').val();
        var groupId = $("#groupSelect").val();

        if (selectedSessionId && levelId) {
            $.ajax({
                url: "getOnlySessionMonthsAjax",
                cache: false,
                type: 'GET',
                dataType: 'HTML',
                data: {
                    "sessionId": selectedSessionId,
                    "levelId": levelId,
                    "shiftId": shiftId,
                    "groupId": groupId
                },
                success: function (response) {
                    // Parse the JSON response
                    response = JSON.parse(response);
                    if (Array.isArray(response)) {
                        $("#monthSelect").empty().prop("disabled", false);

                        $.each(response, function (index, month) {
                            var sessionMatches = true; // Replace with your condition
                            if (sessionMatches) {
                                $("#monthSelect").append('<option value="' + month.id + '">' + month.month_name + '</option>');
                            }
                        });
                    } else {
                        console.error("Invalid response format: Not an array");
                    }
                }
            });
        }
    }
    // Event handlers for session, level, and fees selection
    $("#sessionSelect").change(function () {
        fetchMonths();
    });
    $("#levelSelect").change(function () {
        fetchMonths();
    });
    $("#shiftSelect").change(function () {
        fetchMonths();
    });
    $("#groupSelect").change(function () {
        fetchMonths();
    });

    function calculateTotal() {
        let total = 0;
        $("input[id^='perAmount']").each(function (i, el) {
            if (this.value) {
                total = total + this.value * 1;
            }
        });
        total = total.toFixed(2);
        $("#total").val(total);
    }

</script>
