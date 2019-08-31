<?php

use yii\db\Migration;

/**
 * Class m190831_090712_insertColumn
 */
class m190831_090712_insertColumn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users','status', $this->smallInteger()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users','status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190831_090712_insertColumn cannot be reverted.\n";

        return false;
    }
    */
}
