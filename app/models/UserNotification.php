<?php

class UserNotification extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_notification';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','notif_type_id','notif_key','is_active','created_on','user_notificationcol');

}