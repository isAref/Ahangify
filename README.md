




Configuration:
---------

1. Open the `index.php` file and paste the bot token: **(Line 4)**
```php
define('API_KEY', 'TOKEN');
```
2. Login to [Ahangify](https://ahangify/login) and create an account
3. Open the `login.php` and Enter your username and password: **(Line 5)**
```php
$login = json_encode(['username' => 'UserName', 'password' => 'Password']);
  ```
  
  - We recommend that you use the model and name of your device for the **user agent**
  ```php
  user-agent:Ahangify Mobile/1.7.3 (Samsung SM-A217F, Android 11 "30")
  ```

4. Now open the `login.php` in your browser

* if the `• Login was successful: 45765*****` is displayed, it means that an **CSRF token** has been created


5. Set the webhook to `index.php`

* [Send me your comments and suggestions](https://t.me/is_false)
