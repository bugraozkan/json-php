# PHP ile JSON Derleme 
<code>json_encode</code> fonksiyonunu basitleştirir.
<br>
<br>
Özellikleri:
<br>
<ul>
  <li>Kolay: Basit bir şekilde derlenen fonksiyonlar.</li>
  <li>Hızlı: JSON derlenirken, json_encode() fonksiyonu kullanılır.</li>
  <li>Güvenli: headers'ler otomatik olarak ayarlanır.</li>
  <li>Tamamlayıcı: Nesneler, özellikler veya diziler ekleyebilirsiniz.</li>
  <li>Geri dönüş veya değişken için ayarlanabilir JSON seçeneği.</li>
  <li>JSONP ve jQuery uyumlu.</li>
</ul>
<b>* JSON bir nesne gösterimi olduğu için nesneler optimize edilmektedir.</b>

## Kullanımı

```php
<?php
require 'api.class.php';

use BasicAPI\api;

$api = new api();

//JSON'u oluştur
$api->name = 'buğra';
$api->surname = 'özkan';
$api->age = '17';

//HTTP durum kodu belirle
$api->status(200);

//JSON'u gönder
$api->send();
?>
```

## JSON seçenekleri

Yapıcı, geri dönüş ile veya bir değişken içinde JSON, JSONP göndermenize izin verir.

#### Normal JSON

```php
  $api->send(options);
  > {  ...  }
```

#### Geri dönüş JSONP

```php
  $api->callback('callback', options);
  > callback({  ...  });
```

#### Değişken JSONP

```php
  $api->var('variable', options);
  > var variable = {  ...  };
```

### JSON doğrulama

JSON'u doğrulamak için, JSON dizesini make() yöntemi aracılığıyla geri alabilir ve ardından başka bir kitaplıktan geçirebilirsiniz.

```php
$jsonString = $api->make();
```

#### Seçenekler

[Varsayılan seçenekler kullanılmaktadır.](http://php.net/manual/en/function.json-encode.php#example-4366)

Örnek:

```php 
$api->send(JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
```
