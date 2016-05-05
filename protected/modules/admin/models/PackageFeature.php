<?php

/**
 * This is the model class for table "{{budget}}".
 *
 * The followings are the available columns in table '{{budget}}':
 * @property integer $package_id 
 * @property string $created
 * @property string $updated
 * @property string $status
 */
class PackageFeature extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{package_feature}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pf_packageID,pf_featureID', 'required', 'message' => 'Please enter {attribute}.'),
            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pf_packageID, pf_featureID, update_date, create_date, status', 'safe', 'on' => 'search'),
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
   public static function model($className = __CLASS__) {
        return parent::model($className);
    }
   

}
