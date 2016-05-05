<?php

/**
 * This is the model class for table "{{city}}".
 *
 * The followings are the available columns in table '{{city}}':
 * @property integer $city_id
 * @property string $city_name
 * @property string $city_stateID
 * @property string $city_status 
 */
class City extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{city}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('city_name', 'required', 'message' => 'Please enter {attribute}'),
            array('city_stateID', 'required', 'message' => 'Please select {attribute}'),
            array('city_name', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('city_id, city_name, city_stateID, city_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'city_id' => 'ID',
            'city_name' => 'Name',
            'city_stateID' => 'State',
            'city_status' => 'Status',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('city_name', $this->city_name, true);
        $criteria->compare('city_stateID', $this->city_stateID, true);
        $criteria->compare('city_status', $this->city_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'city_stateID ASC, city_name ASC'
            ),
            'Pagination' => array(
                'PageSize' => 10
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return City the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getCityNameByID($id) {
        $city = City::model()->findByPk($id);
        if (!empty($city)) {
            return $city->city_name;
        } else {
            return '<label class="label label-danger">No City!</label>';
        }
    }

    public function scopes() {
        return array(
            'order_by' => array('order' => 'city_stateID ASC, city_name ASC'),
        );
    }

}
