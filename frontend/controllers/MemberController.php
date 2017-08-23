<?php
namespace frontend\controllers;

use common\models\Dependent;
use common\models\DependentSearch;
use common\models\Member;
use common\models\Membership;
use common\models\MembershipBenefit;
use common\models\MembershipBenefitMap;
use common\models\PaymentMethod;
use common\models\Product;
use common\models\ProductOption;
use common\models\Purchase;
use frontend\models\ChangePasswordForm;
use frontend\models\ContactForm;
use frontend\models\MemberForm;
use frontend\models\PurchaseForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MemberController extends Controller
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
                        'actions' => ['add-membership','add-product'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
//                        'actions' => ['index'],
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
        if(!Yii::$app->user->identity->has_member)
            return $this->redirect(['site/dashboard']);

        $member = Member::findOne(['user_id' => \Yii::$app->user->id]);

//        Yii::info('User ID: '.Yii::$app->user->id);

        $products = [];

        if(empty($member) || empty($member->membership)) {
            Yii::info('Member not found!');
            return $this->redirect(['site/index']);
        }

        $benefits = $member->membership->benefits;

        $upgradeMemberships = Membership::find()->select('id')->where(['>','level',$member->membership->level])->column();
        $upgradeBenefitMap = MembershipBenefitMap::find()->select('benefit_id')->where(['in', 'membership_id', $upgradeMemberships])->andWhere(['not in', 'benefit_id', $member->membership->getBenefits()->select('id')->column()]);
        $upgradeBenefits = MembershipBenefit::find()->where(['in', 'id', $upgradeBenefitMap])->all();

//        Yii::info('Member: '.$member->id);
//        $products = Purchase::find()->where(['member_id' => $member->id, 'type' => 2])->products();
//        Yii::info(print_r($products, true));

//        $upgradeBenefits = MembershipBenefit::find()->where(['>','membership_id',$member->membership->id])->all();

        $products = $member->productOptions;


        return $this->render('index', ['member' => $member, 'benefits' => $benefits, 'upgradeBenefits' => $upgradeBenefits, 'products' => $products]);
    }

    public function actionDetails()
    {
        $model = MemberForm::findOne(['user_id' => \Yii::$app->user->id]);

        if(empty($model))
        {
            return $this->redirect(['member/index']);
        }

        $model->setScenario(MemberForm::SCENARIO_UPDATE);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            Yii::$app->session->setFlash('success', 'Member Details Updated!');
        } else {
            Yii::info('Failed validate!'.print_r($model->errors, true));
        }

        return $this->render('details', [
            'model' => $model,
        ]);
    }

    public function actionDependents()
    {
        $searchModel = new DependentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dependents', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDependent($id)
    {
        $member = Member::findOne(['user_id' => \Yii::$app->user->id]);

        $model = $member->getDependents()->andWhere(['id'=>$id])->one();

        if(empty($model))
            throw new NotFoundHttpException('Dependent Not Found');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // TODO: Check for existing spouse record
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Dependent Information Updated!');
                return $this->redirect(['member/dependents']);
            }
        }

        return $this->render('dependent', ['model' => $model]);
    }

    public function actionAddDependent()
    {
        $member = Member::findOne(['user_id' => \Yii::$app->user->id]);

        $model = new Dependent(['member_id' => $member->id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Dependent Added!');
            return $this->redirect(['member/dependents']);
        }

        return $this->render('add_dependent', ['model' => $model]);
    }

    public function actionContact()
    {
        $member = MemberForm::findOne(['user_id' => \Yii::$app->user->id]);
        $agent = $member->agent;

        $model = new ContactForm(['name' => $member->nameText, 'email' => $member->email]);
        $model->setScenario(ContactForm::SCENARIO_TRUSTED);

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->addFlash('success', 'Message Sent to Agent!');
            return $this->redirect(['member/index']);
        } else {
            Yii::info('Errors: '.print_r($model->errors, true));
        }

        return $this->render('contact',['model'=>$model, 'agent' => $agent]);
    }

    public function actionUser()
    {
        $model = new ChangePasswordForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->changePassword()) {
                Yii::$app->session->addFlash('success', 'Password updated!');
                $model = new ChangePasswordForm();
            }
        }

        return $this->render('user',['model'=>$model]);
    }

    public function actionPayment()
    {
        $member = Member::findOne(['user_id' => \Yii::$app->user->id]);

        $model = $member->paymentMethod;

        if(empty($model))
            $model = new PaymentMethod(['member_id' => $member->id]);

        $updateModel = new PaymentMethod(['member_id' => $member->id]);

//        $model->status = 20;  TODO: Check status update!

        if($updateModel->load(Yii::$app->request->post()) && $updateModel->validate()) {
            $model->load($updateModel->toArray());

            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Payment Information Updated!');
                return $this->redirect(['member/index']);
            }
        }

        Yii::info('Model: '.print_r($model->panText, true));
        Yii::info('Model errors: '.print_r($model->errors, true));

        return $this->render('payment', ['model'=>$model, 'updateModel' => $updateModel]);
    }

    public function actionUpgrade($plan = null)
    {
        $model = MemberForm::find()->where(['user_id' => \Yii::$app->user->id])->one();

        $model->setScenario(MemberForm::SCENARIO_PLAN);

        return $this->render('upgrade',['model' => $model]);
    }

    public function actionPurchase($product_id)
    {
        if(!Yii::$app->user->identity->has_member) {
            return $this->redirect(['site/products']);
        }

        $member = Yii::$app->user->identity->member;

        $product = Product::findOne($product_id);

        if(empty($product))
            return $this->redirect(['site/products']);

        $model = new PurchaseForm(['product_id' => $product->id]);

        if($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->option = ProductOption::findOne($model->product_option_id);

            if(ArrayHelper::keyExists('purchase-confirm-btn', Yii::$app->request->post())) {
                $purchase = Purchase::purchaseProduct((int)$model->product_option_id, $member->id);

                if(empty($purchase)) {
                    Yii::$app->session->addFlash('error', 'Error purchasing product.  Contact your NAHC agent for more info.');
                    return $this->redirect(['member/index']);
                }

                Yii::$app->session->addFlash('success', 'Product Purchased!');

                Yii::$app
                    ->mailer
                    ->compose(
                        ['html' => 'productPurchase-html', 'text' => 'productPurchase-text'],
                        ['member' => $member, 'productOption' => $model->option] )
                    ->setFrom([Yii::$app->params['supportEmail'] => 'NAHC Support'])
                    ->setTo($member->email)
                    ->setSubject('NAHC Product Purchase Confirmation')
                    ->send();

                return $this->redirect(['member/index']);
            }

            $existing = $member->getProductOptions()->indexBy('product_id')->all();



            if(!empty($model->option))
                return $this->render('purchase_confirm', ['model' => $model, 'existing' => $existing]);
        }

        return $this->render('purchase',['model' => $model]);
    }


}