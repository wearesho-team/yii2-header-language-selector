# Yii2 header language selector

This library allows you to configure setting language from http header in yii2 application.

## Setup

```bash
composer require wearesho-team/yii2-header-language-selector
```

## Configure

Append bootstrap declaration in your app config with next item

```php
<?php

// config/main.php

use Wearesho\Yii\HeaderLanguageSelector;

return [
    'id' => 'appId',
    'basePath' => __DIR__,
    'bootstrap' => [
        'headerLanguageSelector' => [
            'class' => HeaderLanguageSelector\Bootstrap::class,
            'defaultLanguage' => 'ru',
            'supportedLanguages' => ['ua', 'ru', 'en',],
            'headerAttribute' => 'language',
        ],
    ],
];

``` 
