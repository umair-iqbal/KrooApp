<?php

class LeagueGameLevel extends \Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'League_game_levels';



    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public  $timestamps = false;
    protected $fillable = array('league_id','level_no','level_desc','is_active','created_on');

}