<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%books}}".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $name
 * @property string $preview
 * @property string $date_create_book
 * @property integer $date_create
 * @property integer $date_update
 *
 */
class Books extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%books}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','author_id','date_create','date_update',/*'date_create_book'*/], 'integer'],
            [['name','date_create_book'],'required'],
            [['name'], 'string', 'max' => 32],
            [['preview'], 'file','skipOnEmpty' => false, 'extensions' => 'png, jpg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Имя автора',
            'name' => 'Название книги',
            'preview' => 'Превью книги(изображение)',
            'date_create_book' => 'Дата выхода книги',
            'date_create' => 'Дата создания записи',
            'date_update' => 'Дата обновления записи',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    public function findAllBooks($selectedAuthors = '', $date_create_book = '', $date_create = '', $nameBook = '')
    {

        $query = new Query();
        $query->select([
            'b.id',
            'b.name',
            'b.date_create',
            'b.date_create_book',
            'b.preview',
            "CONCAT(a.firstname,' ',a.lastname) as authors"
        ])
        ->from(['b'=>'books'])
        ->innerJoin(
            'authors AS a',
            'b.author_id = a.id'
            );
        /*$query =Yii::$app->db->createCommand("SELECT
                                                  b.id,
                                                  b.name,
                                                  b.date_create,
                                                  b.date_create_book,
                                                  b.preview,
                                                  CONCAT(a.firstname,' ',a.lastname) as authors
                                              FROM books b INNER JOIN authors a
                                              ON b.author_id = a.id
                                              WHERE b.name = '".$nameBook."'
                                              AND b.date_create = '".$beforeDateBook."'
                                              AND b.date_create_book = '".$fromDateBook."'
                                              AND a.id = '".$selectedAuthors."'
                                              ");*/

        if (!empty($selectedAuthors) || !empty($fromDateBook) || !empty($nameBook) ||!empty($beforeDateBook))
            $query->where(['search' => 1]);
        if (!empty($selectedAuthors)) {
            $query->andWhere(['a.id' => $selectedAuthors]);
        }
        if (!empty($nameBook)) {
            $query->andWhere(['like', 'b.name', $nameBook]);
        }
        if (!empty($date_create)) {
            $query->andWhere('b.date_create>='.$date_create);
        }
        if (!empty($date_create_book)) {
            $query->andWhere(['b.date_create_book' => $date_create_book]);
        }

        $rows = $query->all();
        return $rows;
    }

    public function createDirectory($path)
    {
        if(!file_exists($path)){
            mkdir($path, 0755, true);
        }

    }

    public function upload()
    {
        $file = UploadedFile::getInstance($this, 'preview');
        if($file){
            $dir = Yii::getAlias('@webroot/uploads/previewBooks/');
            $this->createDirectory($dir);
            $fileName = $file->baseName . '.' . $file->extension;
            if (!$file->saveAs($dir . $fileName)) return false;

            $file->tempName = $dir.$fileName;
            $file->name = '/uploads/previewBooks/'.$fileName;
            //var_dump($file);
            $this->setAttribute('preview', $file);
            return true;
        }
        else return false;
    }

    public function beforeValidate()
    {
        if (!empty($this->date_create_book))
            $this->date_create_book = (string) strtotime($this->date_create_book);

        return parent::beforeValidate();
    }
}
