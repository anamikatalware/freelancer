<?php

/**
 * This is the model class for table "{{certification}}".
 *
 * The followings are the available columns in table '{{certification}}':
 * @property integer $certification_id
 * @property integer $certification_customerID
 * @property string $certification_name
 * @property string $certification_organization
 * @property string $certification_description
 * @property integer $certification_year
 * @property string $certification_created
 */
class Certification extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{certification}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('certification_name,certification_organization,certification_description,certification_year,', 'required'),
            array('certification_customerID, certification_year', 'numerical', 'integerOnly' => true),
            array('certification_name, certification_organization', 'length', 'max' => 500),
            array('certification_description', 'length', 'max' => 1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('certification_id, certification_customerID, certification_name, certification_organization, certification_description, certification_year, certification_created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'certification_id' => 'Certification',
            'certification_customerID' => 'Certification Customer',
            'certification_name' => 'Certification Name',
            'certification_organization' => 'Certification Organization',
            'certification_description' => 'Certification Description',
            'certification_year' => 'Certification Year',
            'certification_created' => 'Certification Created',
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

        $criteria->compare('certification_id', $this->certification_id);
        $criteria->compare('certification_customerID', $this->certification_customerID);
        $criteria->compare('certification_name', $this->certification_name, true);
        $criteria->compare('certification_organization', $this->certification_organization, true);
        $criteria->compare('certification_description', $this->certification_description, true);
        $criteria->compare('certification_year', $this->certification_year);
        $criteria->compare('certification_created', $this->certification_created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Certification the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
