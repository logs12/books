<?php

namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\db\Query;
/**
 * This is the model class for table "{{%authors}}".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%authors}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
        ];
    }

    public function findAllAuthors()
    {
        $query = new Query;
        $authorsArrayDataProvider = new ArrayDataProvider([
            'allModels' => $query
                ->select(["CONCAT(firstname, ' ', lastname) AS full_name", 'id'])
                ->from('authors')
                ->all(),
            'pagination' => false,
            'key' => 'id',
        ]);
        $authors = $authorsArrayDataProvider->allModels;
        return $authors;
    }
}
