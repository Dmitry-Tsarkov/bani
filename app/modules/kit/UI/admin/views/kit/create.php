<?php

use app\modules\kit\forms\KitForm;
use yii\web\View;

/**
 * @var View $this
 * @var KitForm $kitForm
 */

$this->title = 'Добавление комплекта';
$this->params['breadcrumbs'] = [
    ['label' => 'Комплект', 'url' => ['index']],
    $this->title,
];

?>

<?= $this->render('_form', compact('kitForm')) ?>