<?php
/**
 * BehaviorsController.php
 * @author: work
 */

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\AccessControl;

class BehaviorsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['main'],
                        'actions' => ['reg', 'login'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['main'],
                        'actions' => ['logout','index'],
                        'verbs' => ['POST'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['books'],
                        'actions' => ['index', 'create','update','view','delete'],
                        'verbs' => ['GET','POST'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['authors'],
                        'actions' => ['index', 'create','update','view','delete'],
                        'verbs' => ['GET','POST'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'search']
                    ]
                ]
            ]
        ];
    }
}