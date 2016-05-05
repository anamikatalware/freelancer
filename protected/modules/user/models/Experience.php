<?php

/**
 * This is the model class for table "{{experience}}".
 *
 * The followings are the available columns in table '{{experience}}':
 * @property integer $experience_id
 * @property integer $experience_customerID
 * @property string $experience_title
 * @property string $experience_company
 * @property integer $experience_start_month
 * @property integer $experience_start_year
 * @property integer $experience_end_month
 * @property integer $experience_end_year
 * @property integer $experience_currently_working
 * @property string $experience_summary
 * @property string $experience_created
 */
class Experience extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{experience}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('experience_title,experience_company,experience_summary,experience_start_month,experience_start_year', 'required'),
            array('experience_customerID, experience_start_month, experience_start_year, experience_end_month, experience_end_year', 'numerical', 'integerOnly' => true),
            array('experience_title, experience_company', 'length', 'max' => 500),
            array('experience_currently_working', 'checkTerm'),
            //array('experience_end_month', 'checkTerm'),
            array('experience_summary', 'length', 'max' => 1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('experience_id, experience_customerID, experience_title, experience_company, experience_start_month, experience_start_year, experience_end_month, experience_end_year, experience_currently_working, experience_summary, experience_created', 'safe', 'on' => 'search'),
        );
    }

    public function checkTerm() {
             if (empty($this->experience_currently_working)){ 
            if (empty($this->experience_end_month)){
                $this->addError("experience_end_month", 'End Month cannot be blank.');                
            }
             if (empty($this->experience_end_year)){
                $this->addError("experience_end_year", 'End Year cannot be blank.');                
            }
           }
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
            'experience_id' => 'Experience',
            'experience_customerID' => 'Experience Customer',
            'experience_title' => 'Experience Title',
            'experience_company' => 'Experience Company',
            'experience_start_month' => 'Experience Start Month',
            'experience_start_year' => 'Experience Start Year',
            'experience_end_month' => 'Experience End Month',
            'experience_end_year' => 'Experience End Year',
            'experience_currently_working' => 'Experience Currently Working',
            'experience_summary' => 'Experience Summary',
            'experience_created' => 'Experience Created',
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

        $criteria->compare('experience_id', $this->experience_id);
        $criteria->compare('experience_customerID', $this->experience_customerID);
        $criteria->compare('experience_title', $this->experience_title, true);
        $criteria->compare('experience_company', $this->experience_company, true);
        $criteria->compare('experience_start_month', $this->experience_start_month);
        $criteria->compare('experience_start_year', $this->experience_start_year);
        $criteria->compare('experience_end_month', $this->experience_end_month);
        $criteria->compare('experience_end_year', $this->experience_end_year);
        $criteria->compare('experience_currently_working', $this->experience_currently_working);
        $criteria->compare('experience_summary', $this->experience_summary, true);
        $criteria->compare('experience_created', $this->experience_created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Experience the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
