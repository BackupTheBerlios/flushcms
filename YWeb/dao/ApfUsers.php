<?php
/**
 * Table Definition for apf_users
 */
class DaoApfUsers extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'apf_users';                       // table name
    var $id;                              // int(11)  not_null primary_key auto_increment
    var $user_name;                       // string(60)  
    var $user_pwd;                        // string(50)  
    var $gender;                          // string(8)  
    var $addrees;                         // string(150)  
    var $phone;                           // string(80)  
    var $email;                           // string(80)  
    var $photo;                           // string(80)  
    var $role_id;                         // int(8)  
    var $active;                          // string(8)  not_null
    var $add_ip;                          // string(24)  
    var $created_at;                      // datetime(19)  not_null
    var $update_at;                       // datetime(19)  not_null

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) 
	{
		return DB_DataObject::staticGet('DaoApfUsers',$k,$v);
	}


   /**
    * Getter for $Id
    *
    * @return   int
    * @access   public
    */
    function getId() 
    {
        return $this->id;
    }

   /**
    * Getter for $UserName
    *
    * @return   string
    * @access   public
    */
    function getUserName() 
    {
        return $this->user_name;
    }

   /**
    * Getter for $UserPwd
    *
    * @return   string
    * @access   public
    */
    function getUserPwd() 
    {
        return $this->user_pwd;
    }

   /**
    * Getter for $Gender
    *
    * @return   string
    * @access   public
    */
    function getGender() 
    {
        return $this->gender;
    }

   /**
    * Getter for $Addrees
    *
    * @return   string
    * @access   public
    */
    function getAddrees() 
    {
        return $this->addrees;
    }

   /**
    * Getter for $Phone
    *
    * @return   string
    * @access   public
    */
    function getPhone() 
    {
        return $this->phone;
    }

   /**
    * Getter for $Email
    *
    * @return   string
    * @access   public
    */
    function getEmail() 
    {
        return $this->email;
    }

   /**
    * Getter for $Photo
    *
    * @return   string
    * @access   public
    */
    function getPhoto() 
    {
        return $this->photo;
    }

   /**
    * Getter for $RoleId
    *
    * @return   int
    * @access   public
    */
    function getRoleId() 
    {
        return $this->role_id;
    }

   /**
    * Getter for $Active
    *
    * @return   string
    * @access   public
    */
    function getActive() 
    {
        return $this->active;
    }

   /**
    * Getter for $AddIp
    *
    * @return   string
    * @access   public
    */
    function getAddIp() 
    {
        return $this->add_ip;
    }

   /**
    * Getter for $CreatedAt
    *
    * @return   datetime
    * @access   public
    */
    function getCreatedAt() 
    {
        return $this->created_at;
    }

   /**
    * Getter for $UpdateAt
    *
    * @return   datetime
    * @access   public
    */
    function getUpdateAt() 
    {
        return $this->update_at;
    }


   /**
    * Setter for $Id
    *
    * @param    mixed   input value
    * @access   public
    */
    function setId($value) 
    {
        $this->id = $value;
    }

   /**
    * Setter for $UserName
    *
    * @param    mixed   input value
    * @access   public
    */
    function setUserName($value) 
    {
        $this->user_name = $value;
    }

   /**
    * Setter for $UserPwd
    *
    * @param    mixed   input value
    * @access   public
    */
    function setUserPwd($value) 
    {
        $this->user_pwd = $value;
    }

   /**
    * Setter for $Gender
    *
    * @param    mixed   input value
    * @access   public
    */
    function setGender($value) 
    {
        $this->gender = $value;
    }

   /**
    * Setter for $Addrees
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAddrees($value) 
    {
        $this->addrees = $value;
    }

   /**
    * Setter for $Phone
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPhone($value) 
    {
        $this->phone = $value;
    }

   /**
    * Setter for $Email
    *
    * @param    mixed   input value
    * @access   public
    */
    function setEmail($value) 
    {
        $this->email = $value;
    }

   /**
    * Setter for $Photo
    *
    * @param    mixed   input value
    * @access   public
    */
    function setPhoto($value) 
    {
        $this->photo = $value;
    }

   /**
    * Setter for $RoleId
    *
    * @param    mixed   input value
    * @access   public
    */
    function setRoleId($value) 
    {
        $this->role_id = $value;
    }

   /**
    * Setter for $Active
    *
    * @param    mixed   input value
    * @access   public
    */
    function setActive($value) 
    {
        $this->active = $value;
    }

   /**
    * Setter for $AddIp
    *
    * @param    mixed   input value
    * @access   public
    */
    function setAddIp($value) 
    {
        $this->add_ip = $value;
    }

   /**
    * Setter for $CreatedAt
    *
    * @param    mixed   input value
    * @access   public
    */
    function setCreatedAt($value) 
    {
        $this->created_at = $value;
    }

   /**
    * Setter for $UpdateAt
    *
    * @param    mixed   input value
    * @access   public
    */
    function setUpdateAt($value) 
    {
        $this->update_at = $value;
    }


    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'user_name' =>  DB_DATAOBJECT_STR,
             'user_pwd' =>  DB_DATAOBJECT_STR,
             'gender' =>  DB_DATAOBJECT_STR,
             'addrees' =>  DB_DATAOBJECT_STR,
             'phone' =>  DB_DATAOBJECT_STR,
             'email' =>  DB_DATAOBJECT_STR,
             'photo' =>  DB_DATAOBJECT_STR,
             'role_id' =>  DB_DATAOBJECT_INT,
             'active' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_NOTNULL,
             'add_ip' =>  DB_DATAOBJECT_STR,
             'created_at' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
             'update_at' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME + DB_DATAOBJECT_NOTNULL,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('id', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'user_name' => '',
             'user_pwd' => '',
             'gender' => '',
             'addrees' => '',
             'phone' => '',
             'email' => '',
             'photo' => '',
             'active' => 'new',
             'add_ip' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function validateUser_name()
    {
        return empty($this->user_name)?false:true;
    }
}
