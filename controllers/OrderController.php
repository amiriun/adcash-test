<?php

namespace app\controllers;

use adcash\order\data_contracts\OrderDTO;
use adcash\order\exceptions\OrderException;
use adcash\order\repositories\UpdatingOrderRepository;
use adcash\order\services\CreatingOrderService;
use app\models\Order;
use app\models\OrderSearch;
use app\models\Product;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->setSort([
            'defaultOrder' => [ 'created_at' => SORT_DESC],
        ]);;
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'userDataList' => User::instance()->allInUsersForDropdownList(),
            'productDataList' => Product::instance()->allInDropDownListFormat(),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $DTO = new OrderDTO();
        $request = Yii::$app->request->post('OrderSearch');
        $DTO->productId = $request['product_id'];
        $DTO->userId = $request['user_id'];
        $DTO->quantity = $request['quantity'];
        $service = new CreatingOrderService($DTO);
        try {
            $service->create();
        } catch (OrderException $e) {
        } catch (\Exception $e) {
        }

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->getIsPost()) {
            $DTO = new OrderDTO();
            $request = Yii::$app->request->post('Order');
            $DTO->productId = $request['product_id'];
            $DTO->userId = $request['user_id'];
            $DTO->quantity = $request['quantity'];
            $service = new UpdatingOrderRepository($DTO,$model);
            try {
                $service->update();
            } catch (OrderException $e) {
            } catch (\Exception $e) {
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'userDataList' => User::instance()->allInUsersForDropdownList(),
            'productDataList' => Product::instance()->allInDropDownListFormat(),
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
