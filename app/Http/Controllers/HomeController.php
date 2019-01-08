<?php

namespace App\Http\Controllers;

use App\Department;
use App\Movement;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }

    public function check(Request $request)
    {
        $day = Carbon::now()->setTime(0,0,0)->timestamp;
        $now = Carbon::now()->timestamp;
        $response = [
            'status' => 'error',
            'message' => 'Hubo un error en el servidor',
            'user' => [],
        ];
        if ($user = User::where('clave',$request->get('user'))->first()){
            $user->department = Department::find($user->dpto)->nombre;
            $move = Movement::where('user',$user->id)->where('checkin','>',$day)->orderBy('id','desc')->first();
            if(!$move){
                $response['user'] = $user;
                if (Movement::create(['user' => $user->id, 'checkin' => $now, 'inip' => 0, 'checkout' => 0, 'outip' => 0])) {
                    $response['status'] = 'success';
                    $response['message'] = 'Se ha registrado su entrada exitosamente.';
                }
            }
            else{
                if($move->checkout == 0 || $move->checkout == '0'){
                    if(($now - $move->checkin) <= 0){
                        $response['message'] = 'Su registro de entrada fue hace 30 minutos.';
                    }
                    else{
                        if (Movement::where('id',$move->id)->update(['checkout' => $now, 'outip' => 0])) {
                            $response['user'] = $user;
                            $response['status'] = 'success';
                            $response['message'] = 'Se ha registrado su salida exitosamente.';
                        }
                    }
                }
                else{
                    $response['message'] = 'Ya ha registrado sus dos movimientos del día de hoy.';
                }
            }
        }
        else{
            $response['message'] = 'El usuario no se encuentra registrado.';
        }

        return $response;
    }
}
