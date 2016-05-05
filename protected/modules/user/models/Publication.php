<?php

/**
 * This is the model class for table "{{publication}}".
 *
 * The followings are the available columns in table '{{publication}}':
 * @property integer $publication_id
 * @property integer $publication_customerID
 * @property string $publication_title
 * @property string $publication_publisher
 * @property string $publication_summary
 * @property string $publication_created
 */
class Publication extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{publication}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('publication_title,publication_publisher,publication_summary', 'required'),
			array('publication_customerID', 'numerical', 'integerOnly'=>true),
			array('publication_title, publication_publisher', 'length', 'max'=>500),
			array('publication_summary', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('publication_id, publication_customerID, publication_title, publication_publisher, publication_summary, publication_created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'publication_id' => 'Publication',
			'publication_customerID' => 'Publication Customer',
			'publication_title' => 'Publication Title',
			'publication_publisher' => 'Publication Publisher',
			'publication_summary' => 'Publication Summary',
			'publication_created' => 'Publication Created',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('publication_id',$this->publication_id);
		$criteria->compare('publication_customerID',$this->publication_customerID);
		$criteria->compare('publication_title',$this->publication_title,true);
		$criteria->compare('publication_publisher',$this->publication_publisher,true);
		$criteria->compare('publication_summary',$this->publication_summary,true);
		$criteria->compare('publication_created',$this->publication_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Publication the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
