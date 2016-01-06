<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/app.js',
        'js/controllers/Books.js',
        'js/services/Books.js',
        'js/services/Authors.js',
        'js/directives/modalPreview.js',
        'js/directives/modalViewBook.js',
        'js/directives/modalUpdateBook.js',
        'js/directives/datepicker.js',
        'js/filters/dateBooks.js'
    ];
    public $jsOptions= [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AngularAsset',
        'app\assets\FontAwesomeAsset',
    ];
}
