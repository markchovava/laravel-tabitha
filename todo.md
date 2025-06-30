RESOURCE MANAGEMENT SYSTEM

# LIST
Users
Authentication
Logs(13)
Subscription
Subscription Auth
AppInfo

# Authentication
Register
Login
Profile
Update Email
Update Password
Update Profile Info

# Logs
Bath & Hygiene
Blood Glucose
Blood Pressure
Exercise & Activity
Home Test Logs
Medication Logs
Nutrition Logs
Sleep Log
Wake Log
Sore Prevention
Temperature
Urination & Defecation
Visitors

# AppInfo
name
description
email
phone
website
address

# Users
name,
password,
code, 
phone, 
email, 
address, 
role, 
is_admin
accessLevel(
    1. Subscriber
    2. Patient
    3. Assistant,
    4. Family 
)

# Subscription
name
description
fee

# UserSubscription
subscriptionId
amount,
startDate,
endDate
userId
subscriptionToken

# Logs
details,
patient
assistant
date 
time
image

# Visitor
details,
patient
assistant
date 
time
image
mask
sanitization
socialDistance
temperature
