<?php

use app\modules\kit\models\Kit;
use yii\web\View;

/**
 * @var View $this
 * @var Kit $kit
 */

$this->title = 'Редактирование комплекта продукта ';
$this->params['breadcrumbs'] = [
    ['label' => 'Комплект', 'url' => ['index']],

];

?>

<?= $this->render('_form', compact('kit')) ?>