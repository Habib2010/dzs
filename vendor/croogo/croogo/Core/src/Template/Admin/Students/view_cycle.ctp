<?php

$this->Form->unlockField('session_id');
$this->Form->unlockField('level_id');
$this->Form->unlockField('sid');
?>
<!doctype html>

<body>

    <div class="container">
        <div class="header">
            <h3 class=" text-center" style="letter-spacing: 3px; word-spacing: 7px; text-transform:capitalize;">
                    <?= __d('students', 'Search Students') ?>
            </h3>
        </div>
            <?php echo  $this->Form->create('', ['type' => 'file']); ?>
        <div class="form">
            <section class="bg-light mt-1 p-2 m-auto" action="#">
                <fieldset>
                    <div class=" form_area p-2">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'Session') ?></p>
                                    </div>
                                    <div class="col-lg-9 row2Field">
                                        <select class="form-control" name="session_id" id="session_id" required>
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                                <?php foreach ($sessions as $session) { ?>
                                            <option value="<?= $session['session_id']; ?>"><?= $session['session_name']; ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'Class') ?></p>
                                    </div>

                                    <div class="col-lg-9 row2Field">
                                        <select class="form-control" name="level_id" id="level_id">
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                                <?php foreach ($levels as $level) { ?>
                                            <option value="<?= $level['level_id']; ?>"><?= $level['level_name']; ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'SID') ?></p>
                                    </div>
                                    <div class="col-lg-9 row2Field">
                                        <input name="sid" type="text" class="form-control" placeholder="SID">
                                    </div>
                                </div>
                            </div>
                        </div>

                   

                    </div>
                </fieldset>
            </section>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-info"><?= __d('setup', 'Search') ?></button>
        </div>
            <?php echo $this->Form->end(); ?>
    </div>








</body>

</html>

