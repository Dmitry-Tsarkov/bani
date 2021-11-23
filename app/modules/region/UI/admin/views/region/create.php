<?php

use app\modules\region\forms\RegionForm;
use yii\web\View;

/**
 * @var View $this
 * @var RegionForm $regionForm
 */

$this->title = 'Добавление региона';
$this->params['breadcrumbs'] = [
    ['label' => 'Регионы', 'url' => ['index']],
    'Добавление региона'
];
?>

<?= $this->render('_form', ['regionForm' => $regionForm]) ?>

