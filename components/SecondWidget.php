<?php
/**
 * SecondWidget.php
 * @author: work
 */
namespace app\components;
use yii\base\Widget;

class SecondWidget extends Widget
{

    public function init()
    {
        parent::init();
        ob_start();


    }

    public function run()
    {
        $content = ob_get_clean();
        return $this->render('second',
            ['content' => $content]
        );
    }
}