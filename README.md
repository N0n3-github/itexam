# IT Exam

## About project
This project is created for testing the knowledge on any theme you want.  
It can be used as at schools as on study cources.  

## Installation
All you need is to install LAMP server if you are on GNU/LinuxOS and configure it.  
If you are on WindowsOS then just install OpenServer and configure that too the way you want.

### Notice
If you installed OpenServer on Windows then go to "{OpenServer folder}/OSPanel/userdata/config". There open "php.ini" file of php version you are using. Find line "output_buffering" and change the value to 4096.  
Also go to php.ini and find line "date.timezone". In the Internet you can find your own timezone settings for php. Change that value to the timezone you want.

## Configuration
1. In MySQL create a database to keep "itexam" information there. Ex db name: "itexam".
It is better if encode type will be in "utf8_general_ci". Make sure you have the same encoding in settings of OpenServer if you are on Windows.  
2. Go to file "config.php" and correct the connection to your MySQL database you just created.  
3. In "config.php" you can also change the way of holding tests by changing $TYPE_OF_TEST variable. School, courses or just test modes are available.

## Adminpanel  
1. Go to www.example.com/adminpanel and registrate yourself as admin. Default token for registrating an admin is 'VG9rZW4=' (the word "Token" encoded in Base64). If you want to change it then go to "adminpanel/registration.php" and change the checking token on line 45 to that you want.  
2. When you log in as administrator, you will go to www.example.com/adminpanel/adminpanel.php page, where you can control questions, profiles and results.  
3. There you can edit, add, delete questions and profiles. Also you can delete results and so on.  
