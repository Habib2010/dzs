<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .student-thumbnail {
        height: 10px;
        width: 10px;
    }
</style>

<body>

    <div>
        <h3 class="text-center hello"><?= __d('students', 'List of Temp Students') ?></h3>
        <!--<span class="text-right float-right mb-3"><?php echo $this->Html->link('Add Students', ['action' => 'add'], ['class' => 'btn btn-info']) ?></span>-->
    </div>
    <div class="table-responsive-sm">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th><?= __d('students', 'Photo') ?></th>
                    <th><?= __d('students', 'ID') ?></th>
                    <th><?= __d('students', 'Name') ?></th>
                    <th><?= __d('students', 'Reference') ?></th>
                    <th><?= __d('students', 'Mobile') ?></th>
                    <th><?= __d('students', 'Action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($datas as $data) {
                    //print_r($data);die;
                ?>
                    <tr>
                        <td class="student-thumbnail"><?php echo $this->Html->image('/webroot/uploads/students/thumbnail/' . $data['photo']); ?></td>
                        <td><?php echo $data['id'] ?></td>
                        <td class="st_name"><?php echo $data['name'] ?></td>
                        <td><?php echo $data['ref'] ?></td>
                        <td><?php echo $data['mobile'] ?></td>
                        <td>
                            <?php echo $this->Html->link('Edit', ['action' => 'tedit', $data['id']], ['class' => 'btn action-btn btn-warning']) ?>
                            <?php $this->Form->postLink('Delete', ['action' => 'delete', $data['id']], ['class' => 'btn btn-danger ', 'confirm' => 'Are you sure, You want delete this?']) ?>

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
