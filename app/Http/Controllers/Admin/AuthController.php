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
        return view('admin.auth.login');
    }

    public function submitSignIn(Request $request)
    {
        $reqData = $request->validate([
            "username" => "required|email",
            "password" => "required"
        ]);

        $email      = $reqData['username'];
        $password   = $reqData['password'];

        $res = $this->authService->adminSignIn($email, $password);
        //dd($res);
        if(!$res['error']){
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with("errorMsg", $res['message']);
    }

    public function submitSignOut(Request $request)
    {
        $res = $this->authService->adminLogout();

        return redirect()->route('admin.login')->with("successMsg", "You have been signed-out successfully!");
    }
}
