<?php

use app\config\components\Common;
use app\config\components\Getter as GetterAlias;
use app\config\components\grid\GridViewConverter;
use yii\console\Application;
use yii\web\User;

/**
 * This class only exists here for IDE (PHPStorm/Netbeans/...) autocompletion.
 * This file is never included anywhere.
 * Adjust this file to match classes configured in your application config, to enable IDE autocompletion for custom components.
 * Example: A property phpdoc can be added in `__Application` class as `@property \vendor\package\Rollbar|__Rollbar $rollbar` and adding a class in this file
 * ```php
 * // @property of \vendor\package\Rollbar goes here
 * class __Rollbar {
 * }
 * ```
 */
class Yii {
    /**
     * @var \yii\web\Application|Application|__Application
     */
    public static $app;
}

/**
 * @property  yii\rbac\DbManager $authManager
 * @property  User|__WebUser     $user
 * @property  Common             $common
 * @property  GetterAlias        $getter
 * @property  GridViewConverter  $grid
 * 
 */
class __Application {
}

/**
 * @property app\models\User $identity
 */
class __WebUser {
}
