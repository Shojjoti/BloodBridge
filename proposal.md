## BloodBridge -Bridge between donor & patient
### 1. Introduction

BloodLink is a web-based Blood Donor Management and Emergency Blood Finder System designed to connect registered blood donors with individuals who require blood. The system provides a centralized platform where eligible donors can register their information, maintain their donation history, and make themselves available to people searching for blood.

The system allows users to search for blood donors based on blood group and geographical proximity. Using the user's current location and the donor's registered location, the system identifies available donors within a specified radius, with 5 KM being the primary search range.

The platform also provides an administrator panel through which authorized administrators can manage donors, general users, donor verification, donation records, and other system information.

The system will be developed using HTML, CSS, JavaScript, PHP, AJAX and MySQL following the Model-View-Controller (MVC) architectural pattern.

---

## 2. Problem Statement

Finding suitable blood donors during an emergency can be difficult and time-consuming. People often depend on social media posts, personal contacts, or informal groups to find compatible blood donors.

These methods have several limitations:

- Donor information may be outdated.
- The blood group of a donor may not be immediately available.
- It can be difficult to determine which donors are nearby.
- Contact information may be scattered across different platforms.
- There may be no centralized donor database.
- There is limited verification of donor information.

BloodLink aims to solve these problems by providing a centralized and structured blood donor management platform.

---

## 3. Aim

The primary aim of BloodLink is to develop a secure and user-friendly web application that allows people to register as blood donors and helps blood seekers find suitable nearby donors according to blood group and geographical distance.

---

## 4. Objectives

The objectives of the project are:

1. To create a centralized blood donor database.
2. To allow donors to register using their personal and verification information.
3. To use NID information for donor verification.
4. To allow general users to create accounts.
5. To provide secure login and logout functionality.
6. To provide password recovery and password change facilities.
7. To allow users to update their profiles.
8. To maintain donor blood donation history.
9. To allow users to search donors by blood group.
10. To identify donors within approximately 5 KM of the user.
11. To display appropriate donor contact information.
12. To provide an administrative dashboard for complete system management.
13. To implement both JavaScript-side and PHP-side validation.
14. To implement AJAX for dynamic operations without unnecessary page reloads.
15. To implement the backend following MVC architecture.
16. To maintain appropriate security and privacy for sensitive information.

---

## 5. User Types

### 5.1 Donor

A donor must provide:

- Full name
- Valid NID information
- Phone number
- Gmail address
- Blood group
- Last donation date
- Number of previous donations
- Password

A donor will be able to:

- Register
- Login
- Logout
- View profile
- Update profile
- Update donation information
- View donation history
- Change password
- Search for blood
- Manage availability status

### 5.2 General User / Blood Seeker

A general user will provide:

- Full name
- Gmail address
- Password

A general user will be able to:

- Register
- Login
- Logout
- Search for blood
- Find nearby donors
- View permitted donor contact information
- Update profile
- Change password

### 5.3 Administrator

The administrator will have privileged access to the system.

Admin functionality will include:

- Admin login
- Dashboard
- Donor management
- General user management
- Donor verification
- Donation history management
- Search and filtering
- Account suspension/deletion
- System statistics
- Administrative logs
- Admin profile management

---

## 6. Major System Features

### 6.1 Authentication

The system will provide:

- Login
- Logout
- Forgot password
- OTP-based password recovery
- Password reset
- Change password
- Session management
- Role-based access control

### 6.2 Donor Registration

Donors will register their:

- Name
- NID
- Phone
- Gmail
- Blood group
- Last donation date
- Previous donation count

Donor registration will be subject to validation and administrator verification.

### 6.3 General User Registration

General users will register using:

- Name
- Gmail
- Password

### 6.4 Profile Management

Users will be able to:

- View profile
- Edit profile
- Change password
- Update permitted personal information

### 6.5 Blood Search

Users will be able to select a required blood group and search for available donors.

The system will use location information to identify donors within approximately 5 KM.

### 6.6 Nearby Donor Search

The system will:

1. Obtain the user's approximate current location through the browser's Geolocation API.
2. Send the location to the server using AJAX.
3. Retrieve donor location data from the database.
4. Calculate geographical distance.
5. Filter donors according to the selected radius.
6. Return suitable donors through AJAX/JSON.
7. Display the results dynamically.

### 6.7 Donor Availability

Donors will be able to indicate whether they are currently:

- Available
- Temporarily unavailable
- Not available

Only appropriate available donors should be prioritized in emergency searches.

---

## 7. Privacy and Security Design

Because the system handles sensitive personal information, privacy and security are important requirements.

### NID Privacy

NID information will be used for donor verification but will **never be displayed in public donor search results**.

Only authorized administrators should be able to access complete NID information.

### Location Privacy

The system may store donor latitude and longitude for distance calculations, but exact GPS coordinates should not be displayed publicly.

Users should see approximate information such as:

> 2.4 KM away

instead of the donor's exact coordinates.

### Donor Contact Information

Only the necessary contact information should be exposed to a user searching for blood.

---

## 8. Technology Stack

| Layer | Technology |
|---|---|
| Frontend | HTML5, CSS3, JavaScript |
| UI | Bootstrap 5 / Custom CSS |
| Backend | PHP |
| Architecture | MVC |
| Database | MySQL |
| Asynchronous Requests | AJAX / Fetch API |
| Validation | JavaScript + PHP |
| Authentication | PHP Sessions |
| Password Security | `password_hash()` / `password_verify()` |
| Location | Browser Geolocation API |
| Server | Apache / XAMPP / cPanel |
| Development | VS Code |

---

## 9. Proposed Website Pages

### Public Pages

1. Home
2. About Us
3. Find Blood
4. Donor Registration
5. General User Registration
6. Login
7. Forgot Password
8. Reset Password

### Donor Pages

9. Donor Dashboard
10. Donor Profile
11. Edit Profile
12. Donation History
13. Change Password

### General User Pages

14. User Dashboard
15. User Profile
16. Edit Profile

### Administrator Pages

17. Admin Login
18. Admin Dashboard
19. Donor Management
20. User Management
21. Donor Verification
22. Donation Management
23. Reports
24. Admin Profile

---

## 10. Minimum Required Pages

For the minimum viable project, at least these pages should be designed and implemented:

### Page 1 — Home Page

Publicly accessible to everyone.

Main sections:

- Navigation bar
- Hero section
- Find Blood CTA
- Become a Donor CTA
- Blood group section
- How It Works
- Statistics
- Why Donate
- Footer

### Page 2 — Registration Page

The registration area should provide:

- Donor Registration
- General User Registration

Donor registration requires:

- Name
- NID
- Phone
- Gmail
- Blood group
- Last donation date
- Previous donation count
- Password
- Confirm password

General user registration requires:

- Name
- Gmail
- Password
- Confirm password

### Page 3 — Find Blood Page

Users should be able to:

- Select blood group
- Use current location
- Search within 5 KM
- View available nearby donors

The result should display:

- Donor name
- Blood group
- Approximate distance
- Last donation date
- Number of previous donations
- Availability status
- Contact option

---

## 11. Home Page Design

The homepage should be clean, modern, responsive and healthcare-oriented.

Suggested structure:

```text
------------------------------------------------
LOGO       Home  Find Blood  About Us  Login
------------------------------------------------

              FIND BLOOD.
              SAVE A LIFE.

Find nearby blood donors when you need them most.

       [ FIND BLOOD ] [ BECOME A DONOR ]

------------------------------------------------

              FIND BLOOD FAST

 [ Blood Group ] [ Location ] [ Search ]

------------------------------------------------

              HOW IT WORKS

      01              02              03
   Register  --->   Search  --->    Contact

------------------------------------------------

              BLOOD GROUPS

 A+  A-  B+  B-  AB+  AB-  O+  O-

------------------------------------------------

            BECOME A DONOR

       Your donation can save a life.

             [ REGISTER NOW ]

------------------------------------------------

                 FOOTER
------------------------------------------------





Donor  → Donor Dashboard
User   → User Dashboard
Admin  → Admin Dashboard

