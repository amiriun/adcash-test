<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190831_184009_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'fullname' => $this->string('40'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createIndex('fullname_index','user','fullname');
        $this->createIndex('created_at_index','user','created_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
