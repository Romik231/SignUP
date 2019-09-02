<?php
/**
 * @var $model \app\models\Signup
 */
?>

<div>
    <h3>Регистрация</h3>
</div>

<div class="col-md-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

    <?= $form->field($model, 'email'); ?>
    <?= $form->field($model, 'password'); ?>
    <?= $form->field($model, 'passwordRepeat')?>
    <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha2::class,
        ['siteKey'=>'6Lc_PrYUAAAAAEWFlhLlZQrYYHhb13UMPdp_5To-']);?>

    ])?>

    <div class="col-md-3">
        <button class="btn btn-default" type="submit">Зарегистрироваться</button>
    </div>
    <?php \yii\bootstrap\ActiveForm::end(); ?>


</div>

