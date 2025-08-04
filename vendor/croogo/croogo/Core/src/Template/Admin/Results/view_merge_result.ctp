<?php

$this->Form->unlockField('session_id');
$this->Form->unlockField('level_id');
$this->Form->unlockField('section_id');
$this->Form->unlockField('group_id');
$this->Form->unlockField('sid');
$this->Form->unlockField('shift_id');
$this->Form->unlockField('result_template_id');
$this->Form->unlockField('term_cycle_id');
$this->Form->unlockField('type');
$this->Form->unlockField('sort');

?>


<div>
    <?php echo $this->Form->create(); ?>
    <section class="bg-light mt-3 p-4 m-auto" action="#">
        <fieldset>
            <legend class=" mb-4"><?= __d('result', "View Merge Result") ?></legend>
            <div class="p-3">
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'Session**') ?></p>
                            </div>
                            <div class="col-lg-9 row2Field">
                                <select class="form-control" name="session_id" id="session_id" required>
                                    <option value=""><?= __d('result', '-- Choose --') ?></option>
                                                 <?php foreach ($sessions as $session) { ?>
                                    <option value="<?php echo $session['session_id']; ?>"><?php echo $session['session_name']; ?></option>
                                              <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'Shift**') ?></p>
                            </div>

                            <div class="col-lg-9 row2Field">
                                <select class="form-control" name="shift_id" id="shift_id" required>
                                    <option value=""><?= __d('result', '-- Choose --') ?></option>
                                             <?php foreach ($shifts as $shift) { ?>
                                    <option value="<?php echo $shift['shift_id']; ?>"><?php echo $shift['shift_name']; ?></option>
                                              <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'Class**') ?></p>
                            </div>

                            <div class="col-lg-9 row2Field">
                                <select class="form-control" name="level_id" id="level_id" required>
                                    <option value=""><?= __d('result', '-- Choose --') ?></option>
                                             <?php foreach ($levels as $level) { ?>
                                    <option value="<?php echo $level['level_id']; ?>"><?php echo $level['level_name']; ?></option>
                                              <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'Section') ?></p>
                            </div>
                            <div class="col-lg-9 row2Field">
                                <select class="form-control" name="section_id" id="section_id">
                                    <option value=""><?= __d('result', '-- Choose --') ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'Group') ?></p>
                            </div>
                            <div class="col-lg-9 row2Field">
                                <select class="form-control" name="group_id" id="group_id">
                                    <option value=""><?= __d('result', '-- Choose --') ?></option>
                                                 <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group['group_id']; ?>"><?php echo $group['group_name']; ?></option>
                                              <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'SID') ?></p>
                            </div>
                            <div class="col-lg-9 row2Field">
                                <input name="sid" type="text" class="form-control" placeholder="SID">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'Term**') ?></p>
                            </div>
                            <div class="col-lg-9 row2Field">
                                <select class="form-control" name="term_cycle_id" id="term_cycle_id" required>
                                    <option value=""><?= __d('result', '-- Choose --') ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'Type**') ?></p>
                            </div>
                            <div class="col-lg-9 row2Field">
                                <select class="form-control" name="type" id="type" required>
                                    <option value=""><?= __d('result', '-- Choose --') ?></option>
                                                 <?php foreach ($view_type as $key =>$type) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $type; ?></option>
                                              <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="label-font13"><?= __d('result', 'Sort By') ?></p>
                            </div>
                            <div class="col-lg-9 row2Field">
                                <select class="form-control" name="sort" id="sort">
                                                 <?php foreach ($sort_by as $key =>$sort) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $sort; ?></option>
                                              <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </fieldset>
        <div class="mt-3">
            <button type="submit" class="btn btn-info"><?= __d('result', 'Submit') ?></button>
	    <?php echo $this->Form->end(); ?>
        </div>
    </section>
</div>
<script type='text/javascript'>
    $("#level_id").change(function () {
        getSectionAjax();
        getTermAjax();
    });
    $("#shift_id").change(function () {
        getSectionAjax();
    });
    $("#session_id").change(function () {
        getTermAjax();
    });

    function getSectionAjax() {
        var level_id = $("#level_id").val();
        var shift_id = $("#shift_id").val();
        $.ajax({
            url: 'getSectionAjax',
            cache: false,
            type: 'GET',
            dataType: 'HTML',
            data: {
                "level_id": level_id,
                "shift_id": shift_id
            },
            success: function (data) {
                data = JSON.parse(data);
                var text1 = '<option value="">-- Choose --</option>';
                for (let i = 0; i < data.length; i++) {
                    var name = data[i]["section_name"];
                    var id = data[i]["section_id"];
                    text1 += '<option value="' + id + '" >' + name + '</option>';
                }
                $('#section_id').html(text1);
            }
        });
    }
    function getTermAjax() {
        var session_id = $("#session_id").val();
        var level_id = $("#level_id").val();
        $.ajax({
            url: 'getTermAjax',
            cache: false,
            type: 'GET',
            dataType: 'HTML',
            data: {
                "level_id": level_id,
                "session_id": session_id
            },
            success: function (data) {
                data = JSON.parse(data);
                var text1 = '<option value="">-- Choose --</option>';
                for (let i = 0; i < data.length; i++) {
                    var name = data[i]["term_name"];
                    var id = data[i]["term_cycle_id"];
                    text1 += '<option value="' + id + '" >' + name + '</option>';
                }
                $('#term_cycle_id').html(text1);
            }
        });
    }
</script>
