<?php

namespace Croogo\Dashboards\Controller\Admin;

use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use DateTime;
use DateTimeZone;

/**
 * Dashboards Controller
 *
 * @category Controller
 * @package  Croogo.Dashboards.Controller
 * @version  2.2
 * @author   Walther Lalk <emailme@waltherlalk.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class DashboardsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if ($event->getSubject()->request->getParam('action') === 'save') {
            $this->components()->unload('Security');
        }
    }

    /**
     * {@inheritDoc}
     *
     * Load the dashboards helper
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        $this->viewBuilder()->setHelpers([
            'Croogo/Dashboards.Dashboards',
        ]);
    }

    /**
     * Dashboard index
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Dashboards->find()
            ->where([
                'user_id' => $this->Auth->user('id')
            ])
            ->order(['column' => 'asc', 'weight' => 'asc']);
        $dashboards = $this->paginate($query);

        $this->set(compact('dashboards'));
    }

    /**
     * Admin dashboard
     *
     * @return void
     */
    public function dashboard()
    {
        $boxesForDashboard = $this->Dashboards->find('all')->select([
            'id',
            'alias',
            'collapsed',
            'status',
            'column',
            'weight',
        ])->where([
            'user_id' => $this->Auth->user('id'),
        ])->order([
            'weight',
        ]);
        $this->set('boxes_for_dashboard', $boxesForDashboard);


        $setting = TableRegistry::getTableLocator()->get('settings');
        $settings = $setting
            ->find()
            ->where(['`key`' => 'Site.selectedSession'])
            ->toArray();
        $selectedSessionsArray = json_decode($settings[0]['value']);
        
        ## For students_log @shovon 9/4/2024 //start
        $studentsTable = TableRegistry::getTableLocator()->get('scms_students');
        $total_Students = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();

        $timezone = new DateTimeZone('Asia/Dhaka'); // Replace with timezone
        $now = new DateTime('now', $timezone);
        $formattedDate = $now->format('Y-m-d H:i:s');


        $data['total_students'] = $total_Students;
        $data['date'] = $formattedDate;

        $today = $now->format('Y-m-d');

        $studentLog = TableRegistry::getTableLocator()->get('students_log');

        $existingRecord = $studentLog
            ->find()
            ->where(['DATE(date)' => $today])
            ->first();

        if ($existingRecord) {
            // Record exists, you might decide to do nothing or update
            // Optionally update if necessary
            // $query = $studentLog->query();
            // $query->update()
            //     ->set($data)
            //     ->where(['id' => $existingRecord->id])
            //     ->execute();
            // For now, do nothing
        } else {
            // No record exists, perform an insert
            $query = $studentLog->query();
            $query->insert(array_keys($data))
                ->values($data)
                ->execute();
        }
        ##End


        // CUSTOM DASHBOARD STATISTICS FOR DASHBOARD @SHIHAB
        ##GenderWise
        $studentsTable = TableRegistry::getTableLocator()->get('scms_students');
        $totalStudents = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();

        $maleCount = $studentsTable
            ->find()
            ->where(['gender' => 'Male'])
            ->where(['status' => 1])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();

        $femaleCount = $studentsTable
            ->find()
            ->where(['gender' => 'Female'])
            ->where(['status' => 1])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();
        $genders = [
            'Total' => $totalStudents,
            'Male' => $maleCount,
            'Female' => $femaleCount,
        ];

        $genderStats = json_encode($genders); ##SHowing the values only
        $this->set('genderStats', $genderStats);


        ##Statistics By Religion
        $IslamCount = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['religion' => 'Islam'])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();
        $hinduCount = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['religion' => 'Hindu'])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();
        $christianCount = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['religion' => 'Christian'])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();
        $othersCount = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['religion' => 'Others'])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();

        $religion = [
            'Islam' => $IslamCount,
            'Hindu' => $hinduCount,
            'Christian' => $christianCount,
            'Buddhist' => $othersCount,
        ];
        // $religionCounts = implode(',', $religion); ##SHowing the values only
        $religionCounts = json_encode($religion); ##SHowing the values only
        $this->set('religionCounts', $religionCounts);


        ## Statistics by Group
        $students = $studentsTable
            ->find()
            ->select([
                // 'node_title' => 'N.title',
                'group' => 'sc.group_id'
            ])
            ->join([
                'sc' => [
                    'table' => 'scms_student_cycle',
                    'type' => 'LEFT',
                    'conditions' => ['sc.student_id = scms_students.student_id'],
                ]
            ])
            ->where(['status' => 1])
            ->where(['scms_students.session_id IN' => $selectedSessionsArray])
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();

        $this->set('Students', $students);

        $countSc = $countHm = $countCm = 0;
        foreach ($students as $student) {
            if ($student['group'] == 1) {
                $countSc++;
            } elseif ($student['group'] == 2) {
                $countHm++;
            } elseif ($student['group'] == 3) {
                $countCm++;
            }
        }

        $groups = [
            'Science' => $countSc,
            'Humanities' => $countHm,
            'Commerce' => $countCm,
        ];
        $groupCounts = json_encode($groups); ##SHowing the values only
        $this->set('groupCounts', $groupCounts);

        ##Statistics by Quota
        $countFF = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['freedom_fighter' => 'Yes'])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();
        $countTb = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['tribal' => 'Yes'])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();
        $countDs = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['disabled' => 'Yes'])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();
        $countOp = $studentsTable
            ->find()
            ->where(['status' => 1])
            ->where(['orphan' => 'Yes'])
            ->where(['session_id IN' => $selectedSessionsArray])
            ->count();

        $quota = [
            'Freedom Fighter' => $countFF,
            'Tribal' => $countTb,
            'Disabled' => $countDs,
            'Orphan' => $countOp,
        ];
        $quotaCounts = json_encode($quota); ##SHowing the values only
        $this->set('quotaCounts', $quotaCounts);




        ### ATTENDANCE SUMMARY STATISTICS FOR DASHBOARD @SHIHAB
        $studentAttendanceTable = TableRegistry::getTableLocator()->get('scms_attendance');
        $studentsTable = TableRegistry::getTableLocator()->get('scms_students');
        $levelTable = TableRegistry::getTableLocator()->get('scms_levels');
        $levels = $levelTable->find()->toArray();

        $attendanceCount = [];
        $studentCount = [];

        $date = date('Y-m-d');

        foreach ($levels as $key => $level) {
            $classTotal = $studentsTable
                ->find()
                ->join([
                    's' => [
                        'table' => 'scms_student_cycle',
                        'type' => 'LEFT',
                        'conditions' => ['s.student_id = scms_students.student_id'],
                    ],
                ])
                ->where(['status' => 1])
                ->where(['scms_students.session_id IN' => $selectedSessionsArray])
                ->where(['s.level_id' => $level->level_id])
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->count();

            $studentCount[$level->level_name] = $classTotal;
            $studentAttendance = $studentAttendanceTable
                ->find()
                ->where(['date' => $date])
                ->where(['scms_student_cycle.level_id' => $level->level_id])
                ->select([
                    'level_id' => 'scms_student_cycle.level_id',
                ])
                ->join([
                    'scms_student_cycle' => [
                        'table' => 'scms_student_cycle',
                        'type' => 'LEFT',
                        'conditions' => ['scms_student_cycle.student_cycle_id = scms_attendance.student_cycle_id'],
                    ]
                ])
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->count();
            $attendanceCount[$level->level_name] = $studentAttendance;
            if ($classTotal == 0) {
                unset($attendanceCount[$level->level_name]);
                unset($studentCount[$level->level_name]);
            }
        }
        $classWiseTotal = json_encode($studentCount);
        $this->set('classWiseTotal', $classWiseTotal);

        $presentPerClass = json_encode($attendanceCount);
        $this->set('presentPerClass', $presentPerClass);



        $firstDayOfMonth = date('Y-m-01');
        $lastDayOfMonth = date('Y-m-t');

        $query = $studentAttendanceTable->find();
        $query
            ->select([
                'date',
                'count' => $query->func()->count('*')
            ])
            ->where([
                'date >=' => $firstDayOfMonth,
                'date <=' => $lastDayOfMonth
            ])
            ->group('date')
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->count();
        $results = $query->toArray();


        // Create an associative array to hold the results, initialized with zeros for all days of the month
        $attendanceData = [];
        $currentDate = strtotime($firstDayOfMonth);

        while ($currentDate <= strtotime($lastDayOfMonth)) {
            $dateString = date('Y-m-d', $currentDate);
            $attendanceData[$dateString] = 0;
            $currentDate = strtotime('+1 day', $currentDate);
        }


        // Fill in the actual attendance counts from the query results
        foreach ($results as $result) {
            $date = $result['date']->format('Y-m-d'); // Convert the DateTime object to a string in the desired format
            $count = $result['count'];

            // Update the attendance count for the corresponding date in the $attendanceData array
            if (isset($attendanceData[$date])) {
                $attendanceData[$date] = $count;
            }
        }

        $monthlyAttendance = json_encode($attendanceData);
        $this->set('monthlyAttendance', $monthlyAttendance);



        ###QUICK LINK MANAGEMENT BOXES
        $buttonsTable = TableRegistry::getTableLocator()->get('cms_quicklink');
        $buttons = $buttonsTable->find()
            ->order(['button_order' => 'ASC'])
            ->toArray();

        // numeric sort order to the existing query result
        usort($buttons, function ($a, $b) {
            return $a->button_order - $b->button_order;
        });
        $this->set('buttons', $buttons);

        ###VIEW DETAILS STUDENT STATISTICS

        $shiftsTable = TableRegistry::getTableLocator()->get('hr_shift');
        $shifts = $shiftsTable->find()->toArray();
        $sectionsTable = TableRegistry::getTableLocator()->get('scms_sections');
        $sections = $sectionsTable->find()->toArray();

        // Initialize an empty array to store student counts for each class, shift, section, gender, and religion
        $studentCounts = [];
        $classCounts = [];
        foreach ($levels as $level) {
            foreach ($shifts as $shift) {
                foreach ($sections as $section) {
                    // Initialize an empty array to store counts for each gender, religion, group, and quota
                    $ReligionCount = [];
                    $genderCount = [];
                    $groupsCount = []; // Initialize group count array

                    $quotaCount = [
                        'freedom_fighter' => 0,
                        'tribal' => 0,
                        'orphan' => 0,
                        'disabled' => 0,
                    ];

                    $classKey = "{$level->level_name}_{$shift->shift_name}";
                    if (!isset($classCounts[$classKey])) {
                        $classCounts[$classKey] = 0;
                    }

                    $classCounts[$classKey] += 1;

                    // Count students based on gender, religion, group, and quota
                    $classTotal = $studentsTable
                        ->find()
                        ->select([
                            'gender',
                            'religion',
                            'group_name' => 'g.group_name', // Include group name
                            'freedom_fighter',
                            'tribal',
                            'orphan',
                            'disabled',
                            'count' => $studentsTable->query()->func()->count('*'),
                        ])
                        ->join([
                            's' => [
                                'table' => 'scms_student_cycle',
                                'type' => 'LEFT',
                                'conditions' => ['s.student_id = scms_students.student_id'],
                            ],
                        ])
                        ->join([
                            'g' => [
                                'table' => 'scms_groups',
                                'type' => 'LEFT',
                                'conditions' => ['g.group_id = s.group_id'],
                            ],
                        ])
                        ->where(['status' => 1])
                        ->where(['scms_students.session_id IN' => $selectedSessionsArray])
                        ->where(['s.level_id' => $level->level_id])
                        ->where(['s.shift_id' => $shift->shift_id])
                        ->where(['s.section_id' => $section->section_id])
                        ->group(['gender', 'religion', 'freedom_fighter', 'tribal', 'orphan', 'disabled', 'group_name'])
                        ->enableAutoFields(true)
                        ->enableHydration(false)
                        ->toArray();



                    // Calculate and store gender, religion, group, and quota counts
                    foreach ($classTotal as $row) {
                        if ($row['gender'] != null) {
                            $genderCount[$row['gender']] = isset($genderCount[$row['gender']]) ?
                                $genderCount[$row['gender']] + $row['count'] : $row['count'];
                        }


                        if ($row['religion'] != null) {
                            $ReligionCount[$row['religion']] = isset($ReligionCount[$row['religion']]) ?
                                $ReligionCount[$row['religion']] + $row['count'] : $row['count'];
                        }

                        // Calculate and store quota counts
                        if ($row['freedom_fighter'] != null) {
                            $quotaCount['freedom_fighter'] += ($row['freedom_fighter'] === 'Yes') ? 1 : 0;
                            $quotaCount['tribal'] += ($row['tribal'] === 'Yes') ? 1 : 0;
                            $quotaCount['orphan'] += ($row['orphan'] === 'Yes') ? 1 : 0;
                            $quotaCount['disabled'] += ($row['disabled'] === 'Yes') ? 1 : 0;
                        }
                        // Calculate and store group counts
                        if ($row['group_name'] != null) {
                            $groupsCount[$row['group_name']] = isset($groupsCount[$row['group_name']]) ?
                                $groupsCount[$row['group_name']] + $row['count'] : $row['count'];
                        }
                    }
                    $perClass = $studentsTable
                        ->find()
                        ->join([
                            's' => [
                                'table' => 'scms_student_cycle',
                                'type' => 'LEFT',
                                'conditions' => ['s.student_id = scms_students.student_id'],
                            ],
                        ])
                        ->where(['status' => 1])
                        ->where(['scms_students.session_id IN' => $selectedSessionsArray])
                        ->where(['s.level_id' => $level->level_id])
                        ->enableAutoFields(true)
                        ->enableHydration(false)
                        ->count();
                    $perClassCount[$level->level_name] = $perClass;


                    $perSection = $studentsTable
                        ->find()
                        ->join([
                            's' => [
                                'table' => 'scms_student_cycle',
                                'type' => 'LEFT',
                                'conditions' => ['s.student_id = scms_students.student_id'],
                            ],
                        ])
                        ->where(['status' => 1])
                        ->where(['scms_students.session_id IN' => $selectedSessionsArray])
                        ->where(['s.section_id' => $section->section_id])
                        ->enableAutoFields(true)
                        ->enableHydration(false)
                        ->count();
                    $perSectionCount[$section->section_name] = $perSection;


                    // Store the combined counts for gender, religion, and quota
                    if (!empty($genderCount) && !empty($ReligionCount)) {
                        $studentCounts[$level->level_name][$shift->shift_name][$section->section_name]['class_total'] = $perClassCount[$level->level_name];
                        $studentCounts[$level->level_name][$shift->shift_name][$section->section_name]['gender'] = $genderCount;
                        $studentCounts[$level->level_name][$shift->shift_name][$section->section_name]['religion'] = $ReligionCount;
                        $studentCounts[$level->level_name][$shift->shift_name][$section->section_name]['quota'] = $quotaCount;
                        $studentCounts[$level->level_name][$shift->shift_name][$section->section_name]['group'] = $groupsCount;
                        $studentCounts[$level->level_name][$shift->shift_name][$section->section_name]['section_total'] = $perSectionCount[$section->section_name];
                    }
                }
            }
        }
        $this->set('studentCounts', $studentCounts);



        ### ACCOUNTS STATISTICS FOR DASHBOARD @SHIHAB
        $banksTable = TableRegistry::getTableLocator()->get('acc_banks');
        $banks = $banksTable
            ->find()
            ->order([
                'bank_balance' => 'ASC',
            ])
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();

        $bankBalance = [];
        $totalBalance = 0; // Initialize total balance

        foreach ($banks as $bank) {
            $bankBalance[$bank['bank_name']] = $bank['bank_balance'];
            $totalBalance += $bank['bank_balance']; // Accumulate total balance
        }
        $bankBalance['Total'] = $totalBalance; // Assign total balance to 'Total' key
        $bankBalance = json_encode($bankBalance); // Showing the values only
        $this->set('banks', $bankBalance);




        // ALL TIME TOTAL STATISTICS
        $voucherTable = TableRegistry::getTableLocator()->get('acc_vouchers');
        $vouchers = $voucherTable
            ->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();

        $totalAmount = 0;
        $totalPayment = 0;

        foreach ($vouchers as $voucher) {
            $totalAmount += $voucher['amount'];
            $totalPayment += $voucher['payment_amount'];
        }

        $totalDue = $totalAmount - $totalPayment;

        $totalsArray = [
            "Total Billed" => $totalAmount,
            "Total Paid" => $totalPayment,
            "Due" => $totalDue,
        ];

        $totalsArray = json_encode($totalsArray); ##SHowing the values only
        $this->set('amounts', $totalsArray);



        //Daily TOTAL STATISTICS
        $todayVouchers = $voucherTable
            ->find()
            ->where([
                'DATE(create_date)' => date('Y-m-d')
            ])
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();

        $totalAmountDay = 0;
        $totalPaymentDay = 0;

        foreach ($todayVouchers  as $tvoucher) {
            $totalAmountDay += $tvoucher['amount'];
            $totalPaymentDay += $tvoucher['payment_amount'];
        }

        $totalDueDay = $totalAmountDay - $totalPaymentDay;

        $totalDaysArray = [
            "Total Billed" => $totalAmountDay,
            "Total Paid" => $totalPaymentDay,
            "Due" => $totalDueDay,
        ];
        $totalDaysArray = json_encode($totalDaysArray); ##SHowing the values only
        $this->set('dailyAmounts', $totalDaysArray);



        // Get the first and last day of the current month
        $firstDayOfMonth = date('Y-m-01');
        $lastDayOfMonth = date('Y-m-t');

        // Fetch vouchers created within the current month
        $currentMonthVouchers = $voucherTable
            ->find()
            ->where(function ($exp) use ($firstDayOfMonth, $lastDayOfMonth) {
                return $exp->between('create_date', $firstDayOfMonth, $lastDayOfMonth);
            })
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();

        // Initialize variables to hold totals
        $totalAmountMonth = 0;
        $totalPaymentMonth = 0;

        // Loop through vouchers to calculate totals for the month
        foreach ($currentMonthVouchers as $voucher) {
            $totalAmountMonth += $voucher['amount'];
            $totalPaymentMonth += $voucher['payment_amount'];
        }

        // Calculate total due for the month
        $totalDueMonth = $totalAmountMonth - $totalPaymentMonth;

        // Create an array with the totals for the month
        $totalMonthArray = [
            "Total Billed" => $totalAmountMonth,
            "Total Paid" => $totalPaymentMonth,
            "Due" => $totalDueMonth,
        ];

        // Convert the array to JSON if needed
        $totalMonthArray = json_encode($totalMonthArray);

        // Set the statistics data for the current month
        $this->set('monthlyAmounts', $totalMonthArray);


        $voucherTable = TableRegistry::getTableLocator()->get('acc_vouchers');
        $query = $voucherTable->find()
            ->select([
                'level_id',
                'level_name' => 'lvl.level_name',
                'total_amount' => $query->func()->sum('amount'),
                'total_payment' => $query->func()->sum('payment_amount')
            ])
            ->where(['deleted' => 0])
            ->group(['acc_vouchers.level_id'])
            ->join([
                'lvl' => [
                    'table' => 'scms_levels',
                    'type' => 'LEFT',
                    'conditions' => ['lvl.level_id = acc_vouchers.level_id'],
                ]
            ]);

        $vouchers = $query->toArray();

        $totalBilled = [];
        $totalPaid = [];

        foreach ($vouchers as $voucher) {
            $levelId = $voucher['level_name'];
            $totalAmount = $voucher['total_amount'] ?: 0;
            $totalPayment = $voucher['total_payment'] ?: 0;
            $totalDue = $totalAmount - $totalPayment;

            $totalBilled[$levelId] = $totalAmount;
            $totalPaid[$levelId] = $totalPayment;
        }
        $totalBilled = json_encode($totalBilled);
        $this->set('totalBilled', $totalBilled);

        $totalPaid = json_encode($totalPaid);
        $this->set('totalPaid', $totalPaid);
    }

    /**
     * Saves dashboard setting
     *
     * @throws \Cake\Core\Exception\Exception
     * @return void
     */
    public function save()
    {
        $userId = $this->Auth->user('id');
        if (!$userId) {
            throw new Exception('You must be logged in');
        }
        $data = Hash::insert($this->getRequest()->data['dashboard'], '{n}.user_id', $userId);
        $dashboardIds = array_filter(Hash::extract($data, '{n}.id'));
        $query = $this->Dashboards->find();
        if ($dashboardIds) {
            $query->where(['id IN' => $dashboardIds]);
        }
        $entities = $query->toArray();
        $patched = $this->Dashboards->patchEntities($entities, $data);
        $this->Dashboards->connection()->getDriver()->enableAutoQuoting();
        $results = $this->Dashboards->saveMany($patched);
        $this->set(compact('results'));
        $this->set('_serialize', 'results');
    }

    /**
     * Delete a dashboard
     *
     * @param int $id Dashboard id
     * @return \Cake\Http\Response|void
     */
    public function delete($id = null)
    {
        if (!$id) {
            $this->Flash->error(__d('croogo', 'Invalid id for Dashboard'));

            return $this->redirect(['action' => 'index']);
        }
        $entity = $this->Dashboards->get($id);
        if ($this->Dashboards->delete($entity)) {
            $this->Flash->success(__d('croogo', 'Dashboard deleted'));

            return $this->redirect($this->referer());
        }
    }

    /**
     * Toggle dashboard status
     *
     * @param int $id Dashboard id
     * @param int $status Status
     * @return void
     */
    public function toggle($id = null, $status = null)
    {
        $this->Croogo->fieldToggle($this->Dashboards, $id, $status);
    }

    /**
     * Admin moveup
     *
     * @param int $id Dashboard Id
     * @param int $step Step
     * @return \Cake\Http\Response|void
     */
    public function moveup($id, $step = 1)
    {
        $dashboard = $this->Dashboards->get($id);
        $dashboard->weight = $dashboard->weight - $step;
        if ($this->Dashboards->save($dashboard)) {
            $this->Flash->success(__d('croogo', 'Moved up successfully'));
        } else {
            $this->Flash->error(__d('croogo', 'Could not move up'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Admin movedown
     *
     * @param int $id Dashboard Id
     * @param int $step Step
     * @return \Cake\Http\Response|void
     */
    public function movedown($id, $step = 1)
    {
        $dashboard = $this->Dashboards->get($id);
        $dashboard->weight = $dashboard->weight + $step;
        if ($this->Dashboards->save($dashboard)) {
            $this->Flash->success(__d('croogo', 'Moved down successfully'));
        } else {
            $this->Flash->error(__d('croogo', 'Could not move down'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
