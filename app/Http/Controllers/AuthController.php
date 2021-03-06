<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // public function login(){
    //     return view('auth/login');
    // }
    // public function register(){
    //     return view('auth/register');
    // }

    // public function reg(){
    //     return view('auth/reg');
    // }


         //register-details

         public function register(){
            return view('/register/register');
        }
    
        //regiter form details
    
        function insert_register(Request $request){

            try{

                $validated = $request->validate([
                    'name' => 'required',
                    'mail'=>'required',
                    'number'=>'required',
                    'address'=>'required',
                    'gender'=>'required',
                    'image'=>'required',
                ]);

                $name=$request->name;
                $mail=$request->mail;
                $number=$request->number;
                $address=$request->address;
                $gender=$request->gender;
    
    
                    //upload image
                
                    $imageName = time().'.'.$request->file('image')->guessExtension();
                    $request->image->move(public_path('images/profile'),$imageName);
                                       
                  //API for create Registeration
                    $data=[
                        "user_id"=> "12312",
                        "name"=> $name,
                        "contact_number"=> $number,
                        "img"=> $imageName,
                        "gender"=> $gender,
                        "email"=> $mail,
                        "address"=>$address
                    ];
                    $url=  env('API').'createRegistration';
                    $request = Http::post($url,$data );
                    $response=  $request->json();
                 //   dd($response);
                   $response->session()->get('reg_id');

             return redirect("/home/index")->with('message','registeration successfull');
                //  return view('home/index',compact('response'));
     

            }
            catch(Exception $e){
                echo 'message'.$e;
            }

                      }
}
