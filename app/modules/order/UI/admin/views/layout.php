<?php

use app\modules\feedback\helpers\FeedbackHelper;
use app\modules\feedback\models\Feedback;
use yii\widgets\Menu;

$this->title = 'Заказы';
$this->params['breadcrumbs'] = [
    'Заказы',
];
?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-body no-padding">
                <?= Menu::widget([
                    'encodeLabels' => false,
                    'options' => ['class' => 'nav nav-pills nav-stacked'],
                    'items' => [
                        [
                            'label' => '<i class="fa fa-calculator"></i>Заказы продуктов' . FeedbackHelper::badge(FeedbackHelper::newCount(Feedback::TYPE_CALCULATION)),
                            'url' => ['/admin/order/order/index']
                        ],
                        [
                            'label' => '<i class="fa fa-phone-square"></i>Заказы услуг' . FeedbackHelper::badge(FeedbackHelper::newCount(Feedback::TYPE_QUESTION)),
                            'encode' => false,
                            'url' => ['/admin/order/service-order/index']
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <?= $content ?>
    </div>
</div>

