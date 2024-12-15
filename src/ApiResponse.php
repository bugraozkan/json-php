<?php
namespace JsonPhp;

class ApiResponse
{
    // HTTP status code messages
    private static $httpStatusMessages = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        103 => 'Checkpoint',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended',
    ];

    // Declaring properties explicitly to avoid dynamic property warning
    private int $status;
    private array $data;

    /**
     * Creates a new ApiResponse object.
     *
     * @param int $status HTTP status, defaults to 200 (OK).
     * @param array $data Data to be returned in the API response, defaults to an empty array.
     * @return ApiResponse Returns a new ApiResponse object.
     */
    public static function create(int $status = 200, array $data = []): self {
        $instance = new self();
        $instance->setStatus($status)->setData($data);
        return $instance;
    }

    /**
     * Sets the HTTP status code for the API response.
     *
     * @param int $status Status code (e.g., 200, 404, 500).
     * @return ApiResponse $this, supports method chaining.
     * @throws \InvalidArgumentException Throws an error message if an invalid status code is provided.
     */
    public function setStatus(int $status): self {
        // List of valid HTTP status codes
        $validStatusCodes = array_keys(self::$httpStatusMessages);

        if (!in_array($status, $validStatusCodes)) {
            throw new \InvalidArgumentException("An invalid HTTP status code was provided. Please use a valid status code.");
        }

        $this->status = $status;
        return $this;
    }

    /**
     * Sets the data to be returned in the API response.
     *
     * @param mixed $data Data, should only be an array.
     * @return ApiResponse $this, supports method chaining.
     * @throws \InvalidArgumentException Throws an error message if the data is not an array.
     */
    public function setData($data): self {
        if (!is_array($data)) {
            throw new \InvalidArgumentException('Data must be an array. Please ensure you are working with the correct data type.');
        }

        $this->data = $data;
        return $this;
    }

    /**
     * Sends the response along with HTTP headers.
     *
     * Sends the response in JSON format.
     *
     * @param array $customHeaders Optional custom headers.
     */
    public function send(array $customHeaders = []): void {
        // Send headers
        $this->sendHeaders($customHeaders);

        // Create the JSON format response data
        $jsonData = json_encode([
            'status' => $this->status,
            'data' => $this->data,
        ]);

        // If JSON encode fails, send an error message
        if ($jsonData === false) {
            // JSON encode error situation
            $this->status = 500;
            $this->data = ['error' => 'An error occurred while encoding the response data to JSON. Please ensure the data is valid!'];
            echo json_encode(['status' => $this->status, 'data' => $this->data]);
        } else {
            // Send the successfully encoded JSON data
            echo $jsonData;
        }
    }

    /**
     * Sends HTTP headers.
     *
     * Headers are only sent if they have not been sent before.
     *
     * @param array $customHeaders Optional custom headers.
     */
    private function sendHeaders(array $customHeaders): void {
        if (!headers_sent()) {
            // HTTP status header
            header('HTTP/1.1 ' . $this->status . ' ' . $this->getHttpStatusMessage($this->status));
            // Content type header
            header('Content-Type: application/json');

            // Adding custom headers
            foreach ($customHeaders as $key => $value) {
                header("{$key}: {$value}");
            }
        }
    }

    /**
     * Returns the message for the HTTP status code.
     *
     * @param int $status HTTP status.
     * @return string Status message.
     */
    private function getHttpStatusMessage(int $status): string {
        return self::$httpStatusMessages[$status] ?? 'Unknown HTTP Status';
    }
}