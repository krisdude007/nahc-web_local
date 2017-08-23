<?php
namespace frontend\controllers;

use frontend\models\ContactForm;
use Yii;
use yii\web\Controller;

class Site2Controller extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        return $this->redirect(['site/index']);
        $this->layout = "nahc2";
        return $this->render('index');

//        $page = Page::findOne(1);
//
//        if(empty($page))
//            throw new NotFoundHttpException();
//
//        return $this->render('page', ['pageHtml' => $page->html]);
    }

    public function actionBelieve()
    {
        return $this->redirect(['site/index']);
        $this->layout = "nahc-page2";
        return $this->render('believe');
    }

    public function actionMembership()
    {
        return $this->redirect(['site/index']);
        $this->layout = "nahc-page2";
        return $this->render('membership');
    }

    public function actionProducts()
    {
        return $this->redirect(['site/index']);
        $this->layout = "nahc-page2";
        return $this->render('products');
    }

    public function actionAdvocacy()
    {
        return $this->redirect(['site/index']);
        $this->layout = "nahc-page2";
        return $this->render('advocacy');
    }

    public function actionTools()
    {
        return $this->redirect(['site/index']);
        $this->layout = "nahc-page2";
        return $this->render('tools');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        return $this->redirect(['site/index']);
        $this->layout = 'nahc-page2';

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
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->redirect(['site/index']);
        $this->layout = "nahc-page2";
        return $this->render('about');
    }
}