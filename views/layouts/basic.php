<?php
/**
 * base.php
 * @author: work
 * @var $this \yii\web\View
 */
use app\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags(); ?>
    <meta charset="<?=Yii::$app->charset ?>">
    <?php $this->registerMetaTag(['name' => 'viewport', 'content=device-width, initial-scale=1'])?>
    <title><?=Yii::$app->name ?></title>
    <?php $this->head();?>
</head>
<body ng-app="app">
<?php $this->beginBody(); ?>
    <div class="wrap">
        <?php NavBar::begin(
            [
                'options' => [
                    'class' => 'navbar navbar-default',
                    'id' => 'main-menu'
                ],
                'renderInnerContainer' => true,
                'innerContainerOptions' => [
                    'class' => 'container'
                ],
                'brandLabel' => 'Books',
                'brandUrl' => [
                    '/main/index'
                ],
                'brandOptions' => [
                    'class' => 'navbar-brand'
                ]
            ]
        );

        $menuItems = [
            [
                'label' => 'Главная <span class="glyphicon glyphicon-home"></span>',
                'url' => ['/main/index']
            ],
            [
                'label' => 'Выпадающий список <span class="glyphicon glyphicon-inbox"></span>',
                'items'  => [
                    '<li class="dropdown-header">Расширения</li>',
                    '<li class="divider"></li>',
                    [
                        'label' => 'Перейти к просмотру',
                        'url' => ['/widget-test/index']
                    ]
                ]
            ],
            [
                'label' => 'О проекте <span class="glyphicon glyphicon-question-sign"></span>',
                'url' => ['#'],
                'linkOptions' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'style' => 'cursor-pointer'
                ]
            ]
        ];


        if (Yii::$app->user->isGuest) {

            $menuItems[] = ['label' => 'Регистрация', 'url' => ['/main/reg']];
            $menuItems[] = ['label' => 'Вход', 'url' => ['/main/login']];
        } else {
            $menuItems[] = ['label' => 'Авторы <span class="glyphicon glyphicon-user"></span>', 'url' => ['/authors/']];
            $menuItems[] = ['label' => 'Книги <span class="glyphicon glyphicon-hdd"></span>', 'url' => ['/books/']];
            $menuItems[] = [
                'label' => 'Выйти('.Yii::$app->user->identity['username'].')',
                'url' => ['/main/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];

        }

        echo Nav::widget([
                'items' => $menuItems,
                'encodeLabels' => false,
                'options' => [
                    'class' => 'navbar-nav navbar-right'
                ]
            ]);

            Modal::begin([
                'header' => '<h2>Books</h2>',
                'id' => 'modal'
            ]);
                echo 'Books';
            Modal::end();

            ActiveForm::begin([
                'action' => ['/main/search'],
                'method' => 'get',
                'options' => ['class' => 'navbar-form navbar-right']
            ]);

            echo '<div class="input-group input-group-sm">';
            echo Html::input(
                'type:text',
                'search',
                '',
                [
                    'placeholder' => 'Найти ..',
                    'class' => 'form-control'
                ]
            );
            echo '<span class="input-group-btn">';
            echo Html::submitButton(
                '<span class="glyphicon glyphicon-search"></span>',
                ['class'=>'btn btn-success']
            );
            echo '</span>';
            echo '</div>';
            ActiveForm::end();

        NavBar::end(); ?>

        <div class="container">
            <?= $content ?>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <span class="badge">
                <span class="glyphicon glyphicon-copyright-mark"></span> Books <?= date('Y'); ?>
            </span>
        </div>
    </footer>
<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>