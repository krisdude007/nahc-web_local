<?php
/**
 * Copyright (c) 2016-2017 Michael Menefee / CBH
 */
namespace common\components;

use HttpInvalidParamException;
use Symfony\Component\EventDispatcher\Event;
use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;

use common\components\WizardModel;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * Class WizardBehavior
 * @package common\components
 * @property \yii\base\Model    $modelClass
 * @property string             $viewPath
 * @property string             $viewName
 * @property string             $viewBase
 * @property string             $action
 *
 */
class WizardBehavior extends Behavior
{
    public $modelClass;
    public $viewName;
    public $viewPath;
    public $viewBase;
    public $action;
    public $finishPath = 'site/index';

    public $btnClass = 'btn-primary';
    public $btnClassDisabled = 'btn-default';

    const EVENT_WIZARD_FINISH = 'wizardFinish';

    /**
     * Attaches this behavior to the owner.
     *
     * @param \yii\base\Controller $owner The controller that this behavior is to be attached to.
     * @throws InvalidConfigException
     *
     */
    public function attach($owner)
    {
        if (!$owner instanceof \yii\base\Controller) {
            throw new InvalidConfigException('Owner must be an instance of yii\base\Controller');
        }
        parent::attach($owner);
//        // Attach WizardBehavior events to the owner
//        foreach ($this->events as $name => $handler) {
//            $owner->on($name, $handler);
//        }
//        $this->_session = Yii::$app->getSession();
//        $this->_branchKey = $this->sessionKey . '.branches';

        $this->viewPath = $owner->id;
        //$this->viewName = $this->viewName . '.php';
        $this->viewBase = $owner->module->getLayoutPath() . DIRECTORY_SEPARATOR . 'wizardBase.php';
    }

    public function runWizard($params = []) {
        if(empty($this->modelClass))
            throw new HttpInvalidParamException();

        $ref = Yii::$app->session->get('wizard_ref_url');
        if(empty($ref)) {
            Yii::$app->session->set('wizard_ref_url', Yii::$app->request->referrer);
            $ref = Yii::$app->request->referrer;
        }

        $wm = new WizardModel([
            'viewBase' => $this->viewBase,
            'redirect' => Yii::$app->controller->action->id,
            'step' => 1,
            'btnClass' => $this->btnClass,
            'btnClassDisabled' => $this->btnClassDisabled]);

        $model = new $this->modelClass();
        $steps = count($model->scenarios());
        $maxSteps = $steps - 2;

        $wm->steps = $maxSteps;

//        $scenario = 'step' . $wm->step;
//        $model->setScenario($scenario);



        if($wm->load(Yii::$app->request->post()) && $wm->validate())    {
            $step = $wm->step;

            Yii::info('WM: '.print_r($wm->toArray(), true));

            Yii::info('Got step: '.$wm->step.' / action: '.$wm->action . ' / steps: '. $wm->steps);

            $data = base64_decode($wm->data);
            $data = json_decode($data, true);

            $model->setScenario('load');
            $model->load($data, '');

            Yii::info('Form data: ' . print_r($data, true));
            Yii::info('Model data: ' . print_r($model->toArray(), true));

            switch ($wm->action)    {
                case 'cancel':
//                    return $this->owner->redirect(['site/index']);
//                    Yii::info('Referrer: '.print_r(Yii::$app->request->referrer, true));
                    Yii::$app->session->remove('wizard_ref_url');
                    return $this->owner->goBack($ref);
                    break;
                case 'next':
                    Yii::info('Running Next!');
                    $nextStep = $step + 1;
                    if($nextStep > $maxSteps)
                        throw new InvalidParamException();

                    $scenario = 'step' . $step;
                    $model->setScenario($scenario);

                    break;
                case 'prev':
                    Yii::info('Running Prev!');
                    $wm->step = $step - 1;
                    if($wm->step < 1)
                        throw new InvalidParamException();

                    $model->setScenario('step' . $wm->step);
                    return $this->owner->render($this->viewName, array_merge(['wm' => $wm, 'model' => $model], $params));
                    break;
                case 'finish':
                    if($step != $maxSteps) {
                        $scenario = 'step' . $step;
                        $model->setScenario($scenario);
                        break;
                    }

                    Yii::info('Finish action handler');
                    $event = new WizardEvent(['model' => $model]);
                    $this->owner->trigger(self::EVENT_WIZARD_FINISH, $event);

                    Yii::info('Event Result: '.($event->result?'True':'False'));

                    if($event->result) {
//                        return $this->owner->redirect($this->action);
                        $wm->step = 'finish';
                        $model->setScenario('finish');
                        $wm->redirect = $this->finishPath;
                        return $this->owner->render($this->viewName, array_merge(['wm' => $wm, 'model' => $model], $params));
                    }

                default:
                    $scenario = 'step' . $step;
                    $model->setScenario($scenario);
                    break;
            }



            Yii::info('Set Scenario: '.$scenario);

            if (!$model->load(Yii::$app->request->post())) {
                Yii::info('LOAD FAIL: '.print_r($model->errors, true));
                throw new InvalidParamException();
            }


            if (!$model->validate()) {
                Yii::info('Model validation failed!'.print_r($model->errors,true));
                return $this->owner->render($this->viewName, array_merge(['wm' => $wm, 'model' => $model], $params));
            }

            $model_json = json_encode($model->toArray());
            $model_base64 = base64_encode($model_json);
            $wm->data = $model_base64;

            Yii::info('Model array: ' . $model_json);

            if($wm->action === 'next')  {
                Yii::info('nextStep: '.$nextStep);
                $wm->step = $nextStep;

                $scenario = 'step' . $nextStep;
                $model->setScenario($scenario);
            }

            return $this->owner->render($this->viewName, array_merge(['wm' => $wm, 'model' => $model], $params));
        }

        return $this->owner->render($this->viewName, array_merge(['wm' => $wm, 'model' => $model], $params));
    }
}