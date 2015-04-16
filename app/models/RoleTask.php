<?php

class RoleTask extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_tasks';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('role_id','task_id','is_active','created_on','created_by', 'last_updated_on','last_updated_by','is_allowed',
        'is_insert_allowed','is_update_allowed','is_select_allowed','is_delete_allowed');

}