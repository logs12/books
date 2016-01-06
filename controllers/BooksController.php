<?php

namespace app\controllers;

use Yii;
use app\models\Books;
use app\models\BooksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilteruse;
use app\models\Authors;
use yii\web\UploadedFile;
use app\controllers\_ApiControllers;


/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends _ApiControllers
{


    public function actionSearch()
    {
        $model = new Books();
        $r = Yii::$app->getRequest();
        $books = $model->findAllBooks(
            $r->getQueryParam('selectedAuthors'),
            $r->getQueryParam('date_create_book'),
            $r->getQueryParam('date_create'),
            $r->getQueryParam('nameBook')
        );

        //var_dump($r->getQueryParams());

        return $this->success(['books'=>$books]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
            return $this->success();
        else
            return $this->errors();
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
        //var_dump($this->findModel($id));
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$model = $this->findModel($id);

        return $this->render('index', [
            /*'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,*/
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
  /*  public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Books();

        if ($model->load(Yii::$app->request->post()) && $model->upload()) {
            //var_dump(Yii::$app->request->post());die();
            if ($model->save()){
                return $this->redirect(['index']);
            }

            else
                return $this->render('create', [
                    'authors' => Authors::find()->all(),
                    'model' => $model,
                ]);
        } else {
            return $this->render('create', [
                'authors' => Authors::find()->all(),
                'model' => $model,
            ]);
        }
    }

  /*  public function actionUpdate()
    {
        $id = Yii::$app->request->getQueryParams();
        var_dump($_REQUEST);
        var_dump($_FILES);
    }*/

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $model = $this->findModel($id);
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) && $model->upload()) {
            if ($model->save()){
                return $this->success();
            }
            else {
                return $this->errors();
            }
        } else {
            return $this->renderAjax('update', [
                'authors' => Authors::find()->all(),
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        //$model = new Books();
        //var_dump($model);
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
