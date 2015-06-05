<?php
class UserEmailCode extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_email_codes';


    /**
     * Fillable for defining column for masss assignment.
     * @var array
     */

    public $timestamps = false;
    protected $fillable = array('user_email_code', 'user_id', 'is_latest',  'created_on');
}