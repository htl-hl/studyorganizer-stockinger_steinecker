<?php

use yii\db\Migration;

class m260227_075310_ADD_ADMIN_USER extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%USER}}', [
            'email' => 'admin',
            'username' => 'admin',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'authKey' => Yii::$app->getSecurity()->generateRandomString(),
            'accessToken' => Yii::$app->getSecurity()->generateRandomString(),
            'role' => 'admin',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260227_075310_ADD_ADMIN_USER cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260227_075310_ADD_ADMIN_USER cannot be reverted.\n";

        return false;
    }
    */
}
