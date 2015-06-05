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
		return View::make('Users.index',array("data"=> json_encode($users)));
	}


    /**
     * @param $signUpType
     * @param $data
     * @return mixed
     */

    public function SignUp()
    {

        $data = Input::all();

        if($data!=null) {
            $name = $data['name'];
            $signUpType = strtoupper($data['type']);
            $userP = new UserProfile();
            $signUpType = strtoupper($signUpType);
            $data['is_active'] = 'Y';
            $data['role_id'] = 'krooregular';
            $data['type'] = strtoupper($data['type']);
            $data['is_pass_changed'] = 'N';

            if ($signUpType == 'K') {


                $user = User::where('user_id', $data['user_id'])->first();
                if ($user != null) {
                    $data['is_kroo_signup'] = 'Y';
                    if (strtoupper($user->is_kroo_signup) == 'N') {

                        User::where('user_id', $data['user_id'])->update(array('user_id'=> $data['user_id'],'is_kroo_signup'=>$data['is_kroo_signup'],'user_password'=>$data['user_password']));

                        DB::table('user_profiles')
                            ->where('user_id', $data['user_id'])
                            ->update(array('user_id' => $data['user_id'], 'full_name' => $name, 'is_active' => 'Y', 'created_on' => $data['created_on']));
                        //return View::make('users.index', array("data" => 'Success :' .$user));
                        $user = User::where('user_id', $data['user_id'])->first();
                        return Response::json(array('status' => 200, 'datajson' => $user));


                    } else {
                        return Response::json(array('status' => 200, 'datajson' => 'user already exist.'));

                    }
                } else {
                    $data['is_kroo_signup'] = 'Y';
                    $u = new User($data);
                    $u->save();

                    $userP->user_id = $data['user_id'];
                    $userP->full_name = $name;
                    $userP->is_active = 'Y';
                    $userP->created_on = $data['created_on'];
                    $userP->save();
                    $user = User::where('user_id', $data['user_id'])->first();
                    return Response::json(array('status' => 200, 'datajson' => $user));
                }
            } else if ($signUpType == 'S') {
                $user = User::where('user_id', $data['user_id'])->first();
                if ($user != null) {
                    User::where('user_id', $data['user_id'])->update(array('user_id'=> $data['user_id'],'user_password'=>$data['user_password']));
                    DB::table('user_profiles')
                        ->where('user_id', $data['user_id'])
                        ->update(array('user_id' => $data['user_id'], 'full_name' => $name, 'is_active' => 'Y', 'created_on' => $data['created_on']));
                    $user = User::where('user_id', $data['user_id'])->first();
                    return Response::json(array('status' => 200, 'datajson' => $user));
                } else {

                    $data['is_kroo_signup'] = 'N';
                    $u = new User($data);
                    $u->save();
                    $userP->user_id = $data['user_id'];
                    $userP->full_name = $name;
                    $userP->is_active = 'Y';
                    $userP->created_on = $data['created_on'];
                    $userP->save();
                    $user = User::where('user_id', $data['user_id'])->first();
                    return Response::json(array('status' => 200, 'datajson' => $user));
                }

            }
        }
        else{
            return Response::json(array('status' => 203, 'datajson' => 'invalid querry string'));
        }

    }


    /**
     * @param $signUpType
     * @param $data
     * @param $name
     * @return mixed
     */
    public function SignIn()
    {

        $data = Input::all();
        if($data!=null) {
            $signUpType = strtoupper($data['type']);

            if ($signUpType == 'K') {

                $user = User::where('user_id', $data['email'])->first();
                if ($user != null) {
                    if ($user->user_password == $data['password']) {


                        $userP = UserProfile::where('user_id', $data['email'])->first();

                        $final = array('sr_no' => $user->sr_no, 'user_id' => $user->user_id, 'user_category'=> $user->user_category, 'role_id' => $user->role_id,
                            'user_password' => $user->user_password, 'is_active' => $user->is_active, 'is_pass_changed' => $user->is_pass_changed, 'is_kroo_signup' => $user->is_kroo_signup,
                            'potential_points' => $user->potential_points, 'global_rank' => $user->global_rank, 'created_on' => $user->created_on, 'last_login_date' => $user->last_login_date,
                            'last_updated_on' => $user->last_updated_on, 'full_name' => $userP->full_name, 'phone_no' => $userP->phone_no, 'dob' => $user->dob, 'country' => $userP->country,
                            'gender' => $userP->gender);


                        return Response::json(array('status' => 200, 'datajson' => $final));

                    } else {
                        // return 'email id or password invalid';

                        return Response::json(array('status' => 200, 'datajson' => 'email id or password invalid'));
                    }
                } else {
                    //return 'email id or password invalid';
                    return Response::json(array('status' => 200, 'datajson' => 'email id or password invalid'));
                }
            } else if ($signUpType == 'S') {
                $user = User::where('user_id', $data['email'])->first();
                if ($user != null) {
                    $userP = UserProfile::where('user_id', $data['email'])->first();

                    $final = array('sr_no' => $user->sr_no, 'user_id' => $user->user_id, 'user_category'=> $user->user_category, 'role_id' => $user->role_id,
                        'user_password' => $user->user_password, 'is_active' => $user->is_active, 'is_pass_changed' => $user->is_pass_changed, 'is_kroo_signup' => $user->is_kroo_signup,
                        'potential_points' => $user->potential_points, 'global_rank' => $user->global_rank, 'created_on' => $user->created_on, 'last_login_date' => $user->last_login_date,
                        'last_updated_on' => $user->last_updated_on, 'full_name' => $userP->full_name, 'phone_no' => $userP->phone_no, 'dob' => $user->dob, 'country' => $userP->country,
                        'gender' => $userP->gender);
                    return Response::json(array('status' => 200, 'datajson' => $final));
                } else {
                    return Response::json(array('status' => 200, 'datajson' => 'email id or password invalid'));
                }

            }
        }
        else
        {
            return Response::json(array('status' => 203, 'datajson' => 'invalid query string'));
        }

    }


    public function forgetPass()
    {
        $data = Input::all();
        if ($data != null) {


            $dt = new DateTime();

            $user = User::where('user_id', $data['user_id'])->first();
            if ($user != null) {
                $rand = substr(md5(microtime()),rand(0,26),5);
                //echo $rand;
                $userCode = new UserEmailCode();
                $userCode->user_id = $data['user_id'];
                $userCode->user_email_code = $rand;
                $userCode->is_latest = 'Y';
                $userCode->created_on =$dt;
                $userCode->save();

                Mail::send('Email.index',array('code'=>'Code : '.$rand ), function($message) {
                    $data2 = Input::all();
                    $message->to($data2['user_id'] , '')->subject('Password reset code.');
                });


                return Response::json(array('status' => 200, 'datajson' => null,'status_message'=>'email sent.'));
            } else {
                //return 'email id or password invalid';
                return Response::json(array('status' => 200, 'datajson' => null,'status_message'=>'user not exist.'));
            }

        }
        else
        {
            return Response::json(array('status' => 203, 'datajson' => null,'status_message'=>'invalid querry string.'));
        }
    }



    public function resetPass()
    {



        $data = Input::all();
        if ($data != null) {

            $user = User::where('user_id', $data['user_id'])->first();
            if ($user != null) {


                $match = ['user_id' => $data['user_id'], 'user_email_code' => $data['code']];
                $user_email = UserEmailCode::where($match)->first();

                if($user_email!=null) {
                    DB::table('user_email_codes')
                        ->where($match)
                        ->update(array('is_latest' => 'N'));

                    DB::table('users')
                        ->where('user_id',$data['user_id'])
                        ->update(array('user_password' => $data['password']));

                    $response = file_get_contents('http://localhost/KrooApp/public/index.php/user_profiles/GetUserProfile?user_id='.$data['user_id']);
                    $response = json_decode($response);
                    $response->status_message = 'password reset.';
                    return Response::json(array($response));

                }
                else
                {
                    return Response::json(array('status' => 200, 'datajson' =>null,'status_message'=> 'Invalid Code'));
                }
                
            } else {
                //return 'email id or password invalid';
                return Response::json(array('status' => 200, 'datajson' => null,'status_message'=>'user not exist'));
            }

        }
        else
        {
            return Response::json(array('status' => 203, 'datajson' => null,'status_message'=>'invalid query string'));
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


    public function image($data1,$d)
    {
        $output_file = public_path()."\\s.jpg";
        // requires php5
      //  define($output_file, 'images/');

        $data1 = "iVBORw0KGgoAAAANSUhEUgAAAaEAAAEfCAIAAABnCu6QAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAEnQAABJ0Ad5mH3gAABzjSURBVHhe7d0hUPPIH8bxVyJPIpGVSCQSiUQikcg61A0S2XOVnGPmTGf+5pVIZGXnVM8hkfd/ht33N3tJCUm6u0k234+iaWnSNHn6280m+fEvAJSLjANQMjIOQMnIOAAlI+MAlIyMA1AyMg5Aycg4ACUj4wCUjIwDUDIyDkDJyDgAJSPjAJSMjANQMjIOQMnIOAAlI+MAlIyMA1AyMg5Aycg4ACUj4wCUjIwDUDIyDkDJyDgAJSPjAJSMjANQslFn3Nvb28vLy8PDw/X19dnZ2Y+AHmqinvr58+f7+7v/BwD4rxFl3MfHhwLr8fHx5ubm/Pzch1k7RB6Ag4bPuN1ut1wuF4uFj6sYFHl3d3fKOz8PAHM1ZMY9Pz9fXV35WDpE1ZyrztRiVbvV/9snPVyv1/f395eXl/7Vh5yenhJ2wJwNkHGucFP6+BwKXFxcKJJWq1Ul0b6l1ysx9baKvJOTE/92Ac1Ogbjf7/0/AJiHrBn3VeGmiXrKvygGRZ4SrXKYQhR/JB0wK5kyTqVZvXDTFFVeKuv8ixI4GHYkHTAfOTLu4eHBp8sv0Qu3b728vFSO1Srp6KoDipc848KAy1C4NasnnWipCDugVGkz7unpyQfJZ+328fHhnxjUwaQThd3j46N/EYAiJMw4VUY+PMYUcOar4xLX19eMIgaKkSrj1CC1gwyXl5djC7hQPewWi8V2u/VPA5iyJBmnRLu4uHB5oeyYyhHMsOvwt99+U5PWPwFgspJk3O3trUuKk5OT19dXP3UKlGtKN7fwotTzTwCYpvgZFx5nWK/Xfup0qJUanjxL9xwwaZEz7ufPn3Yq1d3dnZ86NQo1RZv7FKLm9lvHc8sAjETMjAuPM1xcXIz5OEMbYfecgjvzoGUAUUTLuPA4g5KujDOlKt1z9/f3Uw9uYG6iZdx0jzM0q3TP6e+SPh1QvDgZFx5nWK1WfmopKt1zslwuKeiASYiQcdrbCzjO8K31eh22WynogEmIkHFWxJ2enpZd3ez3+8r17zi/FRi5CBln3VUKOz+paJWCjnHCwJgdm3EvLy9uV1dzdT5XndQnDe8jQcwBo3VsxllnfME9cQepVR62W4k5YJyOyrjtdut38R8/ZngmADEHjN9RGXd/f+92bzXc/KSZIeaAkeufcdq9ret9zpchIuaAMeufcZvNxu3Vp6enftJcEXPAaPXPODt5a25HGw5SzIXnQhBzwEj0zzhrqHJHK2O5L8QcMAY9M87uR3N2duYn4RMxB4xKz4xT+9Ttxsvl0k/CL8QcMB49M86uhcl56QeFMVfehViACemTcW9vb27vpaHa4Obmxq2lwi6oB0xLn4xT+8vtvapW/CTUfJR4YWRgcvpknO263OKgWWE3uACmqHPGvb+/u51WuCnft8q4URkwXZ0zbr1euz1WhYmfhEbhheC5hyGQWeeMs650RkW0Z4dZ+WEAMuuccWdnZ2535Vhhe/v93lqsdGICOXXOOLejao/1j9HO4+OjW3XF3/UCGJVuGbfb7dyOulgs/CS0o1yzY6w084FsumWcnaZ6dXXlJ6E1tVLd2pvVvS+AYXXLODuoyjCIfs7Pz90KvL6+9pMApNQt4+wMB+4r2o+dBidckwrIoFvG2RgIDg72ZoNvVNNx8AFIrVvG2U1FGTjSWziOZCZ33QYG1C3jbHAcXebHsDMfOPgApNYz4/xj9KImqh18UNPVTwWQABk3DBuFI5zECqQzoozbbDaXl5fr9do/Lp3dx4txJEA6I8o4dxrAfM4SC8eRUMoBiYwo49w7i388A5RyQGpk3JAo5YDUyLiBUcoBSXULFLs3vn8clXtn8Y/nISzlttutnwogkm6B4vdFMi4qK+Xu7+/9JACRkHHDe3l5cR+cy2cC0ZFxVYMM07PLZ85neCCQx4gyzs5UH/aWhoMM07OLVnFTGyCuEWWc3ZpalZSfNAS3DJJzMMd+v/dzZRAJENWIMu7+/t69+bAX4LRyMvNgDjvywDWWgYhGlHF2IfVhR4pZ1ErOCx/ZkQcuuARENKKMs5FiZ2dnftIQPj4+3GLIarXyU7NYLBZuvlw7E4ilW1pZOy7REAd7/2ELGVuMy8tLPykLu3bm6empnwTgON0yzq7smKhf3K6lPuwQCrvlguS8s4x+OSxe1XT1UwEcoVvGWb94oj3QhlDc3t76SUMIz69SwznnuFzrDcxcQqJU2nr//vvvf/75xz+en24ZZ3tgog4juzrusF1y4hbDyXmgc7vd+rn++LHb7fxUoJf//e9/fmP68eOPP/5Q2Pkn5qRbxlmHUaIzK8PG2ki65JycZ8uPpMGOqQsDzpnnbZG7ZZyNb0g3vGMkI4HDLjlJlOkHjaTBjklTueC2ogr/9Jx0+8zWUXV+fu4nxaaGoZvFsOMnwi45yXm2/Hga7JguNUvdVlThn56Tbp/Zfhx+++03Pym21M3h9tximOfnZ/9EYuEvsJ8EdPTPP//4bei//NNz0vkz2xUyEp05ryaqe/+rqys/aSBuMUzOA51+lmQcjvDHH3/4zSjgn5uTzp/Z+ssSDZGzs9MHHwfrFiOUbaycnx8ZhyOoufr4+Oi3pE9//fWXf25OOu9F1hmfbpCqXVF92IssuWUQ+8jn5+d5euXc7MQ/BtBX571ouVy63S/dMQEbPDHsWH+3DKLS0oaS5DkS4uYl/jGAvjrvRavVyu1+6Y4J2OCJAa8yVDm4aUdCFHYZBu65eYl/DKCvznuRHRNIN0RuDIMnbAiL6lY9VBPVztVV09W9Jh03I/GPAfTVeS+yk43SDZFToFjbcKjb8dnh49fXVzfFklcSHW8xfjZkHHC0zntRhiFyYif/DzVKzs1d/ONPtlTpaljHIt4/BtBXn70o9RA5sRZxzhMMQm7u4h9/Ck9+SFfK2eiZpL8iwEz0yTg77pn0lNKzszM3l2wnGITcrMU//iVDKWcnBXN5JeB4fTJO7Ue3Eya9jIENX8y/qzcc9AhLuUTXBbHDyoOfzQYUoE/GqbByO2HSbqlwVFrmK6lVDqpW2JBgLV6KQyJWKg5SwAKF6ZNxdmg19dgOaxTnvJJamK12UDX0/v5u7ejFYhG3u1DvZqd5DHVMGShJn4yTPKdbDXIlNWuJNwyOUfZZDsZdNquRBxwbCJSkZ8blOeyQfzBwWMQ1n0lmZz5IxDLTVuw8L9kKRNcz4/IcdggHA6ceduu0KeKMdZzF6pizTgC9YYYzxoA56JlxeQ47iOVI6hk5NvSvzeUAonfMWcJmOF0MmImeGZftsEOeYbeOzav94Nu4HXOWsGqk+0kAjtMz48QOO6RuVWUr5ayLrdOMwo65h4cHP7W7MVyJAChP/4zLNrAjLOWS5qmFadeLxNk/Su+Yax6UB6Cf/hmXc2DH1dWVm9dqtfKTYguPqHZtFH98fNgSSo+WpuZocz84KA9AP/0zLmfbSqWim1e687o6HVGtU8xZYasV0un4g15sF6e7uLjwUwHE0D/jtGda6ZH6XKv39/feRVYb7YfFNdCbWB+lWq/tm9V2+XgtA+c2AHH1zzjJ1iUn1ufV6YBAS0cWccbqTVFg6W2/TTpr8gvjfoHojsq4nF1y4ZGHuKVclCLOaFW4t3L0znd3d1/10IUBN/j9ZIEiHZVxmYc7JCrlYhVxRkFp/Wvm9PTUlXUKaP2hNeaf+KSA69SFB6ClozIuZ5ecpCjl4hZxoYNJdxABB6RzVMaJjZnI05cUvZSzUWmxiriKg1Vb6ObmhoAD0jk246yXPc+gh7ilXNgdFreIq7OyTo3Whh46AHEdm3HhqI48V+uNVcqF52DR3w+U6tiMk8zN1bCUUyHmp3akN7FopjsMKFiEjMvcXJVwfEaPFqsSzY4GaJkJOKBgETIuf3NVqWTDj7u2WLW0dpxBi815BUDZImScZG6uSthiVVnXsgt/s9nY6VbCeQUogH62Hx4e7Ni9/shw3tGExMm4/M1VqZxRcHp62nxNpHAonHCcAVPn0i382Xa0nRNzJk7Ghc3VbK0/tVjtGKv5qqbTEtp9UZWGbAGYuufn53q6Ge2P/nWzFyfjxOLmPu/d3dVobR5kW5d6KByQWjgwQKx9+vj46Cf9iLZrT120FfH6+urWrFa9iiY/NZeDNd1BNFExdeHAgHrvm5su/vHsxVwRtt67Xis8luaajr5YlKH5goPuKfGPZy/militVm7lKk38JABRhScgHhwY4J8j436JuSJUQlsnKH1eQHRtTkD0T5Nxv0ReEWoquvWb7sYLwDyFxxkaTkB0LxD/uAjr9dr1QfXocYq8Ina7nVu/oq/ETwVwnPA4Q/MJiO414h9PWWV4s9N1WEz8FWHHN+/u7vwkAMexbriDxxlM5ktzp+OOH341ANC/qJ34Gffy8uKWQ1/Gt3dsAdDG6emp262aT0C0c7EneifyhqERNoZf/KvbSVLQLhYLtyhDDSIBStK+OrMonNadyA+2SR1NdB1wKpj8pDFknB390Rr3k4DJsg7vkKasViv/isRaVmdTbKi6dKu3SRUdlctl20o473hbgiQZ9xHcy4ZBJJi0cDxaXYakC68l0VydTaihutvt9Mtxe3tbSbd6tDnht9A1UpJknDCIBAWwYe3Nkl6ky3Ylq1/+/PPP33//3f0dmkRDVeuqXhSLJn41KKTNqMAGqTJuu936hfrxo57KwCRYalTGo+nv8NJeXUczdGLLYPWLAk4P3d/m7dcVFVUZ+UkjoxywnvpQQ7pJy1GBDVJlnNggEn2GHks2W5vNxn7o9Ee2Th9UhEXcwQ1YE233U2PKT43Nvb/4x1+wYkf7nZ80Gmpuh0dFRetNgaWarrnk1BpuOSqwQcKM0wezxrba2H4qGukHrd7/mm7/QQMroLR/+kk11pCURC1W/+7fZZyVFKMazFAf5qa/26+o5qsPtJQw40R7rFtEocX6rYbubWIuP7/qvyjiHD2lesS9LFGL1b25+MeHhMclFCt+6nC0s6usseaI0a+FFtW/6Dvh7nDM70fajBPbAmixNqt0b2sTCfcfIeYy8+v9uwJKX5N/3Xev7KdNeNWPS+Sn9fDy8nJ7e2v1b2ixWHSqcsKA017gp/aSPONosbZ0sHu7EnPUwjn5ld4iufzr0mSc9WR91dEWFnH5h2qpCanWcbiVhrRVHxwL0qxyINV2h36SZ5yELVZ60A/SZupXUK1lpId2o0Vq4Zzat/7cy8Q/jkpz9+/+xZIMUsRpSTTfemvUUVmjgq5f4CoQ/bvECDjJkXFiHaLabihG6vRb59bPwc2UWngQ3xZQxr1M/OPYbPepL0nmIq452tQg1bObzca/urvdbmcNGv20R/lFz5RxWlY7BqzdNc+tpqci7Hr4ajMt/uhNwxmLounaebQ/+1dnERZQDbMOa3A/KbZwSSrdsqmLuNfX1+fnZ81U8Xrw29HurB8DbZ/HfztKiYuLC/e2mlesrztTxkmY0Mr7/Pe1Gaf2favW5aGvP2KLtfl06Ax9C1+dsfgVLVW2vLN13rAeUqeMEw45VtxoebbbrVZC9CJOm5beSrM7OF7X9Otoa2afUR8q4qka+TJOtNz2lURpaU9dJeCaV4g26LgtVv32Hoy2g1LkXdd0q9Ai6SP490rDyuevTklMkTIHaduwwK07Pl5VgjQcOjApos15DO6aGPdrzZpxorrXf47Zdy31OHhku5wc7H5uT4Hl36gLRZL//6NpASrp1pBZig/r6wgpX/wr0lAKW4QdrBzzFHGOthDrIqxT+iiI9QVpHX6bQUo0vUZboF6v/2oo2fSlaOPUy7TnHrnJfUWfS1Hg55cgFnJnnNjYZYleGkyFNpd+Ja390n7bEd7M+g3kYLhokcL2kdEmeGQ7UcFh0eB0qsgqeRcxdg+yFV7fVrMVcSFtOcomffs2607aVM1avfqCjjl00J7WofXBSad9oaUBMk70DbmPpO9pzNdISETfou2lXc/CC7ufe/+uhkVcm7nrNbari7613uPOteeEu1nv9maYkonqC0eL5+ZSb67mLOIqtBrdrEVfTe/2vtE7xDp00J72/fC3Vj+f0QNOhsm4cCfXh8y5WsdApYf77AqLHmfh2S9Ev1IurD60Wfup39FXZvN1ehRQ4azlmB9t/aNCx72P/ki3CYXN1Uob0PbPbEWco89urUv7BhX0Wgx9KfqawsroIP20aKUpo/V6faikPxJf0c+krVj9ka5JN0zGyW63sx+f3lcUmCJtT/bV9quG9A7u36XHvm19H/qZ6braj2wn2qyVDv3Kt1C4HrRKj3/Dr1i4KxpsjSkabKKbko11z+tTT7E+0BcXprA2hqSNucEyTrSV2N5+e3vrpxZNe0jYSvVTu2voJGoWtlL7VR/6CGG7tX3MHT/rOgtNJ9EOr7e132PN0U20WWe+6G44OOFpavdL0cYTdseL9oLUMT1kxkl4bFG/lmoX+CcKFeVaMdLQSdRAG5PtHsopP7W7fjFnLbtjZl2nuFQl5d45XXvHVrioDBFbkzk7lLWD2IftUYYPa7PZ2DYgWoG9e3U7GTjjJPwp1tdW8CkQygL/OY++1ti3YxoOCvvIj9w9esScf2m7oxyd9Ev8ruzz6o8oxXgP1mo+8jcyM22ilc5crcPU5ZsZPuMkPEamRkGRR1rDgItSyNgu17J4CYu4KE3FTjEXNlT9pHjCxFeF5afGpnd2szCZgybchNJ1Pkanrz487KtSLlZPRUujyDjRd2abqf6Y0FfYRiXgohQyXYuXFAMdKjHXkC/WSGl/JLcTKxP0h5+UQGXAYJ6mlhNuQlPpvNZvT6V8U6Mtf3/UWDJOVL6Fed9cF0xIioCTsHj5druJXsQZfRyFrHvnhnxxL5BYH78iLLLSlXJa+EE20XATmsoghJ8/f4a9b4vFYqj22YgyTna7nfV0SAEx1+OErfYsXL6NraSjVb/Nl6QNVZOhlAs/iJNhE030G5mOlrBy8FQPB1zscWWcqCQJmz+Tjjnt8FY9pdg6bev/tvFiv6iJukKa8yV1Q9VJXcqFtXBYoej3I90OPLmA2263lbFvec4JazC6jBN9kQXEnD5FePQtxdbZchhqhtGqYb5odn7qL/6JZA1Vk7SUqxyVDjfRRA2xyQVc2KsuWub8vW91Y8w4qWxDd0efB56f7RL61hMdfdNask2qniwmz2hV649Xklb2Rjdd/ONk0pVyejdb1a4W1me0SHXiHoKYVsBp9wx3WK2rlof7Mxhpxkkl5rTWlBqTSLpKuZ706JvtZvVkccIWVtJOX83IWnBKVT81V2ecSVHKacWGJbmf+kmVS4qjENMKuKenp3AlaBWNauzeeDNO9NVWfirHn3RKNMsU0Qbqn0hDq8I2rzBZTNjC8pOSCS8O6MqoMGGTdsaZFKVcc0muz2gHf0RbrGL9mJ18QgFX+TnX+sk5nqalUWeco6aB/Yo640y63W43yPdtA+U0Rz/plzBiEh1tqKiUUWHCZttXK8twjJYluT5a2OZwVNX2OJ80PCI58oCr/JyPrXwzE8g4Z8xJ9167Znfm79vPtdYYzFnEOWEZpXVirdc8CetUlsFP7U4JFe7DzSW5wkiFqn9poP0CVPJ0zAE3ifLNTCbjnLElXT3dBvm+bVcMW2f5izincjKA45/LJVyGfjGn//L/3+U71fpXMqp+DDcJLUzDESHRf2kbti9LxhxwUynfzMQyzjmYdHd3dznXtVqmalaEm7IM9X1bBRG2zvIXcY52zrB/yvHP5aJlCBuPnWJOv1u26qTfd1pZgPba52l+r6+v4X435kUNTTLjnHrSibbI9Xqd9Dfw+fm5vvmepb9HVIOwdeamDFXEOeHyOP6JjCop02b4Ub0qP6ae0j9az2BLo62J9Fkqpy6Mv3wzE84452DSaTPV5qXtVW2E40ch6gvW++gnS+VSOMDdGTbdjF+aX2liY+IyF3EmbM7kOaJaV4m5hrrDtRYrVfkxAWfcO2sj8W96iDYqfV/N7dkBbTabcPmnUr6ZyWecoyr69vY23K9C+oY6RV4Yag23ZdM+oJrO/8/Q7LNrscMhafmLOEeL4Zcg/ekNDTTrrsWUjOR3a3DaWSq9q5eXl1Mp30whGefoK9Hu3ZBKbXwVlEa/uqrbx3YtT+tC0vJbsakU9k8Pwdakfzycg8X+QaSb0XoIWy0qcie6ZorKOKMGgr4P7fb1zu9+Li4u1JpQgA51fZhvqWDxyxoYsIASV8ppvfnHg9KqOHjA1xl5azGz/X9PzBLVwkMNXThemRlX0SPyxh9qdX7RA/4JoDX9MoX9kkr/wS8cciR2g3JUWtkjKaAwFdv/juwVlQXHH7IbHBlXDuvmv7m5GbaVisnRxhP+Rg542d7oyDhg1url23LQy/ZGR8YB81Vw+WbIOGCOii/fDBkHzIuCbA7lmyHjgBnZbDaVQfKllm+GjANmYb/fV05rOz8/L7h8M2QcUL7KyF79rSn+udKRcUDJfv78WWmc3tzcTPfErB7IOKBMCjLFmQ+2Twq7GZ6TS8YBpXmvXexzVo3TCjIOKMdut7v/760hZG6N0woyDijB29tb/eJR82ycVpBxwLQpxSqXe5Pz8/PxXKR6WGQcMFVKsfr1jZV31G4hMg6YmI+Pj9VqVb8PjtqqarH6F+EXMg6YDKXb09NTeJsFOfm8jfrYbjAyHmQcMA3r9bpSuynsHh4eCrhUb1JkHDB2m82m0u+msFNztexz6WMh44Dxent7q9xoSbWbmqv+abRAxgFjtNvtKmdinZyc0DLtgYwDxmW/39fPVbi7u5vzuQrHIOOAsXBX6A3PM5Xr6+vtdutfge7IOGAUNptN5bDp+fk5o3mPR8YBA1OZVjkZS2HHmVixkHHAYN7f35fLZdj15i6CxKCQiMg4YBjr9bpyxsLML4KUCBkH5Pb6+lq5t6kezuH2MYMg44B8VKbd3d35YPukUk4FnX8aCZBxQA7164+fnJwsl0vG9KZGxgFp1dNNrq6uGPWWBxkHpHIw3RaLxWaz8a9AemQcEN/BdDs7O6PrLT8yDoiJdBsbMg6Ig3QbJzIOiODp6Yl0GycyDjjK6+tr/SK9pNt4kHFAT/v9vnLbZtJthMg4oI9K41R/Pz4++ucwJmQc0E29ccq59GNGxgFt1Runi8WCy1iOHBkHfK9+FXIap1NBxgHfWHOhtykj44Av1W/eTON0csg44ABu3lwMMg74D27eXBgyDvD2nzdv9sH2CzdvnjoyDuAyliUj4zBrB9ONmzeXhIzDTH11KSRu3lwYMg6zw4XeZoWMw4yQbjNExmEuuIzlPJFxKN9ms1ksFj7YPpFu80HGoWTb7fbq6soH2yfSbW7IOJTp/f29MqBXDVVOxpohMg6lUe2mdKt0vWmKUs+/AnNCxqEQirDValW5TIhcX19zusKckXGYvJeXl8pZ9A6nK0DIOEzY09NT5eqVjiJPwedfhHkj4zBJ9eEgosJNzVX63RAi4zAx9eEgKuXu7+/pdMNBZBwmoz4cROmmws0/DRxCxmEC9vt95bZYJycny+WSZim+RcZh1J6fn6+vr32w/aIpu93OvwJoRMZhjBRhKtPqx0wZDoKuyDiMiwq3yiEF5+bmZrPZ+BcBrZFxGIX3zyu71Qs3TdF07hqD3sg4DMylW+X0UlE1x2XHcTwyDoM5mG4q3JbLJYcUEAsZhwG8vb3VLw3Cld2QAhmHVDabjWLLB1gj0g3pkHFIpU3AkW5IjYxDKo+Pjz7Jak5PT+/u7hjphgzIOAAlI+MAlIyMA1AyMg5Aycg4ACUj4wCUjIwDUDIyDkDJyDgAJSPjAJSMjANQMjIOQMnIOAAlI+MAlIyMA1AyMg5Aycg4ACUj4wCUjIwDUDIyDkDJyDgAJSPjAJSMjANQMjIOQMnIOAAlI+MAlOvff/8PEHBkY5/Zr0oAAAAASUVORK5CYII=";
        $img = $data1;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $output_file;
        $success = file_put_contents($file, $data);
        print $success ? $file : 'Unable to save the file.';
//        $base64_string = $data1;
//
//            $ifp = fopen($output_file, "wb");
//
//            $data = explode(',', $base64_string);
//
//            fwrite($ifp, base64_decode($data[1]));
//            fclose($ifp);
//

            return $output_file;

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
