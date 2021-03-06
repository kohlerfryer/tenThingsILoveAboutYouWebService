<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Library\phpqrcode\QRcode;
use Log;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request)
    {
        // $data = $request->all();
        // Log::debug('user data being sent: ' . print_r($data, true));

        // $validator = $this->validator($data);
        // if ($validator->fails()) {
        //     Log::debug('ERROR: ' . print_r(response()
        //         ->json($validator->errors()->all(), 400), true));
        //     return response()
        //         ->json(["Errors" => $validator->errors()->all()], 400);
        // }
        
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        // ]);

    // Configuring SVG 
     
        $dataText   = 'PHP QR Code :)'; 
        $svgTagId   = 'id-of-svg'; 
        $saveToFile = false; 
        $imageWidth = 250; // px 
        
        // SVG file format support 
        $svgCode = \QRcode::svg($dataText, $svgTagId, $saveToFile, QR_ECLEVEL_L, $imageWidth); 
        
        return $svgCode; 
    
    }
}
