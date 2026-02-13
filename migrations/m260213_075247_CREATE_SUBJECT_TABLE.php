<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%SUBJECT}}`.
 */
class m260213_075247_CREATE_SUBJECT_TABLE extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%SUBJECT}}', [
            'subjectId' => $this->primaryKey(),
            'subjectName' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%SUBJECT}}');
    }
}
