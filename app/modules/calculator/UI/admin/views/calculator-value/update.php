<?php

use app\modules\calculator\forms\CalculatorValueForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\CalculatorValue;
use yii\web\View;

/**
 * @var View $this
 * @var CalculatorValue $value
 * @var CalculatorCharacteristc $characteristic
 * @var CalculatorValueForm $editForm
 */

$this->title = 'Калькулятор "' . $characteristic->calculator->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Калькуляторы', 'url' => ['index']],
    ['label' => 'Калькулятор', 'url' => ['view'], 'id' => $characteristic->calculator->id],
    $characteristic->calculator->title
];
$this->title = $characteristic->calculator->title;

?>

<?= $this->render('_form', ['valueForm' => $editForm]) ?>