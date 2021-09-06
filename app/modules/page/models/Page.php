<?php

namespace app\modules\page\models;

use app\modules\seo\behaviors\SeoBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\page\components\Pages;
use creocoder\nestedsets\NestedSetsBehavior;
use PHPThumb\GD;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property string $id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $parent_id
 * @property string $alias
 * @property string $title
 * @property string $content
 * @property string $content_bottom
 * @property string $h1
 * @property string $meta_d
 * @property string $meta_k
 * @property string $meta_t
 * @property string $image
 * @property string $image_hash
 * @property int $updated_at [int(11)]
 * @property int $options_mask [int(11)]
 * @property bool $is_open_by_alias [tinyint(1)]
 *
 * @property bool[] $options
 * @property PageElement[] $elements
 * @property int $created_at [int(11)]
 *
 * @mixin NestedSetsBehavior
 * @mixin SeoBehavior
 * @mixin ImageUploadBehavior
 */
class Page extends ActiveRecord
{
    use QueryExceptions;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SeoBehavior::class,
            NestedSetsBehavior::class,
            'image' => [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'thumbs' => [
                    'thumb' => ['processor' => function(GD $thumb) {
                        return $thumb->resize(100, 100);
                    }],
                    'view' => ['processor' => function(GD $thumb) {
                        return $thumb->resize(1220);
                    }],
                ],
                'filePath' => '@webroot/uploads/pages/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'fileUrl' => '/uploads/pages/[[pk]]_[[attribute_image_hash]].[[extension]]',
                'thumbPath' => '@webroot/uploads/cache/pages/[[pk]]_[[attribute_image_hash]]_[[profile]].[[extension]]',
                'thumbUrl' => '/uploads/cache/pages/[[pk]]_[[attribute_image_hash]]_[[profile]].[[extension]]',
            ],
        ];
    }

    public static function create($id, $title, $alias, $is_open_by_alias = true, $content = null): Page
    {
        $page = new self();
        $page->id = $id;
        $page->title = $title;
        $page->alias = $alias;
        $page->content = $content;
        $page->is_open_by_alias = $is_open_by_alias;
        return $page;
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return PageQuery
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    public static function tableName()
    {
        return '{{%pages}}';
    }

    public function rules()
    {
        return [
            [['id', 'title', 'alias'], 'required'],
            [['id', 'alias'], 'unique'],
            ['is_open_by_alias', 'boolean'],
            ['id', 'match', 'pattern' => '/^[a-z]+[a-z-]*$/i'],
            [['id', 'parent_id'], 'string', 'max' => 50],
            [['title', 'alias'], 'string', 'max' => 250],
            [['content', 'content_bottom', 'meta_d', 'meta_k', 'meta_t', 'h1'], 'string'],
            ['image', 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'parent_id' => 'Родительская страница',
            'alias' => 'Алиас',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'content_bottom' => 'Контент внизу',
            'h1' => 'H1',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
            'image' => 'Картинка',
            'is_open_by_alias' => 'Открывать по алиасу'
        ];
    }

    public function currentParent()
    {
        $current_parent = $this->parents(1)->one();
        $parent = is_null($current_parent) ? '0' : $current_parent->id;

        return $parent;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $id
     * @return Page
     */
    public static function getOrCreate($id)
    {
        $page = Page::findOne(['id' => $id]);

        return (null !== $page) ? $page : new Page(['id' => $id]);
    }

    public function hasImage()
    {
        return !empty($this->image && file_exists($this->getUploadedFilePath('image')));
    }

    public function beforeSave($insert)
    {
        if ($this->image instanceof UploadedFile) {
            $this->image_hash = uniqid();
        }

        return parent::beforeSave($insert);
    }

    public function saveElements()
    {
        $saveElementKeys = [];

        if (!empty(\Yii::$app->request->post('Page')['elements'])) {

            foreach (\Yii::$app->request->post('Page')['elements'] as $key => $arElement)
            {
                if(!empty($arElement['value'])) {
                    $this->setElement($key, $arElement['value']);
                    $saveElementKeys[$key] = $key;
                }
            }
        }

        PageElement::deleteAll([
            'AND',
            ['page_id' => $this->id],
            ['NOT IN', 'key', $saveElementKeys],
        ]);
    }

    public function deleteImage()
    {
        /** @var ImageUploadBehavior $imageBehavior */
        $imageBehavior = $this->getBehavior('image');
        $imageBehavior->cleanFiles();
        $this->updateAttributes(['image' => null, 'image_hash' => null]);
    }

    public function isActive()
    {
        return $this->lft <= Pages::getCurrentPage()->lft && $this->rgt >= Pages::getCurrentPage()->rgt;
    }

    public function getElements()
    {
        return $this->hasMany(PageElement::class, ['page_id' => 'id'])->indexBy('key');
    }

    public function setElement($key, $value): Page
    {
        $element = $this->getElements()->andWhere(['key' => $key])->one()
            ?? new PageElement([
                'page_id' => $this->id,
                'key' => $key,
            ]);

        $element->value = $value;
        $element->save();
        return $this;
    }

    public function getElementValue($key)
    {
        $elements = $this->elements;

        if(!empty($elements) && !empty($elements[$key])) {
            return $elements[$key]->value ?? '';
        }

        return '';
    }
}
