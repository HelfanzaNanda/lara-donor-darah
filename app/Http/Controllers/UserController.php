<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersStoreRequest;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data['user'] = User::all();
        
        return view('dashboard.users.all', $data);
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(UsersStoreRequest $request)
    {

        $posted = $request->validated($messages,$customAttributes);

        $pwd = Str::random(10);

        $posted['password'] = bcrypt($pwd);

        $user = User::create($posted);
        Mail::to($user->email)->send(new InviteUsers($user, $pwd));
            
        return redirect()->route('user.index')->with('success','Users created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }

    public function getData()
    {
        $query = User::select(['id', 'nama', 'email', 'role', 'phone', 'nama_rs', 'created_at']);

        return DataTables::of($query)
            ->addColumn('nama', function($user){
                return ucwords($user->nama) . '<span style="color:#3c8dbc;">  (' . $user->role . ')</span>';
            })
            ->addColumn('kontak', function($user){
                return $user->email . '<br><span style="color: #3c8dbc;">' . $user->phone . '</span>';
            })
            ->addColumn('nama_rs', function($user){
                return $user->nama_rs;
            })
            ->editColumn('action', function ($user) {
                return '<a href="' . route('user.edit',$user->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('user.delete',['id'=>$user->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['nama', 'kontak', 'nama_rs', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function profileUpdate(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.',
        ];

        $customAttributes = [
            'nama' => 'Nama',
            'phone' => 'Telepon',
        ];

        $valid = $request->validate([
            'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            'phone' => 'required',
        ],$messages,$customAttributes);

        if($valid == true){
            $user = auth()->user();
            $user->nama = $request->nama;
            $user->phone = $request->phone;
    
            if (isset($request->new_password) && $request->new_password == $request->confirm_password) {
                $user->password = bcrypt($request->new_password);
            }
            $user->save();

            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }
        return redirect()->route('profile')->with('error', 'Profile updated is failed.');
    }
}
