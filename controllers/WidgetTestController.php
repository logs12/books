<?php

namespace app\controllers;


class WidgetTestController extends BehaviorsController
{
    public function actionIndex()
    {
        $search_name = 'примеры';
        return $this->redirect(
            [
                'main/search',
                'search' => $search_name
            ]
        );
    }

}
