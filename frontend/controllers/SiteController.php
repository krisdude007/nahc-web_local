<?php
namespace frontend\controllers;

use common\components\WizardBehavior;
use common\models\Agent;
use common\models\Member;
use common\models\Membership;
use common\models\MembershipBenefit;
use common\models\Page;
use common\models\PaymentMethod;
use common\models\Product;
use common\models\Purchase;
use common\models\State;
use common\models\User;
use frontend\models\AgentSearchForm;
use frontend\models\MemberForm;
use frontend\models\ProductSearchForm;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\JoinForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'dashboard'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'dashboard'],
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
            'wizard' => [
                'class' => WizardBehavior::className(),
                'finishPath' => 'member/index',
//               'viewName' =>'@vendor/deltav/yii2-wizard-extension/layouts/wizardLayout.php',
                'viewName' => 'join',
                'modelClass' => JoinForm::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if($action->id == 'join')  {
            $this->on(WizardBehavior::EVENT_WIZARD_FINISH, [$this, 'joinFinish']);
        }

        $this->updateSessionLists(false);

        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    private function updateSessionLists($refresh = false) {
        $session = Yii::$app->session;
        $mem = null;
        $state = null;
        $agent = null;
        $products = [];

        if (!$session->isActive) {
            $session->open();
        }

        $memprod =Yii::$app->session->get('memprod', null);

        $agent_id = Yii::$app->session->get('agent_id');
        if(empty($agent_id)) {
            $agent_id = 1;
        }

        $state_id = Yii::$app->session->get('state_id');
        if(!empty($state_id)) {
            $state = State::findOne($state_id);
        }

        if($refresh == true || empty($memprod)) {
            $mem = Membership::find()->select(['name', 'id'])->indexBy('id')->asArray()->column();

            if(!Yii::$app->user->isGuest && Yii::$app->user->identity->has_member) {
//            $agent = Agent::findOne(Yii::$app->user->identity->member->agent_id);

                $member = Member::findOne(['user_id' => Yii::$app->user->id]);

                if(empty($member)) {
                    return false;
                }

                $agent = $member->agent;

                if(empty($agent))
                    return false;

                $state = $member->state;

                $products = $agent->getProductList($state->id);
            }
            elseif(Yii::$app->user->isGuest && !empty($agent_id)) {
                $agent = Agent::findOne($agent_id);

                if(empty($agent)) {
                    Yii::$app->session->destroy();
                    return false;
                }

                if(empty($state))
                    $products = $agent->getProductList();
                else
                    $products = $agent->getProductList($state->id);
            }
            elseif(!empty($state)) {
                $products = Product::find()->state($state_id)->ordered()->all();
            }
            else {
                $products = Product::find()->ordered()->all();
            }

            Yii::$app->session['memprod'] = new \ArrayObject;

            $mem_func = function ($k, $v) {
                return ['label' => $v, 'url' => '/membership#plan'.$k, 'active' => false];
            };

            $mem2 = array_map( $mem_func, array_keys($mem), $mem);

            $prod = ArrayHelper::map($products, 'id', 'name');

            $prod_func = function ($k, $v) {
              return ['label' => $v, 'url' => '/products#prod'.$k, 'active' => false];
            };

            $prod2 = array_map( $prod_func, array_keys($prod), $prod);

            Yii::info('PROD2'.print_r($prod2, true));

            $memprod = ['mem' => array_merge([['label' => 'All Memberships', 'url' => ['site/membership']]],$mem2),
                'prod' => array_merge([['label' => 'All Products', 'url' => ['site/products']]],$prod2)];

            Yii::$app->session->set('memprod', $memprod);

            Yii::$app->session->set('agent_id', $agent->id);

            return true;
        }

        return true;
    }

    public function actionReset() {
        if(Yii::$app->session->isActive)
            Yii::$app->session->destroy();

        return $this->redirect(['site/index']);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        $this->layout = "nahc";

        $level = 0;

        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->has_member) {
            $level = Yii::$app->user->identity->member->level;
        }

        $agent_id = Yii::$app->session->get('agent_id');
        $agent = null;

        if(!empty($agent_id) && $agent_id !== 1)
            $agent = Agent::findOne($agent_id);

        $memberships = Membership::find()->where(['status' => Membership::STATUS_ACTIVE])->with('benefits')->all();
        $benefits = MembershipBenefit::find()->where(['status'=>MembershipBenefit::STATUS_ACTIVE])->orderBy('page_order')->all();
        $products = Product::find()->where(['status' => Product::STATUS_ACTIVE])->orderBy('page_order')->all();

//        Yii::info('Memberships: '.print_r($memberships))

        return $this->render('index', ['level' => $level, 'memberships' => $memberships, 'benefits' => $benefits, 'products' => $products, 'agent' => $agent]);

//        return $this->render('index');

//        $page = Page::findOne(1);
//
//        if(empty($page))
//            throw new NotFoundHttpException();
//
//        return $this->render('page', ['pageHtml' => $page->html]);
    }

    public function actionBelieve()
    {
        $this->layout = "nahc-page";
        return $this->render('believe');
    }

    public function actionMembership()
    {
        $this->layout = "nahc-page";

        $level = 0;

        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->has_member) {
            $level = Yii::$app->user->identity->member->level;
        }

        $memberships = Membership::find()->where(['status' => Membership::STATUS_ACTIVE])->with('benefits')->all();
        $benefits = MembershipBenefit::find()->where(['status'=>MembershipBenefit::STATUS_ACTIVE])->all();

//        Yii::info('Memberships: '.print_r($memberships))

        return $this->render('membership', ['level' => $level, 'memberships' => $memberships, 'benefits' => $benefits]);
    }

    public function actionProducts($state_id = null)
    {
        $this->layout = "nahc-page";

        $state = null;
        $member = null;
        $agent = null;

        if(empty($state_id)) {
            $state_id = Yii::$app->session->get('state_id');
        }

        $model = new ProductSearchForm(['state_id' => $state_id]);

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $state_id = $model->state_id;
            Yii::$app->session->set('state_id', $state_id);
            $this->updateSessionLists(true);
        }

        if(!empty($state_id)) {
            $state = State::findOne($state_id);
        }

        $agent_id = Yii::$app->session->get('agent_id');

//        if(empty($agent_id)) {
//            $agent_id = 1;
//            Yii::$app->session->set('agent_id', 1);
//        }

//        $products = [];


        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->has_member) {
//            $agent = Agent::findOne(Yii::$app->user->identity->member->agent_id);

            $member = Member::findOne(['user_id' => Yii::$app->user->id]);
            $agent = $member->agent;

            if(empty($agent))
                return $this->redirect(['site/index']);

            $state = $member->state;
            $products = $agent->getProductList($state->id);

            Yii::$app->session->set('agent_id', $agent->id);
        }
        elseif(Yii::$app->user->isGuest && !empty($agent_id)) {
            $agent = Agent::findOne($agent_id);

            if(empty($agent)) {
                Yii::$app->session->destroy();
                return $this->redirect(['site/index']);
            }

            $products = $agent->getProductList($state_id);
        }
        elseif(!empty($state)) {
            $products = Product::find()->state($state_id)->ordered()->all();
        }
        else {
            $products = Product::find()->ordered()->all();
        }

        Yii::info('Products: '.print_r($products, true));

        return $this->render('products', ['products' => $products, 'state' => $state, 'model' => $model, 'member' => $member]);
    }

    public function actionTools()
    {
        $this->layout = "nahc-page";

        $member = false;

        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->has_member)
            $member = true;

        return $this->render('tools', ['member' => $member]);
    }

    public function actionAgents()
    {
        $this->layout = "nahc-page";

        $model = new AgentSearchForm();

        return $this->render('agents',['model' => $model]);
    }

    public function actionAgent($id)
    {
        $this->layout = "nahc-page";

        $agent = Agent::findOne(['ext_id' => $id]);

        if(empty($agent))
            Yii::$app->session['agent_id'] = 1;
        else
            Yii::$app->session['agent_id'] = $agent->id;

        return $this->redirect(['site/index']);
    }

//    public function actionJoin($level = 1) {
//        return $this->render('join');
//    }

//    public function actionBuy($prod = 1) {
//        return $this->render('buy');
//    }

    /**
     * Runs join wizard.
     *
     * @return mixed
     */
    public function actionJoin($plan = null)
    {
        $this->layout = 'form-modal';

        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->has_member) {
            return $this->redirect(['site/index']);
        }

        return $this->runWizard(['plan' => $plan]);
    }

    public function actionDashboard()
    {
        $this->layout = 'dashboard';

//        $member = Member::findOne(['user_id' => \Yii::$app->user->id]);
//
//        Yii::info('User ID: '.Yii::$app->user->id);
//
//        $products = [];
//
//        if(!empty($member)) {
//            Yii::info('Member: '.$member->id);
//            $products = Purchase::find()->where(['member_id' => $member->id, 'type' => 2])->products();
//            Yii::info(print_r($products, true));
//        } else {
//            Yii::info('Member not found!');
//        }


        return $this->render('dashboard');
    }

    /**
     * @param $event \common\components\WizardEvent
     * @return void
     */
    public function joinFinish($event)
    {
        Yii::info('Got WIZARD_FINISH event with data: ' . print_r($event->model, true));

        /* @var $model \frontend\models\JoinForm */
        $model = $event->model;

        $member = new Member($model->toArray([
            'f_name',
            'l_name',
            'm_name',
            'dob',
            'gender',
            'address',
            'address2',
            'city',
            'state_id',
            'zip',
            'email',
            'phone',
            'ssn',
        ]));

        Yii::info('Member: ' . print_r($member, true));

        $user = new User();
        $user->username = $model->username;
        $user->email = $model->email;
        $user->setPassword($model->password);
        $user->generateAuthKey();
        $user->has_member = true;

        $transaction = Yii::$app->db->beginTransaction();


        if(!$user->save()) {
            $transaction->rollBack();
            $event->result = false;
            return;
        }

        $member->user_id = $user->id;

        $member->agent_id =  Yii::$app->session->get('agent_id', 1);

//        Yii::info('Email: '.$this->email);

//        $this->setScenario(Member::SCENARIO_JOIN);

        if(!$member->save()) {
            Yii::info('Errors: '.print_r($member->errors, true));
            $transaction->rollBack();
            $event->result = false;
            return;
        }

        $payment = new PaymentMethod([
            'member_id' => $member->id,
            'pay_type' => $model->pay_type,
            'f_name' => $model->acct_f_name,
            'l_name' => $model->acct_l_name,
            'name' => 'Primary',
            'status' => PaymentMethod::STATUS_ACTIVE,
        ]);

        if($payment->pay_type == PaymentMethod::PAY_TYPE_BANK) {
            $payment->routing = $model->routing;
            $payment->account = $model->account;
            $payment->account_type = $model->account_type;
        } elseif($payment->pay_type == PaymentMethod::PAY_TYPE_CARD) {
            $payment->pan = $model->pan;
            $payment->exp = $model->exp;
            $payment->cvv = $model->cvv;
        } else { // bad pay_type
            $transaction->rollBack();
            $event->result = false;
            return;
        }

        if(!$payment->save()) {
            Yii::info('Errors: '.print_r($payment->errors, true));
            $transaction->rollBack();
            $event->result = false;
            return;
        }

        $purchase = Purchase::purchaseMembership($model->plan, $member->id, $payment->id);

        if(empty($purchase)) {
            $transaction->rollBack();
            $event->result = false;
            return;
        }

        try {
            $transaction->commit();
        } catch (\Exception $e) {
            Yii::info('FINISH EXCEPTION! - '.print_r($e, true));
            $event->result = false;
            return;
        }

        /*        // create models
                $user = new User();
                $user->username = $model->username;
        //        $user->breeder_id = $breeder->id;
        //        $user->profile_id = $profile->id;
                $user->email = $model->email;
                $user->setPassword($model->password);
                $user->generateAuthKey();

                if(!$user->save()) {
                    Yii::info('Error saving User!'.print_r($user->errors, true));
                    $event->result = false;
                    return;
                }

                $profile = new Profile([
                    'fname' => $model->firstName,
                    'lname' => $model->lastName,
                    'abbreviation' => $model->userAbbrev,
                    'phone' => $model->phone,
                    'email' => $model->email,

                    'address' => $model->streetAddress,
                    'address2' => $model->streetAddress2,
                    'city' => $model->city,
                    'state' => $model->state,
                    'zip' => $model->zipCode,

                    'user_id' => $user->id,
                ]);
        */
        $event->result = true;

        // TODO: VERIFY EMAIL!
        Yii::$app->user->login($user);

        Yii::$app
            ->mailer
            ->compose(
                ['html' => 'memberWelcome-html', 'text' => 'memberWelcome-text'],
                ['member' => $member] )
            ->setFrom([Yii::$app->params['supportEmail'] => 'NAHC Support'])
            ->setTo($member->email)
            ->setSubject('Welcome to NAHC!')
            ->send();

        return;
    }

    /**
     * Displays a content page
     *
     * @param int $id Page ID to render
     * @return string Rendered Content
     * @throws NotFoundHttpException
     */
    public function actionPage($id = 1)
    {
        $page = Page::findOne($id);

        if(empty($page))
            throw new NotFoundHttpException();

        return $this->render('page', ['pageHtml' => $page->html]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
            if(Yii::$app->user->identity->has_member)
                return $this->redirect(['member/index']);

            if(Yii::$app->user->identity->has_agent)
                return $this->redirect(['agent/index']);

            if(Yii::$app->user->identity->has_provider)
                return $this->redirect(['provider/index']);

            return $this->redirect(['site/dashboard']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $this->layout = 'nahc-page';

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays agent-specific contact page.
     *
     * @return mixed
     */
    public function actionAgentContact()
    {
        $this->layout = 'nahc-page';

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['agentEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('agent-contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $this->layout = "nahc-page";
        return $this->render('about');
    }

    public function actionLegal($doc = null)
    {
        $this->layout = "nahc-page";
        switch ($doc) {
            case 'terms':
                return $this->render('terms');
                break;
            case 'privacy':
                return $this->render('privacy');
                break;
            default:
                return $this->render('legal');
                break;
        }

        return $this->render('legal');
    }


    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        return $this->redirect(['site/join']);

        $model = new MemberForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'login';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'login';

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
