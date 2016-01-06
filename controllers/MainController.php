<?php

namespace app\controllers;
use yii;
use app\models\RegForm;
use app\models\LoginForm;
use app\models\User;

class MainController extends BehaviorsController
{
    public $layout = 'basic';

    public $defaultAction = 'index';

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @param null $searh
     * @return string
     */
    public function actionSearch($search = null)
    {
        return $this->render('search',[
            'search' => $search
        ]);
    }

    public function actionReg(){
        $model = new RegForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            if ($user = $model->reg()){
                if ($user->status === User::STATUS_ACTIVE){
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            }
            else{
                Yii::$app->session->setFlash('error', 'Воникла ошибка при регистрации.');
                Yii::error('Ошибка при регистрации.');
                return $this->refresh();
            }
        }

        return $this->render('reg',[
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/main/index']);
    }

    public function actionLogin(){

        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->goBack();
        }

        return $this->render('login',[
            'model' => $model
        ]);
    }
}
