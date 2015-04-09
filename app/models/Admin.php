<?php

class Admin extends \Eloquent {



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('admin_id','admin_password','is_active','created_on','last_login_date',
        'last_updated_on');


}