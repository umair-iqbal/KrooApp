<?php

class UserEvent extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_events';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','event_id','is_active','is_attended','is_played','created_on', 'last_updated_on');
}