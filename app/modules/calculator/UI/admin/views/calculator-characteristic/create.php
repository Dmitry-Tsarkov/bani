<?php

use app\modules\calculator\forms\CalculatorCharacteristicForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\Calculator;
use yii\web\View;


/**
 * @var View $this
 * @var Calculator $calculator
 * @var CalculatorCharacteristc $characteristic
 * @var CalculatorCharacteristicForm $createForm
 */

$this->title = 'Калькулятор "' . $calculator->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Калькуляторы', 'url' => ['index']],
    ['label' => 'Калькулятор', 'url' => ['view'], 'id' => $calculator->id],
    $calculator->title
];
$this->title = $calculator->title;

?>

<?= $this->render('_form', ['characteristicForm' => $createForm]) ?>