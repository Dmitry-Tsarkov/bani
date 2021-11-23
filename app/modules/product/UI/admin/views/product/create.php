<?php

use app\modules\product\forms\ProductForm;
use yii\web\View;

/**
 * @var View $this
 * @var ProductForm $createForm
 */


$this->title = 'Добавление товара';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['index']],
    'Добавление товара'
];

?>

<?= $this->render('_form', ['productForm' => $createForm]) ?>



