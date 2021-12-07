<?php

use app\modules\order\models\Order;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Order $order
 */

?>

<b>Заказ продукта</b><br>
<br>
<b>Имя:</b> <?= Html::encode($order->name) ?><br>
<b>E-mail:</b> <?= Html::encode($order->email) ?><br>
<b>Телефон:</b> <?= Html::encode($order->phone) ?><br>
<b>Комментарий:</b> <?= Html::encode($order->comment) ?><br>
<?php if(!empty($order->additional_options)): ?>
<b>Дополнительные параметры:</b> <?= Html::encode($order->additional_options) ?><br>
<?php endif; ?>