<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email_lib
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function sendEmail($recipient, $subject, $message, $attachment = null)
    {

        $email_credentials = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('email');

        $thirdPartyIntegrationData = !empty($email_credentials['third_party_integration_is_active'])
            ? (!empty($email_credentials['third_party_integration_is_production']) && $email_credentials['third_party_integration_is_production'] == 1
                ? $email_credentials['third_party_integration_production_data']
                : $email_credentials['third_party_integration_testing_data'])
            : [];

        $sender_email = $thirdPartyIntegrationData['sender_email'];
        $sender_name = $thirdPartyIntegrationData['sender_name'];
        $smtp_host = $thirdPartyIntegrationData['smtp_host'];
        $smtp_user = $thirdPartyIntegrationData['smtp_user'];
        $smtp_pass = $thirdPartyIntegrationData['smtp_pass'];
        $smtp_port = $thirdPartyIntegrationData['smtp_port'];
        $smtp_crypto = $thirdPartyIntegrationData['smtp_crypto'];

        // // Load the environment variables
        // $sender_email = getenv('SENDER_EMAIL');
        // $sender_name = getenv('SENDER_NAME');
        // $smtp_host = getenv('SMTP_HOST');
        // $smtp_user = getenv('SMTP_USER');
        // $smtp_pass = getenv('SMTP_PASS');
        // $smtp_port = getenv('SMTP_PORT');
        // $smtp_crypto = getenv('SMTP_SECURE');

        // Load the email library
        $this->CI->load->library('email');

        // Set email configuration
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $smtp_host;
        $config['smtp_port'] = $smtp_port;
        $config['smtp_user'] = $smtp_user;
        $config['smtp_pass'] = $smtp_pass;
        $config['smtp_crypto'] = $smtp_crypto;
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";

        $this->CI->email->initialize($config);

        // Set email parameters
        $this->CI->email->from($sender_email);
        $this->CI->email->to($recipient);
        $this->CI->email->reply_to($recipient);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        if (!empty($attachment)) {
            $this->CI->email->attach($attachment);
        }

        // Send email
        if (!$this->CI->email->send()) {
            log_message('error', $this->CI->email->print_debugger());
            return false;
        } else {
            return true;
        }
    }
}
