<?php

class NbaEventScore extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nba_event_scores';

    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('event_id','h_points','a_points','h_assists','a_assists','h_rebounds','a_rebounds',
        'h_blocks','a_blocks','h_steals','a_steals','h_turnovers','a_turnovers','h_3pointers_made','a_3pointers_made',
        'h_3pointers_attempt','a_3pointers_attempt','h_foul_shots_made','a_foul_shots_made','h_foul_shots_attempt','a_foul_shots_attempt','quarter_no',
        'created_on', 'last_updated_on');


}