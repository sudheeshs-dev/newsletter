
## NewsLetter Mailing System

### Steps

1. Create Databse Named News Letter <br>
2. "php artisan migrate"
3. "php artisan db:seed" for adding the admin username
4. "Update Mailtrap Credentials"
5. "php artisan serve"

### For Processing Queue
1. For Listening Queue "php artisan queue:listen"
2. For Runnung Scheduler "hp artisan schedule:work"


## Menus and Features

### Admin Login
Admin Login with "admin@admin.com" password "password"<br>
admin can reset the password with Forget password
### Menus
1. Home -> Status of User count,queue count , active newsletter
2. Usermanagemnt
    1. User group ->Created the user group for creating the User
    2. Users -> Create user with Usergroup
    3. User bulk Upload -> Download the CSV file and fill the CSV and upload
3. News Letter Mangement ->Creates the Schedule time to Create the Task the task will run on scheduler
4. Jobs and Queues -> Shows Active Jobs with status enabled.
    1. force Process will push the task to Job and done immediatly changes the status to disabled.


## Thankyou.


