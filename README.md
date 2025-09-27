# 🏋️ Supreme Gym Management System – Laravel Backend

This repository contains the **Laravel backend API** for the **Supreme Gym Management System**, powering both:

- **Admin Desktop App (Flutter)** – manage members, scan QR codes, handle subscriptions, view transactions, and manage trainers.  
- **User Mobile App (Flutter)** – login, QR check-in, subscription, BMI calculation, trainer rating, and profile management.  

> ⚠️ **Note**:  
> This backend is designed for **local/demo use** during project showcases.  
> The live API (previously hosted on `laravel.cloud`) is no longer public.  

---

## 📌 Features

### 🔑 Authentication & Security
- Login & OTP-based password reset  
- Change password

### 👤 Member Features
- Register & update profile (except Gmail)  
- Upload profile image  
- QR check-in with daily validation  
- Membership plan subscription (`one`, `two`, `three` months)  
- View expiry date & subscription history  
- BMI calculator (save results & view history)  
- Rate trainers with star rating  
- Notifications for inactive/expired status  

### 👨‍💻 Admin Features
- Register new members  
- Scan member QR codes at gym entrance  
- Validate membership & reduce expiry days  
- Prevent duplicate daily scans (`Already scanned for today`)  
- Track expired memberships  
- Activate/deactivate members  
- View transactions & subscription history  
- Manage body builder (trainer) info  

---

## 🛠️ Requirements

- **Laravel Framework 11.x** (latest stable release)  
- PHP >= 8.1  
- Composer  
- MySQL / PostgreSQL  

---

### Clone Repository
```bash
git clone https://github.com/Thura-Mon/GymSystemBackend.git
cd GymSystemBackend
