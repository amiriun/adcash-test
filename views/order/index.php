<?php

use yii\grid\GridView;
use yii\helpers\Html;
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

            [
                'attribute' => 'cloned_user_fullname',
                'label' => 'User',
            ],
            [
                'attribute' => 'cloned_product_name',
                'label' => 'Product',
            ],
            [
                'attribute' => 'quantity',
                'label' => 'Quantity',
                'filter'=>false,
            ],
            [
                'attribute' => 'euroPrice',
                'label' => 'Price'
            ],
            [
                'attribute'=>'created_at',
                'format'=>'datetime',
                'label' => 'Date',
                'filter'=>array(null=>"All time","ID1"=>"Today","ID2"=>"Last 7 days"),
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{update} {delete}',
            ],
        ],
    ]); ?>


</div>
