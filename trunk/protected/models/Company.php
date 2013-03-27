<?php

/**
 * This is the model class for table "{{company}}".
 *
 * The followings are the available columns in table '{{company}}':
 * @property string $company_id
 * @property string $company_name
 * @property integer $company_type
 * @property string $company_address
 * @property string $company_phone
 * @property integer $company_status
 * @property integer $create_date
 * @property integer $last_update_date
 * @property integer $last_update_uid
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{company}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name, company_type, company_status, create_date, last_update_date, last_update_uid', 'required'),
			array('company_type, company_status, create_date, last_update_date, last_update_uid', 'numerical', 'integerOnly'=>true),
			array('company_address, company_phone', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('company_id, company_name, company_type, company_address, company_phone, company_status, create_date, last_update_date, last_update_uid', 'safe', 'on'=>'search'),
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
			'company_id' => 'Company',
			'company_name' => 'Company Name',
			'company_type' => 'Company Type',
			'company_address' => 'Company Address',
			'company_phone' => 'Company Phone',
			'company_status' => 'Company Status',
			'create_date' => 'Create Date',
			'last_update_date' => 'Last Update Date',
			'last_update_uid' => 'Last Update Uid',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_type',$this->company_type);
		$criteria->compare('company_address',$this->company_address,true);
		$criteria->compare('company_phone',$this->company_phone,true);
		$criteria->compare('company_status',$this->company_status);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('last_update_date',$this->last_update_date);
		$criteria->compare('last_update_uid',$this->last_update_uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}