<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%USER}}`.
 */
class m260212_135130_CREATE_USER_TABLE extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%USER}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(64)->notNull()->unique(),
            'username' => $this->string(16)->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
            'role' => $this->string()->notNull()->defaultValue('User'),
            'verificationCode' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%USER}}');
    }
}
