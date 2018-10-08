<?php

namespace Wearesho\Yii\HeaderLanguageSelector;

use yii\base;
use yii\web;

/**
 * Class Bootstrap
 * @package Wearesho\Yii\HeaderLanguageSelector
 */
class Bootstrap extends base\BaseObject implements base\BootstrapInterface
{
    /**
     * Name of header with language
     * @var string
     */
    public $headerAttribute = 'language';

    /**
     * Array of supported languages
     * @var array
     */
    public $supportedLanguages = ['en'];

    /**
     * Default language if none sent.
     * @var string
     */
    public $defaultLanguage = 'en';

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (!$app->has('request') || !$app->request instanceof web\Request) {
            $app->language = $this->defaultLanguage;
            return;
        }

        $receivedLanguage = $app->request->headers->get($this->headerAttribute);

        if ($receivedLanguage && in_array($receivedLanguage, $this->supportedLanguages)) {
            $lang = $receivedLanguage;
        } else {
            $lang = $this->defaultLanguage;
        }

        $app->language = $lang;
    }
}
