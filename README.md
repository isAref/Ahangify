# Ahangify
> Search music with voice,
You can use this source to find music by voice 
***(this source is written for Telegram Bot)***

> We use [Ahangify](https://ahangify.com) API here


Configuration:
---------

* Open the `index.php` file and paste the bot token:
```php
define('API_KEY', 'TOKEN');
```
* Login to [Ahangify](https://ahangify/login) and create an account
* Open the `login.php` and Enter your username and password:
```php
$login = [

  'username' => 'UserName', // UserName

  'password' => 'Password' // Password

  ];
  ```
  
  - We recommend that you use the model and name of your device for the **user agent**
  ```php
  user-agent:Ahangify Mobile/1.7.3 (Samsung SM-A217F, Android 11 "30"
  ```
  > To view the model and name of your device, install the [Ahangify application](https://play.google.com/store/apps/details?id=com.ahangify.music) and select the active sessions option so that you can see it.

* Now open the `login.php` file in your browser
> **NOTE**: that after opening the `login.php` file, a file called `auth.txt` is created which contains the access token, restrict all access to the file and allow only ***read*** access to it.
