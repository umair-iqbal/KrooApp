<?php

class LeagueQuestion extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'league_questions';


    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('league_id','constant_id','question_text','event_id','is_active','created_on','created_by', 'last_updated_on','last_updated_by');

}