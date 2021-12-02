<?php

use \app\modules\calculator\models\Calculator;
use yii\web\View;

/**
 * @var View $this
 * @var \app\modules\calculator\models\Calculator $calculator
 */

$this->title = 'Редактирование калькулятора ';
$this->params['breadcrumbs'] = [
    ['label' => 'Комплект', 'url' => ['index']],
    $this->title,
];

?>

<?= $this->render('_form', compact('calculator')) ?>