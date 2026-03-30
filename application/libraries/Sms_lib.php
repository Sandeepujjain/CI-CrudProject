<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sms_lib
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->helper('url');
    }

    public function send_sms($phones, $message)
    {
        // $message = "Hello aman, Your session on 27-01-2025 (Lead ID: LID_2425_00142) concluded with Status done with Reason testing with Details testing. Contact us for help! Brillsense";
        // $SMS_URL = getenv('SMS_URL');
        // $SMS_USERNAME = getenv('SMS_USERNAME');
        // $SMS_AUTH_KEY = getenv('SMS_AUTH_KEY');
        // $SMS_SENDERNAME = getenv('SMS_SENDERNAME');
        // $SMS_PEID = getenv('SMS_PEID');
        // $SMS_TEMPLATEID = getenv('SMS_TEMPLATEID');

        $sms_credentials = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('sms');

        $thirdPartyIntegrationData = !empty($sms_credentials['third_party_integration_is_active'])
            ? (!empty($sms_credentials['third_party_integration_is_production']) && $sms_credentials['third_party_integration_is_production'] == 1
                ? $sms_credentials['third_party_integration_production_data']
                : $sms_credentials['third_party_integration_testing_data'])
            : [];

        $SMS_URL = $thirdPartyIntegrationData['send_sms_url'];
        $SMS_USERNAME = $thirdPartyIntegrationData['username'];
        $SMS_AUTH_KEY = $thirdPartyIntegrationData['api_key'];
        $SMS_SENDERNAME = $thirdPartyIntegrationData['sendername'];
        $SMS_PEID = $thirdPartyIntegrationData['peid'];
        $SMS_TEMPLATEID = $thirdPartyIntegrationData['templateid'];

        // Build SMS URL
        $url = $SMS_URL . "?username=$SMS_USERNAME&message=" . urlencode($message) . "&sendername=$SMS_SENDERNAME&smstype=TRANS&numbers=$phones&apikey=$SMS_AUTH_KEY&peid=$SMS_PEID&templateid=$SMS_TEMPLATEID";

        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20); // Set timeout to 20 seconds

        // Execute cURL session
        try {
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            return ['error' => $th->getMessage()];
        }
    }
}
