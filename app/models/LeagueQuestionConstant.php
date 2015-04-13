<?php

class LeagueQuestionConstant extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'league_question_constants';


    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('constant_id','league_id','constant_desc','is_active','created_on','created_by', 'last_updated_on','last_updated_by');

}