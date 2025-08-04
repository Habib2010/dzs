<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

	<div class="rows">
		<h3 class="text-center"><?= __d('accounts', 'All Status Information') ?></h3>

		<span class="text-right float-right mb-3"><?= $this->Html->link('Add Status', ['action' => 'add'], ['class' => 'btn btn-info']) ?></span>

	</div>
	<div class="table-responsive-sm">
		<table class="table table-bordered table-striped">
			<thead class="thead-dark">
				<tr>
					<th><?= __d('accounts', 'SL') ?></th>
					<th><?= __d('accounts', 'From') ?></th>
					<th><?= __d('accounts', 'To') ?></th>
					<th><?= __d('accounts', 'Status') ?> </th>
					<th><?= __d('accounts', 'Color') ?> </th>
					<th><?= __d('accounts', 'Action') ?></th>

				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($lists as $list) {
				?>
					<tr>
						<td><?= $list->id;  ?></td>
						<td><?= $list->inn; ?></td>
						<td><?= $list->outt; ?></td>
						<td><?= $list->statuss; ?></td>
						<td><?= $list->color ?></td>
						<td>
							<?= $this->Html->link('Edit', ['action' => 'edit', $list->id], ['class' => 'btn action-btn btn-warning']) ?>
							<?= $this->Form->postLink('Delete', ['action' => 'delete', $list->id], ['class' => 'btn action-btn btn-danger', 'confirm' => 'Are you sure, You want delete this?']) ?>
						</td>
					</tr>
				<?php } ?>

			</tbody>
		</table>
	</div>
	<nav aria-label="Page navigation example">
		<ul class="pagination mt-5 custom-paginate justify-content-center">
			<li class="page-item"> <?= $this->Paginator->first("First") ?></li>
			<li class="page-item"><?= $this->Paginator->prev("<<") ?></li>
			<li class="page-item"><?= $this->Paginator->numbers() ?></li>
			<li class="page-item"><?= $this->Paginator->next(">>") ?></li>
			<li class="page-item"><?= $this->Paginator->last("Last") ?></li>
		</ul>
	</nav>
</body>

</html>