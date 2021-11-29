<?php

use yii\db\Migration;

/**
 * Class m211129_203926_calculator
 */
class m211129_203926_calculator extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('calculators', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null)
        ]);

        $this->createTable('calculator_characteristics', [
            'id' => $this->primaryKey(),
            'calculator_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'type' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-calculator_characteristics-calculator_id',
            'calculator_characteristics',
            'calculator_id'
        );

        $this->addForeignKey(
            'fk-calculator_characteristics-calculator_id',
            'calculator_characteristics',
            'calculator_id',
            'calculators',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createTable('calculator_characteristic_values', [
            'id' => $this->primaryKey(),
            'characteristic_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull(),
            'value' => $this->string()->notNull(),
            'price' => $this->decimal()->notNull()
        ]);

        $this->createIndex(
            'idx-calculator_characteristic_values-characteristic_id',
            'calculator_characteristic_values',
            'characteristic_id'
        );

        $this->addForeignKey(
            'fk-calculator_characteristic_values-characteristic_id',
            'calculator_characteristic_values',
            'characteristic_id',
            'calculator_characteristics',
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
       $this->dropTable('characteristic_values');
       $this->dropTable('calculator_characteristics');
       $this->dropTable('calculators');
    }
}
