<?php

use app\modules\calculator\forms\CalculatorForm;
use yii\web\View;

/**
 * @var View $this
 * @var CalculatorForm $createForm
 */

$this->title = 'Добавление калькулятора';
$this->params['breadcrumbs'] = [
    ['label' => 'Калькулятор', 'url' => ['index']],
];

?>

<?= $this->render('_form', ['calculatorForm' => $createForm]) ?>