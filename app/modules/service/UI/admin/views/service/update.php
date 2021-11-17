<?php

use app\modules\service\forms\ServiceForm;
use app\modules\service\models\Service;
use yii\web\View;

/**
 * @var View $this
 * @var Service $service
 * @var ServiceForm $editForm
 */

$this->title = 'Редактирование услуги "' . $service->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Услуги', 'url' => ['index']],
    ['label' => $service->title, 'url' => ['view', 'id' => $service->id]],
    'Редактирование',
];

?>

<?= $this->render('_form', ['serviceForm' => $editForm]) ?>
