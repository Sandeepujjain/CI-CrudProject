<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gps_lib
{
  protected $CI;
  protected $is_active = true;
  public $response = [];

  public function __construct()
  {
    $this->CI = &get_instance();
  }

  /**
   * Get vehicle GPS data from external API
   * 
   * @param array|null &$filter Reference to filter array containing vehicle registration number
   *                          Expected format: ['vehicle_registration_no' => 'VEHICLE_NUMBER']
   * @return array Formatted response with GPS data or error
   */
  public function getVehicleGpsData(&$filter = null)
  {
    // Reset properties
    $this->is_active = true;
    $this->response = [];

    // Get GPS integration credentials
    $gps_credentials = _LM_ThirdPartyIntegrationModel()->getIntegrationDataByType('gps');

    // Check if GPS integration is active
    if (empty($gps_credentials['third_party_integration_is_active'])) {
      $this->response = formatCommonResponse(
        ApiResponseStatusCode::BAD_REQUEST,
        'GPS Integration is not active or not found'
      );
      $this->is_active = false;
      return $this->response;
    }

    // Get production or testing data based on configuration
    $thirdPartyIntegrationData = !empty($gps_credentials['third_party_integration_is_production'])
      && $gps_credentials['third_party_integration_is_production'] == 1
      ? $gps_credentials['third_party_integration_production_data']
      : $gps_credentials['third_party_integration_testing_data'];

    // Extract API credentials
    $api_url = $thirdPartyIntegrationData['gps_api_url'] ?? '';
    $api_username = $thirdPartyIntegrationData['gps_api_username'] ?? '';

    // Validate required parameters
    if (empty($api_url) || empty($api_username)) {
      $this->response = formatCommonResponse(
        ApiResponseStatusCode::BAD_REQUEST,
        'GPS API configuration is incomplete'
      );
      return $this->response;
    }

    try {
      // Make API request
      $api_response = $this->makeGpsApiRequest($api_url, $api_username);

      // Process API response
      if (isset($api_response['code']) && $api_response['code'] == 0) {
        // Filter by vehicle registration number if provided
        if (!empty($filter['vehicle_registration_no']) && isset($api_response['data'])) {
          $filtered_data = $this->filterByVehicleRegistration(
            $api_response['data'],
            $filter['vehicle_registration_no']
          );

          if (!empty($filtered_data)) {
            $api_response['data'] = $filtered_data;
            $message = 'GPS data retrieved successfully';
            $this->response = formatCommonResponse(
              ApiResponseStatusCode::OK,
              $message,
              $api_response['data'] ?? []
            );
          } else {
            $message = 'No GPS data found for the specified vehicle';
            $this->response = formatCommonResponse(
              ApiResponseStatusCode::NOT_FOUND,
              $message
            );
          }
        } else {
          $message = 'GPS data retrieved successfully';
          $this->response = formatCommonResponse(
            ApiResponseStatusCode::OK,
            $message,
            $api_response['data'] ?? []
          );
        }
      } else {
        // Handle API error response
        $error_message = $api_response['msg'] ?? 'Failed to fetch GPS data from external API';
        $this->response = formatCommonResponse(
          ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
          $error_message,
          [],
          ['api_error' => $api_response]
        );
      }

      return $this->response;
    } catch (Exception $e) {
      log_message('error', 'GPS API Error: ' . $e->getMessage());

      $this->response = formatCommonResponse(
        ApiResponseStatusCode::INTERNAL_SERVER_ERROR,
        'Failed to fetch GPS data',
        [],
        ['error' => $e->getMessage()]
      );
      return $this->response;
    }
  }

  /**
   * Make cURL request to GPS API
   * 
   * @param string $api_url GPS API endpoint
   * @param string $api_username Username for authentication
   * @return array Decoded API response
   */
  private function makeGpsApiRequest($api_url, $api_username)
  {
    // Initialize cURL
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'username: ' . $api_username
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 30 second timeout
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Adjust based on your SSL requirements

    // Execute request
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Check for cURL errors
    if (curl_errno($ch)) {
      $error_msg = curl_error($ch);
      curl_close($ch);
      throw new Exception('cURL Error: ' . $error_msg);
    }

    curl_close($ch);

    // Log the raw response for debugging
    log_message('debug', 'GPS API Raw Response: ' . $response);

    // Decode JSON response
    $decoded_response = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      throw new Exception('Invalid JSON response from GPS API');
    }

    return $decoded_response;
  }

  /**
   * Filter GPS data by vehicle registration number
   * 
   * @param array $gps_data Array of GPS data from API
   * @param string $vehicle_registration_no Vehicle registration number to filter
   * @return array Filtered GPS data
   */
  private function filterByVehicleRegistration($gps_data, $vehicle_registration_no)
  {
    if (!is_array($gps_data) || empty($gps_data)) {
      return [];
    }

    // Normalize vehicle registration number (remove spaces, convert to uppercase)
    $search_registration = strtoupper(str_replace(' ', '', $vehicle_registration_no));

    $filtered_data = [];

    foreach ($gps_data as $vehicle) {
      if (isset($vehicle['vehicleNo'])) {
        // Normalize API vehicle number
        $api_vehicle_no = strtoupper(str_replace(' ', '', $vehicle['vehicleNo']));

        // Check for exact match
        if ($api_vehicle_no === $search_registration) {
          $filtered_data[] = $vehicle;
          break; // Assuming one vehicle per registration number
        }

        // Optional: Add partial matching if needed
        // if (strpos($api_vehicle_no, $search_registration) !== false) {
        //     $filtered_data[] = $vehicle;
        // }
      }
    }

    return $filtered_data;
  }

  /**
   * Check if GPS integration is active
   * 
   * @return bool
   */
  public function isActive()
  {
    return $this->is_active;
  }

  /**
   * Get the formatted response
   * 
   * @return array
   */
  public function getResponse()
  {
    return $this->response;
  }

  /**
   * Get all available vehicles from GPS data
   * 
   * @return array List of vehicles with basic info
   */
  public function getAllVehicles()
  {
    $filter = null; // No filter for all vehicles
    $response = $this->getVehicleGpsData($filter);

    if (isset($response['ApiResponseStatusCode']) && $response['ApiResponseStatusCode'] == ApiResponseStatusCode::OK) {
      $vehicles = [];

      foreach ($response['data'] as $gps_data) {
        if (isset($gps_data['vehicleNo'])) {
          $vehicles[] = [
            'vehicleNo' => $gps_data['vehicleNo'],
            'alias' => $gps_data['alias'] ?? '',
            'imei' => $gps_data['imei'] ?? '',
            'vendor' => $gps_data['vendor'] ?? '',
            'status' => $gps_data['vehicleStatus'] ?? 'Unknown'
          ];
        }
      }

      return formatCommonResponse(
        ApiResponseStatusCode::OK,
        'Vehicles retrieved successfully',
        $vehicles
      );
    }

    return $response;
  }

  /**
   * Get vehicle location by registration number
   * 
   * @param array &$filter Reference to filter array containing vehicle registration number
   *                      Expected format: ['vehicle_registration_no' => 'VEHICLE_NUMBER']
   * @return array Vehicle location data or error response
   */
  public function getVehicleLocation(&$filter = null)
  {
    if (empty($filter['vehicle_registration_no'])) {
      return formatCommonResponse(
        ApiResponseStatusCode::BAD_REQUEST,
        'Vehicle registration number is required'
      );
    }

    $response = $this->getVehicleGpsData($filter);

    if (isset($response['ApiResponseStatusCode']) && $response['ApiResponseStatusCode'] == ApiResponseStatusCode::OK) {
      if (!empty($response['data'])) {
        $vehicle_data = $response['data'][0];

        $location_data = [
          'vehicleNo' => $vehicle_data['vehicleNo'] ?? $filter['vehicle_registration_no'],
          'latitude' => $vehicle_data['latitude'] ?? 0,
          'longitude' => $vehicle_data['longitude'] ?? 0,
          'speed' => $vehicle_data['speed'] ?? 0,
          'direction' => $vehicle_data['direction'] ?? 0,
          'ignition' => $vehicle_data['ignition'] ?? false,
          'vehicleStatus' => $vehicle_data['vehicleStatus'] ?? 'Unknown',
          'timestamp' => $vehicle_data['timestamp'] ?? 0,
          'formatted_time' => $this->formatTimestamp($vehicle_data['timestamp'] ?? 0)
        ];

        return formatCommonResponse(
          ApiResponseStatusCode::OK,
          'Vehicle location retrieved successfully',
          $location_data
        );
      } else {
        return formatCommonResponse(
          ApiResponseStatusCode::NOT_FOUND,
          'Vehicle not found in GPS system'
        );
      }
    }

    return $response;
  }

  /**
   * Format timestamp to readable date
   * 
   * @param int $timestamp Milliseconds timestamp
   * @return string Formatted date
   */
  private function formatTimestamp($timestamp)
  {
    if ($timestamp > 0) {
      // Convert milliseconds to seconds
      $seconds = floor($timestamp / 1000);
      return date('Y-m-d H:i:s', $seconds);
    }
    return 'N/A';
  }
}
