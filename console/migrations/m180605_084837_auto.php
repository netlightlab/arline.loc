<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180605_084837_auto
 */
class m180605_084837_auto extends Migration
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
        echo "m180605_084837_auto cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('auto', [
            'id' => Schema::TYPE_PK,
            'driver_id' => Schema::TYPE_INTEGER,
            'mark' => Schema::TYPE_STRING,
            'number' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('auto');

        return false;
    }

}
