# Free Mobile SMS
A small library to send a text message to your Free mobile number.


## Installation
Download the freeMobileSMS.php file and include it in your projet.

`require_once 'FreeMobileSMS.php';`

## Configuration
To enable the API on your Free Mobile phone number, log in to your Free Mobile account, then "Gérer mon compte" -> "Notification par SMS".

Save the key given to you as it will be required when using the API.

In the freeMobileSMS.php file, edit the `$userId` to set it to you Free Mobile user ID (visible on your bills) and `$password` to the key given to you when you activated the SMS Notification option.

## Usage
```php
$freeMobile = new FreeMobileSms(YOUR_USER_ID, YOUR_API_KEY);
echo $freeMobile->sendMessage('Hello world');
```
