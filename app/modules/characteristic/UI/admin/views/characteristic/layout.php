<?php

use app\modules\characteristic\models\Characteristic;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var Characteristic $characteristic
 * @var string $content
 */

?>

<div class="nav-tabs-custom">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Общее',
                'url' => ['characteristic/update', 'id' => $characteristic->id],
                'active' => Yii::$app->controller->action->id == 'update',
            ],
            [
                'label' => 'Варианты (' . $characteristic->getVariants()->count('id') . ')',
                'url' => ['variant/index', 'id' => $characteristic->id],
                'active' => Yii::$app->controller->action->id == 'index',
                'visible' => $characteristic->isDropDown(),
            ],
        ]
    ]) ?>
    <div class="box-body">
        <?= $content ?>
    </div>
</div>
