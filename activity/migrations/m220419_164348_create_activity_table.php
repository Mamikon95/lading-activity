<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m220419_164348_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%activity}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->comment('Activity url'),
            'date' => $this->string(32)->comment('Activity date'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%activity}}');
    }
}
