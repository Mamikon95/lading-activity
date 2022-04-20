<?php

namespace app\components;

use app\models\User;
use JsonRpc2\Exception;
use yii\filters\auth\AuthMethod;
use yii\helpers\Json;
use yii;

class Auth extends AuthMethod
{
    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $requestObject = Json::decode(file_get_contents('php://input'), false);
        $user = User::findIdentityByAccessToken(@$requestObject->auth);

        if (!$user) {
            Yii::$app->response->content = $this->_getError(null, new \JsonRpc2\extensions\AuthException('Missing auth',
                \JsonRpc2\extensions\AuthException::MISSING_AUTH), 1);
            yii::$app->end();
        }

        return true;
    }

    protected function _getError($result = null, Exception $error = null, $id = null)
    {
        $resultArray = [
            'jsonrpc' => '2.0',
            'id' => $id,
        ];

        if (!empty($error)) {
            \Yii::error($error, 'jsonrpc');
            $resultArray['error'] = $error->toArray();
        } else {
            $resultArray['result'] = $result;
        }

        return Json::encode($resultArray);
    }
}