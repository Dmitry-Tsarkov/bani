<?php

namespace app\traits;

use yii\db\Migration;

/**
 * @mixin Migration
 */
trait MigrateTrait
{
    public function columns($columnNames)
    {
        $columns = [];

        foreach ($columnNames as $columnName) {
            switch ($columnName) {
                case 'id' : $columns['id'] = $this->primaryKey(); break;
                case 'created_at' : $columns['created_at'] = $this->integer()->notNull()->comment('Дата создания'); break;
                case 'updated_at' : $columns['updated_at'] = $this->integer()->notNull()->comment('Дата редактирования'); break;
                case 'position' : $columns['position'] = $this->integer()->notNull(); break;
                case 'active' : $columns['active'] = $this->boolean()->defaultValue(1)->comment('Активность'); break;
                case 'title' : $columns['title'] = $this->string(255)->notNull()->defaultValue('')->comment('Название'); break;
                case 'comment' : $columns['comment'] = $this->text()->comment('Комментарий'); break;
                case 'content' : $columns['content'] = $this->text()->comment('Контент'); break;
                case 'description' : $columns['description'] = $this->text()->comment('Описание'); break;
                case 'alias' : $columns['alias'] = $this->string(255)->unique()->notNull()->defaultValue('')->comment('Алиас'); break;
                case 'sort' : $columns['sort'] = $this->integer()->defaultValue(500)->comment('Сортировка'); break;
                case 'image' :
                    $columns['image'] = $this->string(500)->comment('Картинка');
                    $columns['image_hash'] = $this->string(255);
                    break;
                case 'icon' :
                    $columns['icon'] = $this->string(500)->comment('Иконка');
                    $columns['icon_hash'] = $this->string(255);
                    break;
                case 'seo' :
                    $columns['meta_d'] = $this->string(255)->comment('Описание страницы');
                    $columns['meta_k'] = $this->string(255)->comment('Ключевые слова');
                    $columns['meta_t'] = $this->string(255)->comment('Заголовок страницы');
                    $columns['h1'] = $this->string(255)->comment('H1');

                    break;

                case 'nested_sets':
                    $columns['parent_id'] = $this->integer();
                    $columns['lft'] = $this->integer()->notNull();
                    $columns['rgt'] = $this->integer()->notNull();
                    $columns['depth'] = $this->integer()->notNull();

                    break;
            }
        }

        return $columns;
    }

    public function defaultColumns()
    {
        return $this->columns(['id', 'title', 'position', 'active', 'created_at', 'updated_at']);
    }
}