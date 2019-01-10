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
        return view('home');
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
