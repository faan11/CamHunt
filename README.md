# LHunt
A light software that permits you to play a treasure hunt game with QR code.


# Game rules

When the game starts, you need to resolve a riddle.

This permits you to find a QR code.

This QR code give you another clue (if you have internet connection).

When you find all clue you win.

The choice of new clue is only random (if you want to change you must modify classes in app/algorithm folder)

# Game

LHunt stay as Light Hunt, give you the necessary features that permits you to play:

1. Create/Remove/Update clue,

2. Automatic creation of QR code when you create clue,

3. Download all clues image with correct url,

4. See all user progress,

5. Delete/Ban/Reset user progress.

This application was released with Afferro GPL v3.

# How is it made ?

1. Php 5.4

2. Laravel

3. Bootstrap 3

4. MultiAuth component for Laravel

5. Simple Qr code component for Laravel 

6. Zipper  component for Laravel

#Requirement

1. Configuration Apache / PHP / Mysql (or Maria Db) and modrewrite module.

# Deployment

1 . Go in the web site folder with terminal:
```
  cd $WEBSITE 
```
where $WEBSITE is the path where you have the site.



2 . Clone the source code:
```
  git clone https://github.com/faan11/LHunt.git .
```


3 . Create database lhunt:
```
 echo "create database lhunt" | mysql -u root --password=$PASSWORD 
```
where $PASSWORD is the db root password.


4 . Change password:
```
  sed -i 's/%/$PASSWORD/g' app/config/database.php 
```

where $PASSWORD is the db root password.


5 . Migrate data
```
  php artisan migrate --seed
```

5.1 Define timestamp

The default timestamp is UTC.

If you want to change it you need to go in app/config/app.php  and change it with one that you can find in this link:

http://php.net/manual/en/timezones.php

5.2 Check php extension

You need this extension in your /etc/php/php.ini:

```
extension=pdo_mysql.so
extension=mysqli.so
extension=mcrypt.so
extension=curl.so
extension=exif.so
extension=gd.so
extension=gettext.so
extension=iconv.so
extension=openssl.so
extension=phar.so
extension=zip.so

```
5.3 Check permission

in the folder your must have all permissions:

```
sudo chmod 777 $WEBSITE -R
```

6 . Define clues!

If there is no clues the system won't work:

So open the browser and go to:

```
http://localhost/admin
```

(if you have virtualhost in another port or dns name change the part before "/admin")

The default username and password is :

USER: root@root.it

PASS: root

6.1 If you want to change the password (it's a good practice) , you need to change it in admins table (in database).

6.2 Now you can create clues. The clues host link depends on your web page host.  

![](https://raw.githubusercontent.com/faan11/LHunt/master/images/adminclues.png)

7 . Now let's play!

With browser go to this link:
```
http://localhost/user
```
and register with any credentials.

The username is an email field and both field can't be empty.
![](https://raw.githubusercontent.com/faan11/LHunt/master/images/userloginreg.png)
User login
![](https://raw.githubusercontent.com/faan11/LHunt/master/images/screen.png)
First clue.

# Want to contribute?

if you want to contribute, contact me on my email (delphibit@gmail.com).


