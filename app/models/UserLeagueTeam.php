<?php

class UserTeam extends \Eloquent {



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_league_teams';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','team_id','is_active','created_on','last_updated_on');

}