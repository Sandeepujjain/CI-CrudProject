<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/FirebaseController.php');

use \Firebase\JWT\JWT;

class HostelAdmin extends CI_Controller
{


	/**
	 * @var FirebaseController
	 */
	public $FirebaseController;
	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->library('session_validation');
		$this->session_validation->checkSession();
		$this->FirebaseController = new FirebaseController(false, $this);
	}

	//  dashboard	
	public function Hostel_Dashboard()
	{
		$data['title'] = "HostelAdmin";


		$filter['school_id'] = $_SESSION['emp_data_session']['emp_schoolid'];

		$academicYearModel = _LM_AcademicYearModel()->getDefaultAcademicYear();
		if (!empty($academicYearModel)) {
			$filter['academic_year'] = $academicYearModel[0]['acdemic_year_id'];
		} else {
			$filter['academic_year'] = null;
		}


		$AlllotedHostelData = _LM_HostelAllotmentModel()
			->where('allotment_status', '0')
			->where('school_id', $filter['school_id'])
			->where('academic_year_id', $filter['academic_year'])
			->findAll() ?: [];

		$data['AlllotedHostelData']  = ($AlllotedHostelData && is_array($AlllotedHostelData)) ? count($AlllotedHostelData) : 0;

		// Fetch hostel beds data
		$AllHostelbed = _LM_HostelRoomsModel()
			->tableAlias('hostelrooms')
			->select('
        hostelrooms.hostel_occupancy_id,
        occupancy.occupancy_name,
        occupancy.no_of_bed,
        COUNT(hostelrooms.hostel_room_id) AS total_rooms,
        COUNT(CASE WHEN hostelallot.allotment_status = 0 THEN hostelallot.alloted_room_id END) AS allotted_rooms_count
    ')
			->where('hostelrooms.school_id', $filter['school_id'])
			->join('hostel_allotment as hostelallot', 'hostelrooms.hostel_room_id = hostelallot.alloted_room_id', 'left')
			->join('occupancy_type as occupancy', 'hostelrooms.hostel_occupancy_id = occupancy.occupancy_id', 'left')
			->groupBy('hostelrooms.hostel_occupancy_id, occupancy.occupancy_name, occupancy.no_of_bed')
			->findAll() ?: [];

		// Initialize grand totals
		$totalBedsSum = 0;
		$availableBedsSum = 0;
		$grandTotalRooms = 0;
		$grandAllocatedRooms = 0;
		$grandVacantRooms = 0;

		// Process each occupancy type
		foreach ($AllHostelbed as &$row) {
			$row['total_beds'] = $row['total_rooms'] * $row['no_of_bed'];
			$row['available_beds'] = $row['total_beds'] - $row['allotted_rooms_count'];
			$row['vacant_rooms'] = $row['total_rooms'] - $row['allotted_rooms_count'];

			// Accumulate grand totals
			$totalBedsSum += $row['total_beds'];
			$availableBedsSum += $row['available_beds'];
			$grandTotalRooms += $row['total_rooms'];
			$grandAllocatedRooms += $row['allotted_rooms_count'];
			$grandVacantRooms += $row['vacant_rooms'];
		}

		// Assign all results to $data to pass to view

		$data['hostelbed_summary'] = (is_array($AllHostelbed) && !empty($AllHostelbed)) ? $AllHostelbed : [];

		$data['grandtotalbeds'] = $totalBedsSum ?: 0;
		$data['grandavailablebeds'] = $availableBedsSum ?: 0;
		$data['grandtotalrooms'] = $grandTotalRooms ?: 0;
		$data['grandallocatedrooms'] = $grandAllocatedRooms ?: 0;
		$data['grandvacantrooms'] = $grandVacantRooms ?: 0;



		$ExHostellerData = _LM_HostelAllotmentModel()
			->where('allotment_status', '1')
			->where('school_id', $filter['school_id'])
			->where('academic_year_id', $filter['academic_year'])
			->findAll() ?: [];

		$data['ExHostellerCount']  = ($ExHostellerData && is_array($ExHostellerData)) ? count($ExHostellerData) : 0;




		$RoomTypeData = _LM_HostelRoomsModel()
			->tableAlias('hostelrooms')
			->select('
        hostelrooms.hostel_room_type_id,
        hostelroom_type.hostel_room_type_name,
        COUNT(hostelrooms.hostel_room_id) AS total_rooms,
        COUNT(CASE WHEN hostelallot.allotment_status = 0 THEN hostelallot.alloted_room_id END) AS allotted_rooms_count
    ')
			->where('hostelrooms.school_id', $filter['school_id'])
			->join('hostel_allotment as hostelallot', 'hostelrooms.hostel_room_id = hostelallot.alloted_room_id', 'left')
			->join('hostelroom_type as hostelroom_type', 'hostelrooms.hostel_room_type_id = hostelroom_type.hostel_room_id', 'left')
			->groupBy('hostelrooms.hostel_room_type_id, hostelroom_type.hostel_room_type_name')
			->findAll() ?: [];

		$roomTypeNames = [];
		$totalRoomsData = [];
		$allottedRoomsData = [];

		foreach ($RoomTypeData as $row) {
			$roomTypeNames[] = $row['hostel_room_type_name'];
			$totalRoomsData[] = (int)$row['total_rooms'];
			$allottedRoomsData[] = (int)$row['allotted_rooms_count'];
		}


		$data['room_type_names'] = json_encode($roomTypeNames);
		$data['total_rooms_data'] = json_encode($totalRoomsData);
		$data['allotted_rooms_data'] = json_encode($allottedRoomsData);
























































		$schoolId = $filter['school_id'];
		$fiveYearsAgo = date('Y-m-d', strtotime('-5 years'));
		$today = date('Y-m-d');

		// Fetch hostel allotments in last 5 years
		$hostelAllotments = _LM_HostelAllotmentModel()
			->tableAlias('hostelallot')
			->select('hostelallot.alloted_date, students.stu_gender as student_gender, employeeModel.emp_gender as employee_gender')
			->where('hostelallot.school_id', $schoolId)
			->where('hostelallot.allotment_status', '0')
			->where('hostelallot.alloted_date >=', $fiveYearsAgo)
			->where('hostelallot.alloted_date <=', $today)
			->join('students as students', 'hostelallot.alloted_student_id = students.student_id', 'left')
			->join(_LM_NewEmployeeModel()->tableName . " as employeeModel", "hostelallot.alloted_employee_id = employeeModel.employee_id", 'left')
			->findAll();

		// Step 1: Initialize chart data for last 5 years
		$chartData = [];

		// Generate list of all years from 5 years ago to current year
		$currentYear = date('Y');
		$startYear = date('Y', strtotime('-5 years'));

		for ($year = $startYear; $year <= $currentYear; $year++) {
			$chartData[$year] = [
				'male' => 0,
				'female' => 0,
				'other' => 0
			];
		}

		// Step 2: Count gender-wise data for each allotment
		foreach ($hostelAllotments as $row) {
			$year = date('Y', strtotime($row['alloted_date']));

			// Decide gender based on student or employee
			$gender = null;
			if (!empty($row['student_gender'])) {
				$gender = strtolower($row['student_gender']);
			} elseif (!empty($row['employee_gender'])) {
				$gender = strtolower($row['employee_gender']);
			}

			// Increment gender count
			if (in_array($gender, ['male', 'female', 'other'])) {
				$chartData[$year][$gender]++;
			}
		}

		// Step 3: Format for chart
		ksort($chartData); // Sort by year ascending

		$finalChartData = [];
		foreach ($chartData as $year => $genders) {
			$finalChartData[] = [
				'year' => (int)$year,
				'male' => $genders['male'],
				'female' => $genders['female'],
				'other' => $genders['other']
			];
		}

		// Step 4: Encode for chart rendering
		$data['chartData'] = json_encode($finalChartData);


		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hostel_Dashboard', $data);
	}
	public function Hos_Alloted()
	{
		$data['title'] = "Alloted Rooms";
		$data['school_id'] = $_SESSION['emp_data_session']['emp_schoolid'];
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Alloted', $data);
		$this->load->view('NewMaster/footer');
	}

	public function getAllotedHostelRoomsData(&$requestedData = null)
	{
		try {
			// Get the request data
			if (!empty($requestedData)) {
				$filter = $requestedData;
			} else {
				$filter = getRequestData();
			}

			// Fetch the data
			$Data = _LM_HostelAllotmentModel()->getAllotedHostelRoomsData($filter);

			// Check if data is found
			if (empty($Data)) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Hostel  Not Found', [], ['error' => "Hostel Rooms Allot Not Found"]);
			}
			// Return success response
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Hostel Rooms Allot Data Found Successfully', $Data);
		} catch (Exception $e) {
			// Handle exception and return error response
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}

	// public function Hostel_Allotment($alloted_id = null)
	// {
	// 	$data['title'] = "Hostel Allotment";
	// 	$data['employee_id'] = $_SESSION['emp_data_session']['employee_id'];
	// 	$data['school_id'] = $_SESSION['emp_data_session']['emp_schoolid'];

	// 	$academicYearModel = _LM_AcademicYearModel()->getDefaultAcademicYear();
	// 	if (!empty($academicYearModel)) {
	// 		$data['academic_year_id'] = $academicYearModel[0]['acdemic_year_id'];
	// 	} else {
	// 		$data['academic_year_id'] = null;
	// 	}
	// 	if (!empty($alloted_id)) {
	// 		// Fetch hostel allotment data based on ID
	// 		$hostelallot_data = _LM_HostelAllotmentModel()->find($alloted_id);

	// 		if ($hostelallot_data) {
	// 			// If data found, extract and set student admission ID or employee ID
	// 			if (!empty($hostelallot_data['alloted_student_id'])) {
	// 				// Fetch student admission ID
	// 				$this->db->select('students.stu_admission_id');
	// 				$this->db->from('hostel_allotment as hostelallot');
	// 				$this->db->join('students as students', 'hostelallot.alloted_student_id = students.student_id', 'left');
	// 				$this->db->where('hostelallot.alloted_student_id', $hostelallot_data['alloted_student_id']);
	// 				$query = $this->db->get();
	// 				$result = $query->row_array();

	// 				$data['stu_admission_id'] = $result['stu_admission_id'] ?? null;
	// 			} elseif (!empty($hostelallot_data['alloted_employee_id'])) {

	// 				$this->db->select('emp.empautonumber');
	// 				$this->db->from('hostel_allotment as hostelallot');
	// 				$this->db->join('add_newemployee as emp', 'hostelallot.alloted_employee_id = emp.employee_id', 'left');
	// 				$this->db->where('hostelallot.alloted_employee_id', $hostelallot_data['alloted_employee_id']);
	// 				$query = $this->db->get();
	// 				$result = $query->row_array();

	// 				$data['empautonumber'] = $result['empautonumber'] ?? null;
	// 			}
	// 		} else {
	// 			$data['stu_admission_id'] = null;
	// 			$data['empautonumber'] = null;
	// 		}
	// 	} else {
	// 		$data['stu_admission_id'] = null;
	// 		$data['empautonumber'] = null;
	// 		$hostelallot_data = [];
	// 	}

	// 	$data = array_merge($data, $hostelallot_data);
	// 	$this->load->view('NewMaster/layout');
	// 	$this->load->view('HostelAdmin/Hostel_Allotment', $data);
	// 	$this->load->view('NewMaster/footer');
	// }
	public function Hostel_Allotment($alloted_id = null)
	{
		$data = [
			'stu_admission_id'     => null,
			'empautonumber'        => null,
			'display_name_with_id' => null,
			'type'                 => null
		];

		$hostelallot_data = [];

		if (!empty($alloted_id)) {
			$hostelallot_data = _LM_HostelAllotmentModel()->find($alloted_id);

			if ($hostelallot_data) {
				/* ===== STUDENT ===== */
				if (!empty($hostelallot_data['alloted_student_id'])) {
					$this->db->select('
                    students.stu_admission_id,
                    CONCAT(
                        IFNULL(students.stu_firstname,""), " ",
                        IFNULL(students.stu_middlename,""), " ",
                        IFNULL(students.stu_lastname,"")
                    ) AS studentfullname
                ');
					$this->db->from('hostel_allotment as hostelallot');
					$this->db->join('students', 'hostelallot.alloted_student_id = students.student_id', 'left');
					$this->db->where('hostelallot.alloted_student_id', $hostelallot_data['alloted_student_id']);
					$result = $this->db->get()->row_array();

					if ($result) {
						$data['type'] = 'student';
						$data['stu_admission_id'] = $result['stu_admission_id'];
						$data['display_name_with_id'] =
							$result['studentfullname'] . ' (' . $result['stu_admission_id'] . ')';
					}
				}
				/* ===== EMPLOYEE ===== */ elseif (!empty($hostelallot_data['alloted_employee_id'])) {
					$this->db->select('
                    emp.empautonumber,
                    CONCAT(
                        emp.emp_firstname, " ",
                        IFNULL(emp.emp_middlename,""), " ",
                        emp.emp_lastname
                    ) AS emp_name
                ');
					$this->db->from('hostel_allotment as hostelallot');
					$this->db->join('add_newemployee as emp', 'hostelallot.alloted_employee_id = emp.employee_id', 'left');
					$this->db->where('hostelallot.alloted_employee_id', $hostelallot_data['alloted_employee_id']);
					$result = $this->db->get()->row_array();

					if ($result) {
						$data['type'] = 'employee';
						$data['empautonumber'] = $result['empautonumber'];
						$data['display_name_with_id'] =
							$result['emp_name'] . ' (' . $result['empautonumber'] . ')';
					}
				}
			}
		}

		// Additional hostel-specific data
		$data['title'] = "Hostel Allotment";
		$data['employee_id'] = $_SESSION['emp_data_session']['employee_id'];
		$data['school_id'] = $_SESSION['emp_data_session']['emp_schoolid'];

		$academicYearModel = _LM_AcademicYearModel()->getDefaultAcademicYear();
		if (!empty($academicYearModel)) {
			$data['academic_year_id'] = $academicYearModel[0]['acdemic_year_id'];
		} else {
			$data['academic_year_id'] = null;
		}

		// Merge hostel allotment data safely
		$data = array_merge($data, $hostelallot_data);

		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hostel_Allotment', $data);
		$this->load->view('NewMaster/footer');
	}

	public function Insert_Update_HostelAllotment()
	{
		$AllotmentData = $_POST;
		// Validation stu_emp_id
		// $this->form_validation->set_rules(
		// 	'stu_emp_id',
		// 	'stu_emp_id',
		// 	'required',
		// 	array('required' => 'This field is required.',)
		// );
		// if ($this->form_validation->run() == FALSE) {
		// 	$errors = array(
		// 		'stu_emp_id' => trim(form_error('stu_emp_id', ' ', ' ')),
		// 	);
		// 	return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'User ID Validation Failed', [], $errors);
		// }

		




		// Proceed with  update
		if (array_key_exists('alloted_id', $AllotmentData) && !empty($AllotmentData['alloted_id'])) {
			$updateResult = _LM_HostelAllotmentModel()->update($AllotmentData);
			if (is_array($updateResult) && array_key_exists('errors', $updateResult) && !empty($updateResult['errors'])) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Allotment Update Failed', [], $updateResult['errors']);
			}
			$this->hostel_allotment_notification($AllotmentData);
			return apiFormatResponse($this->output, ApiResponseStatusCode::CREATED, 'Allotment Updated Successfully', $updateResult);
		}

		// Check if student or employee already exists
		$existing_entry = _LM_HostelAllotmentModel()->CheckStudentEmployeeExist($AllotmentData);


		if (is_array($existing_entry) && array_key_exists('errors', $existing_entry) && !empty($existing_entry['errors'])) {
			return apiFormatResponse(
				$this->output,
				ApiResponseStatusCode::VALIDATION_FAILED,
				'This User Room already allotted.',
				[],
				$existing_entry['errors']
			);
		}


		// Insert new allotment
		$insertResult = _LM_HostelAllotmentModel()->insert($AllotmentData);

		if (is_array($insertResult) && array_key_exists('errors', $insertResult) && !empty($insertResult['errors'])) {
			return apiFormatResponse(
				$this->output,
				ApiResponseStatusCode::VALIDATION_FAILED,
				'Allotment Insertion Failed',
				[],
				$insertResult['errors']
			);
		}

		$this->hostel_allotment_notification($AllotmentData);

		return apiFormatResponse(
			$this->output,
			ApiResponseStatusCode::CREATED,
			'Allotment Added Successfully',
			[]
		);
	}


	private function hostel_allotment_notification($AllotmentData)
	{
		$student_id = $AllotmentData['alloted_student_id'] ?? null;
		$employee_id = $AllotmentData['alloted_employee_id'] ?? null;
		$alloted_date = $AllotmentData['alloted_date'] ?? null;
		$alloted_hostel_id = $AllotmentData['alloted_hostel_id'] ?? null;
		$alloted_floor_id = $AllotmentData['alloted_floor_id'] ?? null;
		$alloted_room_id = $AllotmentData['alloted_room_id'] ?? null;


		if (!empty($student_id)) {
			$studentdata = _LM_StudentsModel()->find($student_id);
			$user_type = 'STU';
			$user_name = $studentdata['stu_firstname'] . '' . $studentdata['stu_middlename'] . ' ' . $studentdata['stu_lastname'];
		} else if (!empty($employee_id)) {
			$employeedata = _LM_NewEmployeeModel()->find($employee_id);
			$user_type = 'EMP';
			$user_name = $employeedata['emp_firstname'] . '' . $employeedata['emp_middlename'] . ' ' . $employeedata['emp_lastname'];
		} else {
			return false;
		}

		if (!empty($alloted_hostel_id)) {
			$hostelData = _LM_HostelModel()->find($alloted_hostel_id);
			$hostelname = $hostelData['hostel_name'] ?? '';
		}
		if (!empty($alloted_floor_id)) {
			$floorData = _LM_HostelFloorModel()->find($alloted_floor_id);
			$floorname = $floorData['hostel_floor_name'] ?? '';
		} else {
			$floorData = [];
		}
		if (!empty($alloted_room_id)) {
			$roomData = _LM_HostelRoomsModel()->find($alloted_room_id);
			$roomname = $roomData['hostel_room_name'] ?? '';
		} else {
			$roomData = [];
		}



		// Prepare placeholder replacements
		$placeholders = [
			'USER_NAME' => $user_name,
			'USER_TYPE' => $user_type,
			'ALLOTED_DATE' => $alloted_date,
			'HOSTEL_NAME' => $hostelname,
			'FLOOR_NAME' => $floorname,
			'ROOM_NAME' => $roomname,
			'ALLOTMENT_ACTION' => !empty($AllotmentData['alloted_id']) ? 'updated' : 'allotted',
		];

		// Fire the notification (modify this if sending to student or employee)
		if (!empty($student_id)) {
			$this->FirebaseController->notification_student_allotment($student_id, $placeholders);
		} else {
			$this->FirebaseController->notification_employee_allotment($employee_id, $placeholders);
		}
	}

	public function Update_Hostel_LeaveAllotment()
	{
		$LeaveAllotmentData = $_POST;
		$this->form_validation->set_rules(
			'hostel_leave_date',
			'hostel_leave_date',
			'required',
			array(
				'required' => 'This field is required.',
			)
		);
		$this->form_validation->set_rules(
			'hostel_leave_remark',
			'hostel_leave_remark',
			'required',
			array(
				'required' => 'This field is required.',
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$errors = array(
				'hostel_leave_date' => trim(form_error('hostel_leave_date', ' ', ' ')),
				'hostel_leave_remark' => trim(form_error('hostel_leave_remark', ' ', ' ')),

			);
			return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Hostel Leave Validation Failed', [], $errors);
		}

		if (array_key_exists('alloted_id', $LeaveAllotmentData) && !empty($LeaveAllotmentData['alloted_id'])) {
			$Data = _LM_HostelAllotmentModel()->update($LeaveAllotmentData);
			if (is_array($Data) && array_key_exists('errors', $Data) && !empty($Data['errors'])) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Hostel Leave Validation Failed', [], $Data['errors']);
			}
			$this->hostel_leave_notification($LeaveAllotmentData);

			return apiFormatResponse($this->output, ApiResponseStatusCode::CREATED, 'Hostel Leave Update Successfully', $Data);
		}
	}


	private function hostel_leave_notification($LeaveAllotmentData)
	{
		$alloted_id = $LeaveAllotmentData['alloted_id'] ?? null;
		$hostel_leave_date = $LeaveAllotmentData['hostel_leave_date'] ?? null;
		$hostel_leave_remark = $LeaveAllotmentData['hostel_leave_remark'] ?? null;
		if (!empty($alloted_id)) {
			$hostelallotdata = _LM_HostelAllotmentModel()->find($alloted_id);

			$alloted_hostel_id = $hostelallotdata['alloted_hostel_id'] ?? null;
			$alloted_floor_id = $hostelallotdata['alloted_floor_id'] ?? null;
			$alloted_room_id = $hostelallotdata['alloted_room_id'] ?? null;

			$student_id = $hostelallotdata['alloted_student_id'] ?? null;
			if (!empty($student_id)) {
				$studentdata = _LM_StudentsModel()->find($student_id);
				$user_type = 'STU';
				$user_name = $studentdata['stu_firstname'] . '' . $studentdata['stu_middlename'] . ' ' . $studentdata['stu_lastname'];
			} else {
				$employee_id = $hostelallotdata['alloted_employee_id'] ?? null;
				if (!empty($employee_id)) {
					$employeedata = _LM_NewEmployeeModel()->find($employee_id);
					$user_type = 'EMP';
					$user_name = $employeedata['emp_firstname'] . '' . $employeedata['emp_middlename'] . ' ' . $employeedata['emp_lastname'];
				}
			}
		} else {
			return false;
		}

		if (!empty($alloted_hostel_id)) {
			$hostelData = _LM_HostelModel()->find($alloted_hostel_id);
			$hostelname = $hostelData['hostel_name'] ?? '';
		}
		if (!empty($alloted_floor_id)) {
			$floorData = _LM_HostelFloorModel()->find($alloted_floor_id);
			$floorname = $floorData['hostel_floor_name'] ?? '';
		} else {
			$floorData = [];
		}
		if (!empty($alloted_room_id)) {
			$roomData = _LM_HostelRoomsModel()->find($alloted_room_id);
			$roomname = $roomData['hostel_room_name'] ?? '';
		} else {
			$roomData = [];
		}



		// Prepare placeholder replacements
		$placeholders = [
			'USER_NAME' => $user_name,
			'USER_TYPE' => $user_type,
			'LEAVE_DATE' => $hostel_leave_date,
			'HOSTEL_NAME' => $hostelname,
			'FLOOR_NAME' => $floorname,
			'ROOM_NAME' => $roomname,
			'HOSTEL_LEAVE_REMARK' => $hostel_leave_remark,

		];


		if (!empty($student_id)) {
			$this->FirebaseController->student_hostel_leave_notification($student_id, $placeholders);
		} else {
			$this->FirebaseController->employee_hostel_leave_notification($employee_id, $placeholders);
		}
	}





	public function getHostelAllotDataShowApi(&$requestedData = null)
	{
		try {
			// Get the request data
			if (!empty($requestedData)) {
				$filter = $requestedData;
			} else {
				$filter = getRequestData();
			}

			// Fetch the data
			$Data = _LM_HostelAllotmentModel()->getHostelAllotDataShowApi($filter);

			// Check if data is found
			if (empty($Data)) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Hostel Rooms Allot  Not Found', [], ['error' => "Hostel Rooms Allot Not Found"]);
			}
			// Return success response
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Hostel Rooms Allot Data Found Successfully', $Data);
		} catch (Exception $e) {
			// Handle exception and return error response
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}

	public function delete_HostelAllotment($id)
	{
		if (!empty($id)) {
			$Data = _LM_HostelAllotmentModel()->delete($id);
			if (is_array($Data) && array_key_exists('errors', $Data) && !empty($Data['errors'])) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Hostel Allot Validation Failed', [], $Data['errors']);
			}
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Hostel Allot Delete Successfully', $Data);
		}
	}


	public function getStudentDataByOninput()
	{
		try {
			$requestedData = $this->input->post();
			$filter = !empty($requestedData) ? $requestedData : [];

			$Data = _LM_StudentsModel()->getStudentDataByOninput($filter);

			if (empty($Data)) {
				if (strpos($filter['stu_emp_id'], 'EMP') === 0) {
					return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Employee Not Found', [], ['error' => "Employee Not Found"]);
				} else if (strpos($filter['stu_emp_id'], 'STU') === 0) {
					return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Student Not Found', [], ['error' => "Student Not Found"]);
				} else {
					return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Please Enter Valid Id', [], ['error' => "Please Enter Valid Id"]);
				}
			}
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Success', $Data);
		} catch (Exception $e) {
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}

	public  function getStudentEmployeeList()
	{
		try {
			$requestedData = $this->input->post();
			$filter = !empty($requestedData) ? $requestedData : [];

			$Data = _LM_StudentsModel()->getStudentEmployeeListData($filter);
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Success', $Data);
		} catch (Exception $e) {
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}

	public function getAllotmentViewData()
	{
		$filter['alloted_id'] = $this->input->post('alloted_id');
		$data = _LM_HostelAllotmentModel()->getHostelAllotDataShowApi($filter);
		$data = isset($data[0]) ? $data[0] : [];
		$view_content = $this->load->view('HostelAdmin/Hostel_Allotment_ViewPage', ['data' => $data], true);
		echo $view_content;
	}


	public function getAllotMentLeaveHostelData()
	{
		try {
			$filter['alloted_id'] = $this->input->post('alloted_id');
			$data = _LM_HostelAllotmentModel()->getHostelAllotDataShowApi($filter);

			if (empty($data[0])) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Hostel Allot Not Found', [], ['error' => 'Hostel Allot Not Found']);
			}

			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Hostel Allot Data Found Successfully', $data[0]);
		} catch (Exception $e) {
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}


	public function getHostelLeaveData(&$requestedData = null)
	{
		try {
			// Get the request data
			if (!empty($requestedData)) {
				$filter = $requestedData;
			} else {
				$filter = getRequestData();
			}

			// Fetch the data
			$Data = _LM_HostelAllotmentModel()->getHostelLeaveData($filter);

			// Check if data is found
			if (empty($Data)) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Hostel  Not Found', [], ['error' => "Hostel  Not Found"]);
			}
			// Return success response
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Hostel  Data Found Successfully', $Data);
		} catch (Exception $e) {
			// Handle exception and return error response
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}

	public function check_hostelroom_available()
	{
		try {
			$filter = $this->input->post('hostel_room_id');
			$Data = _LM_HostelRoomsModel()->check_hostelroom_available($filter);

			// Check if data is empty
			if (empty($Data)) {
				// No data found
				return apiFormatResponse(
					$this->output,
					ApiResponseStatusCode::NOT_FOUND,
					'Hostel Rooms Allot Not Found',
					['available_rooms' => 0] // Return zero available rooms
				);
			}

			// Return success response with available rooms
			return apiFormatResponse(
				$this->output,
				ApiResponseStatusCode::OK,
				'Hostel Rooms Allot Data Found Successfully',
				['available_rooms' => $Data[0]['available_rooms']]
			);
		} catch (Exception $e) {
			// Handle exception and return error response
			return apiFormatResponse(
				$this->output,
				ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
				'An error occurred',
				['error' => $e->getMessage()]
			);
		}
	}

	public function Hos_Attendance_Report()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Attendance_Report');
		$this->load->view('NewMaster/footer');
	}
	public function Hos_Fee_Pay()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Fee_Pay');
		$this->load->view('NewMaster/footer');
	}
	public function view_profile_emp()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/view_profile_emp');
		$this->load->view('NewMaster/footer');
	}
	public function Hos_Fee_structure()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Fee_structure');
		$this->load->view('NewMaster/footer');
	}
	public function Hos_Fine()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Fine');
		$this->load->view('NewMaster/footer');
	}
	public function Hos_Gatepass()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Gatepass');
		$this->load->view('NewMaster/footer');
	}
	public function Hostel_Mess_Menu($hostel_mess_id = null)
	{
		$data['title'] = "Hostel_Mess_Menu";
		if (!empty($hostel_mess_id)) {
			$data = _LM_HostelMessModel()->find($hostel_mess_id);
		}
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hostel_Mess_Menu', $data);
		$this->load->view('NewMaster/footer');
	}

	public function Insert_Update_HostelMess()
	{
		$HostelMessData = $_POST;

		// Proceed with insert or update
		if (array_key_exists('hostel_mess_id', $HostelMessData) && !empty($HostelMessData['hostel_mess_id'])) {
			$updateResult = _LM_HostelMessModel()->update($HostelMessData);
			if (is_array($updateResult) && array_key_exists('errors', $updateResult) && !empty($updateResult['errors'])) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Hostel Mess Update Failed', [], $updateResult['errors']);
			}
			return apiFormatResponse($this->output, ApiResponseStatusCode::CREATED, 'Hostel Mess Updated Successfully', $updateResult);
		}

		// Insert new Mess
		$insertResult = _LM_HostelMessModel()->insert($HostelMessData);
		if (is_array($insertResult) && array_key_exists('errors', $insertResult) && !empty($insertResult['errors'])) {
			return apiFormatResponse(
				$this->output,
				ApiResponseStatusCode::VALIDATION_FAILED,
				'Hostel Mess Insertion Failed',
				[],
				$insertResult['errors']
			);
		}
		return apiFormatResponse(
			$this->output,
			ApiResponseStatusCode::CREATED,
			'Hostel Mess Added Successfully',
			[],

		);
	}


	public function getHostelMessData(&$requestedData = null)
	{
		try {
			// Get the request data
			if (!empty($requestedData)) {
				$filter = $requestedData;
			} else {
				$filter = getRequestData();
			}

			// Fetch the data
			$Data = _LM_HostelMessModel()->getHostelMessData($filter);

			// Check if data is found
			if (empty($Data)) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Hostel Mess Not Found', [], ['error' => "Hostel Mess  Not Found"]);
			}
			// Return success response
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Hostel Mess Data Found Successfully', $Data);
		} catch (Exception $e) {
			// Handle exception and return error response
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}

	public function delete_HostelMess($id)
	{
		if (!empty($id)) {
			$Data = _LM_HostelMessModel()->delete($id);
			if (is_array($Data) && array_key_exists('errors', $Data) && !empty($Data['errors'])) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Hostel Mess Failed', [], $Data['errors']);
			}
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Hostel Mess  Delete Successfully', $Data);
		}
	}

	public function Hos_Mess_Attendance()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Mess_Attendance');
		$this->load->view('NewMaster/footer');
	}
	public function Hos_Past_Hostellers()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Past_Hostellers');
		$this->load->view('NewMaster/footer');
	}
	public function Hos_Report()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Report');
		$this->load->view('NewMaster/footer');
	}
	public function Hos_Status()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_Status');
		$this->load->view('NewMaster/footer');
	}
	public function Hos_View_Hostel()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hos_View_Hostel');
		$this->load->view('NewMaster/footer');
	}


	public function getHostelViewData(&$requestedData = null)
	{
		try {
			// Get the request data
			if (!empty($requestedData)) {
				$filter = $requestedData;
			} else {
				$filter = getRequestData();
			}

			// Fetch the data
			$Data = _LM_HostelRoomsModel()->getHostelViewData($filter);

			// Check if data is found
			if (empty($Data)) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Hostel Not Found', [], ['error' => "Hostel  Not Found"]);
			}
			// Return success response
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Hostel Data Found Successfully', $Data);
		} catch (Exception $e) {
			// Handle exception and return error response
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}

	public function Hostel_Warden()
	{
		// $data['title'] = "AlumniPortal";
		$this->load->view('NewMaster/layout');
		$this->load->view('HostelAdmin/Hostel_Warden');
		$this->load->view('NewMaster/footer');
	}
	public function HostelFacilitylist()
	{
		$data = getRequestData();          // first
		$data['title'] = "Hostel Facility List";
		$data['facility_type'] = "hostel";

		$this->load->view('NewMaster/layout');
		$this->load->view('Studentsection/FacilityList', $data);
		$this->load->view('NewMaster/footer');
	}
}
