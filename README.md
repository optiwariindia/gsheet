# GSheet : A library to connect your application with google sheet

### Install 
`composer require optiwariindia/gsheet`

### Getting Started

#### Create Credentials at google cloud
1. Open [Google Cloud Console]: https://console.cloud.google.com/
2. Create a new project
3. Navigate to API And Services > Credentials
4. Click on "Create Credentials" link
5. Select Credential type "Service Account"
6. Fill the form and Grant the access
7. Navigate to IAM & Admin > Service Accounts
8. Click on Action link in front of service account just created.
9. Select manage keys
10. Now click on add key button and select key type "JSON"
11. Save the file as credentials.json in the project root directory

#### Grant access to sheet
1. Open "credentials.json" file you have downloaded from google.
2. Find key named "Client_email" and copy the email besides it.
3. Go to sheet you want to access
4. Share that sheet with "Client_email" which you have just coppied.

#### Getting Google Sheet ID
1. Check the url of your sheet 
    https://docs.google.com/spreadsheets/d/_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX_/edit#gid=0
2. Copy the part after `https://docs.google.com/spreadsheets/d/" till next "/"
3. Use this part as sheet id in the code.

#### Initializing Sheet

`use optiwariindia\gsheet`

`gsheet::init("credentials.json",{SHEET_ID})`

#### Add Data into new row

`gsheet::addData("{Sheet Name}!{First Column Name}{Row Number}:{Last Column Name}",{Data to be inserted})`
#### Search in specific column
`gsheet::find("{Sheet Name}!{First Column Name}{Row Number}:{Last Column Name}",{keyword},{column number}})`
#### Update Data in specific row
`gsheet::updateData("{Sheet Name}!{First Column Name}{Row Number(to be updated)}:{Column Name}",{Data to be updated})`
#### Delete Data from a row
`gsheet::deleteData("{Sheet name}!{First Column Name}{Row Number}:{Last Column Number}{Row Number}")`