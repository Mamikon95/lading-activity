<?php
namespace app\controllers\api\v1;

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
                    '*'  => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return bool
     * @throws \JsonRpc2\extensions\AuthException
     */
    public function checkAuth()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $user = User::findIdentityByAccessToken($this->getAuthCredentials());

        if (!$user)
        {
            throw new \JsonRpc2\extensions\AuthException('Missing auth',
                \JsonRpc2\extensions\AuthException::MISSING_AUTH);
        }

        return true;
    }
}