<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h2><?=Yii::t('app','Add new order')?></h2>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?=$this->render('_form', ['model' => $searchModel]);?>
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
