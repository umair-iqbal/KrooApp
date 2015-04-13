<?php

class LeagueQuestionOption extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'league_question_options';


    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('league_ques_id','range_start','range_end','potential_points','is_active','created_on','created_by', 'last_updated_on','last_updated_by','option_motiv_text');


}