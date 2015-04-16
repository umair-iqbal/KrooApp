<?php

class NotifType extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notif_type';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('notif_type_id','notif_type_desc','is_active','created_on','created_by', 'last_updated_on','last_updated_by');


}