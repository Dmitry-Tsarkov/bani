<?php

use yii\db\Migration;

/**
 * Class m210907_091251_product_characteristic
 */
class m210907_091251_product_characteristic extends Migration
{
    public function safeUp()
    {
        $this->createTable('product_characteristics', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'unit' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
        ]);

        $this->createTable('variants', [
            'id' => $this->primaryKey(),
            'characteristic_id' => $this->integer()->defaultValue(null),
            'value' => $this->string()->notNull(),
        ]);

        $this->createIndex(
            'idx-variants-characteristic_id',
            'variants',
            'characteristic_id'
        );

        $this->addForeignKey(
            'fk-variants-characteristic_id',
            'variants',
            'characteristic_id',
            'product_characteristics',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createTable('values', [
            'id' => $this->primaryKey(),
            'characteristic_id' => $this->integer()->defaultValue(null),
            'product_id' => $this->integer()->defaultValue(null),
            'variant_id' => $this->integer()->defaultValue(null),
            'value' => $this->string()->defaultValue(null),
        ]);

        $this->createIndex(
            'idx-values-characteristic_id',
            'values',
            'characteristic_id'
        );

        $this->addForeignKey(
            'fk-values-characteristic_id',
            'values',
            'characteristic_id',
            'product_characteristics',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-values-product_id',
            'values',
            'product_id'
        );

        $this->addForeignKey(
            'fk-values-product_id',
            'values',
            'product_id',
            'products',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-values-variant_id',
            'values',
            'variant_id'
        );

        $this->addForeignKey(
            'fk-values-variant_id',
            'values',
            'variant_id',
            'variants',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('value');
        $this->dropTable('variants');
        $this->dropTable('product_characteristics');
    }
}
