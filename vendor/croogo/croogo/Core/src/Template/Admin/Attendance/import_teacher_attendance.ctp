<?php

$this->Form->unlockField('file');
$this->Form->unlockField('start');
$this->Form->unlockField('end');
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
	<div class="container  mt-5 mb-5">
		<div class="form-border">
			<section class="bg-light  p-4 m-auto" action="#">
				<div class="form_area p-3">
					<div class="header">
						<h1 class="h1 text-center mb-5" style="letter-spacing: 3px; word-spacing: 7px; text-transform:capitalize;">
							<?= __d('students', 'Choose CSV file to upload') ?>
						</h1>
					</div>
					<?php echo $this->Form->create('', ['type' => 'file']); ?>
					<div class="form_area p-2">
						<div class="row mb-3">
							<div class="center">
								<img class="profile-pic" src="" />
								<div class="upload-button">
									<i class="fa fa-arrow-circle-up" aria-hidden="true"><?= __d('students', 'Uplaoad') ?></i>
								</div>
								<input name="file" class="file-upload" type="file" accept="image/*" />
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-2">
								<p class="label-font"><?= __d('students', 'Check-in Time :') ?></p>
							</div>
							<div class="col-lg-4">
								<input name="start" id="checkInTime" type="time" class="form-control">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-2">
								<p class="label-font"><?= __d('students', 'Check-out Time :') ?></p>
							</div>
							<div class="col-lg-4">
								<input name="end" id="checkOutTime" type="time" class="form-control">
							</div>
						</div>
						<div class="mt-5">
							<button type="submit" class="btn btn-info"><?= __d('setup', 'Submit') ?></button>
							<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
			</section>

		</div>
	</div>
</body>

</html>








<script>
	document.addEventListener("DOMContentLoaded", function() {

		var checkInInput = document.getElementById("checkInTime");
		var checkOutInput = document.getElementById("checkOutTime");

		checkInInput.value = "10:00";
		checkOutInput.value = "16:00";
	});
</script>