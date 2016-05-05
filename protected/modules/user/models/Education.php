<?php

/**
 * This is the model class for table "{{education}}".
 *
 * The followings are the available columns in table '{{education}}':
 * @property integer $education_id
 * @property integer $education_customerID
 * @property integer $education_countryID
 * @property string $education_university
 * @property string $education_degree
 * @property integer $education_startyear
 * @property integer $education_endyear
 * @property string $education_created
 */
class Education extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{education}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('education_customerID,education_university,education_degree,education_countryID,education_startyear,education_endyear', 'required'),
			array('education_customerID, education_countryID, education_startyear, education_endyear', 'numerical', 'integerOnly'=>true),
			array('education_university, education_degree', 'length', 'max'=>255),
			array('education_created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('education_id, education_customerID, education_countryID, education_university, education_degree, education_startyear, education_endyear, education_created', 'safe', 'on'=>'search'),
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
			'education_id' => 'Education',
			'education_customerID' => 'Education Customer',
			'education_countryID' => 'Education Country',
			'education_university' => 'Education University',
			'education_degree' => 'Education Degree',
			'education_startyear' => 'Education Startyear',
			'education_endyear' => 'Education Endyear',
			'education_created' => 'Education Created',
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

		$criteria->compare('education_id',$this->education_id);
		$criteria->compare('education_customerID',$this->education_customerID);
		$criteria->compare('education_countryID',$this->education_countryID);
		$criteria->compare('education_university',$this->education_university,true);
		$criteria->compare('education_degree',$this->education_degree,true);
		$criteria->compare('education_startyear',$this->education_startyear);
		$criteria->compare('education_endyear',$this->education_endyear);
		$criteria->compare('education_created',$this->education_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Education the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
