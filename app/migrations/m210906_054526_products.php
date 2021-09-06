<?php

use yii\db\Migration;

/**
 * Class m210906_054526_products
 */
class m210906_054526_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue(null),
            'image_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'price_type' => $this->integer()->notNull(),
            'price' => $this->decimal()->notNull(),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'meta_t' => $this->string()->defaultValue(null),
            'meta_d' => $this->string()->defaultValue(null),
            'meta_k' => $this->string()->defaultValue(null),
            'h1' => $this->string()->defaultValue(null),
        ]);

        $this->createTable('product_images', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->defaultValue(null),
            'position' => $this->integer(),
            'image' => $this->string(),
            'image_hash' => $this->string(),
        ]);

        $this->createIndex(
            'idx-products-category_id',
            'products',
            'category_id'
        );
        $this->addForeignKey(
            'fk-products-category_id',
            'products',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product_images-product_id',
            'product_images',
            'product_id'
        );
        $this->addForeignKey(
            'fk-product_images-product_id',
            'product_images',
            'product_id',
            'products',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->dropTable('product_characteristics');
        $this->dropTable('product_images');
        $this->dropTable('products');
    }
}
