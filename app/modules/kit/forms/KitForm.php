<?php

namespace app\modules\kit\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\kit\models\Kit;
use yii\base\Model;

class KitForm extends Model
{
    public $title;
    public $hint;
    public $price;
    public $price_type;
    public $text;
    public $bottom_text;

    /**
     * @var Kit|null
     */
    private $kit;

    public function __construct(?Kit $kit = null)
    {
        if (!empty($kit)) {
            $this->title = $kit->title;
            $this->hint = $kit->hint;
            $this->price = $kit->price;
            $this->price_type = $kit->price_type;
            $this->text = $kit->text;
            $this->bottom_text = $kit->bottom_text;
        }

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['text', 'title'], 'required'],
            [['title', 'hint'], 'string'],
            [['price'], 'double'],
            [['price_type'], 'integer'],
            [['text', 'bottom_text'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'hint' => 'Подсказка',
            'text' => 'Текст',
            'price' => 'Цена',
            'price_type' => 'Тип цены',
            'bottom_text' => 'Текст снизу',
        ];
    }
}