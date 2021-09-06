<?php


namespace app\modules\category\behaviors;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yiidreamteam\upload\FileUploadBehavior;

class CategoryIconBehavior extends FileUploadBehavior
{
    public $createThumbsOnRequest = true;
    public $attribute = 'icon';
    public $hashAttribute = 'icon_hash';
    public $folder = 'subcategory_icons';

    public function init()
    {
        parent::init();

        $this->filePath = "@webroot/uploads/{$this->folder}/[[pk]]_[[attribute_{$this->hashAttribute}]].[[extension]]";
        $this->fileUrl = "/uploads/{$this->folder}/[[pk]]_[[attribute_{$this->hashAttribute}]].[[extension]]";
    }

    public function beforeSave()
    {
        if ($this->owner->{$this->attribute} instanceof UploadedFile) {
            $this->owner->{$this->hashAttribute} = uniqid();
        }

        if ($this->file instanceof UploadedFile) {

            if (true !== $this->owner->isNewRecord) {
                /** @var ActiveRecord $oldModel */
                $oldModel = $this->owner->findOne($this->owner->primaryKey);
                $behavior = static::getInstance($oldModel, $this->attribute);
                $behavior->cleanFiles();
            }

            $this->owner->{$this->attribute} = implode('.',
                array_filter([$this->file->baseName, $this->file->extension], 'strlen')
            );
        } else {
            if (true !== $this->owner->isNewRecord && empty($this->owner->{$this->attribute})) {
                $this->owner->{$this->attribute} = ArrayHelper::getValue($this->owner->oldAttributes, $this->attribute,
                    null);
            }
        }
    }

    public function deleteIcon()
    {
        $this->cleanFiles();
        $this->owner->updateAttributes([$this->attribute => null, $this->hashAttribute => null]);
    }

    public function hasImage()
    {
        return !empty($this->owner->{$this->attribute}) && is_file($this->getUploadedFilePath($this->attribute));
    }
}