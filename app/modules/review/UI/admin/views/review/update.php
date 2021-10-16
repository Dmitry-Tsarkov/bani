<?php

use app\modules\review\forms\ReviewManageForm;
use app\modules\review\models\Review;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ReviewManageForm $editForm
 * @var Review $review
 */

$this->title = 'Редактирование отзыва: ' . $review->name;
$this->params['breadcrumbs'] = [
    ['label' => 'Отзывы', 'url' => ['review/index']],
    $this->title,
];

?>

<div class="box-body">
    <?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Общее</h3>
        </div>
        <div class="box-body"><p>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-xs']) ?>

                <?php if (!$review->isActive()): ?>
                    <?= Html::a(
                        'Активность',
                        ['activate', 'id' => $review->id],
                        [
                            'class' => 'btn btn-default btn-xs',
                            'data-method' => 'post',
                        ]
                    ) ?>
                <?php else: ?>
                    <?= Html::a(
                        'Активность',
                        ['deactivate', 'id' => $review->id],
                        [
                            'class' => 'btn btn-success btn-xs',
                            'data-method' => 'post',
                        ]
                    ) ?>
                <?php endif ?>
            </p>
            <div class="row">
                <div class="col-xs-4">
                    <?= $form->field($editForm, 'name') ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->field($editForm, 'email') ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->field($editForm, 'city') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($editForm, 'description')->textarea(['rows' => 5]) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end() ?>
</div>


