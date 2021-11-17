<?php

use app\modules\kit\models\Kit;
use yii\web\View;

/**
 * @var View $this
 * @var Kit $kit
 */

$this->title = 'Добавление комплекта';
$this->params['breadcrumbs'] = [
    ['label' => 'Комплект', 'url' => ['/kit/backend/kit/index']],
    $this->title,
];

?>

<?= $this->render('_form', compact('kit')) ?>