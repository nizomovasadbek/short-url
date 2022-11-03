<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string $last_activity
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property File[] $files
 * @property Link[] $links
 */
class User extends CActiveRecord
{	
	public function tableName()
	{
		return 'user';
	}
	
	public function rules()
	{		
		return array(
			array('username, password, role, last_activity, create_time, update_time', 'required'),
			array('username', 'length', 'max'=>60),
			array('password', 'length', 'max'=>255),
			array('role', 'length', 'max'=>45),
			
			array('id, username, password, role, last_activity, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{		
		return array(
			'files' => array(self::HAS_MANY, 'File', 'user_id'),
			'links' => array(self::HAS_MANY, 'Link', 'user_id'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
                        			'id' => Yii::t("translation", "id"),
                        			'username' => Yii::t("translation", "username"),
                        			'password' => Yii::t("translation", "password"),
                        			'role' => Yii::t("translation", "role"),
                        			'last_activity' => Yii::t("translation", "last_activity"),
                        			'create_time' => Yii::t("translation", "create_time"),
                        			'update_time' => Yii::t("translation", "update_time"),
		);
	}
	
	public function search()
	{		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('last_activity',$this->last_activity,true);
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
