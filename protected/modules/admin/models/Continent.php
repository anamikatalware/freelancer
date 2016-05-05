<?php

/**
 * This is the model class for table "{{continent}}".
 *
 * The followings are the available columns in table '{{continent}}':
 * @property integer $continent_id
 * @property string $continent_name
 * @property string $continent_created
 * @property string $continent_updated
 * @property string $continent_status
 */
class Continent extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{continent}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('continent_name', 'required', 'message' => 'Please enter {attribute}.'),
            array('continent_name', 'unique', 'message' => 'This Continent name is already exists.'),
            array('continent_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('continent_id, continent_name, continent_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'continent_id' => 'ID',
            'continent_name' => 'Name',
            'continent_status' => 'Status'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('continent_id', $this->continent_id);
        $criteria->compare('continent_name', $this->continent_name, true);
        $criteria->compare('continent_status', $this->continent_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'continent_name ASC'
            ),
            'Pagination' => array(
                'PageSize' => 20
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Continent the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getContinentName($id) {
        $result = Continent::model()->findByPk($id);
        return $result->continent_name;
    }

}
