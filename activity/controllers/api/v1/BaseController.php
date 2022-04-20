<?php

namespace app\controllers\api\v1;

use app\components\Auth;
use yii;
use app\models\User;
use JsonRpc2\Controller;

class BaseController extends Controller
{
    use \JsonRpc2\extensions\AuthTrait;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => yii\filters\VerbFilter::class,
                'actions' => [
                    '*' => ['POST'],
                ],
            ],
            'authenticator' => [
                'class' => Auth::class
            ]
        ];
    }
}