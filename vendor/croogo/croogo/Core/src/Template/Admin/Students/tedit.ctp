<?php
//pr($student);die;

$this->Form->unlockField('id');
$this->Form->unlockField('name_bangla');
$this->Form->unlockField('name');
$this->Form->unlockField('birth_reg');
$this->Form->unlockField('birth_registration');
$this->Form->unlockField('disabled');
$this->Form->unlockField('exam_registration');
$this->Form->unlockField('freedom_fighter');
$this->Form->unlockField('g_id');
$this->Form->unlockField('g_name_bn');
$this->Form->unlockField('gpa');
$this->Form->unlockField('grade');
$this->Form->unlockField('group_name');
$this->Form->unlockField('image_name');
$this->Form->unlockField('institute');
$this->Form->unlockField('job_type');
$this->Form->unlockField('level_id');
$this->Form->unlockField('marital_status');
$this->Form->unlockField('name');
$this->Form->unlockField('name_bn');
$this->Form->unlockField('national_id');
$this->Form->unlockField('orphan');
$this->Form->unlockField('part_time_job');
$this->Form->unlockField('qualification_id');
$this->Form->unlockField('roll');
$this->Form->unlockField('scholership');
$this->Form->unlockField('section_id');
$this->Form->unlockField('session_id');
$this->Form->unlockField('shift_id');
$this->Form->unlockField('stipend');
$this->Form->unlockField('student_id');
$this->Form->unlockField('telephone');
$this->Form->unlockField('tribal');
$this->Form->unlockField('religion_subject');
$this->Form->unlockField('thrid_subject');
$this->Form->unlockField('forth_subject');

$this->Form->unlockField('nid');
$this->Form->unlockField('gender');
$this->Form->unlockField('religion');
$this->Form->unlockField('permanent_address');
$this->Form->unlockField('present_address');
$this->Form->unlockField('mobile');
//$this->Form->unlockField('serial');
$this->Form->unlockField('email');
$this->Form->unlockField('quota');
$this->Form->unlockField('blood_group');
$this->Form->unlockField('date_of_birth');
$this->Form->unlockField('date_of_admission');
$this->Form->unlockField('nationality');
$this->Form->unlockField('thumbnail');
//$this->Form->unlockField('roll');
$this->Form->unlockField('shift');
$this->Form->unlockField('level');
$this->Form->unlockField('group_id');
$this->Form->unlockField('section');
$this->Form->unlockField('session');



$this->Form->unlockField('thrid_subject');
$this->Form->unlockField('forth_subject');
$this->Form->unlockField('status');

//Educational Information table => "scms_qualification"
$this->Form->unlockField('id');
$this->Form->unlockField('temp_student_id');
$this->Form->unlockField('exam_name');
$this->Form->unlockField('exam_board');
$this->Form->unlockField('exam_roll');
$this->Form->unlockField('exam_reg');
$this->Form->unlockField('exam_gpa');
$this->Form->unlockField('exam_session');
$this->Form->unlockField('passing_year');
$this->Form->unlockField('exam_group');
$this->Form->unlockField('prev_school');

//Father Information table => "scms_qualification"
$this->Form->unlockField('g_name');
//$this->Form->unlockField('g_name_bn');
$this->Form->unlockField('g_mobile');
$this->Form->unlockField('g_nid');
$this->Form->unlockField('g_birth_reg');
$this->Form->unlockField('g_occupation');
$this->Form->unlockField('g_income');
$this->Form->unlockField('g_nationality');
$this->Form->unlockField('g_religion');
$this->Form->unlockField('g_gender');
$this->Form->unlockField('g_relation');

$this->Form->unlockField('active_guardian');

?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <title>Student Edit Form</title>
    </head>
<?php // pr($student);die; ?>
    <body>
        <div class="container  mt-5 mb-5">
            <div class="form-border">
                <section class="bg-light  p-4 m-auto" action="#">
                    <div class="form_area p-3">
                        <div class="header">
                            <h1 class="h1 text-center mb-5" style="letter-spacing: 3px; word-spacing: 7px; text-transform:capitalize;">
                            <?= __d('students', 'Student Registration Form') ?>
                            </h1>
                        </div>
                     <?php echo $this->Form->create('', ['type' => 'file']); ?>

                        <div class="row">
                            <div class="col-lg-9">
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <p class="label-font"><?= __d('students', 'Full Name') ?></p>
                                    </div>
                                    <div class="col-lg-10">
                                        <input name="name" type="text" class="form-control" value="<?php echo $student->name; ?>" placeholder="Full Name" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <p class="label-font"><?= __d('students', 'Full Name<br>(in Bangla)') ?> </p>
                                    </div>
                                    <div class="col-lg-10">
                                        <input name="name_bangla" type="text" value="<?php echo $student->name_bangla; ?>" class="form-control" placeholder="Full Name (in Bangla)" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <p><?= __d('students', 'Mobile No.') ?></p>
                                    </div>
                                    <div class="col-lg-4 d-flex">
                                        <input name="mobile" type="tel" class="form-control" placeholder="Mobile no" value="<?php echo $student->mobile; ?>" >

                                    </div>
                                    <div class="col-lg-2">
                                        <p class="label-font"><?= __d('students', 'Email') ?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="email" type="text" class="form-control" value="<?php echo $student->email; ?>" placeholder="Email address" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <p class="label-font"><?= __d('students', 'Telephone') ?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="telephone" type="tel" class="form-control" value="<?php echo $student->telephone; ?>" placeholder="Telephone number">
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="label-font"><?= __d('students', 'Date of Birth') ?></p>
                                    </div>
                                    <div class="col-lg-4 d-flex">
                                        <input name="date_of_birth" type="date" value="<?php echo $student->dob; ?>"  class="form-control">

                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3">
                                <div class="center">
                                    <div class="avatar-wrapper" id="avatar">
                                        <img class="profile-pic" src="<?php echo '/scms_packet/webroot/uploads/students/thumbnail/' . $student->thumbnail; ?>">
                                        <div class="upload-button">
                                            <i class="fa fa-arrow-circle-up" aria-hidden="true"><?= __d('students', 'Upload') ?></i>
                                        </div>
                                         <?php echo $this->form->file('image_name', ['class' => 'file-upload']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'NID No.') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="national_id" type="tel" class="form-control" value="<?php echo $student->national_id; ?>" placeholder="NID number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Birth Registration') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="birth_registration" type="tel" class="form-control" value="<?php echo $student->birth_reg; ?>"  placeholder="Birth Registration number" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Permanent Address') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="permanent_address" class="form-control" rows="2"value="<?php echo $student->permanent_address; ?>"  placeholder="Permanent Address" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Present Address') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="present_address" class="form-control" rows="2" value="<?php echo $student->current_address; ?>" placeholder="Present Address" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Gender') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="gender" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Male" <?php if ($student->gender == 'Male') {echo 'selected';} ?>><?= __d('students', 'Male') ?></option>
                                                <option value="Female" <?php if ($student->gender == 'Female') {echo 'selected';} ?>><?= __d('students', 'Female') ?></option>
                                                <option value="Others" <?php if ($student->gender == 'Others') {echo 'selected';} ?>><?= __d('students', 'Others') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Religion') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="religion" required>
                                                <option class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Islam" <?php if ($student->religion == 'Islam') {echo 'selected';} ?>><?= __d('students', 'Islam') ?></option>
                                                <option value="Hindu" <?php if ($student->religion == 'Hindu') {echo 'selected';} ?>><?= __d('students', 'Hindu') ?></option>
                                                <option value="Christian" <?php if ($student->religion == 'Christian') {echo 'selected';} ?><?= __d('students', 'Christian') ?></option>
                                                <option value="Buddhist" <?php if ($student->religion == 'Buddhist') {echo 'selected';} ?>><?= __d('students', 'Buddhist') ?></option>
                                                <option value="Others" <?php if ($student->religion == 'Others') {echo 'selected';} ?>><?= __d('students', 'Others') ?></option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Blood Group') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="blood_group" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="A+" <?php if ($student->blood_group == 'A+') {echo 'selected';} ?>><?= __d('students', 'A(+ve) Positive') ?></option>
                                                <option value="A-" <?php if ($student->blood_group == 'A-') {echo 'selected';} ?>><?= __d('students', 'A(-ve) Negative') ?></option>
                                                <option value="B+" <?php if ($student->blood_group == 'B+') {echo 'selected';} ?>><?= __d('students', 'B(+ve) Positive') ?></option>
                                                <option value="B-" <?php if ($student->blood_group == 'B-') {echo 'selected';} ?>><?= __d('students', 'B(-ve) Negative') ?></option>
                                                <option value="O+" <?php if ($student->blood_group == 'O+') {echo 'selected';} ?>><?= __d('students', 'O(+ve) Positive') ?></option>
                                                <option value="O-" <?php if ($student->blood_group == 'O-') {echo 'selected';} ?>><?= __d('students', 'O(-ve) Negative') ?></option>
                                                <option value="AB+" <?php if ($student->blood_group == 'AB+') {echo 'selected';} ?>><?= __d('students', 'AB(+ve) Positive') ?></option>
                                                <option value="AB-" <?php if ($student->blood_group == 'AB-') {echo 'selected';} ?>><?= __d('students', 'AB(-ve) Negative') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Marital Status') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="marital_status" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Married" <?php if ($student->marital_status == 'Married') {echo 'selected';} ?>><?= __d('students', 'Married') ?></option>
                                                <option value="Unmarried" <?php if ($student->marital_status == 'Unmarried') {echo 'selected';} ?>><?= __d('students', 'Unmarried') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Date of Admission') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="date_of_admission" type="date" class="form-control" value="<?php echo $student->date_of_admission; ?>"  placeholder="Date of Admission">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Nationality') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="nationality" type="text" class="form-control" value="<?php echo $student->nationality; ?>" placeholder="Nationality" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Quota') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="quota" type="text" class="form-control" value="<?php echo $student->quota; ?>" placeholder="Quota" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Tribal') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="tribal" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Yes" <?php if ($student->tribal == 'Yes') {echo 'selected';} ?>><?= __d('students', 'Yes') ?></option>
                                                <option value="No" <?php if ($student->tribal == 'No') {echo 'selected';} ?>><?= __d('students', 'No') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Disabled') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="disabled" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Yes" <?php if ($student->disabled == 'Yes') {echo 'selected';} ?>><?= __d('students', 'Yes') ?></option>
                                                <option value="No" <?php if ($student->disabled == 'No') {echo 'selected';} ?>><?= __d('students', 'No') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Orphan') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="orphan" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Yes" <?php if ($student->orphan == 'Yes') {echo 'selected';} ?>><?= __d('students', 'Yes') ?></option>
                                                <option value="No" <?php if ($student->orphan == 'No') {echo 'selected';} ?>><?= __d('students', 'No') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Part-time job') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="part_time_job" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Yes" <?php if ($student->part_time_job == 'Yes') {echo 'selected';} ?>><?= __d('students', 'Yes') ?></option>
                                                <option value="No" <?php if ($student->part_time_job == 'No') {echo 'selected';} ?>><?= __d('students', 'No') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Job Type') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="job_type" type="text" value="<?php echo $student->job_type; ?>" class="form-control" placeholder="Job Type" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Stipend') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="stipend" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Yes" <?php if ($student->stipend == 'Yes') {echo 'selected';} ?>><?= __d('students', 'Yes') ?></option>
                                                <option value="No" <?php if ($student->stipend == 'No') {echo 'selected';} ?>><?= __d('students', 'No') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font"><?= __d('students', 'Scholership') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="scholership" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Yes" <?php if ($student->scholership == 'Yes') {echo 'selected';} ?>><?= __d('students', 'Yes') ?></option>
                                                <option value="No" <?php if ($student->scholership == 'No') {echo 'selected';} ?>><?= __d('students', 'No') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <section class="bg-light mt-3 p-4 m-auto" action="#">
                    <fieldset>
                        <legend class=" mb-4"><?= __d('students', "Academic Information") ?></legend>
                        <div class="form_area p-3">


                            <div class="row mb-3">

                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Session') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="session_id" id="session_id" required>
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
                                            <p class="label-font13"><?= __d('students', 'Shift') ?></p>
                                        </div>

                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="shift_id" id="shift_id" required>
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
                                            <p class="label-font13"><?= __d('students', 'Class') ?></p>
                                        </div>

                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="level_id" id="level_id" required>
                                            <?php foreach ($levels as $level) { ?>
                                                <option value="<?php echo $level['level_id']; ?>" <?php if ($student->level == $level['level_id']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $level['level_name']; ?></option>
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
                                            <p class="label-font13"><?= __d('students', 'Section') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="section_id" id="section_id" required>
                                                 <?php foreach ($sections as $section) { ?>
                                                <option value="<?php echo $section['section_id']; ?>"><?php echo $section['section_name']; ?></option>
                                              <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Roll') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="roll" type="text" class="form-control" value="<?php echo $student->roll;?>"placeholder="Roll" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Religion Subject') ?></p>
                                        </div>
                                        <select class="form-control" name="religion_subject" id="religion_subject">
                                               <?php foreach ($religion as $subject) { ?>
                                            <option value="<?php echo $subject['course_id']; ?>"><?php echo $subject['course_name']; ?></option>
                                              <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', '3rd Subject') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="thrid_subject" id="thrid_subject">
                                                <option class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', '4th Subject') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="forth_subject" id="forth_subject">
                                                <option class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row mb-3">

                                <div class="col-lg-4">

                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Status') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="status" required>
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="1" <?php if ($student->status == 1) {echo 'selected';} ?>><?= __d('students', 'Active') ?></option>
                                                <option value="0"<?php if ($student->status == 0) {echo 'selected';} ?>><?= __d('students', 'In-Active') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                </div>

                            </div>

                        </div>
                    </fieldset>
                </section>

                <section class="bg-light mt-3 p-4 m-auto" action="#">
                    <fieldset>
                        <legend class=" mb-4"><?= __d('Student', 'Educational Information') ?><button type="button" class="eduAdd btn btn-info float-right">Add</button></legend>
                        <div class="add_education1">
                <?php foreach ($educations as $key => $education) { ?>
                            <input type="hidden" name="qualification_id[]" value="<?php echo $education['qualification_id']; ?>">
                            <div class="education_block form_area p-3 mb-2" id="education_block">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <p class="label-font13"><?= __d('employees', 'Exam Name') ?></p>
                                            </div>
                                            <div class="col-lg-10 row3Field">
                                                <input name="exam_name[]" type="text" class="form-control" value="<?php echo $education['exam_name']; ?>" placeholder="Name of Exam">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <p class="label-font13"><?= __d('employees', 'Board') ?></p>
                                            </div>
                                            <div class="col-lg-4 row2Field">
                                                <input name="exam_board[]" type="text" class="form-control" value="<?php echo $education['exam_board']; ?>" placeholder="Exam Board">
                                            </div>
                                            <div class="col-lg-2">
                                                <p class="label-font13"><?= __d('employees', 'Session') ?></p>
                                            </div>
                                            <div class="col-lg-4 row2Field">
                                                <input name="exam_session[]" type="text" class="form-control" value="<?php echo $education['exam_session']; ?>" placeholder=" Exam Session">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p class="label-font13"><?= __d('employees', 'Roll No.') ?></p>
                                            </div>
                                            <div class="col-lg-9 row2Field">
                                                <input name="exam_roll[]" type="text" class="form-control" value="<?php echo $education['exam_roll']; ?>" placeholder="Exam Roll No.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="label-font13"><?= __d('employees', 'Registration No.') ?></p>
                                            </div>
                                            <div class="col-lg-8 row2Field">
                                                <input name="exam_registration[]" type="text" class="form-control" value="<?php echo $education['exam_reg']; ?>" placeholder="Registration No.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <p class="label-font13"><?= __d('employees', 'Institute') ?></p>
                                            </div>
                                            <div class="col-lg-10 row2Field">
                                                <input name="institute[]" type="text" class="form-control" value="<?php echo $education['prev_school']; ?>" placeholder="Institute Name">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <!--                                    <div class="col-lg-3">
                                                                            <div class="row">
                                                                                <div class="col-lg-3">
                                                                                    <p class="label-font13"><?= __d('employees', 'Grade') ?></p>
                                                                                </div>
                                                                                <div class="col-lg-9 row2Field">
                                                                                    <input name="grade[]" type="text" class="form-control" value="<?php echo $education['exam_gpa']; ?>" placeholder="Grade">
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="label-font13"><?= __d('employees', 'Group') ?></p>
                                            </div>
                                            <div class="col-lg-8 row2Field">
                                                <input name="group_name[]" type="text" class="form-control" value="<?php echo $education['exam_group']; ?>" placeholder="Group">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="label-font13"><?= __d('employees', 'GPA') ?></p>
                                            </div>
                                            <div class="col-lg-8 row2Field">
                                                <input name="gpa[]" type="text" class="form-control" value="<?php echo $education['exam_gpa']; ?>" placeholder="GPA">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="label-font13"><?= __d('employees', 'Passing Year:') ?></p>
                                            </div>
                                            <div class="col-lg-8 row2Field">
                                                <input name="passing_year[]" type="text" class="form-control" value="<?php echo $education['passing_year']; ?>" placeholder="Passing Year">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <button id="delete" class=" btn btn-danger" type="button"><?= __d('employees', 'Remove') ?></button>
                                </div>
                            </div>



                        <?php } ?>
                        </div>
                        <div class="add_education">
                            <div class="">
                                <div class="education ">
                                    <div class="education_block form_area p-3 mb-2" id="education_block">
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <p class="label-font13"><?= __d('employees', 'Exam Name') ?></p>
                                                    </div>
                                                    <div class="col-lg-10 row3Field">
                                                        <input name="exam_name[]" type="text" class="form-control" placeholder="Name of Exam">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <p class="label-font13"><?= __d('employees', 'Board') ?></p>
                                                    </div>
                                                    <div class="col-lg-4 row2Field">
                                                        <input name="exam_board[]" type="text" class="form-control" placeholder="Exam Board">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <p class="label-font13"><?= __d('employees', 'Session') ?></p>
                                                    </div>
                                                    <div class="col-lg-4 row2Field">
                                                        <input name="exam_session[]" type="text" class="form-control" placeholder=" Exam Session">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <p class="label-font13"><?= __d('employees', 'Roll No.') ?></p>
                                                    </div>
                                                    <div class="col-lg-9 row2Field">
                                                        <input name="exam_roll[]" type="text" class="form-control" placeholder="Exam Roll No.">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="label-font13"><?= __d('employees', 'Registration No.') ?></p>
                                                    </div>
                                                    <div class="col-lg-8 row2Field">
                                                        <input name="exam_registration[]" type="text" class="form-control" placeholder="Registration No.">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <p class="label-font13"><?= __d('employees', 'Institute') ?></p>
                                                    </div>
                                                    <div class="col-lg-10 row2Field">
                                                        <input name="institute[]" type="text" class="form-control" placeholder="Institute Name">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <p class="label-font13"><?= __d('employees', 'Grade') ?></p>
                                                    </div>
                                                    <div class="col-lg-9 row2Field">
                                                        <input name="grade[]" type="text" class="form-control" placeholder="Grade">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="label-font13"><?= __d('employees', 'Group') ?></p>
                                                    </div>
                                                    <div class="col-lg-8 row2Field">
                                                        <input name="group_name[]" type="text" class="form-control" placeholder="Group">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="label-font13"><?= __d('employees', 'GPA') ?></p>
                                                    </div>
                                                    <div class="col-lg-8 row2Field">
                                                        <input name="gpa[]" type="text" class="form-control" placeholder="GPA">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="label-font13"><?= __d('employees', 'Passing Year:') ?></p>
                                                    </div>
                                                    <div class="col-lg-8 row2Field">
                                                        <input name="passing_year[]" type="text" class="form-control" placeholder="Passing Year">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <button id="delete" class=" btn btn-danger" type="button"><?= __d('employees', 'Remove') ?></button>
                                            <span class="remove_edu text-center ml-5 p-2" style=" background: yellow; color: red; font-weight: 500; border: 1px solid black "> <?= __d('employees', 'Click "Remove", If not Applicable!') ?></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </section>

                <!-- Added Name Till EDUCATION FIELD -->

                <section class="bg-light mt-3 p-4 m-auto" action="#">
                    <fieldset>
                        <legend class=" mb-4"><?= __d('students', "Father's Information") ?></legend>
                        <div class="form_area p-3">
                            <input name="g_relation[]" type="hidden" class="form-control" value="father" >
                            <input name="g_gender[]" type="hidden" class="form-control" value="Male" >
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <p class="label-font13"><?= __d('students', 'Name') ?></p>
                                        </div>
                                        <div class="col-lg-10 row3Field">
                                            <input name="g_name[]" type="text" class="form-control" value="<?php echo $student->fname; ?>" placeholder="Full Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <p class="label-font13"><?= __d('students', 'Name<br>(Bangla)') ?></p>
                                        </div>
                                        <div class="col-lg-10 row2Field">
                                            <input name="g_name_bn[]" type="text" value="<?php echo $student->bn_fname; ?>" class="form-control" placeholder="Full Name (in Bangla)" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Mobile') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="g_mobile[]" value="<?php echo $student->fmobile; ?>" type="text" class="form-control" placeholder="Mobile No.">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'NID No.') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="g_nid[]" value="<?php echo $student->f_nid; ?>" type="text" class="form-control" placeholder="NID No." >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Occupation') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="g_occupation[]" value="<?php echo $student->foccupation; ?>" type="text" class="form-control" placeholder="Occupation" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Yearly Income') ?> </p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="g_income[]" value="<?php echo $student->fincome; ?>" type="text" class="form-control" placeholder="Monthly Income" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Religion') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="g_religion[]" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Islam" <?php if ($student->religion == 'Islam') {echo 'selected';} ?>><?= __d('students', 'Islam') ?></option>
                                                <option value="Hindu" <?php if ($student->religion == 'Hindu') {echo 'selected';} ?>><?= __d('students', 'Hindu') ?></option>
                                                <option value="Christian" <?php if ($student->religion == 'Christian') {echo 'selected';} ?>><?= __d('students', 'Christian') ?></option>
                                                <option value="Buddhist" <?php if ($student->religion == 'Buddhist') {echo 'selected';} ?>><?= __d('students', 'Buddhist') ?></option>
                                                <option value="Others"  <?php if ($student->religion == 'Other') {echo 'selected';} ?>><?= __d('students', 'Others') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </section>

                <section class="bg-light mt-3 p-4 m-auto" action="#">
                    <fieldset>
                        <legend class=" mb-4"><?= __d('students', "Mother's Information") ?></legend>
                        <div class="form_area p-3">
                            <input name="g_relation[]" type="hidden" class="form-control" value="mother" >
                            <input name="g_gender[]" type="hidden" class="form-control" value="Female" >
                            <input name="g_id[]" type="hidden" class="form-control" value="<?php echo $student->id; ?>" >
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <p class="label-font13"><?= __d('students', 'Name') ?></p>
                                        </div>
                                        <div class="col-lg-10 row3Field">
                                            <input name="g_name[]" type="text" value="<?php echo $student->mname; ?>" class="form-control" placeholder="Full Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <p class="label-font13"><?= __d('students', 'Name<br>(Bangla)') ?></p>
                                        </div>
                                        <div class="col-lg-10 row2Field">
                                            <input name="g_name_bn[]" type="text" value="<?php echo $student->name_bn; ?>" class="form-control" placeholder="Full Name (in Bangla)" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Mobile') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="g_mobile[]" type="text" value="<?php echo $student->mmobile; ?>" class="form-control" placeholder="Mobile No." >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'NID No.') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="g_nid[]" type="text" value="<?php echo $student->m_nid; ?>" class="form-control" placeholder="NID No." >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Occupation') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="g_occupation[]" value="<?php echo $student->moccupation; ?>" type="text" class="form-control" placeholder="Occupation" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Yearly Income') ?> </p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <input name="g_income[]" value="<?php echo $student->mincome; ?>" type="text" class="form-control" placeholder="Monthly Income" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p class="label-font13"><?= __d('students', 'Religion') ?></p>
                                        </div>
                                        <div class="col-lg-9 row2Field">
                                            <select class="form-control" name="g_religion[]" >
                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                <option value="Islam" <?php if ($student->religion == 'Islam') {echo 'selected';} ?>><?= __d('students', 'Islam') ?></option>
                                                <option value="Hindu" <?php if ($student->religion == 'Hindu') {echo 'selected';} ?>><?= __d('students', 'Hindu') ?></option>
                                                <option value="Christian" <?php if ($student->religion == 'Christian') {echo 'selected';} ?>><?= __d('students', 'Christian') ?></option>
                                                <option value="Buddhist" <?php if ($student->religion == 'Buddhist') {echo 'selected';} ?>><?= __d('students', 'Buddhist') ?></option>
                                                <option value="Others"  <?php if ($student->religion == 'Other') {echo 'selected';} ?>><?= __d('students', 'Others') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </section>

                <section class="bg-light mt-3 p-4 m-auto" action="#">
                    <fieldset>


                            <div class="row active_guardian mt-5">
                                <div class="col-lg-6 dropdown">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <p class="label-font"><?= __d('students', 'Active Guardian') ?></p>
                                                        </div>
                                                        <div class=" col-lg-6 row2Field">
                                                            <select class="bg-warning form-control" name="active_guardian" >
                                                                <option value="" class="text-center"><?= __d('students', '-- Choose --') ?></option>
                                                                <option value="Father" <?php if ($student->active_guardian == 'Father') {
                                                                        echo 'selected';
                                                                    } ?>><?= __d('students', 'Father') ?></option>
                                                                <option value="Mother" <?php if ($student->active_guardian == 'Mother') {
                                                                        echo 'selected';
                                                                    } ?>><?= __d('students', 'Mother') ?></option>
                                                                <option value="Other" <?php if ($student->active_guardian == 'Other') {
                                                                        echo 'selected';
                                                                    } ?>><?= __d('students', 'Other') ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="btn btn-info"><?= __d('setup', 'Submit') ?></button>
                            <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </section>
            </div>
        </div>
    </body>

</html>
<script>
    $(document).ready(function() {
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(".profile-pic").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        };

        $(".file-upload").on("change", function() {
            readURL(this);
        });

        $(".upload-button").on("click", function() {
            $(".file-upload").click();
        });
    });
    var form = $(".education").html();

    $('.eduAdd').click(function() {
        $('.education').append(form);
    });
    $('.form').on('click', '#delete', function(eq) {
        $(this).closest('#single_row').remove();
    });
    $('.education').on('click', '#delete', function(eq) {
        alert("Are you sure, You want remove this?");
        $(this).closest('#education_block').remove();
    })
    
    $("#level_id").change(function() {
          getSectionAjax();
          getSubjectAjax();  
          getReligionSubjectAjax();
          
           var element1 = document.getElementById("group_id");
           var level_id = $("#level_id").val();
           if(level_id ==9 || level_id ==10 ){
              element1.setAttribute('required', true);
           }else{
             element1.removeAttribute('required');
           }
    });
    
    $("#shift_id").change(function() {
          getSectionAjax();
    }); 
    $("#group_id").change(function() {
          var group_id = $("#group_id").val();
           getSubjectAjax();  
           var element1 = document.getElementById("thrid_subject");
           var element2 = document.getElementById("forth_subject");
        if(group_id ==''){
             element1.removeAttribute('required');
             element2.removeAttribute('required');  
        }else{
             element1.setAttribute('required', true);
             element2.setAttribute('required', true);  
        }
    });
    
    $("#session_id").change(function() {
         getSubjectAjax();  
         getReligionSubjectAjax();
    });
    
    function getSubjectAjax() {
         var group_id = $("#group_id").val();
         var session_id = $("#session_id").val();
         var level_id = $("#level_id").val();
        $.ajax({
            url: 'getSubjectAjax',
            cache: false,
            type: 'GET',
            dataType: 'HTML',
            data: {
                "group_id": group_id,
                "session_id": session_id,
                "level_id": level_id
            },
            success: function(data) {
                data = JSON.parse(data);
                var text1 = '<option value="">-- Choose --</option>';
                for (let i = 0; i < data.length; i++) {
                    var name = data[i]["course_name"];
                    var id = data[i]["course_id"];
                    text1 += '<option value="' + id + '" >' + name + '</option>';
                }
                $('#thrid_subject').html(text1);
                 $('#forth_subject').html(text1);
            }
        }); 
    }
    function getReligionSubjectAjax() {
         var session_id = $("#session_id").val();
         var level_id = $("#level_id").val();
           $.ajax({
            url: 'getReligionSubjectAjax',
            cache: false,
            type: 'GET',
            dataType: 'HTML',
            data: {
                "session_id": session_id,
                "level_id": level_id
            },
            success: function(data) {
                data = JSON.parse(data);
                var text1 = '<option value="">-- Choose --</option>';
                for (let i = 0; i < data.length; i++) {
                    var name = data[i]["course_name"];
                    var id = data[i]["course_id"];
                    text1 += '<option value="' + id + '" >' + name + '</option>';
                }
                $('#religion_subject').html(text1);
            }
        });
    }
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
            success: function(data) {
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
</script>


