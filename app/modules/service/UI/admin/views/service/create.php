<?php

use app\modules\service\forms\ServiceForm;
use yii\web\View;

/**
 * @var View $this
 * @var ServiceForm $createForm
 */

$this->title = 'Добавление услуги';
$this->params['breadcrumbs'] = [
    ['label' => 'Услуги', 'url' => ['index']],
    'Добавление услуги'
];

?>

<?= $this->render('_form', ['serviceForm' => $createForm]) ?>



