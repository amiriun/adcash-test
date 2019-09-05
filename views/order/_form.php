<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Order */
?>

<div class="order-form">


    <?= $form->field($model, 'user_id')->dropdownList($userDataList, ['prompt' => '---Select user---']) ?>

    <?= $form->field($model, 'product_id')->dropdownList($productDataList, ['prompt' => '---Select product---']) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'btn btn-success']) ?>
    </div>

</div>
