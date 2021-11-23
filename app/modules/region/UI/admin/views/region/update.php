<?php

use app\modules\region\forms\RegionForm;
use app\modules\region\models\Region;
use yii\web\View;

/**
 * @var View $this
 * @var Region $region
 * @var RegionForm $regionForm
 */

$this->title = 'Редактирование товара "' . $region->district . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Регионы', 'url' => ['index']],
    ['label' => $region->district, 'url' => ['view', 'id' => $region->id]],
    'Редактирование',
];

?>

<?= $this->render('_form', ['regionForm' => $regionForm]) ?>

