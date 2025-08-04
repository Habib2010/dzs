    <?php

    use Cake\Core\Configure;
    $siteTemplate = Configure::read('Site.template');
    ?>
    
    <?php if ($siteTemplate == 2) { ?>
        <div class="container my-3">
            <h4 class="content_title">
                <?php if ($employees != null) {
                    echo $employees[0]['role_title'];
                } else {
                    echo "No Roles Found";
                } ?>
            </h4><!-- Title should be dynamic here -->
            <div class="row mt-3 grid_emp">
                <?php foreach ($employees as $employee) { ?>
                    <div class="col-md-4 teachers col-6 mb-4 ">
                        <a href="<?php echo $this->Url->build(['controller' => 'Employees', 'action' => 'employeesProfile', $employee['employee_id']]); ?>">
                            <?php echo $this->Html->image('/webroot/uploads/employee_images/regularSize/' . $employee['image_name'], ['alt' => $employee['employee_name'], 'class' => 'custom_img']); ?>
                            <span class="name_deg  pt-2 pb-4 px-2">
                                <?= $employee['employee_name'] ?><br>
                                <?= $employee['designation_title'] ?>
                            </span>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <h4 class="content_title">
            <?php if ($employees != null) {
                echo $employees[0]['role_title'];
            } else {
                echo "No Roles Found";
            } ?>
        </h4><!-- Title should be dynamic here -->
        <div class="row mt-3 grid_emp">
            <?php foreach ($employees as $employee) { ?>
                <div class="col-md-4 teachers col-6 mb-4 ">
                    <a href="<?php echo $this->Url->build(['controller' => 'Employees', 'action' => 'employeesProfile', $employee['employee_id']]); ?>">
                        <?php echo $this->Html->image('/webroot/uploads/employee_images/regularSize/' . $employee['image_name'], ['alt' => $employee['employee_name'], 'class' => 'custom_img']); ?>
                        <span class="name_deg  pt-2 pb-4 px-2">
                            <?= $employee['employee_name'] ?><br>
                            <?= $employee['designation_title'] ?>
                        </span>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
