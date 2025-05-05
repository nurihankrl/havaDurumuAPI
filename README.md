# Hava Durumu API

Bu proje, [CollectAPI](https://collectapi.com/) kullanılarak bir şehir için haftalık hava durumu bilgilerini döndüren bir PHP tabanlı API'dir.

## Özellikler

- Şehir adı parametresi ile haftalık hava durumu bilgisi sağlar.
- Günlük sıcaklık, açıklama, tarih ve ikon bilgilerini JSON formatında döndürür.
- Hata durumlarında uygun HTTP durum kodları ve mesajları döner.

## Gereksinimler

- PHP 7.4 veya üzeri
- cURL eklentisi etkin bir PHP kurulumu
- CollectAPI API anahtarı

## Kurulum

1. Proje dosyalarını `c:\xampp\htdocs` dizinine kopyalayın.
2. `api.php` dosyasındaki `APIKEYDİYORUMSANAXD` sabitini kendi CollectAPI anahtarınızla değiştirin:
   ```php
   define('APIKEYDİYORUMSANAXD', 'your_collectapi_key');
   ```
3. XAMPP veya başka bir yerel sunucuyu başlatın.

## Kullanım

API'yi kullanmak için aşağıdaki URL formatını kullanabilirsiniz:

```
http://localhost/api.php?city=sehirAdi
```

### Örnek

İstanbul için hava durumu bilgisi almak:
```
http://localhost/api.php?city=Istanbul
```

### Dönen JSON Formatı

Başarılı bir istek durumunda API aşağıdaki formatta bir JSON döndürür:

```json
{
    "sehir": "Istanbul",
    "haftalik_hava_durumu": [
        {
            "gun": "Pazartesi",
            "tarih": "2023-10-01",
            "sicaklik": "25 °C",
            "aciklama": "Güneşli",
            "ikon": "https://cdn.collectapi.com/weather/icons/01d.png"
        },
        {
            "gun": "Salı",
            "tarih": "2023-10-02",
            "sicaklik": "22 °C",
            "aciklama": "Parçalı Bulutlu",
            "ikon": "https://cdn.collectapi.com/weather/icons/02d.png"
        }
        // ... diğer günler
    ]
}
```

### Hata Durumları

API, aşağıdaki hata durumlarını dönebilir:

- **400 Bad Request**: Şehir adı parametresi eksik.
- **500 Internal Server Error**: cURL hatası veya API'ye bağlanılamadı.
- **404 Not Found**: Hava durumu bilgisi bulunamadı.
