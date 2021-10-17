<?php

use app\modules\action\models\Action;
use yii\web\View;

/**
 * @var View $this
 * @var Action $action
 */

$this->title = 'Редактирование акции ' . '"' . $action->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Акции', 'url' => ['index']],
    $this->title,
];

?>

<?= $this->render('_form', compact('action')) ?>