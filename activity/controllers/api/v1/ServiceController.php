<?php
namespace app\controllers\api\v1;

use app\models\Activity;
use app\models\search\ActivitySearch;
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
        $activity = new Activity();
        $activity->url = $message->url;
        $activity->date = $message->date;

        if(!$activity->validate())
        {
            throw new Exception(Json::encode($activity->getErrors()), Exception::INVALID_PARAMS);
        }

        return $activity->save();
    }

    /**
     * @throws Exception
     * @throws \JsonRpc2\extensions\AuthException
     */
    public function actionGet($message)
    {
        $search = new ActivitySearch();
        $search->limit = @$message->limit;
        $search->offset = @$message->offset;

        if(!$search->validate())
        {
            throw new Exception(Json::encode($search->getErrors()), Exception::INVALID_PARAMS);
        }

        return ['data' => $search->search()];
    }

    /**
     * @throws \JsonRpc2\extensions\AuthException
     */
    public function actionCount()
    {
        $search = new ActivitySearch();

        return $search->allCount();
    }
}