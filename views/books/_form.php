<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
/* @var $authors app\models\Authors */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin([
        'id' => 'books-form',
        //'enableAjaxValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>

    <?= $form->field($model, 'author_id')->dropDownList(
            ArrayHelper::map($authors,'id','firstname')
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'date_create_book')->widget(
        DatePicker::className(),
        [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd'
        ]
    ) ?>

    <?= $form->field($model, 'preview')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
