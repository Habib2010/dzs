<?php $this->Form->unlockField('faculty_name'); ?>

<div>
	<?php echo $this->Form->create(); ?>
	<section>
		<h4><?= __d('setup', 'Add a Faculty') ?></h4>
		<div class="row mx-3 mt-2 p-3 form-box">
			<div class="col-12 mt-2">
				<label for="inputBR" class="form-label"><?= __d('setup', 'Faculty Name') ?></label>
				<input name="faculty_name" type="text" class="form-control" id="inputBR" placeholder="Faculty Name" required>
			</div>
	</section>
	<div class="text-right mt-5">
		<button type="submit" class="btn btn-info"><?= __d('setup', 'Submit') ?></button>
		 
		<?php echo $this->Html->Link('Back', ['action' => 'Faculty'], ['class' => 'btn btn-sucess']); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>