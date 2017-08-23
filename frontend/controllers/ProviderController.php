<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ProviderController extends Controller
{
    public $layout = 'dashboard';


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup', 'dashboard'],
                'rules' => [
                    [
                        'actions' => ['add-membership','add-product',''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddMembership($id)
    {

    }

    public function actionAddProduct($id)
    {

    }


}