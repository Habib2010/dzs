<?php

$this->Form->unlockField('sid');
$this->Form->unlockField('remove');
$this->Form->unlockField('level_from');
$this->Form->unlockField('level_to');
$this->Form->unlockField('session_from');
$this->Form->unlockField('session_to');
$this->Form->unlockField('section_from');
$this->Form->unlockField('section_to');
$this->Form->unlockField('roll');

// $sections = [
//     'A' => 'A',
//     'B' => 'B',
//     'C' => 'C',
//     'D' => 'D'
// ]

?>
<!doctype html>
<html lang="en">


<body>

    <div class="container">
        <div class="header">
            <h3 class=" text-center" style="letter-spacing: 3px; word-spacing: 7px; text-transform:capitalize;">
                <?= __d('students', 'Individual Students Promotion') ?>
            </h3>
        </div>
        <?php echo  $this->Form->create('', ['type' => 'file']); ?>
        <div class="form">
            <section class="bg-light mt-1 p-2 m-auto" action="#">
                <div class=" p-2">
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="col-lg-12 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'SID') ?></p>
                                    </div>
                                    <div class="col-lg-9 row2Field">
                                        <input class="form-check-input" type="text" name="sid" required value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-lg-12 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="label-font13"><?= __d('students', 'Remove Previous Cycle') ?></p>
                                    </div>
                                    <div class="col-lg-6 row2Field">
                                        <input class="form-check-input" type="checkbox" name="remove" checked value="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <h5>Promotion From</h5>
                            <div class="row mt-3">
                                <div class="col-lg-3">
                                    <p class="label-font13"><?= __d('students', 'Session From') ?></p>
                                </div>
                                <div class="col-lg-7 row2Field">
                                    <select class="form-control" name="session_from" id="session_from" required>
                                        <option value=""><?= __d('students', '-- Choose --') ?></option>
                                        <?php foreach ($sessions as $session) { ?>
                                        <option value="<?= $session['session_id']; ?>"><?= $session['session_name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-3">
                                    <p class="label-font13"><?= __d('students', 'Level From') ?></p>
                                </div>
                                <div class="col-lg-7 row2Field">
                                    <select class="form-control" name="level_from" id="level_from" required>
                                        <option value=""><?= __d('students', '-- Choose --') ?></option>
                                        <?php foreach ($levels as $level) { ?>
                                        <option value="<?= $level['level_id']; ?>"><?= $level['level_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-3">
                                    <p class="label-font13"><?= __d('students', 'Section From') ?></p>
                                </div>
                                <div class="col-lg-7 row2Field">
                                    <select class="form-control" name="section_from" id="section_id_from" required>
                                        <option value=""><?= __d('students', '-- Choose --') ?></option>
                                        <?php foreach ($sections as $section) { ?>
                                        <option value="<?= $section['section_id']; ?>">
                                            <?= $section['section_name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <h5>Promotion To</h5>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'Session To') ?></p>
                                    </div>
                                    <div class="col-lg-7 row2Field">
                                        <select class="form-control" name="session_to" id="session_to" required>
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                            <?php foreach ($sessions as $session) { ?>
                                            <option value="<?= $session['session_id']; ?>">
                                                <?= $session['session_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'Level To') ?></p>
                                    </div>
                                    <div class="col-lg-7 row2Field">
                                        <select class="form-control" name="level_to" id="level_to" required>
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                            <?php foreach ($levels as $level) { ?>
                                            <option value="<?= $level['level_id']; ?>"><?= $level['level_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'Section To') ?></p>
                                    </div>
                                    <div class="col-lg-7 row2Field">
                                        <!-- <select class="form-control" name="section_to" required> -->
                                        <select class="form-control" name="section_to" id="section_id_to" required>
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                            <?php foreach ($sections as $section) { ?>
                                            <option value="<?= $section['section_id']; ?>">
                                                <?= $section['section_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center align-items-center"
                            style="height: 100%; text-align:center;">
                            <div class="col-lg-12 mt-3 mb-3">
                                <div class="row" style="margin-left: 288px;">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'New Roll') ?></p>
                                    </div>
                                    <div class="col-lg-9 row2Field">
                                        <input class="form-check-input" type="text" name="roll" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
        <div class="mt-3 text-right">
            <button type="submit" class="btn btn-info"><?= __d('setup', 'Submit') ?></button>
        </div>

    </div>
    <?php echo $this->Form->end(); ?>
</body>

</html>
<script>
$("#level_to").change(function() {
    getSectionAjaxbylevelto();
});
$("#level_from").change(function() {
    getSectionAjaxbylevelfrom();
});

function getSectionAjaxbylevelto() {
    var level_id = $("#level_to").val();
    $.ajax({
        url: 'getSectionAjaxbylevelto',
        cache: false,
        type: 'GET',
        dataType: 'HTML',
        data: {
            "level_id": level_id
        },
        success: function(data) {
            data = JSON.parse(data);
            var text1 = '<option value="">-- Choose --</option>';
            for (let i = 0; i < data.length; i++) {
                var name = data[i]["section_name"];
                var id = data[i]["section_id"];
                text1 += '<option value="' + id + '" >' + name + '</option>';
            }
            $('#section_id_to').html(text1);

        }
    });
}

function getSectionAjaxbylevelfrom() {
    var level_id = $("#level_from").val();
    $.ajax({
        url: 'getSectionAjaxbylevelfrom',
        cache: false,
        type: 'GET',
        dataType: 'HTML',
        data: {
            "level_id": level_id
        },
        success: function(data) {
            data = JSON.parse(data);
            var text1 = '<option value="">-- Choose --</option>';
            for (let i = 0; i < data.length; i++) {
                var name = data[i]["section_name"];
                var id = data[i]["section_id"];
                text1 += '<option value="' + id + '" >' + name + '</option>';
            }
            $('#section_id_from').html(text1);

        }
    });
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this file?");
}
</script>