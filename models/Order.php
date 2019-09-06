<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property int $item_price
 * @property int $total_price
 * @property string $cloned_product_name
 * @property int $cloned_user_fullname
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Product $product
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'quantity', 'item_price', 'total_price'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['cloned_product_name'], 'string', 'max' => 40],
            [['cloned_user_fullname'], 'string', 'max' => 40],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'item_price' => Yii::t('app', 'Price'),
            'total_price' => Yii::t('app', 'Total price'),
            'cloned_product_name' => Yii::t('app', 'Cloned Product Name'),
            'cloned_user_fullname' => Yii::t('app', 'Cloned User Fullname'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getEuroPrice(){
        return number_format((float)$this->total_price, 2, '.', '') . ' EUR';
    }
}
