<?php
use Cake\Core\Configure;
$this->Form->unlockField('session_id');
$instituteName = Configure::read('Result.instituteName');
$instituteLogo = Configure::read('Result.instituteLogo');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Student</title>
</head>

<body>
    <?php if (!isset($students)) { ?>
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
    <?php   } ?>



    <?php if (isset($students)) { 
    $count = count($students);
    ?>
        <div class="row" style="margin-top: -58px;">
            <div class="col-11">
                <div style="text-align: center;">
                    <div class="resLogo text-left">
                        <?php echo $this->Html->image($instituteLogo, ['alt' => 'logo']); ?>
                    </div>
                    <p style="font-size:25px;"><b><?= $instituteName; ?></b></p>
                    <p style="font-size:25px;"><b>Promotion List Of <?= $session; ?></b></p>
                    <p style="font-size:15px;"><b>Total Students: <?= $count; ?></b></p>
                </div>
            </div>
            <div class="horizontal_scroll table-responsive-sm">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th><?= __d('students', 'SL') ?></th>
                            <th><?= __d('students', 'SID') ?></th>
                            <th><?= __d('students', 'Name') ?></th>
                            <th><?= __d('students', 'Class') ?></th>
                            <th><?= __d('students', 'Section') ?></th>
                            <th><?= __d('students', 'Roll') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						$serial = 1;
						$newClassFlag = $students[0]['section_id'];
						foreach ($students as $student) {

						?>

                    <tr
                        <?php if ($newClassFlag != $student['section_id']) echo 'style="page-break-before: always !important;"'; ?>>
                        <td> <?php echo $serial++; ?></td>
                        <td> <?php echo $student['sid']; ?> </td>
                        <td> <?php echo $student['name']; ?> </td>
                        <td> <?php echo ((!empty($student['level_name'])) ? $student['level_name'] : 'N/A'); ?>
                        </td>
                        <td> <?php echo ((!empty($student['section_name'])) ? $student['section_name'] : 'N/A'); ?>
                        </td>
                        <td> <?php echo $student['roll']; ?> </td>
                    </tr>

                    <?php
							$newClassFlag = $student['section_id'];
						}
						?>
                </tbody>
                </table>
            </div>
        </div>
    <?php } ?>






</body>

</html>
<script>
    $("#level_id").change(function() {
        getSectionAjax();
    });
    $("#shift_id").change(function() {
        getSectionAjax();
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