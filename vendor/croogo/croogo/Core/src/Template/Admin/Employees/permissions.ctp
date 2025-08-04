<?php
$this->Form->unlockField('marks');
$this->Form->unlockField('attendance_course');
$this->Form->unlockField('attendance_section');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Permission</title> 
    </head>
    <body>
        <div class="rows">
            <h3 class="text-center"><?= __d('employees', 'Set Permission for ') ?> <?= $employee['name'] ?></h3>
        </div>
        <section class="container">
             <?php echo $this->Form->create(); ?>
            <div>
                <ul class="nav nav-tabs" role="tablist" style=" border-bottom: 0px !important;">
                    <li role="presentation" class="btn btn-info"><a style="color: #FFFFFF;text-decoration: none;margin-bottom:10px;" href="#tab1" aria-controls="basic" role="tab" data-toggle="tab">Mark Entry</a></li>
                    <li role="presentation" class="btn btn-info ml-5"><a style="color: #FFFFFF;text-decoration: none;margin-bottom:10px;" href="#tab2" aria-controls="attendance" role="tab" data-toggle="tab">Attendance</a></li>
                </ul>   
            </div>
            <div class="tab-content mt-2">
                <div id="tab1" class="tab-pane container">
                    <h3>Permission For Mark Entry </h3>
                    <?php foreach($sessions as $session) {?>
                    <h5>Session Name: <?=  $session['session_name'] ?></h5>
                      <?php foreach($filter_departments as $department) {?>
                    <h6>Department Name: <?=  $department['department_name'] ?></h6>
                         <?php foreach($department['levels'] as $level) {?>
                          <?php foreach($level['sections'] as $section) {?>
                    <div class="row">
                        <div class="col-md-9">
                            <p class="ml-2 mt-2"> Level Name: <?=  $level['level_name'] ?>  Section Name: <?=  $section['section_name'] ?>  </p>
                        </div>
                        <div class="col-md-3">
                            <?php  $class_id = 'mark_course_'.$session['session_id'].'_'.$department['department_id'].'_'.$level['level_id'].'_'.$section['section_id'];?>
                            <p class="pull-right"> Check All <input  class="allcheck" type="checkbox" id="<?=  $class_id ?>" value="1"></p>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach($level['courses'] as $course) {?>
                         <?php  $chacked = isset($set_permission_marks[$session['session_id']][$department['department_id']][$level['level_id']][$section['section_id']][$course['course_id']]) ? "checked" : null;?>
                        <div class="col-md-3 mt-2" style="font-size: 12px; ">
                            <input step="margin-top:-3px;"  class="form-check-input <?=  $class_id ?>" type="checkbox" name="marks[<?=  $session['session_id'] ?>][<?=  $department['department_id'] ?>][<?=  $level['level_id'] ?>][<?=  $section['section_id'] ?>][<?=  $course['course_id'] ?>]" value="1" <?=  $chacked ?> >
                            <?=  $course['course_name'] ?>
                        </div>
                         <?php } ?>
                    </div>
                         <?php } ?>
                         <?php } ?>
                      <?php } ?>
                    <?php } ?>
                </div>
                <div id="tab2" class="tab-pane container">
                    <h3>Permission For Attendance </h3>
                    <?php foreach($sessions as $session) {?>
                    <h5>Session Name: <?=  $session['session_name'] ?></h5>
                      <?php foreach($filter_departments as $department) {?>
                    <h6>Department Name: <?=  $department['department_name'] ?></h6>
                         <?php foreach($department['levels'] as $level) {?>
                          <?php if($attendance_type == 'course') {?>
                            <?php foreach($level['sections'] as $section) {?>
                     <div class="row">
                        <div class="col-md-9">
                            <p class="ml-2 mt-2"> Level Name: <?=  $level['level_name'] ?>  Section Name: <?=  $section['section_name'] ?></p>
                        </div>
                        <div class="col-md-3">
                            <?php  $class_id = 'attendance_course_'.$session['session_id'].'_'.$department['department_id'].'_'.$level['level_id'].'_'.$section['section_id'];?>
                            <p class="pull-right"> Check All <input  class="all_check_attendance_course" type="checkbox" id="<?=  $class_id ?>" value="1"></p>
                        </div>
                    </div>
                   
                    <div class="row">
                                 <?php foreach($level['courses'] as $course) {?>
                         <?php  $chacked = isset($set_permission_attendance[$session['session_id']][$department['department_id']][$level['level_id']][$section['section_id']][$course['course_id']]) ? "checked" : null;?>
                        <div class="col-md-3 mt-2" style="font-size: 12px; ">
                            <input step="margin-top:-3px;"  class="form-check-input <?=  $class_id ?>" type="checkbox" name="attendance_course[<?=  $session['session_id'] ?>][<?=  $department['department_id'] ?>][<?=  $level['level_id'] ?>][<?=  $section['section_id'] ?>][<?=  $course['course_id'] ?>]" value="1" <?=  $chacked ?>>
                                      <?=  $course['course_name'] ?>
                        </div>
                                <?php } ?>
                    </div>
                            <?php } ?>
                           <?php }else { ?>
                    <div class="row">
                        <div class="col-md-9">
                            <p class="ml-2 mt-2"> Level Name: <?=  $level['level_name'] ?></p>
                        </div>
                        <div class="col-md-3">
                            <?php  $class_id = 'attendance_day_'.$session['session_id'].'_'.$department['department_id'].'_'.$level['level_id']?>
                            <p class="pull-right"> Check All <input  class="all_check_attendance_section" type="checkbox" id="<?=  $class_id ?>" value="1"></p>
                        </div>
                    </div>
                    <div class="row">
                                   <?php foreach($level['sections'] as $section) {?>
                        <?php  $chacked = isset($set_permission_attendance[$session['session_id']][$department['department_id']][$level['level_id']][$section['section_id']]) ? "checked" : null;?>
                        <div class="col-md-3 mt-2" style="font-size: 12px; ">
                            <input step="margin-top:-3px;"  class="form-check-input <?=  $class_id ?>" type="checkbox" name="attendance_section[<?=  $session['session_id'] ?>][<?=  $department['department_id'] ?>][<?=  $level['level_id'] ?>][<?=  $section['section_id'] ?>]" value="1" <?=  $chacked ?>>
                                      <?=  $section['section_name'] ?>
                        </div>
                                <?php } ?>
                    </div>
                                <?php } ?>
                         <?php } ?>
                      <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="text-right mt-2">
                <button type="submit" class="btn btn-info"><?= __d('gradings', 'Submit') ?></button>
            </div>
             <?php echo $this->Form->end(); ?>
        </section>
    </body>

</html>
<script type="text/javascript">
    $(document).ready(function () {
        var form = $(".form").html();
        $('.add_more').click(function () {
            $('.form').append(form);
        });
    });
    $('.allcheck').on('change', function () {
        var checked = this.checked;
        var id = this.id;
        var class_name = "." + id;
        var checkboxes = document.querySelectorAll(class_name);
        checkboxes.forEach(function (checkbox) {
            if (checked == true) {
                checkbox.checked = true;
            } else {
                checkbox.checked = false;
            }
        });
    });
    $('.all_check_attendance_section').on('change', function () {
        var checked = this.checked;
        var id = this.id;
        var class_name = "." + id;
        var checkboxes = document.querySelectorAll(class_name);
        checkboxes.forEach(function (checkbox) {
            if (checked == true) {
                checkbox.checked = true;
            } else {
                checkbox.checked = false;
            }
        });
    });
    $('.all_check_attendance_course').on('change', function () {
        var checked = this.checked;
        var id = this.id;
        var class_name = "." + id;
        var checkboxes = document.querySelectorAll(class_name);
        checkboxes.forEach(function (checkbox) {
            if (checked == true) {
                checkbox.checked = true;
            } else {
                checkbox.checked = false;
            }
        });
    });
</script>