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
# Kullanımı

```php
<?php

    include('../includes/json.php');
  
    use \Simple\json;
    
    $json = new json();
  
    // Ojects to send (fetched from the DB for example)
    $object = new stdClass();
    $object->LastLog = '123456789123456';
    $object->Password = 'Mypassword';
    $object->Dramatic = 'Cat';
    $object->Things = array(1,2,3);
    
    // Forge the JSON
    $json->data = $object;
    $json->user = AlexisTM;
    $json->status = 'online';
    
    // Send the JSON
    $json->send();
?>
```
