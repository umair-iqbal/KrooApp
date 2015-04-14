<?php

class MlbEventScore extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mlb_event_scores';

    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('event_id','h_runs','a_runs','h_pitches','a_pitches','h_balls','a_balls',
        'h_strikes','a_strikes','h_strikes_outs','a_strikes_outs','h_doubles','a_doubles','h_triples','a_triples',
        'h_home_runs','a_home_runs','h_works','a_works','h_errors','a_errors','h_hit_by_pitch','a_hit_by_pitch','h_double_plays','a_double_plays','inning_no',
        'created_on', 'last_updated_on');

}