<?php


if (!function_exists('uploadFile')) {
    /**
     * Upload a file with validation checks.
     *
     * @param string $inputName The input field name from the $_FILES array.
     * @param array $allowedMimeTypes An array of allowed MIME types and their corresponding extensions.
     * @param string $uploadDir The directory to upload the file to.
     * @param int $maxFileSize The maximum allowed file size in bytes (default is 2MB).
     *
     * @return array An array containing the status, message, and file name/path if successful.
     */
    function uploadFile($inputName, $allowedMimeTypes = [], $uploadDir = '', $maxFileSize = 2 * 1024 * 1024)
    {
        // Check if the file input exists
        if (!isset($_FILES[$inputName])) {
            return ['status' => false, 'message' => 'No file uploaded.'];
        }

        $fileData = $_FILES[$inputName];

        // Check for upload errors
        if (!is_array($fileData) || $fileData['error'] !== UPLOAD_ERR_OK) {
            return ['status' => false, 'message' => 'File upload error: ' . ($fileData['error'] ?? 'Unknown error')];
        }

        // Validate file size
        if ($fileData['size'] > $maxFileSize) {
            return ['status' => false, 'message' => 'File size exceeds the maximum limit of ' . ($maxFileSize / 1024 / 1024) . 'MB'];
        }

        // Validate file type (MIME type)
        if (!array_key_exists($fileData['type'], $allowedMimeTypes)) {
            return ['status' => false, 'message' => 'Invalid file type. Only the following types are allowed: ' . implode(', ', array_keys($allowedMimeTypes))];
        }

        // Define file extension and file name
        $fileExtension = $allowedMimeTypes[$fileData['type']];
        $fileName = time() . '-' . uniqid() . $fileExtension; // Use timestamp and unique ID for the file name
        $filePath = rtrim($uploadDir, '/') . '/' . $fileName;

        // Create upload directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file to the desired location
        if (move_uploaded_file($fileData['tmp_name'], $filePath)) {
            return ['status' => true, 'message' => 'File uploaded successfully', 'fileName' => $fileName, 'filePath' => $filePath];
        } else {
            return ['status' => false, 'message' => 'Failed to move the uploaded file.'];
        }
    }
}

if (!function_exists('getRequestData')) {
    function getRequestData()
    {
        $CI = &get_instance();

        // Initialize an empty array to store all kinds of request data
        $requestData = [];

        // Get POST data
        $post = $CI->input->post();
        if (!empty($post)) {
            $requestData = $post;
        }

        // Get GET data
        $get = $CI->input->get();
        if (!empty($get)) {
            $requestData = $get;
        }
        // Get JSON data
        $json = file_get_contents("php://input");
        if (!empty($json)) {
            $jsonData = json_decode($json, true);
            if ($jsonData !== null) {
                $requestData = $jsonData;
            }
        }
        return $requestData;
    }
}

class ApiResponseStatusCode
{
    // Success codes
    const OK = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;

    // Client error codes
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    // Server error codes
    const INTERNAL_SERVER_ERROR = 500;
    const SERVICE_UNAVAILABLE = 503;
    // Validation Failed
    const VALIDATION_FAILED = 422;
}


/**
 * Formats a common response array.
 *
 * @param ApiResponseStatusCode The ApiResponseStatusCode code of the response.
 * @param string $message The message associated with the response.
 * @param mixed $data Additional data to include in the response.
 * @param array $error Any errors associated with the response.
 * @return array The formatted response array.
 */
if (!function_exists('commonFormatResponse')) {
    function commonFormatResponse(int $ApiResponseStatusCode, string $message, $data = [], array $error = []): array
    {
        return [
            'ApiResponseStatusCode' => $ApiResponseStatusCode,
            'message' => $message,
            'data' => $data,
            'errors' => $error
        ];
    }
}

/**
 * Automatically formats an API response.
 *
 * @param mixed $response The HTTP response object.
 * @param array $commonFormatResponse The common response array.
 */
if (!function_exists('apiAutoFormatResponse')) {
    function apiAutoFormatResponse($output, array $commonFormatResponse)
    {
        // Returning the common format response directly
        return apiFormatResponse($output, $commonFormatResponse['ApiResponseStatusCode'], $commonFormatResponse['message'], $commonFormatResponse['data'], $commonFormatResponse['errors']);
    }
}

/**
 * Formats an API response.
 *
 * @param mixed $response The HTTP response object.
 * @param int $ApiResponseStatusCode The ApiResponseStatusCode code of the response.
 * @param string $message The message associated with the response.
 * @param mixed $data Additional data to include in the response.
 * @param array $error Any errors associated with the response.
 * @return string The JSON-encoded response.
 */
if (!function_exists('apiFormatResponse')) {
    function apiFormatResponse($output, int $ApiResponseStatusCode, string $message, $data = [], array $error = [], $filters = [])
    {
        $responseData = getRequestData();
        if (array_key_exists('__encode', $responseData) && $responseData['__encode'] == true) {
            $data = base64_encode(gzencode(json_encode($data)));
        }
        // Construct the response array
        $responseArray = [
            'ApiResponseStatusCode' => $ApiResponseStatusCode,
            'message' => $message,
            'data' => $data,
            'errors' => $error,
            'filters' => $filters
        ];
        return $output
            ->set_header('Access-Control-Allow-Origin: *') // Allow all origins, or specify specific domain
            ->set_header('Access-Control-Allow-Methods: GET, POST, OPTIONS') // Specify allowed HTTP methods
            ->set_header('Access-Control-Allow-Headers: Content-Type, Authorization') // Allow specific headers
            // ->set_header('HTTP/1.0 200 OK')
            // ->set_header('HTTP/1.1 200 OK')
            ->set_header('Cache-Control: no-store, no-cache, must-revalidate')
            ->set_header('Cache-Control: post-check=0, pre-check=0')
            ->set_header('Pragma: no-cache')
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            // ->set_output(json_encode($responseArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            ->set_output(json_encode($responseArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
/**
 * Formats an Common response.
 * @param int $ApiResponseStatusCode The ApiResponseStatusCode code of the response.
 * @param string $message The message associated with the response.
 * @param mixed $data Additional data to include in the response.
 * @param array $error Any errors associated with the response.
 * @return array The JSON-encoded response.
 */
if (!function_exists('formatCommonResponse')) {
    function formatCommonResponse(int $ApiResponseStatusCode, string $message, $data = [], array $error = [], $filters = [])
    {
        return $responseArray = [
            'ApiResponseStatusCode' => $ApiResponseStatusCode,
            'message' => $message,
            'data' => $data,
            'errors' => $error,
            'filters' => $filters
        ];
    }
}

/**
 * Formats an Common response.
 * @param mixed $response The HTTP response object.
 * @param array $formatCommonResponse The formatCommonResponse from function formatCommonResponse.
 * @return string The JSON-encoded response.
 */
if (!function_exists('apiFormatAutoResponse')) {
    function apiFormatAutoResponse($output, array $formatCommonResponse)
    {
        return apiFormatResponse($output, $formatCommonResponse['ApiResponseStatusCode'], $formatCommonResponse['message'], $formatCommonResponse['data'], $formatCommonResponse['errors'], $formatCommonResponse['filters']);
    }
}




/**
 * Validates required fields and returns an array of error messages for missing fields.
 *
 * @param array $data The data to validate.
 * @param array $validationRules An array of validation rules with optional custom error messages.
 * @return array An array of error messages for validation failures.
 */
function validateFields($data, $validationRules)
{
    $errors = [];

    foreach ($validationRules as $field => $rules) {
        // If the field is not provided or is empty
        if (empty($data[$field])) {
            $errors[$field] = $rules['required'] ?? "$field is required";
            continue;
        }

        // If the field is provided, apply additional validations
        if (isset($rules['email']) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
            $errors[$field] = $rules['email'] ?? "$field must be a valid email address";
        }

        if (isset($rules['phone']) && !preg_match('/^\d{10}$/', $data[$field])) {
            $errors[$field] = $rules['phone'] ?? "$field must be a 10-digit phone number";
        }

        if (isset($rules['min_length']) && strlen($data[$field]) < $rules['min_length']) {
            $errors[$field] = $rules['min_length_msg'] ?? "$field must be at least {$rules['min_length']} characters long";
        }

        if (isset($rules['max_length']) && strlen($data[$field]) > $rules['max_length']) {
            $errors[$field] = $rules['max_length_msg'] ?? "$field must be no more than {$rules['max_length']} characters long";
        }
    }

    return $errors;
}



if (!function_exists('curlApiRequest')) {
    function curlApiRequest(
        string $url,
        string $method = 'GET',
        array $parameters = [],
        array $headers = [],
        bool $api_response_is_encode = false
    ) {
        log_message('error', $url . ' Start: ' . date('Y-m-d H:i:s'));

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set headers
        if (!empty($headers)) {
            $formattedHeaders = [];
            foreach ($headers as $key => $value) {
                $formattedHeaders[] = "$key: $value";
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $formattedHeaders);
        }

        // Handle file upload (multipart/form-data)
        if (isset($parameters['file']) && is_array($parameters['file'])) {
            // Ensure the parameter is an array with a file field
            if (isset($parameters['file']['tmp_name']) && file_exists($parameters['file']['tmp_name'])) {
                // Set content type for file upload
                $headers['Content-Type'] = 'multipart/form-data';

                // Prepare the POST fields (multipart form-data)
                $postFields = [
                    'file' => new CURLFile($parameters['file']['tmp_name'], $parameters['file']['type'], $parameters['file']['name']),
                ];

                // Add other parameters
                foreach ($parameters as $key => $value) {
                    if ($key !== 'file') {
                        $postFields[$key] = $value;
                    }
                }

                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
        } else {
            // Handle regular POST data (for non-file requests)
            switch (strtoupper($method)) {
                case 'POST':
                    curl_setopt($ch, CURLOPT_POST, true);
                    if (!empty($parameters)) {
                        if (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/json') {
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        } else {
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                        }
                    }
                    break;
                case 'PUT':
                case 'PATCH':
                case 'DELETE':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

                    if (!empty($parameters)) {
                        if (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/json') {
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
                        } else {
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                        }
                    }
                    break;
                case 'GET':
                    // GET method; append parameters to URL
                    if (!empty($parameters)) {
                        $url .= '?' . http_build_query($parameters);
                        curl_setopt($ch, CURLOPT_URL, $url);
                    }
                    break;
                default:
                    throw new Exception("Unsupported HTTP method: $method");
            }
        }

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            log_message('error', $url . ' API Error Response End: ' . date('Y-m-d H:i:s'));

            return [
                'status' => 500,
                'message' => 'cURL Error',
                'errors' => $error,
                'data' => null,
            ];
        }

        // Close cURL session
        curl_close($ch);

        // Decode the response
        $decoded_response = json_decode($response, true);

        // Handle response validation if required
        if ($api_response_is_encode) {
            if (empty($decoded_response)) {
                return [
                    'status' => 500,
                    'message' => 'Empty API Response',
                    'errors' => [],
                ];
            }
            // Check for valid response format
            if (!isset($decoded_response['status'])) {
                return [
                    'status' => 500,
                    'message' => 'Invalid API Response Format',
                    'errors' => [],
                ];
            }
        }

        // If no errors, return the response as success
        return [
            'status' => 200,
            'message' => 'API Request Successful',
            'data' => $decoded_response,
        ];
    }
}


if (!function_exists('generate_qrcode')) {
    /**
     * Generate a QR Code and save it as an image file.
     *
     * @param string $data         The data to encode in the QR code.
     * @param string $dir          The directory where the QR code image will be saved.
     * @param string $fileName     The name of the QR code image file (without extension).
     * @return string|false        The path to the generated QR code image or false on failure.
     */
    function generate_qrcode($data, $dir, $fileName)
    {
        // Load CodeIgniter instance and QR Code library
        $CI = &get_instance();
        $CI->load->library('ciqrcode');

        // Ensure directory ends with a slash
        $dir = rtrim($dir, '/') . '/';

        // Create the directory if it doesn't exist
        if (!file_exists($dir)) {
            if (!mkdir($dir, 0775, true) && !is_dir($dir)) {
                return false; // Return false if the directory couldn't be created
            }
        }

        // QR Code configuration
        $config['cacheable'] = true;
        $config['imagedir'] = $dir;
        $config['quality'] = true;
        $config['size'] = '1024';
        $config['black'] = [0, 0, 0]; // Black color
        $config['white'] = [255, 255, 255]; // White background
        $CI->ciqrcode->initialize($config);

        // Set QR Code parameters
        $params['data'] = $data;
        $params['level'] = 'L'; // Error correction level
        $params['size'] = 10; // QR code size
        $params['savename'] = FCPATH . $config['imagedir'] . $fileName . '.png';

        // Generate QR Code
        if ($CI->ciqrcode->generate($params)) {
            return $config['imagedir'] . $fileName . '.png';
        }

        return false; // Return false if generation fails
    }
}


class Component
{
    // Success codes
    const SELECT = 'select';
    const MULTISELECT = 'multiselect';
    const DATE = 'date';
    const TEXT = 'text';
}

function log_data($data)
{
    // Encode the data to JSON and output the script
    echo "<script>
            $(document).ready(function() {
                console.log(JSON.parse('" . json_encode($data) . "'));
            });
          </script>";
}


/**
 * Generate dynamic HTML for form fields based on provided configuration and prefilled values.
 *
 * @param array $field_array Array of field configurations.
 * @param array $prefill_value Array of prefilled values for the fields.
 * @return string HTML string for the form fields.
 */
function createDynamicFieldHtml(array $field, $prefix = '', $sufix = '', array $prefill_value = []): string
{
    $html = '';
    $fieldName = $field['field_name'];
    $fieldTitle = $field['field_title'] ?? "";
    $fieldLabel = $field['field_label'];
    $fieldType = $field['field_type'];
    $fieldValidation = $field['field_validation'] ?? '';
    $fieldDefaultValue = $field['field_default_value'] ?? '';
    $fieldValue = $prefill_value[$fieldName] ?? $fieldDefaultValue;
    $fieldOptions = $field['field_options'] ?? null;

    // Generate label
    $html .= '<label for="' . htmlspecialchars($fieldName) . '" class="form-label">' . htmlspecialchars($fieldLabel) . '</label>';

    // Generate input based on field type
    if ($fieldType === 'select') {
        $html .= '<select title="' . htmlspecialchars($fieldTitle) . '" id="' . htmlspecialchars($fieldName) . '" name="' . $prefix . htmlspecialchars($fieldName) . $sufix . '" class="form-select" ' . $fieldValidation . '>';
        foreach ($fieldOptions as $value => $label) {
            $selected = ($fieldValue === $value) ? ' selected' : '';
            $html .= '<option value="' . htmlspecialchars($value) . '"' . $selected . '>' . htmlspecialchars($label) . '</option>';
        }
        $html .= '</select>';
    } elseif ($fieldType === 'textarea') {
        $html .= '<textarea title="' . htmlspecialchars($fieldTitle) . '" id="' . htmlspecialchars($fieldName) . '" name="' . $prefix . htmlspecialchars($fieldName) . $sufix . '" class="form-control" ' . $fieldValidation . '>' . htmlspecialchars($fieldValue) . '</textarea>';
    } elseif ($fieldType === 'password') {
        $html .= '<input title="' . htmlspecialchars($fieldTitle) . '"  type="password" id="' . htmlspecialchars($fieldName) . '" name="' . $prefix . htmlspecialchars($fieldName) . $sufix . '" class="form-control" value="' . htmlspecialchars($fieldValue) . '" ' . $fieldValidation . '>';
    } else {
        $html .= '<input title="' . htmlspecialchars($fieldTitle) . '"  type="' . htmlspecialchars($fieldType) . '" id="' . htmlspecialchars($fieldName) . '" name="' . $prefix . htmlspecialchars($fieldName) . $sufix . '" class="form-control" value="' . htmlspecialchars($fieldValue) . '" ' . $fieldValidation . '>';
    }
    return $html;
}

if (!function_exists('sendWhatsAppTemplateMessage')) {
    function sendWhatsAppTemplateMessage(string $templateId, array $templateArgs, string $contactNumber, string $template_type = 'template', string $template_language = 'en', string $file_name = '')
    {
        $whatsapp_credentials = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('whatsapp');
        $thirdPartyIntegrationData = !empty($whatsapp_credentials['third_party_integration_is_production']) && $whatsapp_credentials['third_party_integration_is_production'] == 1
            ? $whatsapp_credentials['third_party_integration_production_data']
            : $whatsapp_credentials['third_party_integration_testing_data'];
        $whatsappApiUrl = $thirdPartyIntegrationData['whatsapp_api_url'] ?: null;

        if (empty($whatsappApiUrl)) {
            return null;
        }

        // Sanitize phone number and prefix with 91
        $cleanPhone = preg_replace('/[^0-9]/', '', $contactNumber);
        $senderPhone = '91' . $cleanPhone;

        $payload = [
            'type'             => $template_type,
            'templateId'       => $templateId,
            'templateLanguage' => $template_language,
            'templateArgs'     => $templateArgs,
            'sender_phone'     => $senderPhone,
        ];
        if (!empty($file_name)) {
            $payload['file_name'] = $file_name;
        }

        try {
            $ch = curl_init($whatsappApiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                curl_close($ch);
                return null;
            }

            curl_close($ch);
            return $response;
        } catch (Exception $e) {
            return null;
        }
    }
}


class StudentIdCardTemplates
{
    /**
     * Get the base folder path dynamically based on session project code
     * @return string
     */
    public static function getBasePath()
    {
        $software_deployment_project_code = '';

        if (!empty($_SESSION['emp_data_session'])) {
            $software_deployment_project_code = $_SESSION['emp_data_session']['software_deployment_project_code'];
        } elseif (!empty($_SESSION['student_session'])) {
            $software_deployment_project_code = $_SESSION['student_session']['software_deployment_project_code'];
        }

        return FCPATH . 'uploads/' . $software_deployment_project_code . '/student_dummy_id_cards/';
    }

    /**
     * Get all SVG dummy ID card file paths dynamically from folder
     * @return array
     */
    public static function getAllTemplates()
    {
        $basePath = self::getBasePath();
        $files = glob($basePath . '*.svg');

        $templates = [];
        foreach ($files as $filePath) {
            // Convert absolute path to URL-friendly base_url path
            $relativePath = str_replace(FCPATH, '', $filePath);
            $templates[] = base_url($relativePath);
        }

        return $templates;
    }
}