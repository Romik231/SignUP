<?php
?>

<h3>Авторизация</h3>

<div class="col-md-6">
    <?php $form=\yii\bootstrap\ActiveForm::begin();?>

    <?=$form->field($model, 'username')?>
    <?=$form->field($model, 'email');?>
    <?=$form->field($model,'password');?>

    <div class="col-md-3">
        <button class="btn btn-default" type="submit">Войти</button>
    </div>
    <?php \yii\bootstrap\ActiveForm::end();?>


</div>
