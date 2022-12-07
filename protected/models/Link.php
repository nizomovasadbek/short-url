<?php

/**
 * This is the model class for table "link".
 *
 * The followings are the available columns in table 'link':
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property string $short_url
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Link extends CActiveRecord {

    public function tableName() {
        return 'link';
    }

    public function rules() {
        return array(
            array('user_id, url, short_url, create_time, update_time', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('short_url', 'length', 'max' => 100),
            array('id, user_id, url, short_url, create_time, update_time', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t("translation", "id"),
            'user_id' => Yii::t("translation", "user"),
            'url' => Yii::t("translation", "url"),
            'short_url' => Yii::t("translation", "short_url"),
            'create_time' => Yii::t("translation", "create_time"),
            'update_time' => Yii::t("translation", "update_time"),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('short_url', $this->short_url, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
