<?php

use yii\db\Migration;

/**
 * Class m211112_092503_kits
 */
class m211112_092503_product_kits extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kit', [
            'id' => $this->primaryKey(),
            'position' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
        ]);

        $this->createTable('products_kits', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'kit_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-products_kits-product_id',
            'products_kits',
            'product_id'
        );

        $this->addForeignKey(
            'fk-products_kits-product_id',
            'products_kits',
            'product_id',
            'products',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-products_kits-kit_id',
            'products_kits',
            'kit_id'
        );

        $this->addForeignKey(
            'fk-products_kits-kit_id',
            'products_kits',
            'kit_id',
            'kit',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products_kits');
        $this->dropTable('kit');
    }
}
