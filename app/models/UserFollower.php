<?php

class UserFollower extends \Eloquent {



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_followers';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','follower_id','followed_on','is_active','last_updated_on');

}