<?php
/**
 * _ApiControllers.php
 * @author: work
 */


namespace app\controllers;

use yii\rest\Controller;
use yii\web\Response;
use yii;


class _ApiControllers extends BehaviorsController
{
    public function success(array $data = []){
        $result = ['success'=>true];
        if ($data)
            $result = array_merge($result, $data);
        return $this->jsonResponse($result);
    }

    public function errors($errorOrErrors = []){
        $result = ['success' => false];
        $result['message'] = $errorOrErrors;
        if(is_array($errorOrErrors)){
            $result['messages'] = $errorOrErrors;
            $result['message'] = implode(';',$errorOrErrors);
        }
        return $this->jsonResponse($result);
    }

    public function jsonResponse($rowData){
        yii::$app->response->format = Response::FORMAT_JSON;
        return $rowData;
    }


/*
    public function getContentFromJson() {
        return Yii::$app->getRequest()->getBodyParams();
    }*/

}