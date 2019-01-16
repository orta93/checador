<?php

namespace App\Http\Controllers;

use App\Department;
use App\Movement;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->type == 1){
            return $this->indexAdmin();
        }
        $today = Carbon::now();
        $user = Auth::user()->id;
        $movements = $this->getReport($user,$today);

        $semesters = $this->getSemestralReport($user);
        $seconds = 0;
        foreach ($semesters as $semester){
            $seconds = $seconds + $semester->seconds;
        }

        $semester = (object)[
            'months' => $semesters,
            'total' => $this->getTotalSeconds($seconds),
        ];
        $semester->hours = intval($semester->total->seconds / 3600);
        $semester->barWidth = intval($semester->hours / 480 * 100);

        return view('home')->with(['movements' => $movements['movements'], 'total' => $movements['total'], 'semester' => $semester]);
    }

    private function indexAdmin(){

    }

    private function getSemestralReport($user){
        $today = Carbon::now();
        $semester = [];
        $month = 6;
        if($today->month < 6){
            $today->subYear(1)->month(12)->day(1)->hour(0)->minute(0)->second(0);
            array_push($semester,(object)$this->getReport($user,$today));
            $today->addYear(1);
            $month = 1;
        }
        while (count($semester) < 6){
            $today->month($month);
            array_push($semester,(object)$this->getReport($user,$today));
            $month++;
        }

        return $semester;
    }

    private function getReport($user,$date){
        $start = $date->day(1)->timestamp;
        $end = (clone $date)->addMonth(1)->timestamp;
        $movements = collect(Movement::where('user',$user)->where('checkin','>',$start)->where('checkout','<',$end)->orderBy('id','desc')->get())->map(function ($move){
            $checkin = Carbon::createFromTimestamp($move->checkin);
            $checkout = $move->checkin;
            if($move->checkout != 0){
                $checkout = $move->checkout;
            }

            $seconds = $checkout - $move->checkin;

            $checkout = Carbon::createFromTimestamp($checkout);
            $diff = $checkin->diff($checkout);

            return (object)[
                'date' => $checkin->format('d').' de '.$this->formattedMonth($checkin->format('n')),
                'checkin' => $checkin->format('H:i'),
                'checkout' => $checkout->format('H:i'),
                'seconds' => $seconds,
                'hours' => $this->lessThanZero($diff->h).':'.$this->lessThanZero($diff->i).':'.$this->lessThanZero($diff->s),
            ];
        });

        $seconds = 0;
        foreach ($movements as $movement){
            $seconds = $seconds + $movement->seconds;
        }

        $total = $this->getTotalSeconds($seconds);
        $response = [
            'movements' => $movements,
            'month' => $this->formattedMonth($date->month),
            'total' => $total->total,
            'seconds' => $total->seconds,
        ];
        return $response;
    }

    private function getTotalSeconds($seconds){
        $hours = intval($seconds / 3600);
        $total = $seconds - ($hours * 3600);
        $minutes = intval($total / 60);

        $response = (object)[
            'total' => $this->lessThanZero($hours).':'.$this->lessThanZero($minutes),
            'seconds' => $seconds,
        ];

        return $response;
    }

    private function lessThanZero($int){
        if($int < 10){
            return '0'.$int;
        }
        return $int;
    }

    private function formattedMonth($month){
        $months = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return $months[$month];
    }

    public function profile()
    {
        return view('profile');
    }

    public function submitProfile(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required','string'],
            'email' => ['required','string','email'],
            'password' => ['confirmed'],
        ]);

        if($valid){
            $values = [
                'nombre' => $request->get('name'),
                'email' => $request->get('email')
            ];

            if($request->filled('password')){
                $values['password'] = Hash::make($request->get('password'));
                $values['key'] = base64_encode($request->get('password'));
            }
            $values['img'] = '/storage/images/default.png';
            if ($request->file('picture') != null){
                if($path = $request->picture->storeAs('images', Auth::user()->id.'.'.$request->picture->extension(),'public')) {
                    $values['img'] = Storage::url($path);
                }
            }

            if($update = User::where('id',Auth::user()->id)->update($values)){
                return redirect()->to('/home')->with('success','Se han actualizado los cambios correctamente.');
            }
            return redirect()->to('/profile')->with('error','No se han realizado los cambios.');
        }
    }
}
