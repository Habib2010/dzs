<?php

namespace Croogo\Dashboards\Controller\Admin;

use Cake\I18n\I18n;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

I18n::setLocale('jp_JP');

class AjaxController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function getSearchMonth()
    {
        $this->autoRender = false;
		$search_month = $_GET['search_month'];
		$firstDayOfMonth = $search_month . '-01';
		$lastDayOfMonth = date("Y-m-t", strtotime($search_month));
		
		$studentAttendanceTable = TableRegistry::getTableLocator()->get('scms_attendance');
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
		// $monthlyAjaxAttendance = json_encode($attendanceData);
		echo json_encode($attendanceData);
		// $this->set('monthlyAjaxAttendance', $monthlyAjaxAttendance);
    }

}
