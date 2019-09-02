<?php

use yii\db\Migration;

/**
 * Class m190830_114103_addColumnStatus
 */
class m190830_114103_addColumnStatus extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'status', $this->smallInteger()
            ->notNull()
            ->defaultValue(0)
            ->after('email_confirm_token'));
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
        echo "m190830_114103_addColumnStatus cannot be reverted.\n";

        return false;
    }
    */
}
