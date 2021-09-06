<?php

use app\modules\product\forms\ProductForm;
use app\modules\product\helpers\DropDownHelper;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
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



