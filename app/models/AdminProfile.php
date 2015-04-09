<?php

class AdminProfile extends \Eloquent {



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_profiles';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('admin_id','full_name','phone','dob','country','gender','is_active','created_on', 'last_updated_on');

}