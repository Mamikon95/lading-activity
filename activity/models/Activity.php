<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string|null $url Activity url
 * @property string|null $date Activity date
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'string', 'max' => 255],
            [['date'], 'string', 'max' => 32],
            [['date', 'url'], 'required'],
            [['url'], 'url'],
            [['date'], 'date', 'format' => 'php:d.m.Y']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'url',
            'date' => 'date',
        ];
    }
}
