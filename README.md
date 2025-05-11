# 💇‍♀️ Hair Salon Customer Management System – Built with Laravel + Oracle Cloud

This project is a **customer management system for a hair salon**, developed using **Laravel**.  
It helps salon staff manage customer information, visit history, and service photos in an efficient and secure way.

## ☁️ Oracle Cloud Object Storage Integration

One of the key features of this system is the integration with **Oracle Cloud Infrastructure (OCI)**.  
Photos associated with customer visits are uploaded to and retrieved from **Oracle Cloud Object Storage**.  
This integration has been successfully implemented and tested in the **local development environment**.

### OCI Features Used:
- Object Storage Bucket (for storing service images)
- Private access configuration (not publicly visible)
- Laravel `.env` file stores API credentials and endpoint
- SDK-based secure access from Laravel backend

## 📸 Core Features

- Customer registration, editing, and deletion
- Visit history tracking (stylist, menu, price, time, memo)
- Upload and display up to 3 photos per visit (stored in OCI)
- UI built using Laravel Blade templates (no Vue.js)
- Fully structured database with migrations

## 🧪 Tech Stack

- PHP 8.x / Laravel 10.x
- MySQL (via Homebrew)
- Oracle Cloud Object Storage (OCI)
- Local development on macOS (Valet or Laragon)

## 🚀 Future Improvements

- Image resizing and optimization
- Role-based access (for salon staff/admins)
- Responsive mobile-friendly UI (still using Blade)
- Deployment-ready OCI configurations


## 🙋‍♀️ Developer

**Megumi Kushida**  
Backend Developer – Laravel / SQL / Oracle Cloud  
Currently based in Vancouver, Canada 🇨🇦

---