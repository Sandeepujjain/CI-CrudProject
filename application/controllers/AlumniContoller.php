<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlumniPortal extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->library('session_validation');
		$this->session_validation->checkSession();
	}
public function alumni_students_list()
	{

		$data['title'] = "AlumniPortal";
		$data['school_id'] = $_SESSION['emp_data_session']['emp_schoolid'];
		$this->load->view('NewMaster/layout');
		$this->load->view('AlumniPortal/alumni_students_list_page', $data);
		$this->load->view('NewMaster/footer');
	}

	public function Create_EventAlumni($alumni_event_id = null)
	{
		$this->load->view('NewMaster/layout');
		// $data['employee_id'] = $_SESSION['emp_data_session']['employee_id'];
		// $data['school_id'] = $_SESSION['emp_data_session']['emp_schoolid'];
		$academicYearModel = _LM_AcademicYearModel()->getDefaultAcademicYear();
		if (!empty($academicYearModel)) {
			$data['academic_year_id'] = $academicYearModel[0]['acdemic_year_id'];
		} else {
			$data['academic_year_id'] = null;
		}
		if (!empty($alumni_event_id)) {
			$data = _LM_AlumniEventModel()->find($alumni_event_id);
		}
		$this->load->view('AlumniPortal/Create_EventAlumni', $data);
		$this->load->view('NewMaster/footer');
	}


	public function getAlumniEventData(&$requestedData = null)
	{
		try {
			// Get the request data
			if (!empty($requestedData)) {
				$filter = $requestedData;
			} else {
				$filter = getRequestData();
			}

			// Fetch the data
			$Data = _LM_AlumniEventModel()->getAlumniEventData($filter);

			// Check if data is found
			if (empty($Data)) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'Data Not Found', [], ['error' => "Data Not Found"]);
			}
			// Return success response
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, ' Data Found Successfully', $Data);
		} catch (Exception $e) {
			// Handle exception and return error response
			return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
		}
	}


	public function Insert_Update_AlumniEvent()
	{
		$AlumniEventData = $_POST;

		// Proceed with insert or update
		if (array_key_exists('alumni_event_id', $AlumniEventData) && !empty($AlumniEventData['alumni_event_id'])) {
			$updateResult = _LM_AlumniEventModel()->update($AlumniEventData);
			if (is_array($updateResult) && array_key_exists('errors', $updateResult) && !empty($updateResult['errors'])) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Data Update Failed', [], $updateResult['errors']);
			}
			return apiFormatResponse($this->output, ApiResponseStatusCode::CREATED, ' Data Updated Successfully', $updateResult);
		}

		// Insert new Record
		$insertResult = _LM_AlumniEventModel()->insert($AlumniEventData);
		if (is_array($insertResult) && array_key_exists('errors', $insertResult) && !empty($insertResult['errors'])) {
			return apiFormatResponse(
				$this->output,
				ApiResponseStatusCode::VALIDATION_FAILED,
				'Data Insertion Failed',
				[],
				$insertResult['errors']
			);
		}
		return apiFormatResponse(
			$this->output,
			ApiResponseStatusCode::CREATED,
			'Data  Added Successfully',
			[],

		);
	}


	public function delete_AlumniEvent($id)
	{
		if (!empty($id)) {
			$Data = _LM_AlumniEventModel()->delete($id);
			if (is_array($Data) && array_key_exists('errors', $Data) && !empty($Data['errors'])) {
				return apiFormatResponse($this->output, ApiResponseStatusCode::VALIDATION_FAILED, 'Data  Failed', [], $Data['errors']);
			}
			return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'Data Delete Successfully', $Data);
		}
	}

}