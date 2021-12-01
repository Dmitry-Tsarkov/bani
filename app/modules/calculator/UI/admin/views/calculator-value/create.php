<?php

use app\modules\calculator\forms\CalculatorValueForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use yii\web\View;

/**
 * @var View $this
 * @var CalculatorCharacteristc $characteristic
 * @var CalculatorValueForm $createForm
 */

$this->title = 'Калькулятор "' . $characteristic->calculator->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Калькуляторы', 'url' => ['index']],
    ['label' => 'Калькулятор', 'url' => ['view'], 'id' => $characteristic->calculator->id],
    $characteristic->calculator->title
];
$this->title = $characteristic->calculator->title;

?>

<?= $this->render('_form', ['valueForm' => $createForm]) ?>