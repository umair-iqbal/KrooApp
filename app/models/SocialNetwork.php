<?php

class SocialNetwork extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_networks';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('social_net_id','social_net_name','is_active','created_on','created_by', 'last_updated_on','last_updated_by');

}