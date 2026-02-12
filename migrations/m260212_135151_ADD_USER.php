<?php

use yii\db\Migration;

class m260212_135151_ADD_USER extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%USER}}', [
            'username' => 'einfach',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('einfach'),
            'authKey' => Yii::$app->getSecurity()->generateRandomString(),
            'accessToken' => Yii::$app->getSecurity()->generateRandomString(),
            'role' => 'User',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260212_135151_ADD_USER cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260212_135151_ADD_USER cannot be reverted.\n";

        return false;
    }
    */
}
