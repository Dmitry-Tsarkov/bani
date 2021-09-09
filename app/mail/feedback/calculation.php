<?php

use app\modules\feedback\models\Feedback;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Feedback $feedback
 */

?>

<b>Рассчитать</b><br>
<br>
<b>Имя:</b> <?= Html::encode($feedback->name) ?><br>
<b>Телефон:</b> <?= Html::encode($feedback->phone) ?><br>
<b>Страница отправки:</b> <?= Html::encode($feedback->referer) ?><br>

