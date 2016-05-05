<?php

/**
 * This is the model class for table "{{faqcategory}}".
 *
 * The followings are the available columns in table '{{faqcategory}}':
 * @property integer $faqcategory_id
 * @property string $faqcategory_name 
 * @property string $faqcategory_slug
 * @property string $faqcategory_status
 * @property string $faqcategory_created
 * @property string $faqcategory_order
 */
class FaqCategory extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{faqcategory}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('faqcategory_name, faqcategory_slug', 'required', 'message' => 'Please enter {attribute}.'),
            array('faqcategory_slug', 'unique', 'message' => 'This FAQ Category is already exists.'),
            array('faqcategory_name, faqcategory_slug', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('faqcategory_id, faqcategory_name, faqcategory_slug, faqcategory_created, faqcategory_order, faqcategory_status', 'safe', 'on' => 'search'),
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
            'faqcategory_id' => 'ID',
            'faqcategory_name' => 'Name',
            'faqcategory_slug' => 'Slug',
            'faqcategory_created' => 'Created',
            'faqcategory_order' => 'Order',
            'faqcategory_status' => 'Status'
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

        $criteria->compare('faqcategory_id', $this->faqcategory_id);
        $criteria->compare('faqcategory_name', $this->faqcategory_name, true);
        $criteria->compare('faqcategory_slug', $this->faqcategory_slug, true);
        $criteria->compare('faqcategory_status', $this->faqcategory_status);
        $criteria->compare('faqcategory_order', $this->faqcategory_order);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'faqcategory_order ASC'
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
     * @return FaqCategory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getFaqCategoryName($id) {
        $result = FaqCategory::model()->findByPk($id);
        return $result->faqcategory_name;
    }

}
