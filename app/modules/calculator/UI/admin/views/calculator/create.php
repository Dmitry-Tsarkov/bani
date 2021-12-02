<?php

use \app\modules\calculator\models\Calculator;
use yii\web\View;

/**
 * @var View $this
 * @var Calculator $calculator
 */

$this->title = 'Добавление калькулятора';
$this->params['breadcrumbs'] = [
    ['label' => 'Калькулятор', 'url' => ['index']],
];

?>

<?= $this->render('_form', compact('calculator')) ?>