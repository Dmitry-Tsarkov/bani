<?php

use app\modules\review\forms\ReviewManageForm;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ReviewManageForm $createForm
 */

$this->title = 'Добавление отзыва';
$this->params['breadcrumbs'] = [
    ['label' => 'Отзывы', 'url' => ['index']],
    'Добавление отзыва'
];
?>

<div class="box-body">
    <?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Общее</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-4">
                    <?= $form->field($createForm, 'name') ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->field($createForm, 'email') ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->field($createForm, 'city') ?>
                </div>
            </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($createForm, 'description')->textarea(['rows' => 5]) ?>
                    </div>

                </div>
            </div>
    </div>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>
