<?php

use yii\db\Migration;

/**
 * Class m190901_184258_deleteUsername
 */
class m190901_184258_deleteUsername extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('users', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190901_184258_deleteUsername cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190901_184258_deleteUsername cannot be reverted.\n";

        return false;
    }
    */
}
