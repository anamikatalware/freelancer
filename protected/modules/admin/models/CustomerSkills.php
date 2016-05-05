<?php

/**
 * This is the model class for table "{{customer_skills}}".
 *
 * The followings are the available columns in table '{{customer_skills}}':
 * @property integer $skill_id
 * @property integer $skill_customerID
 * @property integer $skill_subcategoryID
 * @property string $skill_created
 * @property integer $skill_status
 */
class CustomerSkills extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{customer_skills}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('skill_customerID, skill_subcategoryID, skill_status', 'numerical', 'integerOnly' => true),
            array('skill_created', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('skill_id, skill_customerID, skill_subcategoryID, skill_created, skill_status', 'safe', 'on' => 'search'),
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
            'skill_id' => 'ID',
            'skill_customerID' => 'Customer',
            'skill_subcategoryID' => 'Skill',
            'skill_created' => 'Created',
            'skill_status' => 'Status',
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

        $criteria->compare('skill_id', $this->skill_id);
        $criteria->compare('skill_customerID', $this->skill_customerID);
        $criteria->compare('skill_subcategoryID', $this->skill_subcategoryID);
        $criteria->compare('skill_created', $this->skill_created, true);
        $criteria->compare('skill_status', $this->skill_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CustomerSkills the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
