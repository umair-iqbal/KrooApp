<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
    public $restful = true;

	public function index()
	{
		$users = User::all();
		return View::make('users.index',array("data"=> json_encode($users)));
	}


    /**
     * @param $signUpType
     * @param $data
     * @return mixed
     */

    public function SignUp($signUpType,$data,$name)
    {
        $userP = new UserProfile();
        $signUpType = strtoupper($signUpType);
        $data = json_decode($data,true);

        if($signUpType=='K')
        {

           $user = User::where('user_id',$data['user_id'])->first();
            if($user!=null)
            {
                if(strtoupper($user->is_kroo_signup)=='N'){

                    $user = User::where('user_id',$data['user_id'])->update($data);

                    DB::table('user_profiles')
                        ->where('user_id',$data['user_id'])
                        ->update(array('user_id'=>$data['user_id'],'full_name'=>$name,'is_active'=>'Y','created_on'=>$data['created_on']));


                }
                else {
                    return View::make('users.index', array("data" => 'user already exist'));
                }
            }
            else
            {
                $u =  new User($data);
                $u->save();
                $userP->user_id = $data['user_id'];
                $userP->full_name = $name;
                $userP->is_active = 'Y';
                $userP->created_on = $data['created_on'];
                $userP->save();
                return View::make("Users/Create.show",array("data"=> json_encode($u)));
            }
        }
        else if($signUpType=='S')
        {
            $user = User::where('user_id',$data['user_id'])->first();
            if($user!=null)
            {
                $user = User::where('user_id',$data['user_id'])->update($data);
                DB::table('user_profiles')
                    ->where('user_id',$data['user_id'])
                    ->update(array('user_id'=>$data['user_id'],'full_name'=>$name,'is_active'=>'Y','created_on'=>$data['created_on']));
                return View::make("Users/Create.show",array("data"=> json_encode($data)));
            }
            else
            {

                $u =  new User($data);
                $u->save();
                $userP->user_id = $data['user_id'];
                $userP->full_name = $name;
                $userP->is_active = 'Y';
                $userP->created_on = $data['created_on'];
                $userP->save();
                return View::make("Users/Create.show",array("data"=> json_encode($u)));
            }

        }

    }


    /**
     * @param $signUpType
     * @param $data
     * @param $name
     * @return mixed
     */
    public function SignIn($data)
    {

        $data = json_decode($data,true);

        $userP = new UserProfile();
        $signUpType = strtoupper($data['type']);

        if($signUpType=='K')
        {

            $user = User::where('user_id',$data['email'])->first();
            if($user!=null)
            {
                if($user->user_password==$data['password']){

                    $u = json_encode($user);
                    $userP = UserProfile::where('user_id',$data['email'])->first();
                    $userP = json_encode($userP);
                    return View::make('Users.index', array("data" =>$u.$userP));
                }
                else {
                   // return 'email id or password invalid';
                    return View::make('Users.index', array("data" => 'email id or password invalid'));
                }
            }
            else
            {
                //return 'email id or password invalid';
                return View::make('Users.index', array("data" => 'email id or password invalid'));
            }
        }
        else if($signUpType=='S')
        {
            $user = User::where('user_id',$data['email'])->first();
            if($user!=null)
            {

                $u = json_encode($user);
                $userP = UserProfile::where('user_id',$data['email'])->first();
                $userP = json_encode($userP);
                return View::make('Users.index', array("data" =>$u.$userP));
            }
            else
            {
                return View::make('Users.index', array("data" => 'email id or password invalid'));
            }

        }

    }


	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = DB::table('users')->where('user_id', $id)->first();

		return View::make('users.index', array("data"=> json_encode($user)));
	}


    /**
     * @param $data
     * @return mixed
     */
    public function edit($data)
	{

        $dd = json_decode($data,true);
        $user = User::where('user_id',$dd['user_id'])->update($dd);
        return View::make("Users/Update.show",array("data"=> json_encode($dd)));
	}



	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        DB::table('users')->where('user_id', $id)->delete();

		return View::make('Users/Delete.index',array("data"=>'1'));
	}

}
