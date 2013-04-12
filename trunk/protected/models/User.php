<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $user_id
 * @property string $user_name
 * @property string $real_name
 * @property integer $user_type
 * @property string $email
 * @property integer $phone
 * @property string $user_desc
 * @property string $password
 * @property string $password_salt
 * @property integer $create_uid
 * @property string $create_uname
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $update_uid
 * @property integer $group_id
 * @property integer $role_id
 * @property integer $company_id
 * @property string $is_deleted
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_type, email, password, password_salt, create_uid, create_uname, create_date, group_id, role_id, company_id', 'required'),
			array('user_type, phone, create_uid, create_date, update_date, update_uid, group_id, role_id, company_id', 'numerical', 'integerOnly'=>true),
			array('user_name, email, user_desc, password, password_salt, create_uname', 'length', 'max'=>255),
			array('real_name', 'length', 'max'=>60),
			array('is_deleted', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, user_name, real_name, user_type, email, phone, user_desc, password, password_salt, create_uid, create_uname, create_date, update_date, update_uid, group_id, role_id, company_id, is_deleted', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'user_name' => 'User Name',
			'real_name' => 'Real Name',
			'user_type' => 'User Type',
			'email' => 'Email',
			'phone' => 'Phone',
			'user_desc' => 'User Desc',
			'password' => 'Password',
			'password_salt' => 'Password Salt',
			'create_uid' => 'Create Uid',
			'create_uname' => 'Create Uname',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'update_uid' => 'Update Uid',
			'group_id' => 'Group',
			'role_id' => 'Role',
			'company_id' => 'Company',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('real_name',$this->real_name,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('user_desc',$this->user_desc,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('password_salt',$this->password_salt,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_uname',$this->create_uname,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('update_uid',$this->update_uid);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}