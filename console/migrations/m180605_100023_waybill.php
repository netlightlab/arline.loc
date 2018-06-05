<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180605_100023_waybill
 */
class m180605_100023_waybill extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180605_100023_waybill cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('waybill', [
            'id' => Schema::TYPE_PK,
            'auto_id' => Schema::TYPE_INTEGER,
            'date' => Schema::TYPE_TIMESTAMP,
            'time_start' => Schema::TYPE_TIME,
            'odo_start' => Schema::TYPE_INTEGER,
            'odo_start_photo' => Schema::TYPE_STRING,
            'time_end' => Schema::TYPE_TIME,
            'odo_end' => Schema::TYPE_INTEGER,
            'odo_end_photo' => Schema::TYPE_STRING,
            'passed_km' => Schema::TYPE_INTEGER,
            'way' => Schema::TYPE_STRING,
            'card' => Schema::TYPE_INTEGER,
            'gsm' => Schema::TYPE_INTEGER,
            'gsm_check' => Schema::TYPE_STRING,
        ]);
    }

    public function down()
    {
        $this->dropTable('waybill');

        return false;
    }

}
