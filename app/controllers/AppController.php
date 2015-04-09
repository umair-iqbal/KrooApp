<?php

class AppController extends BaseController {

    public $restful = true;

    public function SignUp($name,$password,$email)
    {
        $user = new AppUser;
        echo($name);
        $user->email = $email ;
        $user->password=Hash::make($password);
        $user->name = $name;
        $user->save();
       //return View::make('hello');

        return View::make("AppUser.AppUser",array("data"=> json_encode($user)));
    }

}