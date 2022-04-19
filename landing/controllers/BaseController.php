<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\services\ActivityService;

class BaseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function beforeAction($action)
    {
        ActivityService::newActivity(preg_replace('/:[0-9]+/', '.local', Url::canonical()), yii::$app->formatter->asDate(time(), 'php:d.m.Y'));
        return parent::beforeAction($action);
    }
}
