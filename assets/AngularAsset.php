<?php
/**
 * AngularAsset.php
 * @author: work
 */

namespace app\assets;
use yii\web\AssetBundle;
use yii\web\View;

class AngularAsset extends AssetBundle
{
    public $sourcePath = '@bower';
    public $js = [
        'angular/angular.js',
        'angular-strap/dist/angular-strap.min.js',
        'angular-strap/dist/angular-strap.tpl.min.js',
        'angular-bootstrap/ui-bootstrap.min.js',
        'angular-bootstrap/ui-bootstrap-tpls.min.js',
        'angular-ui-router/release/angular-ui-router.min.js',

    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

}