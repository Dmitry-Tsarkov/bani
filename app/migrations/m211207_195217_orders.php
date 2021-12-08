<?php

use yii\db\Migration;

/**
 * Class m211207_195217_orders
 */
class m211207_195217_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->defaultValue(null),
            'service_id' => $this->integer()->defaultValue(null),
            'type' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'name' => $this->string()->defaultValue(null),
            'email' => $this->string()->defaultValue(null),
            'phone' => $this->string()->defaultValue(null),
            'comment' => $this->text()->defaultValue(null),
            'additional_options' => $this->string()->defaultValue(null),
        ]);

        $this->createIndex(
            'idx-orders-product_id',
            'orders',
            'product_id'
        );
        $this->addForeignKey(
            'fk-orders-product_id',
            'orders',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-orders-service_id',
            'orders',
            'service_id'
        );
        $this->addForeignKey(
            'fk-orders-service_id',
            'orders',
            'service_id',
            'services',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
