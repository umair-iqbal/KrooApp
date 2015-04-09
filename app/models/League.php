<?php

class League extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leagues';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('league_id','league_name','is_active','created_on','created_by', 'last_updated_on','last_updated_by');


}