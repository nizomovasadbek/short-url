<?php

/**
 * This is the model class for table "translation".
 *
 * The followings are the available columns in table 'translation':
 * @property integer $id
 * @property string $title
 * @property string $title_uz
 * @property string $title_ru
 * @property string $title_en
 * @property string $create_time
 * @property string $update_time
 */
class Translation extends CActiveRecord {

    public function tableName() {
        return 'translation';
    }

    public function rules() {
        return array(
            array('title, title_uz, title_ru, title_en, create_time, update_time', 'required'),
            array('id, title, title_uz, title_ru, title_en, create_time, update_time', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t("translation", "id"),
            'title' => Yii::t("translation", "title"),
            'title_uz' => Yii::t("translation", "title_uz"),
            'title_ru' => Yii::t("translation", "title_ru"),
            'title_en' => Yii::t("translation", "title_en"),
            'create_time' => Yii::t("translation", "create_time"),
            'update_time' => Yii::t("translation", "update_time"),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('title_uz', $this->title_uz, true);
        $criteria->compare('title_ru', $this->title_ru, true);
        $criteria->compare('title_en', $this->title_en, true);
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
