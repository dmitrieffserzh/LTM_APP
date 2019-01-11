<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
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

    protected $redirectTo = '/';

    public function __construct() {
        $this->middleware('guest');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'username'  => ['required', 'string', 'min:3', 'max:15', 'unique:users', 'regex:/^[a-z0-9_]+$/u'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data) {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function checkUsername(Request $request) {

        if(request()->ajax()) {

            $validator = Validator::make($request->all(),
                ['username'     => ['required', 'string', 'min:3', 'max:15', 'unique:users', 'regex:/^[a-z0-9_]+$/u']],
                ['required'     => 'Не может быть пустым!',
                    'min'       => 'Минимальная длина 3 символа!',
                    'max'       => 'Мaксимальная длина 15 символов!',
                    'unique'    => 'Логин занят!',
                    'regex'     => 'Разрешены символы a-z, 0-9 и _!']
            );

            if ($validator->passes())
                return response()->json(['success'=> true ]);

            return response()->json(['success'=> false, 'error'=>$validator->errors()->all()]);

        }

       return abort(404);
    }
}
