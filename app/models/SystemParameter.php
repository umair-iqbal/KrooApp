<?php

class SystemParameter extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'system_parameters';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('param_id','param_desc','is_active','created_on','created_by', 'last_updated_on','last_updated_by');


}