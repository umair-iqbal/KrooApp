<?php

class NbaEvent extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nba_events';


    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('event_id','season_id','season_year','season_type','league_id','status', 'home_team_id','away_team_id','venue_id',
        'venue_name','venue_city','venue_country','venue_zip','venue_state','is_active','created_on','schedduled_on', 'last_update_on');

}