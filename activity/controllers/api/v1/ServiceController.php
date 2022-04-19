<?php
namespace app\controllers\api\v1;

use app\models\Activity;
use JsonRpc2\Exception;
use yii\helpers\Json;

class ServiceController extends BaseController
{
    /**
     * @param $message
     * @return bool
     * @throws Exception
     * @throws \JsonRpc2\extensions\AuthException
     */
    public function actionAdd($message)
    {
        $this->checkAuth();

        $activity = new Activity();
        $activity->url = $message->url;
        $activity->date = $message->date;

        if(!$activity->validate())
        {
            throw new Exception(Json::encode($activity->getErrors()), Exception::INVALID_PARAMS);
        }

        return $activity->save();
    }

    public function actionGet($message)
    {

    }
}