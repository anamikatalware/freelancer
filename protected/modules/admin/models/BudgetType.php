<?php

/**
 * This is the model class for table "{{budgettype}}".
 *
 * The followings are the available columns in table '{{budgettype}}':
 * @property integer $budgettype_id
 * @property string $budgettype_name
 * @property string $budgettype_slug
 * @property string $budgettype_description
 * @property string $budgettype_created
 * @property string $budgettype_updated
 * @property string $budgettype_status
 */
class BudgetType extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{budgettype}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('budgettype_name, budgettype_slug', 'required', 'message' => 'Please enter {attribute}.'),
            array('budgettype_name, budgettype_slug', 'unique', 'message' => 'This {attribute} already exists.'),
            array('budgettype_name, budgettype_slug', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('budgettype_id, budgettype_name, budgettype_slug, budgettype_created, budgettype_updated, budgettype_status', 'safe', 'on' => 'search'),
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
            'budgettype_id' => 'ID',
            'budgettype_name' => 'Name',
            'budgettype_slug' => 'Slug',
            'budgettype_description' => 'Description',
            'budgettype_created' => 'Created',
            'budgettype_updated' => 'Updated',
            'budgettype_status' => 'Status'
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
        // @todo Please modify the following slug to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('budgettype_id', $this->budgettype_id);
        $criteria->compare('budgettype_name', $this->budgettype_name, true);
        $criteria->compare('budgettype_slug', $this->budgettype_slug, true);
        $criteria->compare('budgettype_created', $this->budgettype_created, true);
        $criteria->compare('budgettype_updated', $this->budgettype_updated, true);
        $criteria->compare('budgettype_status', $this->budgettype_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'budgettype_name ASC'
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
     * @return BudgetType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getBudgetTypeName($id) {
        $result = BudgetType::model()->findByPk($id);
        return $result->budgettype_name;
    }

}
