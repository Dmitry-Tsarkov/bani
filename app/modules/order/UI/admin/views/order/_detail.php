<?php

use app\modules\order\models\Order;
use app\modules\order\models\OrderStatus;
use kartik\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Order $order
 */

?>

<?= DetailView::widget([
    'model' => $order,
    'attributes' => [
        'id',
        [
            'label' => 'Статус ',
            'format' => 'raw',
            'value' => function (Order $order) {
                $options = '';
                foreach (OrderStatus::list() as $value => $status) {
                    if ($order->status->getValue() == $value) {
                        continue;
                    }
                    $options .= '<li>' . Html::a($status, ['change-status', 'id' => $order->id, 'status' => $value], ['data-method' => 'post']) . '</li>';
                }
                return
                    '<div class="dropdown">
                                  <button class="btn btn-' . $order->status->getClass() . ' btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ' . $order->status->getLabel() . '
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">' . $options . '</ul>
                                </div>';
            },
        ],
        'name',
        'email',
        'phone',
        'comment',
        'additional_options',
        [
            'class' => DataColumn::class,
            'format' => 'raw',
            'label' => 'Наименование',
            'value' => function (Order $order) {
                $item = $order->getItemByType($order);
                return Html::a($item->title, [$order->getItemLink(), 'id' => $item->id], ['data-pjax' => '0']);
            }
        ],
        [
            'label' => 'Дата создания',
            'value' => date('d.m.Y H:i', $order->created_at)
        ],
        [
            'label' => 'Дата редактирования',
            'value' => date('d.m.Y H:i', $order->updated_at)
        ],
    ],
]); ?>
