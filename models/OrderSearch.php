<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'product_id', 'quantity', 'item_price', 'total_price', 'cloned_user_fullname'], 'integer'],
            [['cloned_product_name', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'item_price' => $this->item_price,
            'total_price' => $this->total_price,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'cloned_product_name', $this->cloned_product_name]);
        $query->andFilterWhere(['like', 'cloned_user_fullname', $this->cloned_user_fullname]);

        if($this->created_at == 'all_time'){
            return $dataProvider;
        }
        if($this->created_at == 'today'){
            $query->andFilterWhere(['>', 'created_at', date('Y-m-d 00:00:00')]);
        }
        if($this->created_at == '7days_ago'){
            $query->andFilterWhere(['>', 'created_at', date('Y-m-d H:i:s', strtotime('-7 days', time()))]);
        }


        return $dataProvider;
    }
}
