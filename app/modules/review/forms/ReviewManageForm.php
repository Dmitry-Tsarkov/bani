<?php

namespace app\modules\review\forms;

use app\modules\review\models\Review;
use yii\base\Model;

class ReviewManageForm extends Model
{
    public $id;
    public $name;
    public $city;
    public $email;
    public $description;
    public $status;


    /**
     * @var Review
     */
    private $review;

    public function __construct(?Review $review = null, $config = [])
    {
        if (!empty($review)) {
            $this->name = $review->name;
            $this->email = $review->email;
            $this->city = $review->city;
            $this->description = $review->description;
        }
        $this->review = $review;

        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return ([
            'name' => 'ФИО',
            'email' => 'E-mail',
            'city' => 'Город',
            'description' => 'Отзыв',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'status' => 'Статус',
        ]);
    }

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['id', 'status'], 'integer'],
            [['name', 'email', 'city', 'description'], 'string'],
        ];
    }
}