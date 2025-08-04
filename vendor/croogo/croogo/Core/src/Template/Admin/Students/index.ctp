<?php

$this->Form->unlockField('session_id');
$this->Form->unlockField('shift_id');
$this->Form->unlockField('level_id');
$this->Form->unlockField('section_id');
$this->Form->unlockField('sid');
$this->Form->unlockField('status');

$session_id = isset($session_id) ? $session_id : '';
$shift_id = isset($shift_id) ? $shift_id : '';
$level_id = isset($level_id) ? $level_id : '';
$section_id = isset($section_id) ? $section_id : '';
$sid = isset($sid) ? $sid : '';
$status = isset($status) ? $status : '';

$statuses = [
    [
        'status_id' => 1,
        'status_name' => 'Active',

    ],
    [
        'status_id' => -1,
        'status_name' => 'In-Active',
    ],
];

?>


<head>
  
 
  
   
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container d-print-none">
        <div class="header">
           <div style="background-color: #6e7691; padding: 5px 5px; border-radius: 8px;">
    <h3 class="text-center fw-bold text-white mb-0" style="letter-spacing: 2px; word-spacing: 5px; text-transform: capitalize; font-size: 1.75rem; text-shadow: 1px 1px 0 #000;">
        <i class="bi bi-search me-2"></i> <?= __d('students', 'Search Students') ?>
    </h3>
</div>

        </div>
        <?php echo  $this->Form->create(); ?>
        <div class="">
            <section class=" mt-1 p-2 mx-auto" action="#">
                <fieldset>
                    <div class=" form_area p-2" style="">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'Session') ?></p>
                                    </div>
                                    <div class="col-lg-9 row2Field">
                                        <select class="form-control"  name="session_id" id="session_id" required>
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                            <?php foreach ($sessions as $session) { ?>
                                                <option value="<?php echo $session['session_id']; ?>" <?php if ($data['session_id'] == $session['session_id']) {
                                                                                                            echo 'Selected';
                                                                                                        } ?>><?php echo $session['session_name']; ?> </option>
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
                                        <select class="form-control" name="shift_id" id="shift_id">
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                            <?php foreach ($shifts as $shift) { ?>
                                                <option value="<?php echo $shift['shift_id']; ?>" <?php if ($data['shift_id'] == $shift['shift_id']) {
                                                                                                        echo 'Selected';
                                                                                                    } ?>><?php echo $shift['shift_name']; ?> </option>
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
                                                <option value="<?php echo $level['level_id']; ?>" <?php if ($data['level_id'] == $level['level_id']) {
                                                                                                        echo 'Selected';
                                                                                                    } ?>><?php echo $level['level_name']; ?>
                                                </option>
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
                                        <select class="form-control" name="section_id" id="section_id">
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                            <?php foreach ($sections as $section) { ?>
                                                <option value="<?php echo $section['section_id']; ?>" <?php if ($data['section_id'] == $section['section_id']) {
                                                                                                            echo 'Selected';
                                                                                                        } ?>><?php echo $section['section_name']; ?> </option>
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
                                        <input name="sid" type="text" class="form-control" placeholder="SID" value="<?php if (isset($data['sid'])) {
                                                                                                                        echo $data['sid'];
                                                                                                                    } ?>">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="label-font13"><?= __d('students', 'Status') ?></p>
                                    </div>
                                    <div class="col-lg-9 row2Field">
                                        <select class="form-control" name="status" id="status">
                                            <option value=""><?= __d('students', '-- Choose --') ?></option>
                                            <?php foreach ($statuses as $status) { ?>
                                                <option value="<?php echo $status['status_id']; ?>" <?php if ($data['status'] == $status['status_id']) {
                                                                                                        echo 'Selected';
                                                                                                    } ?>><?php echo $status['status_name']; ?> </option>
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
        <div class="mt-3 text-center">
            <button type="submit" class="btn btn-info px-5"><?= __d('setup', 'Search') ?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>




    <?php if (isset($students)) { 
        
        ?>



    
<div class="bg-light p-3 rounded shadow-sm d-flex align-items-center mt-3 mb-3 flex-wrap gap-3 justify-content-between">
  <div class="fw-semibold">
        <?php
    $output = [];

    if (!empty($head['session_name'])) {
        $output[] = 'Session: ' . $head['session_name'];
    }
    if (!empty($head['shift_name'])) {
        $output[] = 'Shift: ' . $head['shift_name'];
    }
    if (!empty($head['level_name'])) {
        $output[] = 'Class: ' . $head['level_name'];
    }
    if (!empty($head['section_name'])) {
        $output[] = 'Section: ' . $head['section_name'];
    }
     if (!empty($head['sid'])) {
        $output[] = 'SID: ' . $head['sid'];
    }
    if (!empty($head['status_name'])) {
        $output[] = 'Status: ' . $head['status_name'];
    }
  if (!empty($value['status'])) {
    $output[] = 'Status: ' . ($value['status'] == 1 ? 'Active' : 'In-Active');
}


    echo implode(', ', $output);
    ?>
  </div>
  <div style="display: grid; grid-auto-flow: column; gap: 8px; align-items: center;">
    <div class="fw-semibold text-primary">
        <?= __('Total: ') . count($students) ?>
    </div>
        <?php
        // For student data export purpose 27/01/2024
        $this->Form->unlockField('session_id');
        $this->Form->unlockField('level_id');
        $this->Form->unlockField('shift_id');
        $this->Form->unlockField('section_id');
        $this->Form->unlockField('status');
        echo $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'export'], 'style' => 'display:inline-block; margin:0;']);
        ?>
        <input type="hidden" name="session_id" value="<?= isset($where['scms_student_cycle.session_id']) ? h($where['scms_student_cycle.session_id']) : '' ?>">
        <input type="hidden" name="level_id" value="<?= isset($where['scms_student_cycle.level_id']) ? h($where['scms_student_cycle.level_id']) : '' ?>">
        <input type="hidden" name="shift_id" value="<?= isset($where['scms_student_cycle.shift_id']) ? h($where['scms_student_cycle.shift_id']) : '' ?>">
        <input type="hidden" name="section_id" value="<?= isset($where['scms_student_cycle.section_id']) ? h($where['scms_student_cycle.section_id']) : '' ?>">
        <input type="hidden" name="status" value="<?= isset($where['s.status']) ? h($where['s.status']) : '' ?>">
        <button type="submit" class="btn btn-success shadow-sm align-items-center gap-2 d-print-none">
            <i class="fa fa-download"></i>
            <?= __d('setup', 'Export Data') ?>
        </button>
        <?= $this->Form->end() ?>
        <div class="d-print-none">
    <button class="btn btn-dark" onclick="printStudentTable()">
        <i class="fa fa-print"></i> <?= __('Print Table') ?>
    </button>
</div>
  </div>
</div>

<div class="table-responsive rounded ">
 <table class="table table-striped table-hover table-bordered " style="border: 1px solid #dee2e6; " id="studentTable">
    <thead style="background-color: #f8f9fa; color: #333;">
        
            <tr>
                <th style="min-width: 70px;"> <?= __d('students', 'Action') ?> </th>
                <th style="min-width: 70px;"><?= __d('students', 'SID') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 70px;"><?= __d('students', 'Photo') ?></th>
                <th style="min-width: 70px;"><?= __d('students', 'Name') ?> <span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 70px;"><?= __d('students', 'Class') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 100px;"><?= __d('students', 'Section') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 70px;"><?= __d('students', 'Roll') ?><span class="sort-arrow fa fa-sort" > </span></th>
                <th style="min-width: 150px;"><?= __d('students', 'Resident Status') ?> <span class="sort-arrow fa fa-sort"></th>
                <th style="min-width: 90px;"><?= __d('students', 'Gender') ?> <span class="sort-arrow fa fa-sort"></th>
                <th style="min-width: 170px;"><?= __d('students', 'Religion Subject') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 150px;"><?= __d('students', 'Present Address') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 160px;"><?= __d('students', 'Contact Number') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 80px;"><?= __d('students', 'Group') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 120px;"><?= __d('students', '3rd Subject') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 120px;"><?= __d('students', '4th Subject') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 70px;"><?= __d('students', 'DOB') ?><span class="sort-arrow fa fa-sort"></span></th>
                <th style="min-width: 70px;"><?= __d('students', 'Status') ?><span class="sort-arrow fa fa-sort"></span></th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td class="text-center">
                    <div style="display: grid; grid-auto-flow: column; gap: 8px; justify-content: center;">
                        <?= $this->Html->link('<i class="fa fa-pencil-alt text-white"></i>', ['action' => 'edit', $student['student_id']], [
                            'class' => 'btn btn-sm btn-warning',
                            'escape' => false
                        ]) ?>
                        <?= $this->Html->link('<i class="fa fa-print text-white"></i>', ['action' => 'print', $student['student_id']], [
                            'class' => 'btn btn-sm btn-info',
                            'escape' => false
                        ]) ?>
                    </div>
                    </td>

                    <td><?= h($student['sid']) ?></td>
                    <td class="text-center">
                        <?= $this->Html->image('/webroot/uploads/students/thumbnail/' . $student['thumbnail'], ['class' => 'rounded-circle', 'style' => 'width:40px; height:40px; object-fit:cover;']) ?>
                    </td>
                    <td><?= h($student['name']) ?></td>
                    <td><?= h($student['level_name']) ?></td>
                    <td><?= h($student['section_name']) ?></td>
                    <td><?= h($student['roll']) ?></td>
                    <td><?= $student['resedential'] ? 'Resident' : 'Non-Resident' ?></td>
                    <td><?= h($student['gender']) ?></td>
                    <td><?= h($student['religion_subject']) ?></td>
                    <td><?= h($student['present_address']) ?></td>
                    <td><?= h($student['mobile']) ?></td>
                    <td><?= h($student['group_name']) ?></td>
                    <td><?= h($student['thrid_subject_name']) ?></td>
                    <td><?= h($student['forth_subject_name']) ?></td>
                    <td><?= h($student['date_of_birth']) ?></td>
                    <td>
                        <span class="badge <?= $student['status'] ? 'bg-success' : 'bg-danger' ?>">
                            <?= $student['status'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
</table>
</div>

                </div>
            </div>
        </div>


    <?php  } ?>





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

    function confirmDelete() {
        return confirm("Are you sure you want to delete this file?");
    }
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('studentTable');
    if (!table) return;

    const headers = table.querySelectorAll('thead th');
    const tbody = table.tBodies[0];
    let sortDirection = Array(headers.length).fill(null);

    headers.forEach((header, index) => {
      header.addEventListener('click', () => {
        // Determine new direction
        const isAsc = sortDirection[index] !== 'asc';
        sortDirection.fill(null);
        sortDirection[index] = isAsc ? 'asc' : 'desc';

        // Sort rows
        const rows = Array.from(tbody.rows);
        rows.sort((a, b) => {
          let cellA = a.cells[index].innerText.trim().toLowerCase();
          let cellB = b.cells[index].innerText.trim().toLowerCase();

          // Try numeric sort if possible
          const numA = parseFloat(cellA);
          const numB = parseFloat(cellB);

          if (!isNaN(numA) && !isNaN(numB)) {
            return isAsc ? numA - numB : numB - numA;
          } else {
            return isAsc ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
          }
        });

        // Append sorted rows
        rows.forEach(row => tbody.appendChild(row));

        // Update active arrow classes
        headers.forEach((h, i) => {
          h.classList.remove('active-asc', 'active-desc');
          if (i === index) {
            h.classList.add(isAsc ? 'active-asc' : 'active-desc');
          }
        });
      });
    });
  });
</script>


<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
  rel="stylesheet"
/>


<style>
     #studentTable th,
    #studentTable td {
        /* text-align: center; */
        vertical-align: middle;
    }


  thead th,
  tbody td {
    /* text-align: center;              Horizontally center */
    vertical-align: middle;         /* Vertically center */
    position: relative;             /* Needed for sort icons */
    padding: 10px;
  }

  /* Sort icon base style */
  .sort-arrow {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    color: #ccc;
    opacity: 1.8;
    pointer-events: none;
    
  }

  /* Hover effect */
  thead th:hover .sort-arrow {
    color: #333;
    opacity: 1;
  }

  /* Active sort direction: Ascending */
  thead th.active-asc .sort-arrow::before {
    content: "\f0de"; /* FontAwesome fa-sort-up */
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    color: #000;
  }

  /* Active sort direction: Descending */
  thead th.active-desc .sort-arrow::before {
    content: "\f0dd"; /* FontAwesome fa-sort-down */
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    color: #000;
  }

  /* Default neutral sort icon */
  thead th .sort-arrow::before {
    content: "\f0dc"; /* FontAwesome fa-sort */
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
  }


</style>

<script>
function printStudentTable() {
    const originalContents = document.body.innerHTML;
    const tableContents = document.querySelector('.table-responsive').outerHTML;

    const printWindow = window.open('', '', 'height=600,width=900');
    printWindow.document.write('<html><head><title><?= __('Print Students Table') ?></title>');
    printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">');
    printWindow.document.write('<style>th, td { text-align: center; vertical-align: middle; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h3 class="text-center"><?= __('Students List') ?></h3>');
    printWindow.document.write(tableContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>
<!-- <script>
function printStudentTable() {
    const originalContents = document.body.innerHTML;
    const tableContents = document.querySelector('.table-responsive').outerHTML;

    document.body.innerHTML = `
        <html>
        <head>
            <title>Print Students Table</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <style>
                th, td { text-align: center; vertical-align: middle; }
                table { width: 100%; border-collapse: collapse; }
            </style>
        </head>
        <body>
            <h3 class="text-center">Students List</h3>
            ${tableContents}
        </body>
        </html>
    `;

    window.print();

    // Restore original content after print
    setTimeout(() => {
        document.body.innerHTML = originalContents;
        location.reload(); // To restore event listeners, scripts, etc.
    }, 100);
}
</script> -->
