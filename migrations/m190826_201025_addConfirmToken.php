<?php

use yii\db\Migration;

/**
 * Class m190826_201025_addConfirmToken
 */
class m190826_201025_addConfirmToken extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users','email_confirm_token', $this->string()->unique()->after('email'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users','email_confirm_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190826_201025_addConfirmToken cannot be reverted.\n";

        return false;
    }
    */
}
