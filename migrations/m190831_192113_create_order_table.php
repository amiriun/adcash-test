<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m190831_192113_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10),
            'product_id' => $this->integer(10),
            'quantity' => $this->integer(3),
            'item_price' => $this->float(15),
            'total_price' => $this->float(15),
            'cloned_product_name' => $this->string(40),
            'cloned_user_fullname' => $this->string(40),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->createIndex('index_user_id','order','user_id');
        $this->createIndex('index_product_id','order','product_id');
        $this->createIndex('index_user_id_product_id','order',['user_id','product_id']);
        $this->createIndex('index_created_at','order','created_at');
        $this->addForeignKey('user_id_foreign','order','user_id','user','id');
        $this->addForeignKey('product_id_foreign','order','product_id','product','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
