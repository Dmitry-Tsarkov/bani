<?php

use app\modules\product\forms\ProductForm;
use app\modules\product\models\Product;
use yii\web\View;

/**
 * @var View $this
 * @var Product $product
 * @var ProductForm $editForm
 */

$this->title = 'Редактирование товара "' . $product->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['index']],
    ['label' => $product->title, 'url' => ['view', 'id' => $product->id]],
    'Редактирование',
];

?>

<?= $this->render('_form', ['productForm' => $editForm]) ?>
