#Mondido PHP SDK 2.0 by Snowfire
=======

To get started with the SDK, simply run `composer require snowfire/mondido-php-sdk` and include the composer-generated `autoload.php`.

Every time you wish to use the api through the SDK, you must first instantiate the `Mondido\Mondido` class with your merchant id, password and secret. If you plan to use this in more than one place, it is recommended to place this instantiation in a constructor, trait or similar.

You can then access the different api features through your main instance.

## Example

```
<?php

namespace Foo\Bar

class MondidoExample
{

    private $api;
    
    public function __construct()
    {
        $merchantId = 'yourMerchantId';
        $password = 'yourApiPassword';
        $secret = 'yourApiSecret';
        
        $this->api = new Mondido\Mondido($merchantId, $password, $secret);
    }
    
    public function recordPayment($data)
    {
        $transaction = $this->api->transaction()->create($data);
    }
 }
```

For complete API documentation, please visit [Mondido](https://doc.mondido.com/api). 


The unit tests require PHPUnit to be installed and run `phpunit test/`

*Changelog*   
- 2.0, Transitioned to non-static api
- 2.0, Refactored all code for PSR-0
- 2.0, Fixed tests
- 2.0, Bug and syntax fixes
- 1.2, Updated Hash recipe, refactor models, etc.