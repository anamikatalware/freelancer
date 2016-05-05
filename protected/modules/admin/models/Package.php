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
class Package extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{package}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('package_name,package_price', 'required', 'message' => 'Please enter {attribute}.'),
            array('package_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('package_id, package_name,package_price, update_date, create_date, status', 'safe', 'on' => 'search'),
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
            'package_id' => 'ID',
            'package_name' => 'Name',
            'package_price' => 'Price',
            'package_bids_per_month' => 'Bids per Month',
            'package_skills' => 'No. of Skills',
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

        $criteria->compare('package_id', $this->package_id);
        $criteria->compare('package_name', $this->package_name, TRUE);
        $criteria->compare('package_price', $this->package_price, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'package_id  ASC'
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

    public static function getPackageName($id) {
        $result = Package::model()->findByPk($id);
        return $result->package_name;
    }

}
