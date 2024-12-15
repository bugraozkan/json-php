# Compiling JSON with PHP
This library simplifies the <code>json_encode</code> function, making it easier to generate and send JSON responses in PHP.

## Installation

Install the library via Composer:

```bash
composer require bugraozkan/json-php
```

Include the autoloader in your project:

```php
require 'vendor/autoload.php';
```

## Features

<ul>
  <li><b>Easy:</b> Simplified API for creating and sending JSON responses.</li>
  <li><b>Quick:</b> Built on PHP's <code>json_encode</code> for fast performance.</li>
  <li><b>Secure:</b> Automatically sets appropriate HTTP headers.</li>
  <li><b>Flexible:</b> Supports adding objects, properties, or arrays dynamically.</li>
  <li><b>Configurable:</b> Allows customization of JSON encoding options.</li>
  <li><b>Compatible:</b> Works seamlessly with JSONP and jQuery.</li>
</ul>

<b>Note:</b> Objects are optimized to leverage JSON's inherent object representation.

## Usage Example

```php
<?php
require 'src/ApiResponse.php';

use JsonPhp\ApiResponse;

// Create an API response instance
$response = ApiResponse::create();

// Add data to the response
$response->setData([
    'name' => 'Bugra',
    'surname' => 'Ozkan',
    'age' => 21
]);

// Set the HTTP status code
$response->setStatus(200);

// Send the JSON response
$response->send();
```

## Advanced JSON Options

### Sending Regular JSON

Use the <code>send</code> method to send a standard JSON response.

```php
$response->send();
// Output: { "name": "Bugra", "surname": "Ozkan", "age": 21 }
```

### Returning JSONP

To return a JSONP response, specify a callback function:

```php
$response->sendHeaders(['Content-Type' => 'application/javascript']);
echo "callback(" . json_encode([
    'status' => 200,
    'data' => [
        'name' => 'Bugra',
        'surname' => 'Ozkan',
        'age' => 21
    ]
]) . ");";
```

Output:

```javascript
callback({ "status": 200, "data": { "name": "Bugra", "surname": "Ozkan", "age": 21 }});
```

### JSON Validation

To validate JSON, use the <code>json_encode</code> method to retrieve the JSON string and validate it:

```php
$jsonString = json_encode([
    'name' => 'Bugra',
    'surname' => 'Ozkan',
    'age' => 21
]);

// Validate the JSON with an external library or tool
```

## JSON Encoding Options

You can customize the JSON encoding options using constants from PHP's <code>json_encode</code> function. For example:

```php
$response->setData([
    'name' => 'Bugra',
    'surname' => 'Ozkan',
    'age' => 21
]);
$response->sendHeaders(['Content-Type' => 'application/json']);
echo json_encode($response->data, JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
```

## Notes

- This library is compatible with PHP 7.0 and later.
- Default JSON encoding options are used unless specified otherwise.
- Supports custom HTTP headers for enhanced flexibility.

For more details, refer to the [PHP Documentation on JSON Encoding](https://www.php.net/manual/en/function.json-encode.php).