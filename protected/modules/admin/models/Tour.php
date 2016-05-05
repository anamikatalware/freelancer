<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $tour_id
 * @property string $tour_name
 * @property string $tour_slug
 * @property string $tour_image
 * @property string $tour_amount
 * @property string $tour_duration
 * @property string $tour_overview
 * @property string $tour_gallery
 * @property string $tour_categoryID
 * @property string $tour_created
 * @property string $tour_status
 * @property string $tour_is_private
 * @property string $tour_is_bestSeller
 */
class Tour extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{tour}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tour_name, tour_amount, tour_duration', 'required', 'message' => 'Please enter {attribute}.'),
            array('tour_slug', 'unique', 'message' => 'This Slug is already exists. Please make some changes in it.'),
            array('tour_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('tour_id, tour_name, tour_slug, tour_amount, tour_duration, tour_overview, tour_categoryID, tour_created, tour_status', 'safe', 'on' => 'search'),
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
            'tour_id' => 'ID',
            'tour_name' => 'Name',
            'tour_slug' => 'Slug',
            'tour_image' => 'Featured Image',
            'tour_amount' => 'Tour Amount',
            'tour_duration' => 'Tour Duration',
            'tour_overview' => 'Tour Overview',
            'tour_gallery' => 'Gallery',
            'tour_categoryID' => 'Category',
            'tour_status' => 'Status',
            'tour_is_private' => 'Private',
            'tour_is_bestSeller' => 'Best Seller',
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

        $criteria->compare('tour_id', $this->tour_id);
        $criteria->compare('tour_name', $this->tour_name, true);
        $criteria->compare('tour_slug', $this->tour_slug, true);
        $criteria->compare('tour_is_private', $this->tour_is_private);
        $criteria->compare('tour_is_bestSeller', $this->tour_is_bestSeller);
        $criteria->compare('tour_status', $this->tour_status);
        $criteria->compare('tour_created', $this->tour_created, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'tour_name ASC'
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

    public static function getTourName($id) {
        $result = Tour::model()->findByPk($id);
        return $result->tour_name;
    }

    public static function getTourSlug($id) {
        $result = Tour::model()->findByPk($id);
        return $result->tour_slug;
    }

}
