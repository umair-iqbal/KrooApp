<?php

class LeagueTeam extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'league_teams';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('team_id','team_name','team_abbr','division_id','division_name','venue','city','country','league_id','is_active','created_on', 'last_updated_on');

}