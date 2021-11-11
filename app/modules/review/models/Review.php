<?php

namespace app\modules\review\models;

use app\modules\admin\traits\QueryExceptions;
use DomainException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * @property int $id [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $status [int(11)]
 * @property string $name [varchar(255)]  Имя и отчество
 * @property string $description
 * @property string $email [varchar(255)]
 * @property string $city [varchar(255)]
 * @property bool $is_preview [tinyint(1)]
 */
class Review extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    const NOT_SHOW = 0;
    const SHOW = 1;

    public static function tableName()
    {
        return 'reviews';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function create($name, $description, $city, $email): self
    {
        $self = new self();
        $self->name = $name;
        $self->description = $description;
        $self->city = $city;
        $self->email = $email;
        $self->status = self::STATUS_ACTIVE;

        return $self;
    }

    public function edit($name, $description, $city, $email): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->city = $city;
        $this->email = $email;
    }

    public static function feedback($name, $email, $city, $description): self
    {
        $self = new self();
        $self->name = $name;
        $self->email = $email;
        $self->city = $city;
        $self->description = $description;

        return $self;
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function activate(): void
    {
        if ($this->isActive()){
            throw new DomainException('Отзыв уже активный');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function deactivate(): void
    {
        if (!$this->isActive()){
            throw new DomainException('Отзыв уже неактивная');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function show()
    {
        if ($this->is_preview == true) {
            throw new DomainException('Портфолио уже покаызвается на главной странице');
        }

        $this->is_preview = true;
    }

    public function hide()
    {
        if ($this->is_preview == false) {
            throw new DomainException('Портфолио уже не покаызвается на главной странице');
        }
        $this->is_preview = false;
    }
}