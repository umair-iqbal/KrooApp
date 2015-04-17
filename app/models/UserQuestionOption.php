<?php

class UserQuestionOption extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_question_options';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','option_id','event_id','event_level','selected_on','is_selection_correct');


}