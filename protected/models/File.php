<?php

/**
 * This is the model class for table "file".
 *
 * The followings are the available columns in table 'file':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $path
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property User $user
 */
class File extends CActiveRecord
{	
	public function tableName()
	{
		return 'file';
	}
	
	public function rules()
	{		
		return array(
			array('user_id, name, path, create_time, update_time', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			
			array('id, user_id, name, path, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{		
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
                        			'id' => Yii::t("translation", "id"),
                        			'user_id' => Yii::t("translation", "user"),
                        			'name' => Yii::t("translation", "name"),
                        			'path' => Yii::t("translation", "path"),
                        			'create_time' => Yii::t("translation", "create_time"),
                        			'update_time' => Yii::t("translation", "update_time"),
		);
	}
	
	public function search()
	{		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
