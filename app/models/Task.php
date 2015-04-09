<?php

class Task extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('task_id','task_desc','task_module_type','is_active','created_on','created_by', 'last_updated_on','last_updated_by');

}