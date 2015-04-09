<?php

class TeamProfile extends \Eloquent {

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
    protected $fillable = array('team_id','email','phone_no','is_active','created_on', 'last_updated_on');


}