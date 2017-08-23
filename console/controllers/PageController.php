<?php
namespace console\controllers;

use common\models\Page;
use kartik\markdown\Markdown;
use yii\console\Controller;
use yii\helpers\HtmlPurifier;


class PageController extends Controller {

    public function actionUpdate()
    {
        $pages = Page::find()->all();

        foreach($pages as $page)
        {
            $page->html = HtmlPurifier::process(Markdown::convert($page->content));
            $page->save();

            echo 'Updated Page: '.$page->id.PHP_EOL;
        }

        return Controller::EXIT_CODE_NORMAL;
    }
}