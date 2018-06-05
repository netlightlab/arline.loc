<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180605_090153_driver
 */
class m180605_090153_driver extends Migration
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
        echo "m180605_090153_driver cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('driver', [
            'id' => Schema::TYPE_PK,
            'auto_id' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'surname' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('driver');

        return false;
    }

}
