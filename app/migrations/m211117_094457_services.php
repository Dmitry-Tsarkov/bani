<?php

use yii\db\Migration;

/**
 * Class m211117_094457_services
 */
class m211117_094457_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('services', [
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

        $this->createTable('service_images', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer()->defaultValue(null),
            'position' => $this->integer(),
            'image' => $this->string(),
            'image_hash' => $this->string(),
        ]);

        $this->createIndex(
            'idx-services-category_id',
            'services',
            'category_id'
        );
        $this->addForeignKey(
            'fk-services-category_id',
            'services',
            'category_id',
            'service_categories',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-service_images-service_id',
            'service_images',
            'service_id'
        );
        $this->addForeignKey(
            'fk-service_images-service_id',
            'service_images',
            'service_id',
            'services',
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
        $this->dropTable('service_images');
        $this->dropTable('services');
    }
}
