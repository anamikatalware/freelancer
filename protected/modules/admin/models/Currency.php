<?php

/**
 * This is the model class for table "{{currency}}".
 *
 * The followings are the available columns in table '{{currency}}':
 * @property integer $currency_id
 * @property string $currency_name
 * @property string $currency_code
 * @property string $currency_icon
 * @property string $currency_created
 * @property string $currency_updated
 * @property string $currency_status
 */
class Currency extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{currency}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('currency_name, currency_code', 'required', 'message' => 'Please enter {attribute}.'),
            //array('currency_icon', 'required', 'message' => 'Please select {attribute}.'),
            array('currency_name, currency_code', 'unique', 'message' => 'This {attribute} already exists.'),
            array('currency_name, currency_code', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('currency_id, currency_name, currency_code, currency_created, currency_updated, currency_status', 'safe', 'on' => 'search'),
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
            'currency_id' => 'ID',
            'currency_name' => 'Name',
            'currency_code' => 'Code',
            'currency_icon' => 'Icon',
            'currency_created' => 'Created',
            'currency_updated' => 'Updated',
            'currency_status' => 'Status'
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

        $criteria->compare('currency_id', $this->currency_id);
        $criteria->compare('currency_name', $this->currency_name, true);
        $criteria->compare('currency_code', $this->currency_code, true);
        $criteria->compare('currency_icon', $this->currency_icon, true);
        $criteria->compare('currency_created', $this->currency_created, true);
        $criteria->compare('currency_updated', $this->currency_updated, true);
        $criteria->compare('currency_status', $this->currency_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'currency_order ASC'
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
     * @return Currency the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getCurrencyName($id) {
        $result = Currency::model()->findByPk($id);
        return $result->currency_name;
    }

    public static function getCurrencyNameWithCode($id) {
        $result = Currency::model()->findByPk($id);
        return $result->currency_code . ', ' . $result->currency_name;
    }

    public static function getCurrencyDropdownList() {
        $currencies = Currency::model()->findAll(array('order' => 'currency_order'));
        $result = array();

        if (!empty($currencies)) {
            foreach ($currencies as $currency) {
                $result[$currency->currency_id] = $currency->currency_code . ', ' . $currency->currency_name;
            }
        }

        return $result;
    }

}
