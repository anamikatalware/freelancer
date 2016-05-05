<?php

/**
 * This is the model class for table "{{faq}}".
 *
 * The followings are the available columns in table '{{faq}}':
 * @property integer $faq_id 
 * @property string $faq_faqcategoryID
 * @property string $faq_question
 * @property string $faq_answer
 * @property string $faq_created
 * @property string $faq_status
 */
class Faq extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{faq}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('faq_faqcategoryID', 'required', 'message' => 'Please select {attribute}.'),
            array('faq_question', 'required', 'message' => 'Please enter {attribute}.'),
            array('faq_question', 'length', 'max' => 1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('faq_id, faq_faqcategoryID, faq_question, faq_answer, faq_status, faq_created', 'safe', 'on' => 'search'),
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
            'faq_id' => 'ID',
            'faq_faqcategoryID' => 'Category',
            'faq_question' => 'Question',
            'faq_answer' => 'Answer',
            'faq_status' => 'Status',
            'faq_created' => 'Created'
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

        $criteria->compare('faq_id', $this->faq_id);
        $criteria->compare('faq_faqcategoryID', $this->faq_faqcategoryID);
        $criteria->compare('faq_question', $this->faq_question, true);
        $criteria->compare('faq_answer', $this->faq_answer, true);
        $criteria->compare('faq_created', $this->faq_created, true);
        $criteria->compare('faq_status', $this->faq_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'faq_faqcategoryID, faq_question ASC'
            ),
            'Pagination' => array(
                'PageSize' => 25
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Faq the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
