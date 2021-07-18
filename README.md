# Compiling JSON with PHP
It simplifies the <code>json_encode</code> function.
<br>
<br>
Features:
<br>
<ul>
  <li>Easy: Simply compiled functions.</li>
  <li>Quick: The json_encode() function is used when compiling JSON.</li>
  <li>Secure: headers are set automatically.</li>
  <li>Supplementary: You can add objects, properties, or arrays.</li>
  <li>Configurable JSON option for return or variable.</li>
  <li>JSONP and jQuery compatible.</li>
</ul>
<b>* Objects are optimized because JSON is an object representation.</b>

## Use of

```php
<?php
require 'api.class.php';

use BasicAPI\api;

$api = new api();

// generate the JSON
$api->name = 'bugra';
$api->surname = 'ozkan';
$api->age = '17';

// Set HTTP status code
$api->status(200);

//send the JSON
$api->send();
?>
```

## JSON options

The constructor allows you to send JSON, JSONP with return or inside a variable.

#### Regular JSON

```php
  $api->send(options);
  > { ... }
```

#### Return JSONP

```php
  $api->callback('callback', options);
  > callback({ ... });
```

#### Variable JSONP

```php
  $api->var('variable', options);
  > var variable = { ... };
```

#### Options

[Default options are used.](http://php.net/manual/en/function.json-encode.php)

Sample:

```php
$api->send(JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
```

## JSON validation

To validate the JSON, you can get the JSON string back via the encode() method and then pass it through another library.

```php
$jsonString = $api->encode();
```
