<?php

use app\modules\product\models\Addition;
use app\modules\product\models\Product;
use yii\web\View;

/**
 * @var View $this
 * @var Addition $addition
 * @var Product $product
 */

$this->title = 'Добавление параметра';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['product/index']],
    ['label' => $product->title, 'url' => ['product/view', 'id' => $product->id]],
    'Добавление параметра',
];


?>

<?= $this->render('_form', compact('addition')) ?>