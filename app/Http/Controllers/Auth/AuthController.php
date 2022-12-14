<?php

namespace App\Http\Controllers\Auth;

use App\Events\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\DangkyTKRequest;
use App\Models\GhiNo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Events\Dispatchable ;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use MongoDB\Driver\Session;

class AuthController extends Controller
{
    use  InteractsWithSockets, SerializesModels;
    protected $v, $user , $message;
    public function __construct(Request $request)
    {
        $this->v = [];
        $this->user  = new User();
        $this->message  = $request->contents;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('auth.dang-nhap');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     if ($request->isMethod('POST')) {
    //         $email = $request->input('email');
    //         $password = $request->input('password');
    //         if (Auth::attempt(['email' => $email, 'password' => $password, 'trang_thai' => 1])) {

    //             return redirect()->route('route_BE_Admin_Khoa_Hoc');
    //         } else {
    //             dd(123);
    //         }
    //     }
    //     return view('form.login');
    // }
    public function loginForm()
    {
        return view('auth.dang-nhap');
    }

   
    public function login(AuthRequest $request)
    {
       
        // end pusher
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->status == 0) {
                    if ($user->vai_tro_id == 1) {
                        return redirect()->route('home');
                    }
                    if ($user->vai_tro_id != 1) {
                        return redirect()->route('client_khoa_hoc');
                    }
                } else {
                    session()->flash('error', 'T??i kho???n c??? b???n ???? b??? kh??a');
                    return redirect()->route('auth.loginForm');
                }
            }
        } else {
            session()->flash('error', 'Email ho???c m???t kh???u kh??ng ch??nh x??c !');
            return redirect()->route('auth.loginForm');
            // dd('cc');
        }
    }
    public function getdangki()
    {
        return view('auth.dang-ky');
    }
    public function store(DangkyTKRequest $request)
    {
        // dd($request->all());
        $request->hinh_anh = 'https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere-thumbnail.png';
        $user = new User();
        // $array = array_merge($request->all());
        $user->fill($request->all());
        // 2. Ki???m tra file v?? l??u
        $user->password = Hash::make($request->password);
        $user->vai_tro_id = 4;
        // 3. L??u $user v??o CSDL
        $user->save();  
        $data = User::where('users.email','=',$request->email)
        ->get();

        // dd($data);
        foreach($data as $value){
            $ghino = new GhiNo();
            $ghino->user_id = $value->id;
            $ghino->tien_no = 0;
            $ghino->trang_thai = 0;
            $ghino->save();
        }
        session()->flash('success', 'B???n ???? ????ng k?? th??nh c??ng');
        return redirect()->route('auth.loginForm');
    }
    public function logout(Request $request)
    {
        // xo?? session user ???? ????ng nh???p
        Auth::logout();
        // 2 c??u l???nh b??n d?????i c?? ??? laravel 8 v?? 9
        // Hu??? to??n b??? session ??i
        $request->session()->invalidate();
        // T???o token m???i
        $request->session()->regenerateToken();
        // Quay v??? m??n login
        return redirect()->route('home');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
