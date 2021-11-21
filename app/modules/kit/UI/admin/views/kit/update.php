<?php

use app\modules\kit\forms\KitForm;
use app\modules\kit\models\Kit;
use yii\web\View;

/**
 * @var View $this
 * @var KitForm $kitForm
 */

$this->title = 'Редактирование комплекта продукта ';
$this->params['breadcrumbs'] = [
    ['label' => 'Комплект', 'url' => ['index']],

];

?>

<?= $this->render('_form', compact('kitForm')) ?>