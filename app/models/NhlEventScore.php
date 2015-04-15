<?php

class NhlEventScore extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nhl_event_scores';

    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('event_id','h_goals','a_goals','h_assists','a_assists','h_points','a_points',
        'h_shot_on_goal','a_shot_on_goal','h_power_plays','a_power_plays','h_penalty_minutes','a_penalty_minutes','h_power_play_goals','a_power_play_goals',
        'h_short_handed_goals','a_short_handed_goals','h_total_faceoffs','a_total_faceoffs','period_no','created_on', 'last_updated_on');


}