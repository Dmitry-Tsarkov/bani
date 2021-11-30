<?php

use app\modules\calculator\forms\CalculatorForm;
use yii\web\View;

/**
 * @var View $this
 * @var CalculatorForm $editForm
 */

$this->title = 'Редактирование калькулятора ';
$this->params['breadcrumbs'] = [
    ['label' => 'Комплект', 'url' => ['index']],
    $this->title,
];

?>

<?= $this->render('_form', ['calculatorForm' => $editForm]) ?>