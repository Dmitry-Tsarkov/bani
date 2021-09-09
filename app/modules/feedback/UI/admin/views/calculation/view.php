<?php

use app\modules\feedback\models\Feedback;
use yii\web\View;

/* @var View $this
 * @var Feedback $feedback
 */

$this->title = $feedback->name;
$this->params['breadcrumbs'] = [
    ['label' => 'Заявки', 'url' => ['index']],
    $feedback->name,
];


?>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Общее</h3>
    </div>
    <div class="box-body">
        <?= $this->render('_detail', compact('feedback')) ?>
    </div>
</div>


