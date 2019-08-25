<?php

use yii\db\Migration;

/**
 * Class m190825_113006_createTableUsers
 */
class m190825_113006_createTableUsers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'username'=>$this->string(150)->notNull(),
            'email'=>$this->string(150)->notNull(),
            'password_hash'=>$this->string(150)->notNull(),
            'createdAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),

        ]);
        $this->createIndex('UserEmailUniq','users','email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190825_113006_createTableUsers cannot be reverted.\n";

        return false;
    }
    */
}
