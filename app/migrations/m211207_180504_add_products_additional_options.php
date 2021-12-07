<?php

use yii\db\Migration;

/**
 * Class m211207_180504_add_products_additional_options
 */
class m211207_180504_add_products_additional_options extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products_additional_options', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(1),
            'title' => $this->string()->notNull(),
        ]);

        $this->createIndex(
            'idx-products_additional_options-product_id',
            'products_additional_options',
            'product_id'
        );
        $this->addForeignKey(
            'fk-products_additional_options-product_id',
            'products_additional_options',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products_additional_options');
    }
}
