<?php

class AppController extends BaseController {

    public $restful = true;

    protected $user;

//    public function _construct(User $user )
//    {
//        $this->User = $user;
//        return View::make("AppUser.AppUser",array("data"=> json_encode($user)));
//
//    }


    public function show()
    {

        $row = $_POST['email'];
        echo $row;
        return "<pre>" . print_r(Input::all(), true) . "</pre>";
        //return print_r($id);
//        //_construct();
//
//        return EventsView::all();
//
//       // _construct();
//       // $use = input::get('data');
//
//        $dd = json_decode($id,true);
//
//        $d = var_dump($dd);
//        $u =  new User($dd);
//        //$u->fill($dd);
//        $u->save();
//
//       // return  $dd->role_id;
        //return View::make("AppUser.AppUser",array("data"=> json_encode($dd)));
    }

    public function update($id)
    {
        //try {


        $dd = json_decode($id,true);
       // print_r($dd);

        ///$d = var_dump($dd);
       $user =  User::where('user_id',$dd['user_id'])->update($dd);

        //$u->fill($dd);


        // return  $dd->role_id;
        return View::make("AppUser.AppUser",array("data"=> json_encode($user)));
//        }
//        catch(PDOException $exception) {
//           // return Response::make('Database error! ' . $exception->getCode().'---'. $exception->getMessage());
//            throw new PDOException;
//        }
    }



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