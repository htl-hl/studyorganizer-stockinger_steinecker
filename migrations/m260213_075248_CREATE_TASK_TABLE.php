<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%TASK}}`.
 */
class m260213_075248_CREATE_TASK_TABLE extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%TASK}}', [
            'taskId' => $this->primaryKey(),
            'taskTitle' => $this->string()->notNull(),
            'taskDescription' => $this->text(),
            'taskDueDate' => $this->date(),
            'taskOwnerId' => $this->integer()->notNull(),
            'taskSubjectId' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'foreignTaskOwnerId',
            '{{%TASK}}',
            'taskOwnerId',
            '{{%USER}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'foreignTaskSubjectId',
            '{{%TASK}}',
            'taskSubjectId',
            '{{%SUBJECT}}',
            'subjectId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%TASK}}');
    }
}
