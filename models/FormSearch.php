<?php 
namespace app\models;
use Yii;
use Yii\base\model;

class FormSearch extends PersonSearch{
    public $q;

    public function rules()
    {
        return [
            ["q","match","pattern" => "/^[0-9a-z\s-]+$/i","message" => "Solo se aceptan letras y números"],
        ];
    }

    public function attributeLabels()
    {
        return [ 'q' => "Buscar:", ];
    }

  



}