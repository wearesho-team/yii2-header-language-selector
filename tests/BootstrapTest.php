<?php

namespace Wearesho\Yii\HeaderLanguageSelector\Tests;

use PHPUnit\Framework\TestCase;
use Wearesho\Yii\HeaderLanguageSelector;
use yii\web;

/**
 * Class BootstrapTest
 * @package Wearesho\Yii\HeaderLanguageSelector\Tests
 */
class BootstrapTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        \Yii::$app = new web\Application([
            'id' => '1',
            'basePath' => dirname(__DIR__),
        ]);
    }

    public function testDefaultLanguage(): void
    {
        $bootstrap = new HeaderLanguageSelector\Bootstrap([
            'defaultLanguage' => 'ru',
        ]);
        $bootstrap->bootstrap(\Yii::$app);
        $this->assertEquals('ru', \Yii::$app->language);
    }

    public function testInvalidLanguage(): void
    {
        $_SERVER['HTTP_LANGUAGE'] = 'uk';
        $bootstrap = new HeaderLanguageSelector\Bootstrap([
            'defaultLanguage' => 'ru',
        ]);
        $bootstrap->bootstrap(\Yii::$app);
        $this->assertEquals('ru', \Yii::$app->language);
    }

    public function testCorrectSetting(): void
    {
        $_SERVER['HTTP_LANGUAGE'] = 'uk';
        $bootstrap = new HeaderLanguageSelector\Bootstrap([
            'defaultLanguage' => 'ru',
            'supportedLanguages' => ['ru', 'uk',],
        ]);
        $bootstrap->bootstrap(\Yii::$app);
        $this->assertEquals('uk', \Yii::$app->language);
    }

    public function testInvalidRequestConfig(): void
    {
        $_SERVER['HTTP_LANGUAGE'] = 'uk';
        $bootstrap = new HeaderLanguageSelector\Bootstrap([
            'defaultLanguage' => 'ru',
            'supportedLanguages' => ['ru', 'uk',],
        ]);

        \Yii::$app->set('request', null);

        $bootstrap->bootstrap(\Yii::$app);
        $this->assertEquals('ru', \Yii::$app->language);

        \Yii::$app->set('request', function () {
            return new class
            {
            };
        });

        $bootstrap->bootstrap(\Yii::$app);
        $this->assertEquals('ru', \Yii::$app->language);
    }
}
