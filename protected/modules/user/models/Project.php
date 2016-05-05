<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property integer $project_id
 * @property string $project_name
 * @property integer $project_categoryID
 * @property string $project_isLocal
 * @property string $project_localAddress
 * @property string $project_skills
 * @property string $project_description
 * @property string $project_files
 * @property integer $project_budgetType
 * @property integer $project_currencyID
 * @property integer $project_budgetRangeID
 * @property integer $project_status
 * @property string $project_created
 * @property string $project_updated
 * @property integer $project_customerID
 */
class Project extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{project}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_name, project_description, project_skills', 'required'),
            array('project_categoryID, project_budgetType, project_currencyID, project_budgetRangeID, project_status, project_customerID', 'numerical', 'integerOnly' => true),
            array('project_name', 'length', 'max' => 255),
            array('project_isLocal', 'length', 'max' => 100),
            array('project_localAddress, project_skills, project_description, project_files, project_created, project_updated', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('project_id, project_name, project_categoryID, project_isLocal, project_localAddress, project_skills, project_description, project_files, project_budgetType, project_currencyID, project_budgetRangeID, project_status, project_created, project_updated, project_customerID', 'safe', 'on' => 'search'),
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
            'project_id' => 'ID',
            'project_name' => 'Name',
            'project_categoryID' => 'Category',
            'project_isLocal' => 'Is Local',
            'project_localAddress' => 'Local Address',
            'project_skills' => 'Skills',
            'project_description' => 'Description',
            'project_files' => 'Files',
            'project_budgetType' => 'Budget Type',
            'project_currencyID' => 'Currency',
            'project_budgetRangeID' => 'Budget Range',
            'project_status' => 'Status',
            'project_created' => 'Created',
            'project_updated' => 'Updated',
            'project_customerID' => 'Customer',
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

        $criteria->compare('project_id', $this->project_id);
        $criteria->compare('project_name', $this->project_name, true);
        $criteria->compare('project_categoryID', $this->project_categoryID);
        $criteria->compare('project_isLocal', $this->project_isLocal, true);
        $criteria->compare('project_localAddress', $this->project_localAddress, true);
        $criteria->compare('project_skills', $this->project_skills, true);
        $criteria->compare('project_description', $this->project_description, true);
        $criteria->compare('project_files', $this->project_files, true);
        $criteria->compare('project_budgetType', $this->project_budgetType);
        $criteria->compare('project_currencyID', $this->project_currencyID);
        $criteria->compare('project_budgetRangeID', $this->project_budgetRangeID);
        $criteria->compare('project_status', $this->project_status);
        $criteria->compare('project_created', $this->project_created, true);
        $criteria->compare('project_updated', $this->project_updated, true);
        $criteria->compare('project_customerID', $this->project_customerID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
