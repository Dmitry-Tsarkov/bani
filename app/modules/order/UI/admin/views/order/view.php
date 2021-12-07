<?php

use app\modules\order\models\Order;
use yii\web\View;

/* @var View $this
 * @var Order $order
 */

$this->title = $order->name;
$this->params['breadcrumbs'] = [
    ['label' => 'Заявки', 'url' => ['index']],
    $order->name,
];


?>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Общее</h3>
    </div>
    <div class="box-body">
        <?= $this->render('_detail', compact('order')) ?>
    </div>
</div>


