<?php
namespace frontend\controllers;

use common\models\Agent;
use common\models\Dependent;
use common\models\DependentSearch;
use common\models\Member;
use common\models\MemberSearch;
use common\models\Membership;
use common\models\PaymentMethod;
use common\models\Purchase;
use frontend\models\ChangePasswordForm;
use frontend\models\MemberForm;
use frontend\models\ProductForm;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AgentController extends Controller
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
//                    [
//                        'actions' => ['add-membership','add-product',''],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
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

    private function findMember($id)
    {
        $agent = $this->findAgent();

        $member = Member::findOne(['id' => $id, 'agent_id' => $agent->id]);

        if(empty($member))
            throw new NotFoundHttpException('The requested page does not exist.');

        return $member;
    }

    private function findAgent()
    {
        if(Yii::$app->user->isGuest)
            throw new NotFoundHttpException('The requested page does not exist.');

        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);

        if(empty($agent))
            throw new NotFoundHttpException('The requested page does not exist.');

        return $agent;
    }

    public function actionIndex()
    {
        $model = Agent::findOne(['user_id' => Yii::$app->user->id]);

        return $this->render('index', ['model' => $model]);
    }

    public function actionDetails()
    {
        $model = Agent::findOne(['user_id' => Yii::$app->user->id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success', 'Agent Details Updated!');
            return $this->redirect(['agent/index']);
        }

        return $this->render('details', ['model' => $model]);
    }

    public function actionUser()
    {
        $model = new ChangePasswordForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->changePassword()) {
                Yii::$app->session->addFlash('success', 'Password updated!');
                $model = new ChangePasswordForm();
                return $this->redirect(['agent/index']);
            }
        }

        return $this->render('user',['model'=>$model]);
    }

    public function actionEnroll()
    {
        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);

        $plans = Membership::find()->where(['status' => Membership::STATUS_ACTIVE])->all();

        $model = new MemberForm(['agent_id' => $agent->id]);
        $model->setScenario(MemberForm::SCENARIO_ENROLL);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(empty($model->user_id)) {
                $model->init_user_hash = Yii::$app->security->generateRandomString();
                $model->save(false);
            }

            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'memberAgentWelcome-html', 'text' => 'memberAgentWelcome-text'],
                    ['member' => $model] )
                ->setFrom([Yii::$app->params['supportEmail'] => 'NAHC Support'])
                ->setTo($model->email)
                ->setSubject('Welcome to NAHC!')
                ->send();
            
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'memberAgentWelcome-html', 'text' => 'memberAgentWelcome-text'],
                    ['member' => $model] )
                ->setFrom([Yii::$app->params['supportEmail'] => 'NAHC Support'])
                ->setTo($agent->email)
                ->setSubject('Welcome to NAHC!')
                ->send();

            return $this->redirect(['member', 'id' => $model->id]);
        }

        return $this->render('enroll', [
            'model' => $model,
            'plans' => $plans,
        ]);
    }

//    public function actionProducts()
//    {
//        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);
//
//        $params = ArrayHelper::merge(Yii::$app->request->queryParams, ['MemberSearch'=>['agent_id' => $agent->id]]);
//
//        Yii::info(print_r($params, true));
//
//        $searchModel = new MemberSearch();
//        $dataProvider = $searchModel->search($params);
//
//        return $this->render('products', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionAgents()
    {
        return $this->render('agents');
    }

    public function actionMembers()
    {
        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);

        $params = ArrayHelper::merge(Yii::$app->request->queryParams, ['MemberSearch'=>['agent_id' => $agent->id]]);

        Yii::info(print_r($params, true));

        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search($params);

        return $this->render('members', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMember($id)
    {
        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);

        $model = MemberForm::findOne(['id' => (int)$id, 'agent_id' => $agent->id]);

        if(empty($model))
            throw new NotFoundHttpException('The requested page does not exist.');

        $membership = $model->membership;

        $model->plan = $membership->level;

        $payment = PaymentMethod::findOne(['member_id'=>$model->id]);

        $productOptions = $model->productOptions;

        return $this->render('member', [
            'model' => $model, 'membership' => $membership, 'payment' => $payment, 'productOptions' => $productOptions
        ]);
    }

    public function actionMemberDetail($id)
    {
        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);

        $model = MemberForm::findOne(['id' => (int)$id, 'agent_id' => $agent->id]);

        if(empty($model))
            throw new NotFoundHttpException('The requested page does not exist.');

        $level = $model->level;

//        $pay = $model->getPaymentMethod();
//
//        if(!empty($pay)) {
//            $model->pay_type = $pay->pay_type;
//            $model->acct_name = $pay->acct_name;
//            $model->routing = $pay->routing;
//            $model->account = $pay->account;
//            $model->pan = $pay->pan;
//            $model->exp = $pay->exp;
//            $model->cvv = $pay->cvv;
//        }

        $model->setScenario(MemberForm::SCENARIO_UPDATE);

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Member Updated!');
            $this->redirect(['agent/member', 'id' => $model->id]);
        }

        return $this->render('member_detail', [
            'model' => $model,
        ]);
    }

    public function actionMemberPlan($id)
    {
        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);

        if(empty($agent))
            throw new NotFoundHttpException('The requested page does not exist.');

        $model = MemberForm::findOne(['id' => (int)$id, 'agent_id' => $agent->id]);

        if(empty($model))
            throw new NotFoundHttpException('The requested page does not exist.');

        $level = $model->level;

        $memberships = Membership::find()->all();

        $memberOptions = [];

        foreach ($memberships as $m) {
            if($m->level > $level) {
                $memberOptions[$m->id] = $m->name;
            }
        }

//        $pay = $model->getPaymentMethod();
//
//        if(!empty($pay)) {
//            $model->pay_type = $pay->pay_type;
//            $model->acct_name = $pay->acct_name;
//            $model->routing = $pay->routing;
//            $model->account = $pay->account;
//            $model->pan = $pay->pan;
//            $model->exp = $pay->exp;
//            $model->cvv = $pay->cvv;
//        }

        $model->setScenario(MemberForm::SCENARIO_PLAN);

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Member Plan Updated!');
            $this->redirect(['agent/member', 'id' => $model->id]);
        }

        return $this->render('member_plan', [
            'model' => $model,
            'options' => $memberOptions,
        ]);
    }

    public function actionMemberPayment($id) {
        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);

        if(empty($agent))
            throw new NotFoundHttpException('The requested page does not exist.');

        $member = MemberForm::findOne(['id' => (int)$id, 'agent_id' => $agent->id]);

        if(empty($member))
            throw new NotFoundHttpException('The requested page does not exist.');

        $model = $member->paymentMethod;

        if(empty($model))
            $model = new PaymentMethod(['member_id' => $member->id]);

        if($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->status = 10; //TODO: SET STATUS FOR UPDATED PAYMENT INFO!

            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Payment Information Updated!');
                return $this->redirect(['agent/member', 'id' => $member->id]);
            }
        }

        return $this->render('member_payment', ['member' => $member, 'model' => $model]);
    }



    public function actionProducts($member_id)
    {
        $agent = Agent::findOne(['user_id' => Yii::$app->user->id]);

        if(empty($agent))
            throw new NotFoundHttpException('The requested page does not exist.');

        $member = Member::findOne(['id' => $member_id, 'agent_id' => $agent->id]);

        if(empty($member))
            throw new NotFoundHttpException('The requested page does not exist.');

        $products = $agent->getProductList($member->state_id);
        $productOptions = $member->getProductOptions()->indexBy('product_id')->select(['product_option.id', 'product_id'])->asArray()->column();

        Yii::info('Options: '.print_r($productOptions, true));

        $models = [];

        foreach($products as $product) {
            $opt = ArrayHelper::getValue($productOptions, $product->id,0);

            $models[$product->id] = new ProductForm(['product_id' => $product->id, 'product_option_id' => $opt]);
        }

        if(Model::loadMultiple($models, Yii::$app->request->post()))
        {
            Yii::info('Multiple loaded');
            $existing = [];
            $changed = [];

            foreach($products as $product) {
                $opt = ArrayHelper::getValue($productOptions, $product->id,0);

                if($models[$product->id]->product_option_id != $opt) {
                    Yii::info('Changed! '.$product->id.' - '.$models[$product->id]->product_option_id.'/'.$opt);
                    $changed[$product->id] = $models[$product->id];
                } else {
                    $existing[$product->id] = $models[$product->id];
                }
            }

            if(!empty($changed) && ArrayHelper::keyExists('product-summary-btn', Yii::$app->request->post())) {
                // BEGIN TRANSACTION

                foreach($changed as $ch) {
                    $purchase = Purchase::purchaseProduct($ch->product_option_id, $member->id);

                    Yii::info('Product Purchase - ' . $purchase->id);

                    if (empty($purchase)) {
                        // ABORT TRANSACTION
                        Yii::$app->session->addFlash('error', 'Error Purchasing Product - ' . $ch->product->name);
                        return $this->render('product_summary', ['member' => $member, 'changed' => $changed, 'products' => $products, 'models' => $models]);
                    }
                }

                // COMMIT TRANSACTION
                Yii::$app->session->addFlash('success', 'Products Purchased');
                return $this->redirect(['agent/member', 'id' => $member->id]);
            }

            return $this->render('product_summary', ['member' => $member, 'existing' => $existing, 'changed' => $changed, 'products' => $products, 'models' => $models]);
        }

        return $this->render('product', ['member' => $member, 'products' => $products, 'models' => $models]);
//
//        if(Model::loadMultiple($models, Yii::$app->request->post()))
//        {
//            $enable_purchase = ArrayHelper::keyExists('product-summary-btn', Yii::$app->request->post());
//            $purchase_state = true;
//            $change_flag = false;
//            foreach($models as $model) {
//                $opt = ArrayHelper::getValue($productOptions, $model->product_id,null);
//                $opt_id = ArrayHelper::getValue($opt, 'id', 0);
//
//                if($model->product_option_id != $opt_id) {
//                    $change_flag = true;
//                    if ($enable_purchase) {
//                        Yii::info('Update Purchase!');
//                        $purchase = Purchase::purchaseProduct($model->product_option_id, $member->id);
//                        if (empty($purchase))
//                            $purchase_state = false;
//                    }
//                }
//            }
//
//            if($purchase_state && $change_flag) {
//                Yii::$app->session->addFlash('success', 'Products Purchased');
//                return $this->redirect(['agent/member', 'id' => $member->id]);
//            }
//
//            if($change_flag) {
//                return $this->render('product_summary', ['products' => $products, 'models' => $models]);
//            }
//        }


    }

    public function actionDependents($id) {
        $member = $this->findMember($id);

        $searchModel = new DependentSearch(['member_id' => $member->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dependents', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'member' => $member,
        ]);
    }

    public function actionDependent($id = null, $member_id = null) {
        if(empty($id) && empty($member_id))
            return $this->redirect(['agent/members']);

        $agent = $this->findAgent();

        $model = null;

        if(empty($id) && !empty($member_id)) {
            $member = $this->findMember($member_id);

            $model = new Dependent([
                'member_id' => $member->id,
                'address' => $member->address,
                'address2' => $member->address2,
                'city' => $member->city,
                'state_id' => $member->state_id,
                'zip' => $member->zip,
            ]);


        } else {
            $model = Dependent::findOne($id);

            if(empty($model))
                throw new NotFoundHttpException('Dependent not found');

            $member = $model->member;

            if($member->agent_id != $agent->id)
                throw new NotFoundHttpException('Dependent not found');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success', (empty($id)?'Dependent Added':'Dependent Updated'));
            return $this->redirect(['agent/dependents', 'id' => $member->id]);
        } else {
            return $this->render('dependent', [
                'model' => $model,
            ]);
        }
    }
}