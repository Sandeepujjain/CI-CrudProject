<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'controllers/FirebaseController.php';

// use Dompdf\Dompdf;

class AccountAdmin extends CI_Controller
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

  /**
   * Load the common header layout
   *
   * @param array $data Data to be passed to the header view
   * @return void
   */
  protected function callLayout($data = [])
  {
    return $this->load->view('NewMaster/layout', $data);
  }

  /**
   * Load the common footer layout
   *
   * @param array $data Data to be passed to the footer view
   * @return void
   */
  protected function callFooter($data = [])
  {
    return $this->load->view('NewMaster/footer', $data);
  }

  /**
   * Generate breadcrumb array
   *
   * @param array $items
   * @return array
   */
  protected function generateBreadcrumbs($items)
  {
    $breadcrumbs = [
      ['name' => 'Home', 'url' => base_url('AccountAdmin/Dashboard'), 'icon' => base_url('assets/images/schoolicon2.png')],
      ['name' => 'Account Admin', 'url' => base_url('AccountAdmin/Dashboard')],
    ];

    foreach ($items as $item) {
      $breadcrumbs[] = $item;
    }

    return $breadcrumbs;
  }


  //  dashboard
  public function dashboard()
  {
    // $session_data = $this->session->userdata('emp_data_session');
    // $filter['school_id'] = $session_data['emp_schoolid'];

    $filter = array('school_id' => $this->session->userdata('emp_data_session')['emp_schoolid']);
    //  if (empty($filter['school_id']) || strpos($filter['school_id'], ',') !== false) {
    //   redirect($_SERVER['HTTP_REFERER']); // Redirect back to the previous page
    // }

    $data['title'] = "AccountAdmin";
    $filter['school_id'] = $_SESSION['emp_data_session']['emp_schoolid'];

    $academicYearModel = _LM_AcademicYearModel()->getDefaultAcademicYear();
    if (!empty($academicYearModel)) {
      $filter['academic_year_id'] = $academicYearModel[0]['acdemic_year_id'];
    } else {
      $filter['academic_year_id'] = null;
    }


    $data['AllFessData'] = _LM_StudentFeesPaymentsModel()
      ->select(
        'student_fees_payments.*, 
      CONCAT(
          IFNULL(students.stu_firstname, ""), " ",
          IFNULL(students.stu_middlename, ""), " ",
          IFNULL(students.stu_lastname, "")
      ) AS studentfullname,
      SUM(student_fees_clearance.late_fees_amount) AS total_late_fees,
      student_fees_clearance.due_date,
      student_fees_clearance.installment_amount,
      student_fees_clearance.deposit_installment_with_late_fees_amount'
      )
      ->where('student_fees_payments.school_id', $filter['school_id'])
      ->where('student_fees_payments.academic_year_id', $filter['academic_year_id'])
      ->join('student_fees_clearance', 'student_fees_clearance.student_fees_payment_id = student_fees_payments.student_fees_payment_id', 'left')
      ->join('students', 'students.student_id = student_fees_payments.student_id', 'left')
      ->groupBy('student_fees_payments.student_id, student_fees_clearance.due_date') // Add unique fields
      ->findAll();


    $data['totalLateFeesAmountSum'] = is_array($data['AllFessData']) ? array_reduce($data['AllFessData'], function ($sum, $item) {
      return $sum + (float) $item['total_late_fees'];
    }, 0) : 0;


    $data['OtherExpenseData'] = _LM_PostingLedgersModel()
      ->select('debit_amount')
      ->where('school_id', $filter['school_id'])
      ->whereIn('posting_voucher_type', ['OE', 'SAL']) // OE = Other Expense, SAL = Salary
      ->where('cr_dr', 'dr') // Only Debit (Expenses)
      ->findAll(); // Get all rows

    $data['totalexpenseAmountSum'] = is_array($data['OtherExpenseData']) ? array_reduce($data['OtherExpenseData'], function ($sum, $item) {
      return $sum + (float) $item['debit_amount'];
    }, 0) : 0;


    $data['PayrollData'] = _LM_PostingLedgersModel()
      ->where('school_id', $filter['school_id'])
      ->where('posting_voucher_type', 'SAL')
      ->where('cr_dr', 'cr')
      ->findAll();

    $data['totalPayrollAmountSum'] = is_array($data['PayrollData']) ? array_reduce($data['PayrollData'], function ($sum, $item) {
      return $sum + (float) $item['credit_amount'];
    }, 0) : 0;


    $data['fineData'] = _LM_LibraryIssueBookModel()->getIssueListWithFine($filter);
    $totalFineArray = array_map('floatval', array_column($data['fineData'], 'total_fine'));
    $totalFineSum = array_sum($totalFineArray);
    $data['totalfinevalue'] = number_format($totalFineSum, 2);


    $StudentFessData = _LM_StudentFeesModel()->getClassWiseFeesData($filter);
    $data['OverAllDueFeesAmount'] = array_sum(array_column($StudentFessData, 'total_unpaid_fees'));

    // Fetch Total Earning In School (Currently School Earn Student Fees)
    $total_earning_data = _LM_PostingLedgersModel()
      ->select('credit_amount')
      ->where('school_id', $filter['school_id'])
      ->whereIn('posting_voucher_type', ['SF', 'LF']) // SF = Student Fees , LF =Library Fine
      ->where('cr_dr', 'cr') // Only Credit 
      ->findAll() ?: []; // Get all rows

    // Total sum calculate
    $data['TotalEarningAmount'] = array_reduce($total_earning_data, function ($sum, $item) {
      return $sum + (float) $item['credit_amount'];
    }, 0);

    $data['total_concession_amount'] = _LM_StudentFeesModel()->getTotalConcessionAmount($filter);


    $totaltransportearningdata = _LM_PostingLedgersModel()
      ->select('credit_amount')
      ->where('school_id', $filter['school_id'])
      ->whereIn('posting_voucher_type', ['STF'])
      ->where('cr_dr', 'cr')
      ->findAll() ?: [];
    $data['TotalTransportFeesEarningAmount'] = array_reduce($totaltransportearningdata, function ($sum, $item) {
      return $sum + (float) $item['credit_amount'];
    }, 0);

    $data['TransportFeesSummary'] = _LM_StudentTransportFeesModel()
      ->getTransportFeesSummaryOverall([
        'school_id' =>  $filter['school_id'],
        'academic_year_id' => $filter['academic_year_id']
      ]);



    $this->callLayout($data);
    $this->load->view('AccountAdmin/dashboard-backup', $data);
  }

  
  public function Student_Registration_Fees($requestedData = null)
  {
    if (!empty($this->session->userdata('emp_data_session'))) {
      $data['title'] = "Registration Fees";

      if (!empty($requestedData)) {
        $filter = $requestedData;
      } else {
        $filter = getRequestData();
      }
      $School_id = $_SESSION['emp_data_session']['emp_schoolid'];
      $data['studentDataList'] = _LM_StudentsModel()
        ->select('stu_admission_id, student_id,
                CONCAT_WS(" ", stu_firstname, NULLIF(stu_middlename, ""), stu_lastname) AS studentfullname')
        // ->where('stu_approve', 'approve')
        ->where('stu_schoolid', $School_id)
        ->findAll();




      $this->callLayout($data);
      $this->load->view('AccountAdmin/Student_Registration_Fees', $data);
      $this->callFooter($data);
    } else {
      redirect('Login/index');
    }
  }


  public function RegistrationFeesData(&$requestedData = null)
  {
    try {
      $filter = !empty($requestedData) ? $requestedData : getRequestData();
      $Data = _LM_StudentRegistrationFeesModel()->getStudentRegistrationFeesData($filter);

      // Check if data is found
      if (empty($Data)) {
        return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'DATA  Not Found', [], ['error' => "DATA Not Found"]);
      }
      // Return success response
      return apiFormatResponse($this->output, ApiResponseStatusCode::OK, 'DATA  Found Successfully', $Data);
    } catch (Exception $e) {
      // Handle exception and return error response
      return apiFormatResponse($this->output, ApiResponseStatusCode::INTERNAL_SERVER_ERROR, 'An error occurred', [], ['error' => $e->getMessage()]);
    }
  }





  public function StudentRegistrationFeePay($requestedData = null)
  {
    if (!empty($this->session->userdata('emp_data_session'))) {
      $data['title'] = "Student Registration Fee Payment";
      $filter = !empty($requestedData) ? $requestedData : getRequestData();
      $data['student_data'] = _LM_StudentRegistrationFeesModel()->getStudentRegistrationFeesData($filter);

      if (empty($data['student_data'])) {
        return apiFormatResponse($this->output, ApiResponseStatusCode::NOT_FOUND, 'DATA  Not Found', [], ['error' => "DATA Not Found"]);
      }

      $data['registration_payment_reference_number'] = $this->generateRegistrationPaymentReferenceNumber();

      $this->callLayout($data);
      $this->load->view('AccountAdmin/StudentRegistrationFeesPayment_Page', $data);
    } else {
      redirect('Login/index');
    }
  }

  public function generateRegistrationPaymentReferenceNumber()
  {
    $society_data = trim(_LM_SocietyModel()->where('society_id', $_SESSION['emp_data_session']['emp_societyid'])->findAll()[0]['societyshortname'] ?? "");
    $school_data = str_replace(' ', '', _LM_SchoolModel()->where('school_id', $_SESSION['emp_data_session']['emp_schoolid'])->findAll()[0]['campusshortname'] ?? "");
    $lastId = _LM_StudentRegistrationPaymentsModel()->getLastRegistrationPaymentReferenceNumberUniqueId();


    if (empty($society_data) || empty($school_data)) {
      $registration_payment_reference_number = null;
    } else {
      $prefix = date("Y-m-d") . "-{$society_data}/{$school_data}/SRF"; //SRF for Student Registration Fees
      $registration_payment_reference_number = generateDocumentNum(5, $lastId, $prefix, null, "-");
    }

    return $registration_payment_reference_number;
  }

  public function submit_student_registration_fees()
  {
    $response = $this->process_student_registration_fees_payment('direct', "ARRAY");

    if ($response['ApiResponseStatusCode'] !== ApiResponseStatusCode::OK) {
      // If there's an error, handle it
      return apiformatResponse(
        $this->output,
        $response['ApiResponseStatusCode'],
        $response['message'],
        $response['data'],
        $response['errors']
      );
    }

    return apiFormatResponse(
      $this->output,
      ApiResponseStatusCode::OK,
      'Registration fees payment processed successfully.',
      $response['data']
    );
  }

  public function process_student_registration_fees_payment($payment_mode = 'direct', $return_type = "JSON")
  {
    try {
      $StudentRegistrationFeesPaymentData = getRequestData();
      $paymentIds = []; // Initialize paymentIds array

      // Set payment method
      if (isset($_POST['payment_method']) && !empty($_POST['payment_method'])) {
        $StudentRegistrationFeesPaymentData['payment_method'] = implode(", ", $_POST['payment_method']);
      } else {
        $StudentRegistrationFeesPaymentData['payment_method'] = '';
      }

      // Set payment status based on mode
      $paymentStatus = ($payment_mode === 'gateway') ? 'Pending' : 'Completed';

      // Begin DB transaction
      $this->db->trans_begin();

      $insertData = [
        'student_registration_id' => $StudentRegistrationFeesPaymentData['student_registration_id'] ?? null,
        'school_id' => $StudentRegistrationFeesPaymentData['school_id'] ?? null,
        'student_id' => $StudentRegistrationFeesPaymentData['student_id'] ?? null,
        'academic_year_id' => $StudentRegistrationFeesPaymentData['academic_year_id'] ?? null,
        'class_id' => $StudentRegistrationFeesPaymentData['class_id'] ?? null,
        'payment_date' => $StudentRegistrationFeesPaymentData['payment_date'] ?? date('Y-m-d'),
        'registration_payment_reference_number' => $this->generateRegistrationPaymentReferenceNumber(),
        'payment_method' => $StudentRegistrationFeesPaymentData['payment_method'],
        'payment_status' => $paymentStatus,
        'transaction_registration_reference_number' => $StudentRegistrationFeesPaymentData['transaction_registration_reference_number'] ?? null,
        'transaction_id' => $StudentRegistrationFeesPaymentData['transaction_id'] ?? null,
        'bank_name' => $StudentRegistrationFeesPaymentData['bank_name'] ?? null,
        'cheque_number' => $StudentRegistrationFeesPaymentData['cheque_number'] ?? null,
        'cheque_date' => $StudentRegistrationFeesPaymentData['cheque_date'] ?? null,
        'paid_amount' => $StudentRegistrationFeesPaymentData['paid_amount'] ?? null,
        'remark' => $StudentRegistrationFeesPaymentData['remark'] ?? null,
        'created_employee_id' => $StudentRegistrationFeesPaymentData['created_employee_id'] ?? null,
      ];

      $StudentRegistrationPaymentId = _LM_StudentRegistrationPaymentsModel()->insert($insertData, false, true);

      if (!$StudentRegistrationPaymentId) {
        throw new Exception('Failed to insert installment record.');
      }

      $paymentIds[] = $StudentRegistrationPaymentId;

      // Only process ledger entries and update fees if payment is completed (direct payment)
      if ($paymentStatus === 'Completed') {
        try {
          // Update registration fees record
          $updateData = [
            'total_paid_amount' => $StudentRegistrationFeesPaymentData['paid_amount'] ?? null,
            'payment_status' => 'Paid',
            'remark' => $StudentRegistrationFeesPaymentData['remark'] ?? null,
          ];

          // Update query
          $updateResult = _LM_StudentRegistrationFeesModel()->update(
            $updateData,
            $StudentRegistrationFeesPaymentData['student_registration_id'] ?? null
          );

          if (is_array($updateResult) && isset($updateResult['errors'])) {
            throw new Exception('Failed to update registration fees record.');
          }

          // Insert ledger entries
          $this->InsertRegistrationFeesForPostingLedgers($StudentRegistrationPaymentId, $StudentRegistrationFeesPaymentData, $insertData);
        } catch (Exception $e) {
          $this->db->trans_rollback();
          throw new Exception('Posting ledgers failed: ' . $e->getMessage());
        }
      }

      // Transaction check
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();

        if ($return_type === "JSON") {
          return apiFormatResponse(
            $this->output,
            ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
            'Failed to insert registration fees records',
            [],
            ['error' => 'DB Transaction failed']
          );
        } else {
          return [
            'ApiResponseStatusCode' => ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
            'message' => 'Failed to insert registration fees records',
            'data' => [],
            'errors' => ['error' => 'DB Transaction failed']
          ];
        }
      } else {
        $this->db->trans_commit();

        $responseData = [
          'payment_ids' => $paymentIds,
          'total_amount' => $StudentRegistrationFeesPaymentData['paid_amount'] ?? null,
          'payment_mode' => $payment_mode,
          'payment_status' => $paymentStatus,
          'reference_number' => $insertData['registration_payment_reference_number'] ?? null
        ];

        if ($return_type === "JSON") {
          return apiFormatResponse(
            $this->output,
            ApiResponseStatusCode::OK,
            'Registration Fees payment submitted successfully',
            $responseData
          );
        } else {
          return [
            'ApiResponseStatusCode' => ApiResponseStatusCode::OK,
            'message' => 'Student Registration Fees payment submitted successfully',
            'data' => $responseData,
            'errors' => []
          ];
        }
      }
    } catch (Exception $e) {
      $this->db->trans_rollback();

      if ($return_type === "JSON") {
        return apiFormatResponse(
          $this->output,
          ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
          'An error occurred while processing registration fees',
          [],
          ['error' => $e->getMessage()]
        );
      } else {
        return [
          'ApiResponseStatusCode' => ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
          'message' => 'An error occurred while processing registration fees',
          'data' => [],
          'errors' => ['error' => $e->getMessage()]
        ];
      }
    }
  }




  public function InsertRegistrationFeesForPostingLedgers($StudentRegistrationPaymentId, $StudentRegistrationFeesPaymentData, $data = [])
  {
    if (empty($StudentRegistrationPaymentId) || empty($StudentRegistrationFeesPaymentData)) {
      return false;
    }

    // Voucher number nikalne ka better tarika
    $voucherNumber = $StudentRegistrationFeesPaymentData['registration_payment_reference_number'] ??
      ($data['registration_payment_reference_number'] ??
        $StudentRegistrationFeesPaymentData['transaction_registration_reference_number'] ??
        null
      );

    // ✅ Sundry Debtor Entry (DR)
    $sundryDebtorArray = [
      'school_id' => $StudentRegistrationFeesPaymentData['school_id'],
      'posting_voucher_type' => "SRF",
      'voucher_number' => $voucherNumber,
      'voucher_date' => $StudentRegistrationFeesPaymentData['payment_date'] ?? date('Y-m-d'),
      'student_registration_payment_id' => $StudentRegistrationPaymentId,
      'ledger_id' => '45', // Sundry Debtors
      'amount' => $StudentRegistrationFeesPaymentData['paid_amount'] ?? 0,
      'cr_dr' => "dr",
      'debit_amount' => $StudentRegistrationFeesPaymentData['paid_amount'] ?? 0,
      'remark' => $StudentRegistrationFeesPaymentData['remark'] ?? 'Student Registration Fees Payment',
      'created_emp_id' => $StudentRegistrationFeesPaymentData['created_employee_id'] ?? null,
    ];

    // ✅ Student Registration Fees Income Entry (CR)
    $studentFeesIncomeArray = [
      'school_id' => $StudentRegistrationFeesPaymentData['school_id'],
      'posting_voucher_type' => "SRF",
      'voucher_number' => $voucherNumber,
      'voucher_date' => $StudentRegistrationFeesPaymentData['payment_date'] ?? date('Y-m-d'),
      'student_registration_payment_id' => $StudentRegistrationPaymentId,
      'ledger_id' => '62', // Student Registration Fees Income
      'amount' => $StudentRegistrationFeesPaymentData['paid_amount'] ?? 0,
      'cr_dr' => "cr",
      'credit_amount' => $StudentRegistrationFeesPaymentData['paid_amount'] ?? 0,
      'remark' => $StudentRegistrationFeesPaymentData['remark'] ?? 'Student Registration Fees Income',
      'created_emp_id' => $StudentRegistrationFeesPaymentData['created_employee_id'] ?? null,
    ];

    // Insert both entries
    $sundryDebtorData = _LM_PostingLedgersModel()->insert($sundryDebtorArray);
    if (is_array($sundryDebtorData) && !empty($sundryDebtorData['errors'] ?? [])) {
      throw new Exception('Failed to insert Sundry Debtors entry.');
    }

    $studentFeesIncomeData = _LM_PostingLedgersModel()->insert($studentFeesIncomeArray);
    if (is_array($studentFeesIncomeData) && !empty($studentFeesIncomeData['errors'] ?? [])) {
      throw new Exception('Failed to insert Student Registration Fees Income entry.');
    }

    return true;
  }





  public function submit_student_registration_fees_with_gateway()
  {
    $paymentData = getRequestData();

    // Get gateway data
    $gateway = _LM_PaymentGatewayModel()->get_testing_gateway_data($paymentData['school_id']);

    if (empty($gateway)) {
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::BAD_REQUEST,
        'No payment gateway configured for this school. Please configure payment gateway first.'
      );
    }

    // First, process the payment as pending
    $response = $this->process_student_registration_fees_payment('gateway', "ARRAY");


    if ($response['ApiResponseStatusCode'] !== ApiResponseStatusCode::OK) {
      // Return error response
      return apiformatResponse(
        $this->output,
        $response['ApiResponseStatusCode'],
        $response['message'],
        $response['data'],
        $response['errors']
      );
    }

    // Store payment data in session for payment gateway
    $paymentData['student_registration_payment_id'] = $response['data']['payment_ids'];
    $paymentData['payment_status'] = 'Pending';
    $paymentData['amount'] = $response['data']['paid_amount'];

    // Store gateway type in session
    $paymentData['gateway_type'] = $gateway['payment_gateway_type'];
    $paymentData['gateway_data'] = $gateway;

    $this->session->set_userdata('student_registration_payment_session', $paymentData);

    // Set redirect URL based on gateway type
    $redirect_url = base_url('AccountAdmin/StudentRegistrationPaymentIntegration');

    // Add redirect URL to response
    $response['data']['redirect_url'] = $redirect_url;

    return apiFormatResponse(
      $this->output,
      ApiResponseStatusCode::OK,
      'Payment processed. Redirecting to payment gateway.',
      $response['data'],
    );
  }



  public function StudentRegistrationPaymentIntegration()
  {
    $feesData = $this->session->userdata('student_registration_payment_session');

    if (empty($feesData)) {
      redirect('AccountAdmin/Student_Registration_Fees');
    }

    $gatewayType = $feesData['gateway_type'] ?? '';
    $gatewayData = $feesData['gateway_data'] ?? [];

    // Prepare common data
    $data['gateway'] = $gatewayData;
    $data['amount'] = $feesData['paid_amount'];
    $data['student_registration_payment_id'] = $feesData['student_registration_payment_id'];
    $data['registration_payment_reference_number'] = $feesData['registration_payment_reference_number'] ?? '';
    $data['payment_type'] = 'registration_fees'; // Added to identify payment type
    // Load appropriate view based on gateway type
    if ($gatewayType === 'RAZORPAY') {
      $this->load->view('AccountAdmin/CommonRazorpayPaymentPage', $data);
    } elseif ($gatewayType === 'CCAVENUE') {
      $this->load->view('AccountAdmin/CommonCCAvenuePaymentPage', $data);
    }
  }

  // Complete student registration payment after gateway success
  public function complete_student_registration_fees_payment($payment_ids, $transaction_data = [])
  {
    $this->db->trans_start();

    $successCount = 0;
    $failedCount = 0;

    if (!is_array($payment_ids)) {
      $payment_ids = [$payment_ids];
    }

    foreach ($payment_ids as $payment_id) {
      // Get payment record
      $paymentRecord = _LM_StudentRegistrationPaymentsModel()->find($payment_id);

      if (!$paymentRecord) {
        $failedCount++;
        continue;
      }

      // Update payment record
      $updateData = [
        'payment_status' => 'Completed',
        'transaction_id' => $transaction_data['transaction_id'] ?? null,
        'transaction_registration_reference_number' => $transaction_data['transaction_registration_reference_number'] ?? null,
        'bank_name' => $transaction_data['bank_name'] ?? null,
        'cheque_number' => $transaction_data['cheque_number'] ?? null,
        'cheque_date' => $transaction_data['cheque_date'] ?? null,
        'updated_at' => date('Y-m-d H:i:s')
      ];

      $updateResult = _LM_StudentRegistrationPaymentsModel()->update($updateData, $payment_id);

      if ($updateResult) {
        // Get the installment data from payment record
        $paymentData = _LM_StudentRegistrationPaymentsModel()->find($payment_id);

        $feesUpdateData = [
          'total_paid_amount' => $paymentData['paid_amount'] ?? null,
          'payment_status' => 'Paid',
          'remark' => $paymentData['remark'] ?? null,
        ];

        $feesUpdateResult = _LM_StudentRegistrationFeesModel()->update(
          $feesUpdateData,
          $paymentData['student_registration_id'] ?? null
        );

        if (is_array($feesUpdateResult) && isset($feesUpdateResult['errors'])) {
          throw new Exception('Failed to update registration fees record.');
        }

        $this->InsertRegistrationFeesForPostingLedgers($payment_id, $paymentData);



        $successCount++;
      } else {
        $failedCount++;
      }
    }

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return false;
    } else {
      $this->db->trans_commit();
      return ['success' => $successCount, 'failed' => $failedCount];
    }
  }

  // Razorpay Payment Success Callback for Student Registration Fees
  public function razorpay_payment_success_student_registration_fees()
  {
    $data = getRequestData();
    $feesData = $this->session->userdata('student_registration_payment_session');

    if (empty($feesData)) {
      // Try to get payment IDs from data
      $paymentIds = $data['student_registration_payment_id'] ?? null;
      if (!$paymentIds) {
        return apiFormatResponse(
          $this->output,
          ApiResponseStatusCode::BAD_REQUEST,
          'Payment session expired.'
        );
      }
    } else {
      $paymentIds = $feesData['student_registration_payment_id'];
    }

    // Complete the payment
    $transaction_data = [
      'transaction_id' => $data['razorpay_payment_id'] ?? null,
      'transaction_registration_reference_number' => $data['razorpay_order_id'] ?? null,
      'bank_name' => $data['bank_name'] ?? null,
      'cheque_number' => $data['cheque_number'] ?? null,
      'cheque_date' => $data['cheque_date'] ?? null
    ];

    $completeResult = $this->complete_student_registration_fees_payment($paymentIds, $transaction_data);

    // Clear session
    $this->session->unset_userdata('student_registration_payment_session');

    if ($completeResult) {
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::OK,
        'Registration Fees completed successfully.',
        ['result' => $completeResult]
      );
    } else {
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
        'Failed to  Registration Fees.'
      );
    }
  }

  // Razorpay Payment Failed Callback for Student Registration Fees
  public function razorpay_payment_failed_student_registration_fees()
  {
    $data = getRequestData();
    $feesData = $this->session->userdata('student_registration_payment_session');

    if (!empty($feesData)) {
      $paymentIds = $feesData['student_registration_payment_id'];

      // Delete pending payment records
      $this->db->trans_start();
      foreach ($paymentIds as $paymentId) {
        _LM_StudentRegistrationPaymentsModel()->delete($paymentId);
      }
      $this->db->trans_commit();
    }

    // Clear session
    $this->session->unset_userdata('student_registration_payment_session');

    return apiFormatResponse(
      $this->output,
      ApiResponseStatusCode::BAD_REQUEST,
      'Registration Fees payment was cancelled or failed. Please try again.'
    );
  }

  // CCAvenue Payment Success Callback for Student Registration Fees
  public function ccavenue_payment_success_student_registration_fees()
  {
    $data = $this->input->post();
    $feesData = $this->session->userdata('student_registration_payment_session');

    if (empty($feesData)) {
      return apiFormatResponse(
        $this->output,
        ApiResponseStatusCode::BAD_REQUEST,
        'Payment session expired.'
      );
    }

    $paymentIds = $feesData['student_registration_payment_id'];
    $order_status = $data['order_status'] ?? '';

    if ($order_status === "Success") {
      // Complete the payment
      $transaction_data = [
        'transaction_id' => $data['tracking_id'] ?? null,
        'transaction_registration_reference_number' => $data['order_id'] ?? null,
        'bank_name' => $data['bank_name'] ?? null,
        'cheque_number' => $data['cheque_number'] ?? null,
        'cheque_date' => $data['cheque_date'] ?? null
      ];

      $completeResult = $this->complete_student_registration_fees_payment($paymentIds, $transaction_data);

      $message = 'Student Registration payment completed successfully.';
      $statusCode = ApiResponseStatusCode::OK;
    } elseif ($order_status === "Failure") {
      // Delete pending payment records
      $this->db->trans_start();
      foreach ($paymentIds as $paymentId) {
        _LM_StudentRegistrationPaymentsModel()->delete($paymentId);
      }
      $this->db->trans_commit();

      $message = 'Student Registration payment failed.';
      $statusCode = ApiResponseStatusCode::BAD_REQUEST;
    } else {
      $message = 'Payment status unknown.';
      $statusCode = ApiResponseStatusCode::BAD_REQUEST;
    }

    // Clear session
    $this->session->unset_userdata('student_registration_payment_session');

    return apiFormatResponse(
      $this->output,
      $statusCode,
      $message
    );
  }

  // CCAvenue Payment Failed Callback for Student Registration Fees
  public function ccavenue_payment_failed_student_registration_fees()
  {
    $data = $this->input->post();
    $feesData = $this->session->userdata('student_registration_payment_session');

    if (!empty($feesData)) {
      $paymentIds = $feesData['student_registration_payment_id'];

      // Delete pending payment records
      $this->db->trans_start();
      foreach ($paymentIds as $paymentId) {
        _LM_StudentRegistrationPaymentsModel()->delete($paymentId);
      }
      $this->db->trans_commit();
    }

    // Clear session
    $this->session->unset_userdata('student_registration_payment_session');

    return apiFormatResponse(
      $this->output,
      ApiResponseStatusCode::BAD_REQUEST,
      'Student Registration payment was cancelled or failed. Please try again.'
    );
  }



  public function StudentRegistrationFeesRecipt(&$requestedData = null)
  {
    $filter = !empty($requestedData) ? $requestedData : getRequestData();

    // Debug - check karte hain data aa raha hai ya nahi
    log_message('debug', 'StudentRegistrationFeesRecipt called with filter: ' . print_r($filter, true));

    // Student Registration Fees Data
    $data['studentregistrationfeedata'] = _LM_StudentRegistrationFeesModel()->getStudentRegistrationFeesData($filter);

    // Debug - check data
    log_message('debug', 'Student Registration Fees Data: ' . print_r($data['studentregistrationfeedata'], true));

    // Load view
    $view_content = $this->load->view('AccountAdmin/registrationfees_receipt_view', $data, true);

    // Debug - check view content
    log_message('debug', 'View content length: ' . strlen($view_content));

    $response = [
      'success' => true,
      'view' => $view_content,
      'data' => $data['studentregistrationfeedata'] // Optional: data bhi bhej sakte hain
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Important: exit karna mat bhoolna
  }
}


