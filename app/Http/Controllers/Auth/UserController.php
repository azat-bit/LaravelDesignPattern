<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    // Giriş formunu göster
    public function loginForm()
    {
        return view('auth.login');
    }
    // Giriş işlemini yap
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if ($this->userService->attemptLogin($credentials)) {
            return response()->json([
                'message' => __('user.login_success'),
                'redirect' => route('dashboard')
            ]);
        }

        return response()->json([
            'message' => __('user.login_failed')
        ], 401);
    }

    // Çıkış
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login.form');
    }

    // Kullanıcı listesi (opsiyonel)
    public function index()
    {
        $users = $this->userService->getAll();
        return view('users.index', compact('users'));
    }

    // Belirli kullanıcı (gösterim için)
    public function show($id)
    {
        try {
            $user = $this->userService->getById($id);
            return view('users.show', compact('user'));
        } catch (UserNotFoundException $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    // Kayıt işlemi (AJAX)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $this->userService->store($data);

        return response()->json(['message' => __('user.register_success')]);
    }
}
