------------------------------------------------
LOGO    Dashboard  Find Blood  Profile  Logout
------------------------------------------------

Welcome, Donor

Your Donor Status

        ● AVAILABLE

Blood Group
O+

Last Donation
20 July 2026

Total Donations
5

------------------------------------------------

             QUICK ACTIONS

[ Update Profile ]
[ Update Donation ]
[ Find Blood ]
[ Change Password ]

------------------------------------------------




7. Donor Profile

The donor profile should display:

Profile image if implemented
Name
Blood group
Phone
Email
Last donation date
Total donations
Availability
Verification status

Example:

              MY PROFILE

Name
Rahim Ahmed

Blood Group
O+

Phone
01XXXXXXXXX

Email
rahim@gmail.com

Last Donation
20 July 2026

Total Donations
5

Donor Status
Available

Verification
Verified

          [ EDIT PROFILE ]
18. Update Donor Profile

The donor should be able to update:

Name
Phone
Gmail
Blood group
Last donation date
Donation count
Availability status

NID should not normally be freely editable after verification.

Example:

NID
************5678

Status: Verified

Contact administrator to change NID information.
19. Blood Search Page

This is one of the primary features of the project.

                 FIND BLOOD

Blood Group
[ O+ ▼ ]

Your Location
[ Use My Current Location ]

Search Radius
[ 5 KM ]

             [ SEARCH DONORS ]

The search should return only suitable donors according to:

Selected blood group
Distance
Donor verification status
Donor availability
20. Donor Search Results

Recommended card design:

┌──────────────────────────────────────┐
│ 🩸 Rahim Ahmed                      │
│                                      │
│ Blood Group: O+                      │
│ 📍 2.4 KM away                       │
│                                      │
│ Last Donation: 12 June 2026          │
│ Previous Donations: 5                │
│                                      │
│ ● Available                          │
│                                      │
│          [ CONTACT DONOR ]           │
└──────────────────────────────────────┘
21. Contact Donor Page / Modal

After clicking "Contact Donor":

             DONOR INFORMATION

Rahim Ahmed

Blood Group
O+

Distance
2.4 KM

Phone
01XXXXXXXXX

Email
rahim@gmail.com

Last Donation
12 June 2026

Total Donations
5

[ CALL DONOR ]

[ SEND EMAIL ]

NID must not be displayed here.

22. Location-Based 5 KM Search

The location system will use the browser's Geolocation API.

Workflow:

User clicks "Use My Current Location"
              ↓
JavaScript requests location permission
              ↓
Latitude + Longitude obtained
              ↓
AJAX request
              ↓
PHP Controller
              ↓
Donor Model
              ↓
MySQL Database
              ↓
Distance calculation
              ↓
Filter donors within 5 KM
              ↓
JSON response
              ↓
JavaScript
              ↓
Donor result cards

The system should prioritize verified and available donors.

23. Change Password Page
             CHANGE PASSWORD

Current Password
[________________________]

New Password
[________________________]

Confirm New Password
[________________________]

          [ CHANGE PASSWORD ]
24. General User Dashboard
------------------------------------------------
Welcome, User
------------------------------------------------

Need Blood?

Search for nearby blood donors.

             [ FIND BLOOD ]

------------------------------------------------

Recent Search

O+ Blood
3 donors found

------------------------------------------------

[ My Profile ]
[ Change Password ]
[ Logout ]
25. General User Profile
             MY PROFILE

Name
Shojjoti Hossen

Email
example@gmail.com

Account Type
General User

          [ EDIT PROFILE ]
26. Admin Login

Admin authentication should be handled separately or through strict role-based authentication.

              ADMIN LOGIN

Username / Email

[______________________]

Password

[______________________]

             [ LOGIN ]
27. Admin Dashboard

The administrator dashboard should contain:

------------------------------------------------
ADMIN PANEL
------------------------------------------------

Dashboard
Donors
Users
Donations
Verification
Reports
Settings
Logout

------------------------------------------------

SYSTEM OVERVIEW

┌──────────────┐
│ Total Donors │
│    5,240     │
└──────────────┘

┌──────────────┐
│ Total Users  │
│    8,421     │
└──────────────┘

┌──────────────┐
│ Donations    │
│    14,320    │
└──────────────┘

┌──────────────┐
│ Pending      │
│ Verification │
│      32      │
└──────────────┘
28. Admin Donor Management

The donor management table should include:

ID	Name	Blood Group	Phone	Status	Verification	Action
001	Rahim	O+	01XXX	Available	Verified	View
002	Karim	A+	01XXX	Offline	Pending	Verify

Possible actions:

View
Edit
Verify
Reject
Suspend
Delete
29. Admin Donor Verification

When a donor registers, their verification status should initially be:

Pending

Admin can review:

             DONOR VERIFICATION

Name:
Rahim Ahmed

NID:
********1234

Phone:
01XXXXXXXXX

Email:
rahim@gmail.com

Blood Group:
O+

Status:
Pending

[ VERIFY ]
[ REJECT ]

After successful verification:

Verification Status = Verified
30. Database Design
users
users
-------------------------
id
name
email
password
phone
role
status
created_at
updated_at
donors
donors
-------------------------
id
user_id
nid_number
blood_group
last_donation_date
total_donations
latitude
longitude
availability_status
verification_status
created_at
updated_at
donation_history
donation_history
-------------------------
id
donor_id
donation_date
location
notes
created_at
password_resets
password_resets
-------------------------
id
user_id
otp
expires_at
verified_at
created_at
admin_logs
admin_logs
-------------------------
id
admin_id
action
target_type
target_id
created_at

This database separation will make the application easier to maintain and more suitable for MVC architecture.

31. MVC Architecture

Recommended project structure:

bloodlink/
│
├── app/
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── DonorController.php
│   │   ├── UserController.php
│   │   ├── BloodSearchController.php
│   │   └── AdminController.php
│   │
│   ├── models/
│   │   ├── User.php
│   │   ├── Donor.php
│   │   ├── Donation.php
│   │   └── Admin.php
│   │
│   └── views/
│       ├── home/
│       ├── auth/
│       ├── donor/
│       ├── user/
│       └── admin/
│
├── config/
│   └── database.php
│
├── public/
│   ├── index.php
│   ├── css/
│   ├── js/
│   ├── images/
│   └── uploads/
│
├── routes/
│   └── web.php
│
└── storage/
32. AJAX Features

AJAX should be used as a meaningful part of the system.

Blood Search
Select blood group
       ↓
Get location
       ↓
AJAX request
       ↓
PHP
       ↓
Database
       ↓
JSON response
       ↓
Display donor cards
Email Availability

During registration:

someone@gmail.com
       ↓
AJAX
       ↓
Check database
       ↓
"Email already exists"
Phone Availability

The same approach can be used for phone number checking.

Dynamic Profile Operations

Selected profile updates can be performed without full page reloads.

33. JavaScript Validation

Frontend validation should provide immediate feedback.

Validation includes:

Required field checking
Gmail format
Bangladesh phone number format
Password strength
Confirm password matching
NID format
Blood group selection
Donation count
Donation date validation

Example messages:

Email is required.

Please enter a valid Gmail address.

Passwords do not match.

Donation date cannot be in the future.

Please select a blood group.
34. PHP Validation

JavaScript validation is not sufficient for security.

Every important form must be validated again on the server.

Workflow:

Browser
   ↓
JavaScript Validation
   ↓
POST / AJAX
   ↓
PHP Validation
   ↓
Database Validation
   ↓
MySQL

This prevents users from bypassing frontend validation.

35. Security Features

The application should implement:

Password Security

Use:

password_hash()
password_verify()

Never store plain-text passwords.

SQL Injection Protection

Use:

PDO
Prepared Statements
Session Security

Use PHP sessions for authentication.

Role-Based Access Control

For example:

/admin

must only be accessible to authenticated administrators.

CSRF Protection

Use CSRF tokens on important state-changing forms.

Input Validation

Validate and sanitize all user-submitted data.

Sensitive Data Protection

NID, exact coordinates and other sensitive information must not be exposed through public APIs or search results.

36. Donor Availability

Donors should have an availability status:

● Available

● Temporarily Unavailable

● Not Available

The search system should prioritize donors marked as available.

37. Donation Eligibility Information

The system may display a basic warning based on the donor's last donation date.

Example:

Last Donation:
10 August 2026

Status:
Recently Donated

Please confirm medical eligibility before donating again.

The system should not make a medical eligibility decision. Medical eligibility should be determined by qualified healthcare professionals.

38. Search Filters

The search interface can support:

Blood Group
A+
A-
B+
B-
AB+
AB-
O+
O-

Distance
1 KM
3 KM
5 KM
10 KM

Availability
Available
All

Sort By
Nearest First
Recently Active

For the initial version, the default search radius should be 5 KM.

39. Navigation Structure
Before Login
LOGO

Home
Find Blood
Become a Donor
About Us
Login
Register
Donor
LOGO

Dashboard
Find Blood
My Profile
Donation History
Change Password

Logout
General User
LOGO

Home
Find Blood
My Profile
Change Password

Logout
Admin
Dashboard
----------------
Donors
Users
Donations
Verification
Reports
Admin Profile
Settings
Logout
40. Figma Design System

Before designing individual pages, create a reusable Figma design system.

Recommended Colors
Purpose	Color
Primary Red	#D62839
Dark Red	#A4161A
Dark Text	#1F2937
Background	#F8FAFC
White	#FFFFFF
Success	#16A34A
Warning	#F59E0B
Border	#E5E7EB
Typography

Recommended font:

Poppins

Suggested sizes:

Heading: 32px / Bold
Subheading: 24px / Semi Bold
Body: 16px / Regular
Small Text: 14px
Buttons

Primary button:

Background: #D62839
Text: White
Border Radius: 8px
Height: 44–48px

Secondary button:

Background: White
Border: #D62839
Text: #D62839
Border Radius: 8px
Cards
Background: #FFFFFF
Border: #E5E7EB
Border Radius: 12px
Shadow: Subtle
41. Recommended Figma Page Order

Design the UI in this order:

Design System
Home Page
Donor Registration
General User Registration
Login
Forgot Password
Find Blood
Search Results
Donor Dashboard
Donor Profile
Donation History
User Dashboard
User Profile
Admin Login
Admin Dashboard
Admin Donor Management
Donor Verification
User Management
Reports
Change Password

This order will keep the design consistent and make development easier.

42. Complete System Workflow
                         HOME
                           │
              ┌────────────┴────────────┐
              ↓                         ↓
          REGISTER                    LOGIN
              │                         │
         ┌────┴────┐              ┌─────┴─────┐
         ↓         ↓              ↓           ↓
      Donor      User          Donor        User
         │         │              │           │
         ↓         ↓              ↓           ↓
    Verification Account      Dashboard   Dashboard
         │                        │           │
         └────────────┬───────────┴───────────┘
                      ↓
                  FIND BLOOD
                      │
                      ↓
                GET LOCATION
                      │
                      ↓
               SEARCH DATABASE
                      │
                      ↓
               DISTANCE ≤ 5 KM
                      │
                      ↓
                DONOR RESULTS
                      │
                      ↓
                 CONTACT DONOR
43. Admin Workflow
Donor Registration
        ↓
Verification Pending
        ↓
Admin Review
        ↓
   ┌────┴────┐
   ↓         ↓
Verify      Reject
   ↓
Active Donor
   ↓
Visible in Search
44. Future Scope

Future versions can include:

Emergency blood request posting
SMS notifications
Email notifications
Push notifications
Hospital integration
Donation certificates
Donor reward system
Donor rating
Blood request tracking
Advanced analytics
Mobile application
Map-based donor visualization
Multi-language support
AI-assisted donor matching
45. Expected Outcome

At the completion of the project, BloodLink will provide a functional web-based platform where:

Donors can register and manage their information.
Donor information can be verified by administrators.
General users can create accounts.
Users can search for required blood groups.
Nearby donors can be identified using location.
Donors within approximately 5 KM can be displayed.
Appropriate donor contact information can be accessed.
Administrators can manage the complete database.
Authentication and password management will be implemented.
JavaScript and PHP validation will protect forms.
AJAX will provide dynamic user interactions.
MVC architecture will provide a structured and maintainable backend.
46. Conclusion

BloodLink aims to provide a centralized, secure and user-friendly platform for blood donor management and emergency blood discovery. By combining donor registration, verification, blood-group searching, location-based donor discovery, secure authentication, AJAX-based interactions and an administrative management system, the project can reduce the difficulty of finding suitable blood donors during emergencies.

The implementation of PHP MVC architecture, MySQL, JavaScript, AJAX and appropriate security practices will make the system scalable, maintainable and suitable for future expansion.

47. Project Summary

Project Name: BloodLink

Project Type: Web-Based Blood Donor Management & Emergency Blood Finder System

Architecture: MVC

Frontend: HTML, CSS, JavaScript

Backend: PHP

Database: MySQL

Asynchronous Communication: AJAX

Authentication: PHP Session-Based Authentication

Primary Search Radius: 5 KM

Main Users:

Donor
General User / Blood Seeker
Administrator

Core Features:

Donor Registration
General User Registration
Login
Logout
Forgot Password
OTP Verification
Reset Password
Change Password
Profile Update
Donor Verification
Blood Group Search
Location-Based Donor Search
5 KM Nearby Donor Search
Donor Availability
Donation History
Admin Dashboard
User Management
Donor Management
Reports
JavaScript Validation
PHP Validation
AJAX
MVC Architecture
Secure Password Storage
Role-Based Access Control
Privacy Protection
"""

output_path = "/mnt/data/BloodLink_Project_Proposal.md"
pypandoc.convert_text(
markdown,
"md",
format="md",
outputfile=output_path,
extra_args=["--standalone"]
)

print(f"Created: {output_path}")

STDOUT/STDERR
Created: /mnt/data/BloodLink_Project_Proposal.md


Done. I created the complete proposal in Markdown (.md) format, including the project overview, objectives, features, pages, database design, MVC structure, AJAX, validation, security, Figma design system, workflows, and future scope.

Download the BloodLink Project Proposal (.md) 

BloodLink_Project_Proposal.md
Document