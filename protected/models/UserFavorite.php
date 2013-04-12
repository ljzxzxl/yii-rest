<?php

/**
 * This is the model class for table "{{user_favorite}}".
 *
 * The followings are the available columns in table '{{user_favorite}}':
 * @property string $id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $file_id
 * @property string $memo
 * @property integer $create_date
 * @property string $is_deleted
 */
class UserFavorite extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFavorite the static model class
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
		return '{{user_favorite}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, user_name, file_id, memo, create_date', 'required'),
			array('user_id, file_id, create_date', 'numerical', 'integerOnly'=>true),
			array('user_name, memo', 'length', 'max'=>255),
			array('is_deleted', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, user_name, file_id, memo, create_date, is_deleted', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'user_id' => 'User',
			'user_name' => 'User Name',
			'file_id' => 'File',
			'memo' => 'Memo',
			'create_date' => 'Create Date',
			'is_deleted' => 'Is Deleted',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}