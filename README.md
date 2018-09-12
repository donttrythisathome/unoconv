#The Unoconv client laravel package.
##Installation:
```bash
composer require donttruthisathome/unoconv 
```
Add the following provider in config/app.php:
```PHP
'providers' => [
    ...
    Dtth\Unoconv\UnoconvServiceProvider::class,
    ...
],
'aliases'=>[
    ...
    'Unoconv'=>Dtth\Unoconv\Facades\Unoconv::class,
    ...
],
```
##Configuration
To configure the package you need to publish settings first:
```bash
php artisan vendor:publish --provider="Dtth\Unoconv\UnoconvServiceProvider"
```
then configure the package in the ```config/uniconv.php```

Option | Description
--- | ---
host | The Unoconv server host name.

##Methods

Return type | Description
--- | ---
boolean  | \Unoconv::convert(string $file, string $output, $string $format) Convert a file to the given format and save to output path. 

##Usage
```PHP
<?php

namespace App\Http\Controllers;

use Dtth\Unoconv\Contracts\Unoconv;

class AppController extends Controller
{
    public function example(){
        ...
        $result = \Unoconv::convert(
            storage_path('app/public/test.pptx'),
            storage_path('app/public/test.pdf'),
            Unoconv::PDF
        ); 
        if (!$result) return;
        ...
    }    
}

```