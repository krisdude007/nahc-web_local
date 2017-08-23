<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'NAHC Admin';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">This is the admin page.  Mind the gap, and try not to break anything...</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Pages</h2>

                <p>Edit content.</p>

                <p><a class="btn btn-default" href="<?=Url::to('page/index')?>">Edit &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Products</h2>

                <p>Edit Products.</p>

                <p><a class="btn btn-default" href="<?=Url::to('product/index')?>">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Users</h2>

                <p>Edit Users</p>

                <p><a class="btn btn-default" href="<?=Url::to('user/index')?>">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
