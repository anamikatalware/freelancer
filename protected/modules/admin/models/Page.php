<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property integer $page_id
 * @property string $page_name
 * @property string $page_slug
 * @property string $page_description
 * @property string $page_created
 * @property string $page_status
 * 
 */
class Page extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{page}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('page_name, page_slug', 'required', 'message' => 'Please enter {attribute}.'),
            array('page_slug', 'unique', 'message' => 'This Slug is already exists. Please make some changes in it.'),
            array('page_name', 'length', 'max' => 255),
            array('page_slug', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('page_id, page_name, page_slug, page_description, page_created, page_status', 'safe', 'on' => 'search'),
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
            'page_id' => 'ID',
            'page_name' => 'Name',
            'page_slug' => 'Slug',
            'page_description' => 'Page Description',
            'page_created' => 'Created',
            'page_status' => 'Status',
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

        $criteria->compare('page_id', $this->page_id);
        $criteria->compare('page_name', $this->page_name, true);
        $criteria->compare('page_slug', $this->page_slug, true);
        $criteria->compare('page_description', $this->page_description, TRUE);
        $criteria->compare('page_created', $this->page_created, TRUE);
        $criteria->compare('page_status', $this->page_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'page_name ASC'
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
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getPageName($id) {
        $result = Page::model()->findByPk($id);
        return $result->page_name;
    }

    public static function getPageSlug($id) {
        $result = Page::model()->findByPk($id);
        return $result->page_slug;
    }

}
