<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Model
{
    public $limit;
    public $offset;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['limit', 'offset'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Create data array
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Activity::find();

        if($this->offset)
        {
            $query->offset($this->offset);
        }

        if($this->limit)
        {
            $query->limit($this->limit);
        }

        $query->select('url, COUNT(url) AS visitCounts, MAX(`date`) AS `lastVisitDate`');
        $query->groupBy('url');

        return $query->asArray()->all();
    }

    /**
     * @return bool|int|string|null
     */
    public function allCount()
    {
        $query = Activity::find();
        $query->select('url, COUNT(url) AS visitCounts, MAX(`date`) AS `lastVisitDate`');
        $query->groupBy('url');

        return $query->count();
    }
}
