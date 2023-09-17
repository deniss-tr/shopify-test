## Shopify test app

### How to start

1. Clone repo
2. Run composer install in project root on "main" branch
3. Create and insert config.php file in /app/etc directory 
    (in this test project, content of config.php present in this Read me file, in real project this file will be providen individually)
4. Tests can be run by executing in terminal ```vendor/bin/phpunit tests```

### How it works

1. On first page load we make async request with checking if we have saved products in storage. 
If we have saved products we return them and render list on Frontend.
2. Clicking on button Fetch products -> makes async request to app controller, where we make API call to Shopify, then we save recieved data into storage and return results to Frontend.

### Content of config.php

```
<?php

return [
    'shopify_access_token' => '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',
    'shopify_api_key' => '27537f19f8c54dd03657959102600c0e',
    'shopify_api_secret' => 'ff22d31870e2b95a94e1a9f0cdff1021'
];
```