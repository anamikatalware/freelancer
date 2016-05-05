<?php

/**
 * This is the model class for table "{{budget}}".
 *
 * The followings are the available columns in table '{{budget}}':
 * @property integer $budget_id
 * @property integer $budget_budgettypeID
 * @property integer $budget_currencyID
 * @property string $budget_name
 * @property string $budget_max_value
 * @property string $budget_min_value
 * @property string $budget_order
 * @property string $budget_created
 * @property string $budget_updated
 * @property string $budget_status
 */
class Budget extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{budget}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('budget_budgettypeID, budget_currencyID, budget_name, budget_min_value', 'required', 'message' => 'Please enter {attribute}.'),
            array('budget_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('budget_id, budget_budgettypeID, budget_currencyID, budget_name, budget_max_value, budget_min_value, budget_order, budget_created, budget_updated, budget_status', 'safe', 'on' => 'search'),
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
            'budget_id' => 'ID',
            'budget_budgettypeID' => 'Budget Type',
            'budget_currencyID' => 'Currency',
            'budget_name' => 'Name',
            'budget_min_value' => 'Min Value',
            'budget_max_value' => 'Max Value',
            'budget_order' => 'Order',
            'budget_created' => 'Created',
            'budget_updated' => 'Updated',
            'budget_status' => 'Status'
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

        $criteria->compare('budget_id', $this->budget_id);
        $criteria->compare('budget_budgettypeID', $this->budget_budgettypeID);
        $criteria->compare('budget_currencyID', $this->budget_currencyID);
        $criteria->compare('budget_name', $this->budget_name, true);
        $criteria->compare('budget_min_value', $this->budget_min_value, true);
        $criteria->compare('budget_max_value', $this->budget_max_value, true);
        $criteria->compare('budget_created', $this->budget_created, true);
        $criteria->compare('budget_updated', $this->budget_updated, true);
        $criteria->compare('budget_status', $this->budget_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'budget_budgettypeID ASC, budget_currencyID ASC, budget_order ASC'
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

    public static function getBudgetName($id) {
        $result = Budget::model()->findByPk($id);
        return $result->budget_name;
    }

}
