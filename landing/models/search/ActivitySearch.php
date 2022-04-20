<?php

namespace app\models\search;

use app\services\ActivityService;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Model
{

    /**
     * Create data array
     * @param $data
     * @return ArrayDataProvider
     */
    public function search($data)
    {
        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => false
        ]);

        return $provider;
    }
}
