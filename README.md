# CF7 API Sender
git commit -m "first commit"

## Installation

1. Download the Zip from the repository
2. Install and activate the plugin through the 'Plugins' screen in WordPress
3. View the Admin Menu to see the APIs you are querying in the code.
4. Paste you need cf7 form title in cf7-api-sender.php
```php
if ( $title === 'PASTE FORM TITLE HERE' ) {
 ...
}
```
5. Paste you need API URL in cf7-api-sender.php
```php
$url = 'PASTE URL HERE';
```