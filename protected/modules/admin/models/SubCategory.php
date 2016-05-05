<?php

/**
 * This is the model class for table "{{subcategory}}".
 *
 * The followings are the available columns in table '{{subcategory}}':
 * @property integer $subcategory_id
 * @property string $subcategory_name
 * @property string $subcategory_categoryID
 * @property string $subcategory_created
 * @property string $category_status
 */
class SubCategory extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{subcategory}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('subcategory_name, subcategory_categoryID', 'required', 'message' => 'Please enter {attribute}.'),
            array('subcategory_name', 'unique', 'message' => 'This Sub Category already exists.'),
            array('subcategory_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('subcategory_id, subcategory_name, subcategory_status', 'safe', 'on' => 'search'),
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
            'subcategory_id' => 'ID',
            'subcategory_name' => 'Name',
            'subcategory_categoryID' => 'Category',
            'subcategory_created' => 'Created',
            'subcategory_status' => 'Status'
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

        $criteria->compare('subcategory_id', $this->subcategory_id);
        $criteria->compare('subcategory_name', $this->subcategory_name, true);
        $criteria->compare('subcategory_categoryID', $this->subcategory_categoryID, true);
        $criteria->compare('subcategory_created', $this->subcategory_created, true);
        $criteria->compare('subcategory_status', $this->subcategory_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'subcategory_categoryID, subcategory_name ASC'
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

    public static function getSubCategoryName($id) {
        $result = SubCategory::model()->findByPk($id);
        return $result->subcategory_name;
    }

}
