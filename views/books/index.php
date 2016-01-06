<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
\app\assets\JqueryUiAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <div ng-controller="Books">
        <div class="alert alert-info">
            <p>
                <select ng-model="selectedAuthors" ng-options="author as author.full_name for author in authors" ></select>
                <input ng-model="nameBook" placeholder="Название книги"/>
            </p>
            <p>Дата выхода книги <input id = "date_create_book" datepick="" /> до <input id = "date_create" datepick=""/> </p>
            <button ng-click = "searchBook()">Искать</button>
        </div>
    <!--    <div class="alert alert-info">
            <p>orderOptions: {{ orderOptions }}</p>
            <p>reverseOptions: {{ reverseOptions }}</p>
            <p>sortStyle: {{ sortStyle }}</p>
            <p>Search Query: {{ sortStyle }}</p>
            <div>{{'1451506272000' | date:'yyyy-MM-dd'}}</div>
        </div>-->
        <table class="table table-hover table-bordered" >
            <thead>
                <tr>
                    <th>
                        <a href="" ng-click="setOrder ('id',sortReverse);">
                            ID
                            <span ng-class="sortStyle.id || 'fa fa-caret-down'"></span>
                        </a>
                    </th>
                    <th>
                        <a href="" ng-click="setOrder ('name',sortReverse);">
                        Название
                        <span ng-class="sortStyle.name || 'fa fa-caret-down'"></span>
                    </th>
                    <th>
                        <a href="" ng-click="setOrder ('preview',sortReverse);">
                        Превью
                        <span ng-class="sortStyle.preview || 'fa fa-caret-down'"></span>
                    </th>
                    <th>
                        <a href="" ng-click="setOrder ('authors', sortReverse);">
                        Автор
                        <span ng-class="sortStyle.authors || 'fa fa-caret-down'"></span>
                    </th>
                    <th>
                        <a href="" ng-click="setOrder ('date_create_book', sortReverse);">
                        Дата выхода книги
                        <span ng-class="sortStyle.date_create_book || 'fa fa-caret-down'"></span>
                    </th>
                    <th>
                        <a href="" ng-click="setOrder ('date_create',sortReverse);">
                        Дата добавления
                        <span ng-class="sortStyle.date_create || 'fa fa-caret-down'"></span>
                    </th>
                    <th colspan="3">Кнопки действий</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="book in books | orderBy:orderOptions.field:reverseOptions[orderOptions.field]" ng-model="books">
                    <td>{{book.id}}</td>
                    <td>{{book.name}}</td>
                    <td>
                        <a class="modal_preview" href="/books/index" title="preview" modal-preview>
                            <img ng-src="{{book.preview}}" width="150" height="150">
                        </a>
                    </td>
                    <td>{{book.authors}}</td>
                    <td>{{book.date_create_book | dateBooks}}</td>
                    <td>{{book.date_create | dateBooks}}</td>
                    <td>
                        <a class = "viewBooks glyphicon glyphicon-eye-open" href="#" modal-view-book = "{{book.id}}"></a>

                    </td>
                    <td>
                        <a class="updateBooks glyphicon glyphicon-pencil" href="#" modal-update-book = "{{book.id}}"></a>
                        <!--<a class="updateBooks glyphicon glyphicon-pencil" href="#" class = 'updateBooks'></a>-->
                    </td>
                    <td><a href="" ng-click="delBook(book.id)"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
            </tbody>
        </table>
    </div>

  <!--  --><?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'author_id',
            'name',
            [
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        Html::img(Url::toRoute($data->preview),[
                            'alt'=>'preview',
                            'style' => 'width:150px;']),
                        Url::toRoute($data->preview),
                        ['title' => 'preview', 'class' => 'modal_preview']
                    );
                },
            ],
            [
                'attribute'=>'date_create_book',
                'label'=>'Дата создания книги',
                'format'=>'date', // Доступные модификаторы - date:datetime:time
                'headerOptions' => ['width' => '200'],
            ],
            'date_create:date',
            'date_update:date',

            //['class' => 'yii\grid\ActionColumn'],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $url,
                            ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0','class' => 'viewBooks']);
                    },
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            $url,
                            ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0','class' => 'updateBooks']);
                    },
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            $url);
                    },
                ],
            ],
        ],

    ]); */?>

    <?php
    Modal::begin(['id' => 'modal_preview','footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>']);Modal::end();

    Modal::begin(['id' => 'modal_update_book']); Modal::end();
    Modal::begin(['id' => 'modal_view_book','footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>']); Modal::end();
    ?>
</div>