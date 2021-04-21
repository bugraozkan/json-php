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
<br>
<br>
Usage
-------

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
