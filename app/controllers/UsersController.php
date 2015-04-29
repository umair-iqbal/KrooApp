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
    public function SignUp($signUpType,$data)
    {
        $signUpType = strtoupper($signUpType);
        $data = json_decode($data,true);
        if($signUpType=='K')
        {

           $user = User::where('user_id',$data['user_id'])->first();
            if($user!=null)
            {
                if(strtoupper($user->is_kroo_signup)=='N'){

                    edit($data);
                }
                else {
                    return View::make('users.index', array("data" => 'user already exist'));
                }
            }
            else
            {
                $u =  new User($data);
                $u->save();
                return View::make("Users/Create.show",array("data"=> json_encode($u)));
            }
        }
        else if($signUpType=='S')
        {
            $user = User::where('user_id',$data['user_id'])->first();
            if($user!=null)
            {
                $user = User::where('user_id',$data['user_id'])->update($data);
                return View::make("Users/Create.show",array("data"=> json_encode($data)));
            }
            else
            {

                $u =  new User($data);
                $u->save();
                return View::make("Users/Create.show",array("data"=> json_encode($u)));
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
