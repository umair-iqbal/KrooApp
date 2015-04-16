<?php

class UserSocailNetwork extends \Eloquent {



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_socail_networks';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('user_id','social_net_id','is_active','last_updated_on','is_notif_allowed');

}