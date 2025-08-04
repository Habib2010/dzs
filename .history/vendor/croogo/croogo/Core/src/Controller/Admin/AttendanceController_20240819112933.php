<?php

namespace Croogo\Core\Controller\Admin;

use Cake\I18n\I18n;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use DateTime;

I18n::setLocale('jp_JP');

class AttendanceController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function index() {
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            if (isset($request_data['user_id'])) {
                if ($this->save_attendance($request_data)) {
                    $this->save_attendance_log($request_data);
                    if (isset($request_data['sms']) && $request_data['sms']) {
                        $absent = $this->sms($request_data);
                        $message = 'Successfully Save Attendance and ' . $absent . ' Absent SMS sent';
                    } else {
                        $message = 'Successfully Save Attendance';
                    }
                    $this->Flash->success($message, [
                        'key' => 'positive',
                        'params' => [],
                    ]);
                } else {
                    $this->Flash->error('Error, Attendance Saving Failed', [
                        'key' => 'negative',
                        'params' => [],
                    ]);
                    unset($request_data);
                }
                $this->redirect(['action' => 'index']);
            } else {
                $students = $this->search_student($request_data); //search student for attendance
                $this->set('students', $students);
                if (!isset($request_data['courses_cycle_id'])) {
                    $request_data['courses_cycle_id'] = null;
                }
                $data = $request_data;
                $data['user_id'] = $this->Auth->user('id');
                $this->set('data', $data);
            }
        }

        $session = TableRegistry::getTableLocator()->get('scms_sessions');
        $sessions = $session
                ->find()
                ->toArray();
        $this->set('sessions', $sessions);

        $levels = $this->get_levels();
        $this->set('levels', $levels);
        $group = TableRegistry::getTableLocator()->get('scms_groups');
        $groups = $group
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->toArray();
        $this->set('groups', $groups);
        $shift = TableRegistry::getTableLocator()->get('hr_shift');
        $shifts = $shift
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->toArray();
        $this->set('shifts', $shifts);
         $attendance_type = $this->get_settings_value('Attendance.Type');
         $this->set('attendance_type', $attendance_type);
    }
    
    
    public function add()
    {

        if (!empty($this->request->data)) {
            $request_data = $this->request->getData();
            $attendance_reports = TableRegistry::getTableLocator()->get('attendance_reports');
            $query = $attendance_reports->query();
            $query
                ->insert(['inn', 'outt', 'statuss', 'color'])
                ->values($request_data)
                ->execute();

            $this->Flash->info('Status has been saved Successfully!', [
                'key' => 'positive',
                'params' => [],
            ]);

            return $this->redirect(['action' => 'listOfAttendanceReports']);
        }
        $attendanceDateinput = TableRegistry::getTableLocator()->get('attendance_reports');
        $attendanceDateinputs = $attendanceDateinput
            ->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->order(['attendance_reports.inn' => 'ASC'])
            ->toArray();
        $this->set('attendanceDateinputs', $attendanceDateinputs);
    }

    public function edit($id)
    {
        if ($this->request->is(['post'])) {
            $datas = TableRegistry::getTableLocator()->get('attendance_reports');
            $query = $datas->query();
            $query
                ->update()
                ->set($this->request->getData())
                ->where(['id' => $id])
                ->execute();

            //Set Flash
            $this->Flash->info('Status Updated Successfully', [
                'key' => 'positive',
                'params' => [],
            ]);
            return $this->redirect(['action' => 'listOfAttendanceReports']);
        }

        $request_data = TableRegistry::getTableLocator()->get('attendance_reports'); //Execute First
        $get_datas = $request_data
            ->find()
            ->where(['id' => $id])
            ->toArray();
        $this->set('get_datas', $get_datas);
    }

    public function delete($id)
    {
        if ($this->request->is(['post'])) {
            $datas = TableRegistry::getTableLocator()->get('attendance_reports');
            $query = $datas->query();
            $query
                ->delete()
                ->where(['id' => $id])
                ->execute();
            //Set Flash
            $this->Flash->error('Status Deleted Successfully', [
                'key' => 'positive',
                'params' => [],
            ]);
            return $this->redirect(['action' => 'listOfAttendanceReports']);
        }


        $request_data = TableRegistry::getTableLocator()->get('attendance_reports'); //Execute First
        $get_datas = $request_data
            ->find()
            ->where(['id' => $id])
            ->toArray();
        $this->set('get_datas', $get_datas);
    }

    public function listOfAttendanceReports()
    {
        $data = TableRegistry::getTableLocator()->get('attendance_reports');
        $list = $data->find();
        $paginate = $this->paginate($list, ['limit' => $this->Paginate_limit]);
        $paginate = $paginate->toArray();
        $this->set('lists', $paginate);
    }

    public function importTeacherAttendance($fileName = null, $in_time = null, $out_time = null)
    {

        if (!empty($this->request->data)) {


            $file = $this->request->data['file']['name'];
            $tmpName = $this->request->data['file']['tmp_name'];
            $in_time = date("G:i", strtotime($this->request->data['start']));
            $out_time = date("G:i", strtotime($this->request->data['end']));
            // pr($in_time);
            // pr($out_time);die;
            $ext = substr(strrchr($file, "."), 1);
            if ($ext == "csv") {
                $fileName = md5(rand() * time()) . ".$ext";
                $UPLOAD = WWW_ROOT . '/uploads/'; // Specify original folder path
                $result = move_uploaded_file($tmpName, $UPLOAD . $fileName);
            } else {
                //$this->Session->setFlash(__('Wrong File. Only "csv"  file extensions are allowed.', true), 'default', ['class' => 'notice']);
                $this->redirect(['action' => 'upload', null]);
            }
        }

        if ($fileName) {
            // pr($fileName);die;
            //            $MAX_POSSIBLE_CSV_ROWS = 1200;
            $STATUS_FILE_NAME = $UPLOAD . DS . 'import-status-report.txt';
            $filePath = $UPLOAD . DS . $fileName;
            $han = fopen($filePath, "r");
            $header = fgetcsv($han);


            if ($header[0] == 'Department' && $header[1] == 'Name') {

                if (($handle = fopen($filePath, "r")) !== false) {
                    //loop through the csv file and insert into database
                    while (($data = fgetcsv($handle, 12000, ",")) !== false) {

                        if ($data[0] == 'Department' && $data[1] == 'Name') {
                            continue;
                        }
                        $datetime = empty($data[3]) ? '' : strtotime(trim($data[3]));
                        $time = date("G:i", $datetime);
                        //			$time = $objTime->format("H:i");
                        //                            $data[0] = empty($data[0]) ? '' : $this->parseDate(trim($data[0])); //date time,
                        $data[0] = empty($data[0]) ? '' : addslashes(trim($data[0])); // Designation
                        $data[1] = empty($data[1]) ? '' : addslashes(trim(str_replace(chr(160), " ", $data[1]))); // name,
                        $data[2] = empty($data[2]) ? '' : addslashes(trim($data[2])); //Id, 
                        $data[3] = empty($data[3]) ? '' : addslashes(trim($data[3])); //date time, 
                        $data[4] = empty($data[4]) ? '' : addslashes(trim($data[4])); //location Id,        
                        $data[5] = empty($data[5]) ? '' : addslashes(trim($data[5])); //Id Number,                            
                        $data[6] = empty($data[6]) ? '' : addslashes(trim($data[6])); //Verify code,                            
                        $data[7] = empty($data[7]) ? '' : addslashes(trim($data[7])); //card no

                        if (!empty($data[2]) && !empty($data[3])) {
                            $day = date("j", strtotime($data[3]));
                            $teachers[] = array(
                                'designation' => $data[0],
                                'personnel_id' => $data[2],
                                'day' => $day,
                                'date' => $data[3],
                                'time' => $time,
                                'datetime' => $datetime,
                                'name' => $data[1],
                                //                                'status' => '',
                            );
                        }
                    }
                    // pr($teachers);
                    // die;

                    // if ($data == false)
                    //     echo PHP_EOL . PHP_EOL . "<br>====THE END :: (SUCCESS)====" . PHP_EOL . PHP_EOL;
                    fclose($handle);
                }
                $chk_in = new DateTime($in_time);
                $chk_out = new DateTime($out_time);
                // pr($chk_in);
                // pr($chk_out);die;
                $previousId = $previousDay = '';
                $count = 1;
                foreach ($teachers as $key => $teacher) {
                    $chk = date("g:i A", strtotime($teacher['time']));
                    $chktime = new DateTime($teacher['time']);
                    if ($chk_in >= $chktime) {
                        $diff = $chk_in->diff($chktime);
                        $interval = $diff->format("%H:%i");
                        $status = 'In ' . $chk . ' ' . $interval . ' Min Early';
                        $css = 'check_green';
                    } else {
                        $diff = $chktime->diff($chk_in);
                        $interval = $diff->format("%H:%i");
                        $status = 'In ' . $chk . ' ' . $interval . ' Min Late';
                        $css = 'check_red';
                    }
                    $teachers[$key]['status'] = $status;
                    $teachers[$key]['css'] = $css;
                    if ($teacher['personnel_id'] == $previousId && $teacher['day'] == $previousDay) {
                        $count++;
                        if ($chktime <= $chk_out) {
                            $diff = $chk_out->diff($chktime);
                            $interval = $diff->format("%H:%i");
                            $status = 'Out ' . $chk . ' ' . $interval . ' Min Early';
                            $css = 'check_red';
                        } else {
                            $diff = $chktime->diff($chk_out);
                            $interval = $diff->format("%H:%i");
                            $status = 'Out ' . $chk . ' ' . $interval . ' Min After';
                            $css = 'check_green';
                        }
                        $teachers[$key]['status'] = $status;
                        $teachers[$key]['css'] = $css;

                        if (
                            $count > 2
                        ) {
                            unset($teachers[$key]);
                            $count--;
                        }
                    } else {
                        $count = 1;
                    }
                    $previousId = $teacher['personnel_id'];
                    $previousDay = $teacher['day'];
                    $previoustime = $teacher['datetime'];
                }
                usort($teachers, function ($x, $y) {
                    if ($x['datetime'] == $y['datetime']) {
                        return 0;
                    } else if ($x['datetime'] == '') {
                        return 1;
                    } else if ($y['datetime'] == '') {
                        return -1;
                    }

                    return $x['datetime'] < $y['datetime'] ? -1 : 1;
                });
                $attendances = array();

                foreach ($teachers as $key => $teacher) {
                    $year = date("Y", strtotime($teacher['date']));
                    $month = date("n", strtotime($teacher['date']));
                    $day = date("j", strtotime($teacher['date']));

                    $attendances[$year][$month][$teacher['personnel_id']]['designation'] = $teacher['designation'];
                    $attendances[$year][$month][$teacher['personnel_id']]['name'] = $teacher['name'];
                    $attendances[$year][$month][$teacher['personnel_id']][$day][] = $teacher;
                }
                $attendanceDateinput = TableRegistry::getTableLocator()->get('attendance_reports');
                $attendanceDateinputs = $attendanceDateinput
                    ->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->order(['attendance_reports.inn' => 'ASC'])
                    ->toArray();
                // pr($attendances);die;
                $this->set('attendanceDateinputs', $attendanceDateinputs);
                $this->set('attendances', $attendances);
                $this->autoRender = false;
                $this->layout = 'report';
                $this->render('/reports/teacher_attendance');
                //                $mysqli->close();
                // echo 'DONE !!!';
                // exit();
            } else {
                // $this->Session->setFlash(__('Wrong File, Please Check the header of the file', true), 'default', ['class' => 'notice']);
                // $this->redirect(['action' => 'import', null]);
            }

            // unlink($filePath);
        }
    }


    public function deviceLog() {
        $device_logs = TableRegistry::getTableLocator()->get('device_logs');
        $logs = $device_logs->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->toArray();
        $this->set('logs', $logs);
    }
      private function get_term_cycle_id() {
        $scms_term_cycle = TableRegistry::getTableLocator()->get('scms_term_cycle');
        $term_cycle = $scms_term_cycle
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->toArray();
        $return_data = array();
        foreach ($term_cycle as $term) {
            $return_data[$term['session_id']][$term['level_id']][$term['term_id']] = $term['term_cycle_id'];
        }
        return $return_data;
    }

   /* public function deviceAttendence() {
        if (!empty($this->request->data)) {
            $request_data = $this->request->getData();
            $term_cycle = $this->get_term_cycle_id();
            $live_attendance = $this->send_tipsoi($request_data['date']);
            // echo '<pre>';
            // print_r($live_attendance);die;
            //$live_attendance = $this->send_tipsoi('2023-09-25');
            $rfids = array();
            foreach ($live_attendance['data'] as $attendance) {
                $rfids[] = $attendance['rfid'];
            }
            // echo '<pre>';
            // print_r($rfids);die;
            $device_logs_data['present'] = count(array_unique($rfids));
            $device_logs_data['date'] = $request_data['date'];
            $present_students = array();
            $student = TableRegistry::getTableLocator()->get('scms_students');
            if (count($rfids)) {
                $present_students = $student
                        ->find()
                        ->enableAutoFields(true)
                        ->enableHydration(false)
                        ->where(['scms_students.card_no IN' => $rfids])
                        ->where(['scms_students.status' => 1])
                        ->select([
                            'student_cycle_id' => 'scms_student_cycle.student_cycle_id',
                            'shift_id' => 'scms_student_cycle.shift_id',
                            'section_id' => 'scms_student_cycle.section_id',
                        ])
                        ->join([
                            'scms_student_cycle' => [
                                'table' => 'scms_student_cycle',
                                'type' => 'LEFT',
                                'conditions' => [
                                    'scms_students.student_id  = scms_student_cycle.student_id',
                                    'scms_students.level_id  = scms_student_cycle.level_id',
                                    'scms_students.session_id  = scms_student_cycle.session_id',
                                ],
                            ],
                        ])
                        ->toArray();
            }
            $scms_attendance_data = array();
            $present_student_cycle_ids = array();
            $scms_attendance_data_single['user_id'] = $this->Auth->user('id');
            $scms_attendance_data_single['date'] = $present_sms_data_single['date'] = $request_data['date'];
            foreach ($present_students as $present_student) {
                $scms_attendance_data_single['student_cycle_id'] = $present_student['student_cycle_id'];
                $scms_attendance_data_single['shift_id'] = $present_student['shift_id'];
                $scms_attendance_data_single['level_id'] = $present_student['level_id'];
                $scms_attendance_data_single['section_id'] = $present_student['section_id'];
                $scms_attendance_data_single['term_cycle_id'] = $term_cycle[$present_student['session_id']][$present_student['level_id']][$request_data['term_id']];
                $scms_attendance_data[$present_student['student_cycle_id']] = $scms_attendance_data_single;
                $present_student_cycle_ids[] = $present_student['student_cycle_id'];
            }
            $scms_attendance = TableRegistry::getTableLocator()->get('scms_attendance');
            $save_attendances = $scms_attendance
                    ->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->where(['scms_attendance.date' => $request_data['date']])
                    ->toArray();
            $filter_save_attendances = array();
            foreach ($save_attendances as $key => $save_attendance) {
                if (isset($scms_attendance_data[$save_attendance['student_cycle_id']])) {
                    unset($scms_attendance_data[$save_attendance['student_cycle_id']]);
                    unset($save_attendances[$key]);
                } else {
                    $filter_save_attendances[$save_attendance['student_cycle_id']] = $save_attendance;
                }
            }
            $scms_attendance_data = array_values($scms_attendance_data);
            
            if (count($scms_attendance_data)) {
                $scms_attendance = TableRegistry::getTableLocator()->get('scms_attendance');
                $columns = array_keys($scms_attendance_data[0]);
                $insertQuery = $scms_attendance->query();
                $insertQuery->insert($columns);
// you must always alter the values clause AFTER insert
                $insertQuery->clause('values')->values($scms_attendance_data);
                $insertQuery->execute();
            }

            $absent = 0;
            if (count($rfids)) {
                $where['scms_students.card_no NOT IN'] = $rfids;
            }

            $where['scms_students.status'] = 1;
            $absent_students = $student
                    ->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->where(['scms_students.card_no IS NOT NULL'])
                    ->where($where)
                    ->select([
                        'student_cycle_id' => 'scms_student_cycle.student_cycle_id',
                        'guardian_mobile' => 'scms_guardians.mobile',
                        'rtype' => 'scms_guardians.rtype'
                    ])
                    ->join([
                        'scms_student_cycle' => [
                            'table' => 'scms_student_cycle',
                            'type' => 'INNER',
                            'conditions' => [
                                'scms_students.student_id  = scms_student_cycle.student_id',
                                'scms_students.session_id  = scms_student_cycle.session_id',
                                'scms_students.level_id  = scms_student_cycle.level_id',
                            ],
                        ],
                        'scms_guardians' => [
                            'table' => 'scms_guardians',
                            'type' => 'INNER',
                            'conditions' => [
                                'scms_guardians.student_id  = scms_students.student_id',
                                'scms_guardians.rtype  = scms_students.active_guardian',
                            ]
                        ]
                    ])
                    ->toArray();
                    
            $device_logs_data['absent'] = count($absent_students);
            if (isset($request_data['sms']) && $request_data['sms'] == 1) {
                foreach ($absent_students as $absent_student) {
                    if (isset($filter_save_attendances[$absent_student['student_cycle_id']])) {
                        unset($scms_attendance_data[$absent_student['student_cycle_id']]);
                    } else {
                        $student_data['name'] = $absent_student['name'];
                        $student_data['mobile'] = $absent_student['guardian_mobile'];
                        $filter_absent_student[$absent_student['student_id']] = $student_data;
                    }
                }
                $arrg['students'] = array_values($filter_absent_student);
                $arrg['date'] = date('d-m-Y', strtotime($request_data['date']));
                $numbers = array();
                $type = "absent";
                $absent = $this->send_sms($type, $numbers, $arrg);
                $message = 'Successfully Save Attendance and ' . $absent . ' Absent SMS sent';
            } else {
                $message = 'Successfully Save Attendance';
            }
            $device_logs = TableRegistry::getTableLocator()->get('device_logs');
            $logs = $device_logs->find()
                    ->where(['device_logs.date' => $request_data['date']])
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->toArray();
            if (count($logs)) {
                $query = $device_logs->query();
                $query->update()
                        ->set($device_logs_data)
                        ->where(['id' => $logs[0]['id']])
                        ->execute();
            } else {
                $query = $device_logs->query();
                $query->insert(['date', 'absent', 'present'])
                        ->values($device_logs_data)
                        ->execute();
            }
            $this->Flash->success($message, [
                'key' => 'positive',
                'params' => [],
            ]);
            return $this->redirect(['action' => 'deviceAttendence']);
        }

        $scms_term = TableRegistry::getTableLocator()->get('scms_term');
        $terms = $scms_term->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->toArray();

        $this->set('terms', $terms);
    }
    */
    
    
    public function atdReport()
    {
        $value['date'] = null;
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $date = $request_data['date'];
            $dateTime = new DateTime($date);
            $year = $dateTime->format('Y');

            $session = TableRegistry::getTableLocator()->get('scms_sessions');
            $sessions = $session
            ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['session_name' => $year])
                ->toArray();
            $session_id = $sessions[0]['session_id'];

            $studentAttendanceTable = TableRegistry::getTableLocator()->get('scms_attendance');
            $studentsTable = TableRegistry::getTableLocator()->get('scms_students');
            $levelTable = TableRegistry::getTableLocator()->get('scms_levels');
            $levels = $levelTable->find()->toArray();
            $sectionTable = TableRegistry::getTableLocator()->get('scms_sections');
            $sections = $sectionTable->find()->toArray();
            $shiftTable = TableRegistry::getTableLocator()->get('hr_shift');
            $shifts = $shiftTable->find()->toArray();

            $attendanceData = [];
            foreach ($shifts as $shift) {
                foreach ($levels as $level) {
                    foreach ($sections as $section) {
                        // Skip sections that do not belong to the current level
                        if ($section->level_id != $level->level_id) {
                            continue;
                        }

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
                            ->where(['s.session_id IN' => $session_id])
                            ->where(['s.level_id' => $level->level_id])
                            ->where(['s.section_id' => $section->section_id])
                            ->where(['s.shift_id' => $shift->shift_id])
                            ->enableAutoFields(true)
                            ->enableHydration(false)
                            ->count();

                        // Skip sections that are not present in the database
                        if ($classTotal == 0) {
                            continue;
                        }

                        $presentCount = $studentAttendanceTable
                            ->find()
                            ->where(['date' => $date])
                            ->where(['scms_student_cycle.level_id' => $level->level_id])
                            ->where(['scms_student_cycle.section_id' => $section->section_id])
                            ->where(['scms_student_cycle.shift_id' => $shift->shift_id])
                            ->join([
                                'scms_student_cycle' => [
                                    'table' => 'scms_student_cycle',
                                    'type' => 'LEFT',
                                    'conditions' => ['scms_student_cycle.student_cycle_id = scms_attendance.student_cycle_id'],
                                ],
                                'shifts' => [
                                    'table' => 'hr_shift',
                                    'type' => 'LEFT',
                                    'conditions' => ['shifts.shift_id = scms_student_cycle.shift_id'],
                                ],
                            ])
                            ->enableAutoFields(true)
                            ->enableHydration(false)
                            ->count();

                        $absentCount = $classTotal - $presentCount;

                        $attendanceData[$shift->shift_name][$level->level_name][$section->section_name] = [
                            'present' => $presentCount,
                            'absent' => $absentCount
                        ];
                    }
                }
            }

            // pr($attendanceData);
            // die;
            $this->set('data', $request_data);
            $this->set('students', $attendanceData);
            $value = $request_data;
        }
        $this->set('data', $value);
    }
    
    //------Updated by @shovon 16/7/2024
    public function deviceAttendence()
    {
        if (!empty($this->request->data)) {
            $request_data = $this->request->getData();
            $date = new DateTime($request_data['date']);

            $year = $date->format('Y');
            $term_cycle = $this->get_term_cycle_id();
            $live_attendance = $this->send_tipsoi($request_data['date']);

            $school_session = TableRegistry::getTableLocator()->get('scms_sessions');
            $school_sessions = $school_session
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['session_name' => $year])

                ->toArray();
            $session_id = $school_sessions[0]['session_id'];
            // echo '<pre>';
            // print_r($session_id);die;
            //$live_attendance = $this->send_tipsoi('2023-09-25');
            $rfids = array();
            foreach ($live_attendance['data'] as $attendance) {
                $rfids[] = $attendance['rfid'];
            }
            // echo '<pre>';
            // print_r($rfids);die;
            // $device_logs_data['present'] = count(array_unique($rfids));
            $device_logs_data['date'] = $request_data['date'];
            $present_students = array();
            $student = TableRegistry::getTableLocator()->get('scms_students');
            if (count($rfids)) {
                $present_students = $student
                    ->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->where(['scms_students.card_no IN' => $rfids])
                    ->where(['scms_students.status' => 1])
                    ->where(['scms_student_cycle.session_id' => $session_id])
                    ->select([
                        'student_cycle_id' => 'scms_student_cycle.student_cycle_id',
                        'shift_id' => 'scms_student_cycle.shift_id',
                        'section_id' => 'scms_student_cycle.section_id',
                        'class' => 'scms_levels.level_name'
                    ])
                    ->join([
                        'scms_student_cycle' => [
                            'table' => 'scms_student_cycle',
                            'type' => 'LEFT',
                            'conditions' => [
                                'scms_students.student_id  = scms_student_cycle.student_id',
                                'scms_students.level_id  = scms_student_cycle.level_id',
                                'scms_students.session_id  = scms_student_cycle.session_id',
                            ],
                        ],
                        'scms_levels' => [
                            'table' => 'scms_levels',
                            'type' => 'INNER',
                            'conditions' => [
                                'scms_levels.level_id  = scms_student_cycle.level_id',
                            ]
                        ]
                    ])
                    ->toArray();
            }

            $present_students_count = [];

            foreach ($present_students as $student) {
                $class = $student['class'];

                if (!isset($present_students_count[$class])) {
                    $present_students_count[$class] = [
                        'count' => 0
                    ];
                }

                $present_students_count[$class]['count']++;
            }


            $students = TableRegistry::getTableLocator()->get('scms_student_cycle');
            $total_students = $students
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['scms_student_cycle.session_id' => $session_id])
                ->select([
                    'class' => 'scms_levels.level_name'
                ])
                ->join([
                    'scms_students' => [
                        'table' => 'scms_students',
                        'type' => 'LEFT',
                        'conditions' => [
                            'scms_students.student_id  = scms_student_cycle.student_id'
                        ],
                    ],
                    'scms_students' => [
                        'table' => 'scms_students',
                        'type' => 'LEFT',
                        'conditions' => [
                            'scms_students.student_id  = scms_student_cycle.student_id'
                        ],
                    ],
                    'scms_levels' => [
                        'table' => 'scms_levels',
                        'type' => 'INNER',
                        'conditions' => [
                            'scms_levels.level_id  = scms_student_cycle.level_id',
                        ]
                    ]
                ])
                ->toArray();

            $total_students_count = [];

            foreach ($total_students as $student) {
                $class = $student['class'];

                if (!isset($total_students_count[$class])) {
                    $total_students_count[$class] = [
                        'count' => 0
                    ];
                }

                $total_students_count[$class]['count']++;
            }


            $present_percentage = array();

            foreach ($total_students_count as $class => $total_data) {
                if (isset($present_students_count[$class])) {
                    $total = $total_data["count"];
                    $present = $present_students_count[$class]["count"];
                    // $absent = $total - $present;
                    $percentage_absent = ($present / $total) * 100;
                    $present_percentage[$class] = $percentage_absent;
                }
            }

            $scms_attendance_data = array();
            $present_student_cycle_ids = array();
            $scms_attendance_data_single['user_id'] = $this->Auth->user('id');
            $scms_attendance_data_single['date'] = $present_sms_data_single['date'] = $request_data['date'];
            foreach ($present_students as $present_student) {
                $scms_attendance_data_single['student_cycle_id'] = $present_student['student_cycle_id'];
                $scms_attendance_data_single['shift_id'] = $present_student['shift_id'];
                $scms_attendance_data_single['level_id'] = $present_student['level_id'];
                $scms_attendance_data_single['section_id'] = $present_student['section_id'];
                $scms_attendance_data_single['term_cycle_id'] = $term_cycle[$present_student['session_id']][$present_student['level_id']][$request_data['term_id']];
                $scms_attendance_data[$present_student['student_cycle_id']] = $scms_attendance_data_single;
                $present_student_cycle_ids[] = $present_student['student_cycle_id'];
            }
            $device_logs_data['present'] = count(($present_students));

            $scms_attendance = TableRegistry::getTableLocator()->get('scms_attendance');
            $save_attendances = $scms_attendance
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['scms_attendance.date' => $request_data['date']])
                ->toArray();
            $filter_save_attendances = array();
            foreach ($save_attendances as $key => $save_attendance) {
                if (isset($scms_attendance_data[$save_attendance['student_cycle_id']])) {
                    unset($scms_attendance_data[$save_attendance['student_cycle_id']]);
                    unset($save_attendances[$key]);
                } else {
                    $filter_save_attendances[$save_attendance['student_cycle_id']] = $save_attendance;
                }
            }
            $scms_attendance_data = array_values($scms_attendance_data);


            if (count($scms_attendance_data)) {
                $scms_attendance = TableRegistry::getTableLocator()->get('scms_attendance');
                $columns = array_keys($scms_attendance_data[0]);
                $insertQuery = $scms_attendance->query();
                $insertQuery->insert($columns);
                // you must always alter the values clause AFTER insert
                $insertQuery->clause('values')->values($scms_attendance_data);
                $insertQuery->execute();
            }

            $absent = 0;
            if (count($rfids)) {
                $where['scms_students.card_no NOT IN'] = $rfids;
            }


            $where['scms_students.status'] = 1;
            $students = TableRegistry::getTableLocator()->get('scms_students');
            $absent_students = $students
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['scms_students.card_no IS NOT NULL'])
                ->where($where)
                ->where(['scms_student_cycle.session_id' => $session_id])
                ->select([
                    'student_cycle_id' => 'scms_student_cycle.student_cycle_id',
                    'guardian_mobile' => 'scms_guardians.mobile',
                    'rtype' => 'scms_guardians.rtype',
                    'class' => 'scms_levels.level_name'
                ])
                ->join([
                    'scms_student_cycle' => [
                        'table' => 'scms_student_cycle',
                        'type' => 'INNER',
                        'conditions' => [
                            'scms_students.student_id  = scms_student_cycle.student_id',
                            'scms_students.session_id  = scms_student_cycle.session_id',
                            'scms_students.level_id  = scms_student_cycle.level_id',
                        ],
                    ],
                    'scms_guardians' => [
                        'table' => 'scms_guardians',
                        'type' => 'INNER',
                        'conditions' => [
                            'scms_guardians.student_id  = scms_students.student_id',
                            'scms_guardians.rtype  = scms_students.active_guardian',
                        ]
                    ],
                    'scms_levels' => [
                        'table' => 'scms_levels',
                        'type' => 'INNER',
                        'conditions' => [
                            'scms_levels.level_id  = scms_student_cycle.level_id',
                        ]
                    ]
                ])
                ->toArray();

            $classWiseStudents = [];

            foreach ($absent_students as $student) {
                $class = $student['class'];

                if (!isset($classWiseStudents[$class])) {
                    $classWiseStudents[$class] = [
                        'count' => 0,
                        'students' => []
                    ];
                }

                $classWiseStudents[$class]['count']++;
                $classWiseStudents[$class]['students'][] = $student;
            }

            $filter_array = array();

            foreach ($present_percentage as $class => $percentage) {
                $apikey = Configure::read('Absent.percentage');
                if ($percentage > $apikey) {
                    $filter_array[$class] = $classWiseStudents[$class];
                }
            }

            $device_logs_data['absent'] = count($absent_students);

            if (isset($request_data['sms']) && $request_data['sms'] == 1) {

                foreach ($filter_array as $class => $class_info) {

                    foreach ($class_info['students'] as $absent_student) {
                        if (isset($filter_save_attendances[$absent_student['student_cycle_id']])) {
                            unset($scms_attendance_data[$absent_student['student_cycle_id']]);
                        } else {
                            $student_data['name'] = $absent_student['name'];
                            $student_data['mobile'] = $absent_student['guardian_mobile'];
                            $filter_absent_student[$absent_student['student_id']] = $student_data;
                        }
                    }
                }


                $arrg['students'] = array_values($filter_absent_student);
                $arrg['date'] = date('d-m-Y', strtotime($request_data['date']));
                $numbers = array();
                $type = "absent";
                $absent = $this->send_sms($type, $numbers, $arrg);
                $message = 'Successfully Save Attendance and ' . $absent . ' Absent SMS sent';
            } else {
                $message = 'Successfully Save Attendance';
            }

            $device_logs = TableRegistry::getTableLocator()->get('device_logs');
            $logs = $device_logs->find()
                ->where(['device_logs.date' => $request_data['date']])
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->toArray();
            if (count($logs)) {
                $query = $device_logs->query();
                $query->update()
                    ->set($device_logs_data)
                    ->where(['id' => $logs[0]['id']])
                    ->execute();
            } else {
                $query = $device_logs->query();
                $query->insert(['date', 'absent', 'present'])
                    ->values($device_logs_data)
                    ->execute();
            }
            $this->Flash->success($message, [
                'key' => 'positive',
                'params' => [],
            ]);
            return $this->redirect(['action' => 'deviceAttendence']);
        }

        $scms_term = TableRegistry::getTableLocator()->get('scms_term');
        $terms = $scms_term->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();

        $this->set('terms', $terms);
    }
    
    
    /*
    public function deviceAttendence()
    {
        if (!empty($this->request->data)) {
            $request_data = $this->request->getData();
            $date = new DateTime($request_data['date']);

            $year = $date->format('Y');
            $term_cycle = $this->get_term_cycle_id();
            $live_attendance = $this->send_tipsoi($request_data['date']);

            $school_session = TableRegistry::getTableLocator()->get('scms_sessions');
            $school_sessions = $school_session
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['session_name' => $year])

                ->toArray();
            $session_id = $school_sessions[0]['session_id'];
            // echo '<pre>';
            // print_r($session_id);die;
            //$live_attendance = $this->send_tipsoi('2023-09-25');
            $rfids = array();
            foreach ($live_attendance['data'] as $attendance) {
                $rfids[] = $attendance['rfid'];
            }
            // echo '<pre>';
            // print_r($rfids);die;
            // $device_logs_data['present'] = count(array_unique($rfids));
            $device_logs_data['date'] = $request_data['date'];
            $present_students = array();
            $student = TableRegistry::getTableLocator()->get('scms_students');
            if (count($rfids)) {
                $present_students = $student
                    ->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->where(['scms_students.card_no IN' => $rfids])
                    ->where(['scms_students.status' => 1])
                    ->where(['scms_student_cycle.session_id' => $session_id])
                    ->select([
                        'student_cycle_id' => 'scms_student_cycle.student_cycle_id',
                        'shift_id' => 'scms_student_cycle.shift_id',
                        'section_id' => 'scms_student_cycle.section_id',
                    ])
                    ->join([
                        'scms_student_cycle' => [
                            'table' => 'scms_student_cycle',
                            'type' => 'LEFT',
                            'conditions' => [
                                'scms_students.student_id  = scms_student_cycle.student_id',
                                'scms_students.level_id  = scms_student_cycle.level_id',
                                'scms_students.session_id  = scms_student_cycle.session_id',
                            ],
                        ],
                    ])
                    ->toArray();
            }

            //die;
            $scms_attendance_data = array();
            $present_student_cycle_ids = array();
            $scms_attendance_data_single['user_id'] = $this->Auth->user('id');
            $scms_attendance_data_single['date'] = $present_sms_data_single['date'] = $request_data['date'];
            foreach ($present_students as $present_student) {
                $scms_attendance_data_single['student_cycle_id'] = $present_student['student_cycle_id'];
                $scms_attendance_data_single['shift_id'] = $present_student['shift_id'];
                $scms_attendance_data_single['level_id'] = $present_student['level_id'];
                $scms_attendance_data_single['section_id'] = $present_student['section_id'];
                $scms_attendance_data_single['term_cycle_id'] = $term_cycle[$present_student['session_id']][$present_student['level_id']][$request_data['term_id']];
                $scms_attendance_data[$present_student['student_cycle_id']] = $scms_attendance_data_single;
                $present_student_cycle_ids[] = $present_student['student_cycle_id'];
            }
            $device_logs_data['present'] = count(($present_students));

            $scms_attendance = TableRegistry::getTableLocator()->get('scms_attendance');
            $save_attendances = $scms_attendance
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['scms_attendance.date' => $request_data['date']])
                ->toArray();
            $filter_save_attendances = array();
            foreach ($save_attendances as $key => $save_attendance) {
                if (isset($scms_attendance_data[$save_attendance['student_cycle_id']])) {
                    unset($scms_attendance_data[$save_attendance['student_cycle_id']]);
                    unset($save_attendances[$key]);
                } else {
                    $filter_save_attendances[$save_attendance['student_cycle_id']] = $save_attendance;
                }
            }
            $scms_attendance_data = array_values($scms_attendance_data);


            if (count($scms_attendance_data)) {
                $scms_attendance = TableRegistry::getTableLocator()->get('scms_attendance');
                $columns = array_keys($scms_attendance_data[0]);
                $insertQuery = $scms_attendance->query();
                $insertQuery->insert($columns);
                // you must always alter the values clause AFTER insert
                $insertQuery->clause('values')->values($scms_attendance_data);
                $insertQuery->execute();
            }

            $absent = 0;
            if (count($rfids)) {
                $where['scms_students.card_no NOT IN'] = $rfids;
            }


            $where['scms_students.status'] = 1;
            $absent_students = $student
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['scms_students.card_no IS NOT NULL'])
                ->where($where)
                ->where(['scms_student_cycle.session_id' => $session_id])
                ->select([
                    'student_cycle_id' => 'scms_student_cycle.student_cycle_id',
                    'guardian_mobile' => 'scms_guardians.mobile',
                    'rtype' => 'scms_guardians.rtype'
                ])
                ->join([
                    'scms_student_cycle' => [
                        'table' => 'scms_student_cycle',
                        'type' => 'INNER',
                        'conditions' => [
                            'scms_students.student_id  = scms_student_cycle.student_id',
                            'scms_students.session_id  = scms_student_cycle.session_id',
                            'scms_students.level_id  = scms_student_cycle.level_id',
                        ],
                    ],
                    'scms_guardians' => [
                        'table' => 'scms_guardians',
                        'type' => 'INNER',
                        'conditions' => [
                            'scms_guardians.student_id  = scms_students.student_id',
                            'scms_guardians.rtype  = scms_students.active_guardian',
                        ]
                    ]
                ])
                ->toArray();
           
            $device_logs_data['absent'] = count($absent_students);

            if (isset($request_data['sms']) && $request_data['sms'] == 1) {
                foreach ($absent_students as $absent_student) {
                    if (isset($filter_save_attendances[$absent_student['student_cycle_id']])) {
                        unset($scms_attendance_data[$absent_student['student_cycle_id']]);
                    } else {
                        $student_data['name'] = $absent_student['name'];
                        $student_data['mobile'] = $absent_student['guardian_mobile'];
                        $filter_absent_student[$absent_student['student_id']] = $student_data;
                    }
                }
                $arrg['students'] = array_values($filter_absent_student);
                $arrg['date'] = date('d-m-Y', strtotime($request_data['date']));
                $numbers = array();
                $type = "absent";
                $absent = $this->send_sms($type, $numbers, $arrg);
                $message = 'Successfully Save Attendance and ' . $absent . ' Absent SMS sent';
            } else {
                $message = 'Successfully Save Attendance';
            }
            
            $device_logs = TableRegistry::getTableLocator()->get('device_logs');
            $logs = $device_logs->find()
                ->where(['device_logs.date' => $request_data['date']])
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->toArray();
            if (count($logs)) {
                $query = $device_logs->query();
                $query->update()
                    ->set($device_logs_data)
                    ->where(['id' => $logs[0]['id']])
                    ->execute();
            } else {
                $query = $device_logs->query();
                $query->insert(['date', 'absent', 'present'])
                    ->values($device_logs_data)
                    ->execute();
            }
            $this->Flash->success($message, [
                'key' => 'positive',
                'params' => [],
            ]);
            return $this->redirect(['action' => 'deviceAttendence']);
        }

        $scms_term = TableRegistry::getTableLocator()->get('scms_term');
        $terms = $scms_term->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();

        $this->set('terms', $terms);
    }  */
    
    public function attendanceSheet()
    {
        $value['session_id'] = null;
        $value['shift_id'] = null;
        $value['level_id'] = null;
        $value['section_id'] = null;
        $value['month'] = null;


        if ($this->request->is('post')) {
            $request_data = $this->request->getData();


            $student_cycle = TableRegistry::getTableLocator()->get('scms_student_cycle');
            $student_cycles = $student_cycle
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->select([
                    'student_id' => 's.student_id',
                    'name' => 's.name',
                    'sid' => 's.sid',
                ])
                ->where(['scms_student_cycle.level_id' => $request_data['level_id']])
                ->where(['scms_student_cycle.session_id' => $request_data['session_id']])
                ->where(['scms_student_cycle.section_id' => $request_data['section_id']])
                ->order(['scms_student_cycle.roll' => 'ASC'])
                ->join([
                    's' => [
                        'table' => 'scms_students',
                        'type' => 'INNER',
                        'conditions' => [
                            's.student_id = scms_student_cycle.student_id',
                            's.status' => 1,
                        ]
                    ],
                ])
                ->toArray();



            $session = TableRegistry::getTableLocator()->get('scms_sessions');
            $sessions = $session
                ->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['session_id' => $request_data['session_id']])
                ->toArray();
            $date = $sessions[0]['session_name'] . '-' . ucfirst($request_data['month']);
            $first_date = date("Y-m-d", strtotime($date));
            $last_day = date("Y-m-t", strtotime($first_date));

            $attendance = TableRegistry::getTableLocator()->get('scms_attendance');
            $dates = $attendance->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where(['scms_attendance.shift_id' => $request_data['shift_id']])
                ->where(['scms_attendance.level_id' => $request_data['level_id']])
                ->where(['scms_attendance.section_id' => $request_data['section_id']])
                // ->select([
                //     'courses_setup_id' => 'scc.courses_setup_id',
                // ])
                ->where(['date >=' => $first_date])
                ->where(['date <=' => $last_day])
                ->group('date')

                ->toArray();
                
            foreach ($dates as $date) {
                $d = date('Y-m-d', strtotime($date['date']));
                $inital_attandances[$d] = 'A';
                $attandances_date[] = date('d-m', strtotime($date['date']));
            }
            
            $this->set('dates', $attandances_date);
            foreach ($student_cycles as $key => $student_cycle) {
                $student_cycles[$key]['attandances'] = $inital_attandances;

                $attendances_historys = $attendance->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->where(['date >=' => $first_date])
                    ->where(['date <=' => $last_day])
                    ->where(['scms_attendance.student_cycle_id' => $student_cycle['student_cycle_id']])

                    ->toArray();
                foreach ($attendances_historys as $attendances_history) {
                    $date = date('Y-m-d', strtotime($attendances_history['date']));
                    $student_cycles[$key]['attandances'][$date] = "P";
                }
            }
            $total_attendance = array();
            $student_count = count($student_cycles);
            foreach ($inital_attandances as $key => $inital) {
                $total_attendance[$key]['present'] = 0;
                foreach ($student_cycles as $cycles) {
                    if ($cycles['attandances'][$key] == 'P') {
                        $total_attendance[$key]['present'] = $total_attendance[$key]['present'] + 1;
                    }
                }
                $total_attendance[$key]['absent'] = $student_count - $total_attendance[$key]['present'];
            }
            
            $this->set('total_attendance', $total_attendance);
            $this->set('students', $student_cycles);
            $value = $request_data;
            $this->set('value', $value);
        }


        $data = TableRegistry::getTableLocator()->get('scms_levels');
        $levels = $data
            ->find()
            ->toArray();
        $this->set('levels', $levels);


        $session = TableRegistry::getTableLocator()->get('scms_sessions');
        $sessions = $session
            ->find()
            ->order(['session_name' => 'DESC'])
            ->toArray();
        $this->set('sessions', $sessions);

        $section = TableRegistry::getTableLocator()->get('scms_sections');
        $sections = $section
            ->find()
            ->toArray();
        $this->set('sections', $sections);

        $shift = TableRegistry::getTableLocator()->get('hr_shift');
        $shifts = $shift
            ->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('shifts', $shifts);

        $months['january'] = array('name' => 'January', 'has_access' => 0);
        $months['february'] = array('name' => 'February', 'has_access' => 0);
        $months['march'] = array('name' => 'March', 'has_access' => 0);
        $months['april'] = array('name' => 'April', 'has_access' => 0);
        $months['may'] = array('name' => 'May', 'has_access' => 0);
        $months['june'] = array('name' => 'June', 'has_access' => 0);
        $months['july'] = array('name' => 'July', 'has_access' => 0);
        $months['august'] = array('name' => 'August', 'has_access' => 0);
        $months['september'] = array('name' => 'September', 'has_access' => 0);
        $months['october'] = array('name' => 'October', 'has_access' => 0);
        $months['november'] = array('name' => 'November', 'has_access' => 0);
        $months['december'] = array('name' => 'December', 'has_access' => 0);
        // pr($months);die;
        $this->set('months', $months);

        $this->set('data', $value);
        // $this->set('courses', $courses);
    }

    public function monthlyAttendenceReport()
    {
        $this->set('title_for_layout', __('Monthly Attendence Report'));

        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $levelId = $request_data['level_id'];
            $sectionId = $request_data['section_id'];
            $date = $request_data['start_date'];
            $date1 = $request_data['end_date'];
            $stYr = date('Y', strtotime($request_data['start_date']));
            $endYr = date('Y', strtotime($request_data['end_date']));
            $session = TableRegistry::getTableLocator()->get('scms_sessions');
            $sessions = $session
                ->find()
                ->where(['session_name' => $stYr])
                ->toArray();

            if (empty($levelId) || empty($sectionId) || empty($date) && empty($date1)) {
                $this->Flash->success('Please select mendatory fields.', [
                    'key' => 'Negative',
                    'params' => [],
                ]);
            } elseif ($stYr != $endYr) {
                $this->Flash->success('Please select date of same year.', [
                    'key' => 'Negative',
                    'params' => [],
                ]);
            } else {


                $student = TableRegistry::getTableLocator()->get('scms_student_cycle');
                $students = $student->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->select([
                        'name' => 'scc.name',
                    ])
                    ->where(['scms_student_cycle.level_id' => $levelId])
                    ->where(['scms_student_cycle.section_id' => $sectionId])
                    ->where(['scms_student_cycle.session_id' => $sessions[0]['session_id']])
                    ->where(['scc.status' => 1])
                    ->order(['scms_student_cycle.roll' => 'ASC'])
                    // ->group('date')
                    ->join([
                        'scc' => [
                            'table' => 'scms_students',
                            'type' => 'INNER',
                            'conditions' => [
                                'scc.student_id = scms_student_cycle.student_id'
                            ]
                        ],
                    ])
                    ->toArray();


                if (empty($students))
                    return array('status' => '000', 'msg' => 'No student is found! Please refine your search!');
                $allStudents = array();
                foreach ($students as $i => $student) {
                    $allStudents[$i]['student_cycle_id'] = $student['student_cycle_id'];
                    $allStudents[$i]['name'] = $student['name'];
                    $allStudents[$i]['level_id'] = $student['level_id'];
                    $allStudents[$i]['section_id'] = $student['section_id'];
                    $allStudents[$i]['roll'] = $student['roll'];

                    $attendence = TableRegistry::getTableLocator()->get('scms_attendance');
                    $attendences = $attendence->find()
                        ->enableAutoFields(true)
                        ->enableHydration(false)
                        ->where([
                            'shift_id' => $request_data['shift_id'],
                            'level_id' => $request_data['level_id'],
                            'section_id' => $request_data['section_id'],
                            'student_cycle_id' => $student['student_cycle_id']
                        ])
                        ->where(function ($exp, $q) use ($date, $date1) {
                            return $exp->between('date', $date, $date1);
                        })
                        ->select([
                            'cnt' => $attendence->query()->func()->count('scms_attendance.attendance_id')
                        ])
                        ->first(); // Use first() to get a single row with the total count

                    $atD = array();
                    if (!empty($attendences)) {
                        // No need for a loop since we're not grouping by month anymore
                        $atD['total_days_present'] = $attendences['cnt'];
                    }

                    $allStudents[$i]['student'] = array(
                        'attendence' => $atD,
                    );
                }
                $attend = TableRegistry::getTableLocator()->get('scms_attendance');
                $attendenCnt = $attend->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->where(['shift_id' => $request_data['shift_id']])
                    ->where(['level_id' => $request_data['level_id']])
                    ->where(['section_id' => $request_data['section_id']])
                    ->where(['date BETWEEN :date1 AND :date2'])
                    ->bind(':date1', $date, 'date')
                    ->bind(':date2', $date1, 'date')
                    ->group('(date)')

                    ->toArray();

                $workingDays = count($attendenCnt);
                $this->set('sumWorkingday', $workingDays);
                $this->set(compact('allStudents'));
                $session = TableRegistry::getTableLocator()->get('scms_sessions');
                $sessions = $session
                    ->find()
                    ->where(['session_id' => $request_data['session_id']])
                    ->toArray();
                $session_name = $sessions[0]['session_name'];
                $this->set('session_name', $session_name);

                $data = TableRegistry::getTableLocator()->get('scms_levels');
                $levels = $data
                    ->find()
                    ->where(['level_id' => $request_data['level_id']])
                    ->toArray();
                $level_name = $levels[0]['level_name'];
                $this->set('level_name', $level_name);

                $section = TableRegistry::getTableLocator()->get('scms_sections');
                $sections = $section
                    ->find()
                    ->where(['section_id' => $request_data['section_id']])
                    ->toArray();
                $section_name = $sections[0]['section_name'];
                $this->set('section_name', $section_name);

                $shift = TableRegistry::getTableLocator()->get('hr_shift');
                $shifts = $shift
                    ->find()
                    ->where(['shift_id' => $request_data['shift_id']])
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->toArray();
                $shift_name = $shifts[0]['shift_name'];
                $this->set('shift_name', $shift_name);


                $value = $request_data;
                $this->set('value', $value);
            }
        }
        $data = TableRegistry::getTableLocator()->get('scms_levels');
        $levels = $data
            ->find()
            ->toArray();
        $this->set('levels', $levels);


        $session = TableRegistry::getTableLocator()->get('scms_sessions');
        $sessions = $session
            ->find()
            ->order(['session_name' => 'DESC'])
            ->toArray();
        $this->set('sessions', $sessions);

        $shift = TableRegistry::getTableLocator()->get('hr_shift');
        $shifts = $shift
            ->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('shifts', $shifts);
    }

    private function save_attendance_log($request_data) {
        if ($request_data['date']) {
            $where['date'] = $request_data['date'];
        }
        if ($request_data['term_cycle_id']) {
            $where['term_cycle_id'] = $request_data['term_cycle_id'];
        }
        if ($request_data['courses_cycle_id']) {
            $where['courses_cycle_id'] = $request_data['courses_cycle_id'];
        }
        $scms_attendance_log = TableRegistry::getTableLocator()->get('scms_attendance_log');
        $scms_attendance_logs = $scms_attendance_log->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where($where)
                ->toArray();
        if (count($scms_attendance_logs) == 0) {
            $scms_attendance_log_data['date'] = $request_data['date'];
            $scms_attendance_log_data['term_cycle_id'] = $request_data['term_cycle_id'];
            $scms_attendance_log_data['user_id'] = $request_data['user_id'];
            $query = $scms_attendance_log->query();
            if ($request_data['courses_cycle_id']) {
                $scms_attendance_log_data['courses_cycle_id'] = $request_data['courses_cycle_id'];
                $query->insert(['term_cycle_id', 'user_id', 'date', 'courses_cycle_id'])
                        ->values($scms_attendance_log_data)
                        ->execute();
            } else {
                $query->insert(['term_cycle_id', 'user_id', 'date'])
                        ->values($scms_attendance_log_data)
                        ->execute();
            }
        }
        return true;
    }

    private function search_student($request_data) {
        if ($request_data['session_id']) {
            $where['sc.session_id'] = $request_data['session_id'];
        }
        if ($request_data['shift_id']) {
            $where['sc.shift_id'] = $request_data['shift_id'];
        }
        if ($request_data['level_id']) {
            $where['sc.level_id'] = $request_data['level_id'];
        }
        if ($request_data['section_id']) {
            $where['sc.section_id'] = $request_data['section_id'];
        }
        if ($request_data['section_id']) {
            $where['sc.section_id'] = $request_data['section_id'];
        }
        if ($request_data['term_cycle_id']) {
            $where['term_cycle_id'] = $request_data['term_cycle_id'];
        }
        $where['s.status'] = 1;
        $student_term_cycle = TableRegistry::getTableLocator()->get('scms_student_term_cycle');
        $students = $student_term_cycle->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->select([
                    'student_id' => 'sc.student_id',
                    'name' => 's.name',
                    'roll' => 'sc.roll',
                ])
                ->where($where)
                ->order(['CAST(roll AS SIGNED)' => 'ASC'])
                ->join([
                    'sc' => [
                        'table' => 'scms_student_cycle',
                        'type' => 'INNER',
                        'conditions' => [
                            'sc.student_cycle_id  = scms_student_term_cycle.student_cycle_id'
                        ]
                    ],
                    's' => [
                        'table' => 'scms_students',
                        'type' => 'INNER',
                        'conditions' => [
                            's.student_id = sc.student_id',
                            'status = 1',
                        ]
                    ],
                ])
                ->toArray();
        $filter_students = array();
        foreach ($students as $student) {
            $student['attendance'] = null;
            $filter_students[$student['student_cycle_id']] = $student;
        }


        $attendances = $this->getAttendances($request_data);
        foreach ($attendances as $attendance) {
            if (isset($filter_students[$attendance['student_cycle_id']])) {
                $filter_students[$attendance['student_cycle_id']]['attendance'] = 1;
            }
        }
        return $filter_students;
    }

    private function getAttendances($request_data) {
        $courseStatus = Configure::read('attendance_course');

        if ($request_data['session_id']) {
            $where['sc.session_id'] = $request_data['session_id'];
        }
        if ($request_data['shift_id']) {
            $where['sc.shift_id'] = $request_data['shift_id'];
        }
        if ($request_data['level_id']) {
            $where['sc.level_id'] = $request_data['level_id'];
        }
        if ($request_data['section_id']) {
            $where['sc.section_id'] = $request_data['section_id'];
        }
        if ($request_data['term_cycle_id']) {
            $where['term_cycle_id'] = $request_data['term_cycle_id'];
        }
        if ($courseStatus != 0) {
            if ($request_data['courses_cycle_id']) {
                $where['courses_cycle_id'] = $request_data['courses_cycle_id'];
            }
        }

        $where['date'] = $request_data['date'];
        $scms_attendance = TableRegistry::getTableLocator()->get('scms_attendance');
        $attendances = $scms_attendance->find()
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->where($where)
                ->join([
                    'sc' => [
                        'table' => 'scms_student_cycle',
                        'type' => 'INNER',
                        'conditions' => [
                            'sc.student_cycle_id  = scms_attendance.student_cycle_id'
                        ]
                    ],
                ])
                ->toArray();

        return $attendances;
    }

    private function save_attendance($request_data) {
        $privious_attendances = $this->getAttendances($request_data);
        $privious_attendance_filter = array();
        foreach ($privious_attendances as $privious_attendance) {
            $privious_attendance_filter[$privious_attendance['student_cycle_id']] = $privious_attendance;
        }
        $present_students = array();
        $attendance = TableRegistry::getTableLocator()->get('scms_attendance');
        if (isset($request_data['student_cycle_id'])) {
            foreach ($request_data['student_cycle_id'] as $key_student => $student_cycle_id) {
                $present_students[$key_student]['term_cycle_id'] = $request_data['term_cycle_id'];
                $present_students[$key_student]['student_cycle_id'] = $student_cycle_id;
                $present_students[$key_student]['date'] = $request_data['date'];
                $present_students[$key_student]['shift_id'] = $request_data['shift_id'];
                $present_students[$key_student]['level_id'] = $request_data['level_id'];
                $present_students[$key_student]['section_id'] = $request_data['section_id'];
                $present_students[$key_student]['user_id'] = $request_data['user_id'];

                if (count($privious_attendance_filter) > 0 && isset($privious_attendance_filter[$student_cycle_id])) {
                    unset($privious_attendance_filter[$student_cycle_id]);
                } else {
                    $query = $attendance->query();
                    if ($request_data['courses_cycle_id']) {
                        $present_students[$key_student]['courses_cycle_id'] = $request_data['courses_cycle_id'];
                        $query->insert(['term_cycle_id', 'student_cycle_id', 'shift_id', 'level_id', 'section_id', 'user_id', 'date', 'courses_cycle_id'])
                                ->values($present_students[$key_student])
                                ->execute();
                    } else {
                        $query->insert(['term_cycle_id', 'student_cycle_id', 'shift_id', 'level_id', 'section_id', 'user_id', 'date'])
                                ->values($present_students[$key_student])
                                ->execute();
                    }
                }
            }
        }
        foreach ($privious_attendance_filter as $delete_attendance) {
            $query = $attendance->query();
            $query->delete()
                    ->where(['attendance_id' => $delete_attendance['attendance_id']])
                    ->execute();
        }
        return true;
    }

    private function sms($data) {
        $present_student_cycle_id = isset($data['student_cycle_id']) ? $data['student_cycle_id'] : array();
        $students = $this->search_student($data);
        $studnets_student_cycle_id = array();
        foreach ($students as $student) {
            $studnets_student_cycle_id[] = $student['student_cycle_id'];
        }
        $absent_student_cycle_id = array_diff($studnets_student_cycle_id, $present_student_cycle_id);
        if (count($absent_student_cycle_id)) {
            $return = $this->get_sms_number($absent_student_cycle_id);
            if (count($return) == 0) {
                return 0;
            }
            $args['students'] = array_values($return);
            $args['date'] = date('d-m-Y', strtotime($data['date']));
            $numbers = array();
            $type = "absent";
            $absent = $this->send_sms($type, $numbers, $args);
            return $absent;
        } else {
            return 0;
        }
    }

    private function get_sms_number($student_cycle_ids) {
        if ($student_cycle_ids != null) {
            $student_cycle = TableRegistry::getTableLocator()->get('scms_student_cycle');
            $student_cycles = $student_cycle->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->where(['scms_student_cycle.student_cycle_id IN' => $student_cycle_ids])
                    ->toArray();

            $student_ids = array();
            foreach ($student_cycles as $student_data) {
                $student_ids[] = $student_data['student_id'];
            }

            $guardian = TableRegistry::getTableLocator()->get('scms_guardians'); //Execute First
            $guardians = $guardian
                    ->find()
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->where(['scms_guardians.student_id IN' => $student_ids])
                    ->select([
                        'student_name' => 'scms_students.name',
                        'active_guardian' => 'scms_students.active_guardian',
                        'level_name' => 'lv.level_name',
                    ])
                    ->join([
                        'scms_students' => [
                            'table' => 'scms_students',
                            'type' => 'INNER',
                            'conditions' => ['scms_students.student_id = scms_guardians.student_id'],
                        ],
                        'sscycle' => [
                            'table' => 'scms_student_cycle',
                            'type' => 'INNER',
                            'conditions' => ['scms_students.student_id = sscycle.student_id'],
                        ],
                        'lv' => [
                            'table' => 'scms_levels',
                            'type' => 'INNER',
                            'conditions' => ['lv.level_id = sscycle.level_id'],
                        ],
                    ])
                    ->toArray();
            $active_gurardian = array();
            foreach ($guardians as $guardian) {
                if ($guardian['active_guardian'] == $guardian['rtype'] && $guardian['mobile']) {
                    $active_gurardian[$guardian['student_id']] = $guardian;
                }
            }
            return $active_gurardian;
        } else {
            return array();
        }
    }


    private function get_levels() {
        $level = TableRegistry::getTableLocator()->get('scms_levels');
        $levels = $level
                ->find()
                ->toArray();

        return $levels;
    }

    public function send_tipsoi() {
        $url = "https://api-inovace360.com/api/v1/logs";
 
        $data = [
            "start" => date('Y-m-d 0:0:0'),
	        "end" => date('Y-m-d 23:59:59'),
            "api_token" => "fb93-508d-be66-64e7-a2cb-a9c7-458c-c849-f4d3-f45b-b665-7f4f-f3dd-b7e2-5342-5859",
            "per_page" => "500"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);

        $headers = array();
        $headers[] = "Key: Value";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error :-' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($result, true);
    }

}
