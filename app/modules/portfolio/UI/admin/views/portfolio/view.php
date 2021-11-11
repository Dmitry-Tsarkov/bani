<?php

use app\modules\portfolio\models\Portfolio;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Portfolio $portfolio
 */

$this->title = $portfolio->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Портфолио', 'url' => ['index']],
    $portfolio->title,
];

?>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $portfolio->id], ['class' => 'btn btn-primary btn-sm']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $portfolio->id], ['class' => 'btn btn-danger btn-sm', 'data-method' => 'POST']) ?>
</p>

<p>
    <?php if ($portfolio->status == 1): ?>
        <?= Html::a('Активность', ['draft', 'id' => $portfolio->id], ['class' => 'btn btn-success btn-xs']) ?>
    <?php else: ?>
        <?= Html::a('Активность', ['activate', 'id' => $portfolio->id], ['class' => 'btn btn-default btn-xs']) ?>
    <?php endif ?>
    <?php if ($portfolio->is_preview == true): ?>
        <?= Html::a('Показывать на главной', ['hide', 'id' => $portfolio->id], ['class' => 'btn btn-success btn-xs']) ?>
    <?php else: ?>
        <?= Html::a('Показывать на главной', ['show', 'id' => $portfolio->id], ['class' => 'btn btn-default btn-xs']) ?>
    <?php endif ?>
</p>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Общее</h3>
            </div>
            <?= DetailView::widget([
                'model' => $portfolio,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Показывать на главной',
                        'format' => 'raw',
                        'value' => $portfolio->is_preview
                            ? '<span class="label label-success" data-test="123">Да</span>'
                            : '<span class="label label-danger">Нет</span>',
                    ],
                    [
                        'label' => 'Статус',
                        'format' => 'raw',
                        'value' => $portfolio->status
                            ? '<span class="label label-success" data-test="123">Активен</span>'
                            : '<span class="label label-danger">Черновик</span>',
                    ],
                    'title',
                    'alias',
                    [
                        'label' => 'Картинка',
                        'format' => 'raw',
                        'value' => function (Portfolio $portfolio) {
                            return Html::img($portfolio->getThumbSrc());
                        },
                    ],
                    [
                        'label' => 'Дата создания',
                        'value' => date('d.m.Y H:i', $portfolio->created_at)
                    ],
                    [
                        'label' => 'Дата редактирования',
                        'value' => date('d.m.Y H:i', $portfolio->updated_at)
                    ],
                ],
            ]); ?>
        </div>

        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Описание</h3>
            </div>
            <div class="box-body">
                <?= $portfolio->description ?>
            </div>
        </div>
    </div>
</div>
