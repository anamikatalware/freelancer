<?php

/**
 * This is the model class for table "{{template}}".
 *
 * The followings are the available columns in table '{{template}}':
 * @property integer $template_id
 * @property string $template_alias
 * @property string $template_title
 * @property string $template_subject
 * @property string $template_content
 * @property string $template_parameters 
 * @property string $template_created
 * @property integer $template_status
 *
 * The followings are the available model relations:
 * @property TemplateCategory $templateCategory
 */
class Template extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{template}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('template_alias, template_title, template_subject', 'required', 'message' => 'Please enter {attribute}.'),
            array('template_status', 'numerical', 'integerOnly' => true),
            array('template_alias, template_title', 'length', 'max' => 255),
            array('template_subject, template_parameters', 'length', 'max' => 500),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('template_id, template_alias, template_title, template_subject, template_content, template_parameters, template_created, template_status', 'safe', 'on' => 'search'),
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
            'template_id' => 'ID',
            'template_alias' => 'Slug',
            'template_title' => 'Title',
            'template_subject' => 'Subject',
            'template_content' => 'Content',
            'template_parameters' => 'Parameters',
            'template_created' => 'Created Date',
            'template_status' => 'Status',
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

        $criteria->compare('template_id', $this->template_id);
        $criteria->compare('template_alias', $this->template_alias, true);
        $criteria->compare('template_title', $this->template_title, true);
        $criteria->compare('template_subject', $this->template_subject, true);
        $criteria->compare('template_content', $this->template_content, true);
        $criteria->compare('template_parameters', $this->template_parameters, true);
        $criteria->compare('template_created', $this->template_created, true);
        $criteria->compare('template_status', $this->template_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'template_title ASC'
            ),
            'Pagination' => array(
                'PageSize' => 50
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Template the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
