<?php

use app\modules\review\models\Review;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Review $review
 */

?>

Новый отзыв<br>
<br>
Имя: <?= Html::encode($review->name) ?><br>
Социальная сеть: <?= Html::encode($review->socials) ?><br>
Ссылка на отзыв: <?= Html::encode($review->review_link) ?><br>
Описание: <?= Html::encode($review->description) ?><br>

