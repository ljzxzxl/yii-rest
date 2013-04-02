<?php

/**
 * This is the model class for table "{{pref}}".
 *
 * The followings are the available columns in table '{{pref}}':
 * @property string $pref_id
 * @property string $pref_key
 * @property string $pref_name
 * @property string $pref_value
 * @property integer $user_id
 */
class Pref extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pref the static model class
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
		return '{{pref}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pref_key, pref_name, pref_value, user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('pref_key, pref_name, pref_value', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pref_id, pref_key, pref_name, pref_value, user_id', 'safe', 'on'=>'search'),
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
			'pref_id' => 'Pref',
			'pref_key' => 'Pref Key',
			'pref_name' => 'Pref Name',
			'pref_value' => 'Pref Value',
			'user_id' => 'User',
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

		$criteria->compare('pref_id',$this->pref_id,true);
		$criteria->compare('pref_key',$this->pref_key,true);
		$criteria->compare('pref_name',$this->pref_name,true);
		$criteria->compare('pref_value',$this->pref_value,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}