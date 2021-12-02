<?php

namespace app\modules\calculator\models;

use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\traits\QueryExceptions;
use PHPThumb\GD;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * @mixin ImageBehavior
 *
 * @property CalculatorCharacteristc[] $characteristics
 *
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $description
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 */
class Calculator extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return 'calculators';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageBehavior::class,
                'folder' => 'services',
                'thumbs' => [
                    'thumb' => ['processor' => function (GD $thumb) {
                        $thumb->resize(357, 323)->pad(250, 250, [255, 255, 255]);
                    }],
                    'view' => ['processor' => function (GD $thumb) {
                        $thumb->resize(1132, 566)->pad(1132, 566, [255, 255, 255]);
                    }]
                ],
            ],
        ];
    }

    public static function create($title, $description, ?UploadedFile $image): self
    {
        $self = new self();

        $self->title = $title;
        $self->description = $description;
        $self->image = $image;

        return $self;
    }

    public function edit($title, $description, ?UploadedFile $image)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    public function getCharacteristics()
    {
        return $this->hasMany(CalculatorCharacteristc::class, ['calculator_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description'  => 'Описание',
            'image' => 'Картинка',
        ];
    }

    public function beforeValidate(): bool
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        return parent::beforeValidate();
    }

    public function getThumbSrc()
    {
        return $this->hasImage() ? Url::to($this->getThumbFileUrl('image'), true) : '';
    }

    public function getViewImageSrc()
    {
        return $this->hasImage() ? Url::to($this->getThumbFileUrl('image', 'view'), true) : '';
    }
}