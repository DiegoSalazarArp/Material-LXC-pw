<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Venta extends ActiveRecord{
    
    public static function getDb()
    {
        return Yii::$app->db;
    }
    
    public static function tableName()
    {
        return 'venta';
    }
    
}