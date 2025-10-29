# 📄 Contract Management System (Laravel)

> A Laravel-based web application for efficient contract management — built during my internship at **Société pour l’Équipement Hydraulique et Industriel (SEHI)**.  
> This system automates notifications, secures data access, and provides advanced analytics for proactive contract monitoring.

---

## 🚀 Project Overview

The **Contract Management System** addresses one of the main challenges in company operations — tracking and managing contract end dates.  
It integrates seamlessly into the **GED (Gestion Électronique des Documents)** project to:

- Automate notifications before contract expiration  
- Analyze and visualize contract data  
- Ensure secure and efficient contract lifecycle management

---

## ✨ Key Features

### 🔐 Contract Management
- Create, edit, view, and logically delete contracts  
- Role-based access control using Laravel’s built-in authorization system  
- Logical deletion for safe recovery and auditability  

### 📧 Automated Notifications
- Email alerts sent **7 days before contract expiration** (customizable)
- Implemented with **Laravel Mail** and **Task Scheduler**
- Fully automated with the command:
  ```bash
  php artisan schedule:run
  ```

### 📊 Data Analytics & Visualization
- Dashboard with real-time contract insights:
  - Bar chart: fees per contract type
  - Line chart: number of contracts by type
  - Pie chart: contracts by department
- Built using **Chart.js** and **Google Charts**

---

## 🧰 Tech Stack

| Category | Technologies |
|-----------|--------------|
| **Backend** | PHP 8+, Laravel Framework |
| **Frontend** | HTML5, CSS3, JavaScript, Bootstrap |
| **Database** | MySQL (managed with phpMyAdmin) |
| **Visualization** | Chart.js, Google Charts |
| **Automation** | Laravel Scheduler / Windows Task Scheduler |
| **IDE** | Visual Studio Code |

---

## 🧮 Database Schema (Main Tables)

| Table | Description |
|--------|--------------|
| `contrats` | Stores contract details (with foreign keys) |
| `typecontrats` | Defines contract types |
| `departements` | Company departments |
| `users` | Contract owners and admins |
| `menus` / `droitsacces` | Manage user permissions and routes |

---

## ⚙️ Notification Workflow

1. **Mail Template** — Created in `app/Mail/EmailSend.php`  
2. **Command** — `php artisan send:email` triggers notifications  
3. **Scheduler** — Executes periodically to check upcoming expirations  
4. **Delivery** — Emails sent to responsible users with contract details  

---

## 📈 Analytics Page Details

The analytics dashboard includes:
- **3 Graphs**:  
  - Bar: Fees per contract type  
  - Line: Number of contracts per type  
  - Pie: Percentage of contracts by department  
- **2 Tables**:  
  - Contract count by type and client  
  - List of expired contracts  

All visualizations update dynamically from the database.

---

## 🧪 Testing

✅ Verified email delivery before contract expiration  
✅ Confirmed correct filtering of active vs deleted contracts  
✅ Tested data visualization and performance  
✅ Integrated successfully with the existing GED platform  

---

## 🧠 Learning Outcomes

Through this project, I strengthened my skills in:
- Laravel MVC design & database migrations  
- Model relationships and access control  
- Task scheduling and email automation  
- Frontend data visualization  
- Database-driven dashboard development  

---

## 👨‍💻 Author

**Rhouli Mohamed Mounim**  
🎓 AI Engineering Student  
🏢 Internship Host: Société pour l’Équipement Hydraulique et Industriel (SEHI)  
📅 Duration: **July 11 – August 11, 2023**  
📧 mohamedmounim.rhouli@usmba.ac.ma

---

## 📜 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

### ⭐ If you found this project helpful, consider giving it a star on GitHub!
