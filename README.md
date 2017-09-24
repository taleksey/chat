REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.0.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:^1.3.1"
git clone https://github.com/taleksey/chat.git chat
cd ./chat
php composer.phar install
~~~

### Install from an Archive File

Extract the archive file downloaded from https://github.com/taleksey/chat to
a directory named `chat` that is directly under the Web root.

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/chat
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=chat',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.

1. Set `chat` as web root path in Apache/Nginx.

2. Next step create DB and run migration for creating tables.
~~~
  yii migration
~~~
 
3. Om main page site you have to input nick name if it was created before we will use it otherwise we will create new.
User that is active will be have in right side different color from another users.

4. After you input nick name you can add new messages.

