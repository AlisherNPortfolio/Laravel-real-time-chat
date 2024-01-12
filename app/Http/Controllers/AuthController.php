<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use App\Traits\TResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Pusher\Pusher;

class AuthController extends Controller
{
    use TResponse;

    public function __construct(protected UserRepository $repository)
    {
        $this->middleware("auth", ["except" => ["login", "loginView", "register", "registerView"]]);
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectToView('chat', 'success', 'Welcome');
        }

        return $this->redirectBackError('error', 'Error on login');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        try {
            $data['password'] = Hash::make($data['password']);
            $this->repository->create($data);

            return $this->redirectToView('login', 'success', 'You have registered');
        } catch (Exception $e) {
            return $this->redirectBackError('error', 'Error on registering');
        }
    }

    public function logout()
    {
        try {
            Auth::logout();

            return response()->json(true);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function authPusher(Request $request)
    {
        $user = auth()->user();
        $socket_id = $request['socket_id'];
        $channel_name = $request['channel_name'];
        $key = env('PUSHER_APP_KEY');
        $secret = env('PUSHER_APP_SECRET');
        $app_id = env('PUSHER_APP_ID');

        if ($user) {

            $pusher = new Pusher($key, $secret, $app_id);
            $auth = $pusher->authorizeChannel($channel_name, $socket_id);

            return response($auth, 200);
        } else {
            header('', true, 403);
            echo "Forbidden";
            return;
        }
    }
}
