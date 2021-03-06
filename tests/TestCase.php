<?php
/**
 * @link https://github.com/matrozov/yii2-couchbase
 * @author Oleg Matrozov <oleg.matrozov@gmail.com>
 */

namespace yiiunit\extensions\couchbase;

use matrozov\couchbase\Connection;
use Yii;
use yii\helpers\ArrayHelper;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Connection Couchbase connection instance
     */
    protected static $db;

    /**
     * @var string bucket name for test cases
     */
    protected static $bucketName;

    public static function setUpBeforeClass()
    {
        $params = require(__DIR__ . '/data/config.php');

        self::mockApplication($params);

        self::$bucketName = 'yii2test';
        self::$db = Yii::$app->couchbase;
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected static function mockApplication($config = [], $appClass = '\yii\console\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => realpath(__DIR__ . '/../vendors'),
            'runtimePath' => dirname(__DIR__) . '/runtime',
        ], $config));
    }
}