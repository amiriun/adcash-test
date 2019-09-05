<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h2><?=Yii::t('app','Add new order')?></h2>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?php $form = ActiveForm::begin(['action' => 'index.php?r=order/create']); ?>
            <?=$this->render('_form', ['model' => $searchModel,'form' => $form,'userDataList'=>$userDataList,'productDataList'=>$productDataList]);?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cloned_user_fullname',
            'cloned_product_name',
            'quantity',
            'price',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
