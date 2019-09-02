<?php

/**
 * @var $confirm_token \app\models\Users
 */
$url = \yii\helpers\Url::base(true) . '/auth/activation?code='.$confirm_token;
?>

<a href='<?=$url?>'>Ссылка для активации аккаунта</a>
