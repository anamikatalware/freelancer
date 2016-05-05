<?php

/**
 * This is the model class for table "{{state}}".
 *
 * The followings are the available columns in table '{{state}}':
 * @property integer $state_id
 * @property string $state_name
 * @property string $state_countryID
 * @property string $state_status 
 */
class State extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{state}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('state_name', 'required', 'message' => 'Please enter {attribute}'),
            array('state_countryID', 'required', 'message' => 'Please select {attribute}'),
            array('state_name', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('state_id, state_name, state_countryID, state_status', 'safe', 'on' => 'search'),
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
            'state_id' => 'ID',
            'state_name' => 'Name',
            'state_countryID' => 'Country',
            'state_status' => 'Status',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('state_id', $this->state_id);
        $criteria->compare('state_name', $this->state_name, true);
        $criteria->compare('state_countryID', $this->state_countryID, true);
        $criteria->compare('state_status', $this->state_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'state_countryID ASC, state_name ASC'
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
     * @return State the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getStateNameByID($id) {
        $state = State::model()->findByPk($id);
        if (!empty($state)) {
            return $state->state_name;
        } else {
            return '<label class="label label-danger">No State!</label>';
        }
    }
    
     public static function getCountryNameByStateID($id) {
        $state = State::model()->findByPk($id);
        if (!empty($state)) {
            $country = Country::model()->getCountryNameByID($state->state_countryID);
            return $country;
        } else {
            return '<label class="label label-danger">No Country!</label>';
        }
    }

    public function scopes() {
        return array(
            'order_by' => array('order' => 'state_name ASC'),
        );
    }

}
