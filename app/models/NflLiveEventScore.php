<?php

class NflLiveEventScore extends \Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nfl_live_event_scores';

    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('event_id','quarter_no','h_points','a_points','h_yards','a_yards','h_pass_yards','a_pass_yards',
        'h_rush_yards','a_rush_yards','h_total_turnovers','a_total_turnovers','h_first_downs','a_first_downs','h_kick_off','a_kick_off',
        'h_punt_return','a_punt_return','h_total_touchdowns','a_total_touchdowns','h_field_goals_made','a_field_goals_made','h_total_fumbles_lost','a_total_fumbles_lost',
        'h_total_interceptions','a_total_interceptions','created_on', 'last_updated_on');


}