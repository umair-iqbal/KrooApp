<?php

class NotifSetting extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notif_settings';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('notif_setting_id','notif_setting_desc','is_active','created_on','created_by', 'last_updated_on','last_updated_by');

}