<?php

/**
 * This is the model class for table "{{portfolio}}".
 *
 * The followings are the available columns in table '{{portfolio}}':
 * @property integer $portfolio_id
 * @property string $portfolio_content_type
 * @property string $portfolio_title
 * @property string $portfolio_description
 * @property string $portfolio_files
 * @property string $portfolio_other_description
 * @property string $portfolio_skills
 * @property integer $portfolio_status
 * @property string $portfolio_created
 * @property string $portfolio_updated
 */
class Portfolio extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{portfolio}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('portfolio_content_type, portfolio_title, portfolio_description, portfolio_files, portfolio_skills', 'required'),
            array('portfolio_status', 'numerical', 'integerOnly' => true),
            array('portfolio_content_type', 'length', 'max' => 55),
            array('portfolio_title', 'length', 'max' => 256),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('portfolio_id, portfolio_content_type, portfolio_title, portfolio_description, portfolio_files, portfolio_other_description, portfolio_skills, portfolio_status, portfolio_created, portfolio_updated', 'safe', 'on' => 'search'),
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
            'portfolio_id' => 'ID',
            'portfolio_content_type' => 'Content Type',
            'portfolio_title' => 'Title',
            'portfolio_description' => 'Item Description',
            'portfolio_files' => 'Upload Files',
            'portfolio_other_description' => 'Other Description',
            'portfolio_skills' => 'Skills',
            'portfolio_status' => 'Status',
            'portfolio_created' => 'Created',
            'portfolio_updated' => 'Updated',
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

        $criteria->compare('portfolio_id', $this->portfolio_id);
        $criteria->compare('portfolio_content_type', $this->portfolio_content_type, true);
        $criteria->compare('portfolio_title', $this->portfolio_title, true);
        $criteria->compare('portfolio_description', $this->portfolio_description, true);
        $criteria->compare('portfolio_files', $this->portfolio_files, true);
        $criteria->compare('portfolio_other_description', $this->portfolio_other_description, true);
        $criteria->compare('portfolio_skills', $this->portfolio_skills, true);
        $criteria->compare('portfolio_status', $this->portfolio_status);
        $criteria->compare('portfolio_created', $this->portfolio_created, true);
        $criteria->compare('portfolio_updated', $this->portfolio_updated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Portfolio the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
