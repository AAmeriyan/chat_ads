<?php

    namespace App\Http\Controllers;


    use App\Http\Resources\UserResource;
    use App\Models\User;
    use App\Services\UserService;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class AuthController extends Controller
    {
        public function __construct(public UserService $userService)
        {
        }

        public function register(Request $request)
        {

            $data = $request->only('first_name', 'last_name', 'email', 'password');
            $user = $this->userService->post('register', $data);
            return response($user, Response::HTTP_CREATED);
        }

        public function login(Request $request)
        {
            $data = $request->only('email', 'password');
            $response = $this->userService->post('login',$data);

            $cookie = cookie('jwt', $response['jwt'], 60 * 24); // 1 day
            return response([
                'message' => 'success'
            ])->withCookie($cookie);
        }
        public function user(Request $request)
        {
            return $this->userService->get('user');
        }

    }
