<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%TEACHER}}`.
 */
class m260213_074953_CREATE_TEACHER_TABLE extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%TEACHER}}', [
            'teacherId' => $this->primaryKey(),
            'teacherName' => $this->string()->notNull(),
            'active' => $this->boolean()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%TEACHER}}');
    }
}
