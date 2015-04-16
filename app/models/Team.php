<?php

class Team extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teams';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('team_id','league_id','api_team_id','is_active','is_pass_changed','created_on','last_login_date', 'last_updated_on','team_password');


}