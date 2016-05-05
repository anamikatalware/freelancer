<?php

/**
 * This is the model class for table "{{budget}}".
 *
 * The followings are the available columns in table '{{budget}}':
 * @property integer $feature_id 
 * @property string $created
 * @property string $updated
 * @property string $status
 */
class Feature extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{feature}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('feature_name,feature_key', 'required', 'message' => 'Please enter {attribute}.'),
            array('feature_name', 'length', 'max' => 512),
            array('feature_key', 'unique'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('feature_id, feature_name,feature_key,feature_fixedvalue,feature_percentagevalue, update_date, create_date, status', 'safe', 'on' => 'search'),
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
            'feature_id' => 'ID', 
            'feature_name' => 'Feature', 
            'feature_key' => 'Key', 
            'feature_fixedvalue' => 'Fixed Value', 
            'feature_percentagevalue' => 'Percentage Value', 
            'create_date' => 'Created',
            'update_date' => 'Updated',
            'status' => 'Status'
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

        $criteria->compare('feature_id', $this->feature_id);
        $criteria->compare('feature_name', $this->feature_name,TRUE);
        

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'feature_id  ASC'
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
     * @return Budget the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getFeatureName($id) {
        $result = Feature::model()->findByPk($id);
        return $result->feature_name;
    }

}
