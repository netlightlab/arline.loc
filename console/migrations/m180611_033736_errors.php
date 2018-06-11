<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180611_033736_errors
 */
class m180611_033736_errors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('errors', [
            'id' => Schema::TYPE_PK,
            'coordinator' => Schema::TYPE_INTEGER,
            'car' => Schema::TYPE_INTEGER,
            'date' => Schema::TYPE_STRING
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('errors');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180611_033736_errors cannot be reverted.\n";

        return false;
    }
    */
}
