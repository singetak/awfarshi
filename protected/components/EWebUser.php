<?php

/**
 * EWebUser represents the data needed to identity a user level.
 * It contains the authentication method that checks if the provided
 */
class EWebUser extends CWebUser{
 
    protected $_model;
 
    function isAdmin(){
        $user = $this->loadUser();
        if ($user)
           return $user->roles >= LevelLookUp::ADMIN;
        return false;
    }
    
    function isSuperAdmin(){
        $user = $this->loadUser();
        if ($user)
           return $user->roles == LevelLookUp::SUPERADMIN;
        return false;
    }
    
    function isLevel($level){
        $user = $this->loadUser();
        if ($user)
           return $user->roles >= $level;
        return false;
    }
    
    /**
	 * Check if the current user is the owner.
	 * @param integer $id the ID of the model to be test
	 */
	function isOwner($id)
	{
		return $this->id == $id;
	}
    
    /**
	 * Check if the logged user is higher then current role.
	 * @param integer $role the role of the model to be test
	 */
	function isHigher($role)
	{
		$user = $this->loadUser();
		if ($user)
           return $user->roles > $role;
        return false;
	}
    
    /**
	 * Check if the current user is higher then current in.
	 * @param integer $role the role of the model to be test
	 */
	function isLower($role)
	{
		$user = $this->loadUser();
		if ($user)
           return $user->roles <= $role;
        return false;
	}
    
    // Load user model.
    protected function loadUser()
    {
        if ( $this->_model === null ) {
                $this->_model = Users::model()->findByPk($this->id);
        }
        return $this->_model;
    }
}