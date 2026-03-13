<?php

use yii\db\Migration;

/**
 * Handles adding column isDone to table `{{%TASK}}`.
 */
class m260312_121000_add_is_done_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableSchema = $this->db->schema->getTableSchema('{{%TASK}}');
        if ($tableSchema === null || $tableSchema->getColumn('isDone') !== null) {
            return;
        }

        $this->addColumn('{{%TASK}}', 'isDone', $this->boolean()->notNull()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableSchema = $this->db->schema->getTableSchema('{{%TASK}}');
        if ($tableSchema === null || $tableSchema->getColumn('isDone') === null) {
            return;
        }

        $this->dropColumn('{{%TASK}}', 'isDone');
    }
}
