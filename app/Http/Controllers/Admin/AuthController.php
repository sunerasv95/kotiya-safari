<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('auth.admin-auth.login');
    }

    public function submitSignIn(Request $request)
    {
        //dd($request->all());
        $reqData = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $email      = $reqData['email'];
        $password   = $reqData['password'];

        $loginResult = $this->authService->adminSignIn($email, $password);

        if($loginResult['success']){
            $request->session()->put('login_session', $loginResult['data']);
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors("msg", $loginResult['message']);
    }
}
