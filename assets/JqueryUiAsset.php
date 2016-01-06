<?php
/**
 * JqueryUiAsset.php
 * @author: work
 */

namespace app\assets;


use yii\web\AssetBundle;

class JqueryUiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/jquery-ui/';

    public $js = [
        'jquery-ui.min.js',
    ];

    public $css = [
        'themes/base/jquery-ui.min.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
    ];
}