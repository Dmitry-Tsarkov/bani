<?php

/* @var View $this
 * @var Order $order
 */

use app\modules\feedback\models\Feedback;
use app\modules\order\models\Order;
use yii\web\View;

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Заказ</h4>
</div>
<div class="modal-body">
    <?= $this->render('_detail', compact('order')) ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
</div>

