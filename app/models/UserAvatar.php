<?php

class UserAvatar extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_avatars';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','user_avatar','is_active','is_current_avatar','created_on', 'last_updated_on','user_avatarscol');
}