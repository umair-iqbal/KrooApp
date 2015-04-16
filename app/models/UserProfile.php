<?php

class UserProfile extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','full_name','phone_no','dob','country','gender','is_active','created_on','last_updated_on');

}