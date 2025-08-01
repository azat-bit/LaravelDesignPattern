# Laravel Design Pattern Example

Bu proje, **Laravel Service - Repository - Interface Design Pattern** mimarisiyle hazırlanmış bir örnek uygulamadır.  
Amaç, katmanlı yapı ile sürdürülebilir, test edilebilir ve genişletilebilir bir Laravel API + Web mimarisi kurmaktır.

---

## 🚀 Kullanılan Teknolojiler

- PHP ^8.1
- Laravel ^10.x
- MySQL
- Composer
- Bootstrap (Giriş formu için)
- jQuery + AJAX (Login/Register işlemleri için)

---

## 🧱 Mimaride Neler Var?

### 🔹 Repository Pattern
Veritabanı işlemleri `Repository` katmanında toplanır. Model ile doğrudan Controller iletişim kurmaz.

### 🔹 Service Layer
İş mantığı `Service` katmanına ayrılmıştır. Controller, sadece `ServiceInterface` ile iletişime geçer.

### 🔹 Interface Abstraction
Her Repository ve Service için Interface tanımlanır. Böylece bağımlılıklar minimize edilir, kolay test edilir.

---

## 📁 Klasör Yapısı

