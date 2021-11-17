<?php

namespace app\modules\service\models;

use app\modules\admin\behaviors\ImageBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * @property int $id [int(11)]
 * @property int $service_id [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $position [int(11)]
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 *
 * @mixin ImageBehavior
 */
class ServiceImage extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => ImageBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                    'preview' => ['width' => 1170, 'height' => 482],
                    'view' => ['width' => 1170, 'height' => 420],
                    'mini' => ['width' => 180, 'height' => 116],
                ],
                'folder' => 'service',
            ],
        ];
    }

    public static function tableName()
    {
        return 'service_images';
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function hasImage()
    {
        return !empty($this->image && file_exists($this->getUploadedFilePath('image')));
    }

    public function getImageSrc()
    {
        return $this->hasImage() ? Url::to($this->getUploadedFileUrl('image'),true) : '';
    }

    public function getMiniImageSrc()
    {
        return $this->hasImage() ? Url::to($this->getThumbFileUrl('image', 'mini'),true) : '';
    }

    public function getThumbImageSrc()
    {
        return $this->hasImage() ? Url::to($this->getThumbFileUrl('image'),true) : '';
    }

    public function getPreviewImageSrc(): string
    {
        return $this->hasImage() ? Url::to($this->getThumbFileUrl('image', 'preview'),true) : '';
    }

    public static function create(UploadedFile $image): self
    {
        $self = new self();
        $self->image = $image;
        return $self;
    }
}