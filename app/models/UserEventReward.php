<?php

class UserEventReward extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_event_rewards';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','event_id','game_level','user_rank','live_points', 'last_updated_on');

}