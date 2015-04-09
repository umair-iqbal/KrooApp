<?php

class TeamAvatar extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'team_avatars';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('team_id','avatar_id','is_current_avatar','is_active','created_on', 'last_updated_on');

}