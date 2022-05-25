<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin-create|staf-create|owner-create|tenant-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin-edit|owner-edit|tenant-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin-delete|owner-delete', ['only' => ['destroy']]);
        $this->middleware('permission:staf-list', ['only' => ['index_staf']]);
        $this->middleware('permission:owner-list', ['only' => ['index_owner']]);
        // $this->middleware('permission:tenant-list', ['only' => ['index_tenant','resend_verify_email']]);

    }

    public function index(Request $request)
    {

        // dd($type);
        // $user = Auth::user();
        // if ($user->hasPermissionTo('edit articles')) {
        // }

        // $data = User::orderBy('id', 'DESC')->paginate(15);
        // return view('users.index', compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 15);

        $data = User::orderBy('id', 'DESC')->get();
        return view('users.index', compact('data'));
    }

    public function index_staf(Request $request)
    {
        // $data = User::with('roles')->whereHas(
        //     "roles",
        //     function ($q) {
        //         $q->where("name", "Staf")->orWhere("name", "Admin");
        //     }
        // )->orderBy('id', 'DESC')->paginate(5);

        // return view('users.index', compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);

        $data = User::with('roles')->whereHas(
            "roles",
            function ($q) {
                $q->where("name", "Staf")->orWhere("name", "Admin");
            }
        )->orderBy('id', 'DESC')->get();

        return view('users.index', compact('data'));
    }

    public function index_owner(Request $request)
    {
        // dd('test');
        // $data = User::where('role_id', 3)->orderBy('id', 'DESC')->paginate(5);
        // $users = User::with('roles')->get();


        $data = User::with('roles')->whereHas(
            "roles",
            function ($q) {
                $q->where("name", "Owner");
            }
        )->orderBy('id', 'DESC')->get();

        // dd($data);
        return view('users.index', compact('data'));

        // return view('users.index', compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function index_tenant(Request $request)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Super Admin', 'Admin', 'Staf')) {

            // $data = User::with('roles')->whereHas(
            //     "roles",
            //     function ($q) {
            //         $q->where("name", "Tenant");
            //     }
            // )->orderBy('id', 'DESC')->paginate(5);

            $data = User::with('roles')->whereHas(
                "roles",
                function ($q) {
                    $q->where("name", "Tenant");
                }
            )->orderBy('id', 'DESC')->get();

        }

        if ($user->hasAnyRole('Owner')) {

            // $data = User::with('roles')->whereHas(
            //     "roles",
            //     function ($q) use ($user){
            //         $q->where("name", "Tenant")
            //         ->where('created_by', $user->id);
            //     }
            // )->orderBy('id', 'DESC')->paginate(5);

            $data = User::with('roles')->whereHas(
                "roles",
                function ($q) use ($user){
                    $q->where("name", "Tenant")
                    ->where('created_by', $user->id);
                }
            )->orderBy('id', 'DESC')->get();

        }

        // dd($data);

        return view('users.index', compact('data'));

        // return view('users.index', compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(url()->previous()->path());

        $user = Auth::user();

        if ($user->hasRole('Super Admin')) {
            $roles = Role::whereIn('id', array(1, 2, 3))->select('id', 'name')->get();
        }

        if ($user->hasRole('Admin')) {
            $roles = Role::whereIn('id', array(2, 3, 4))->select('id', 'name')->get();
        }

        if ($user->hasRole('Staf')) {
            $roles = Role::where('id', 4)->select('id', 'name')->get();
        }

        if ($user->hasRole('Owner')) {
            $roles = Role::where('id', 5)->select('id', 'name')->get();
        }


        // dd($roles);
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin|Admin|Staf|Owner')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone_no' => 'required',
                'password' => 'required|same:confirm-password',
                'date_subscribe' => 'required',
                'period_before_end_subscribe' => 'required|numeric|min:1|max:100',
                'roles' => 'required'
            ]);
        }

        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $input['password'] = Hash::make($input['password']);

        if ($user->hasRole('Super Admin|Admin|Staf|Owner')) {
            $date_subscribe = Carbon::createFromFormat('d/m/Y', $request->date_subscribe)->format('Y-m-d');
            $period = $request->period_before_end_subscribe;
            $input['period_before_end_subscribe'] = $period ;
            $input['date_expired'] = date('Y-m-d', strtotime($date_subscribe . ' + ' . $period . ' months'));
            $input['status'] = 1;

        }

        try {
            $user = User::create($input);
            $user->assignRole($request->input('roles'));

            // $user->sendEmailVerificationNotification();
            event(new Registered($user));
         } catch (\Exception $e) { // It's actually a QueryException but this works too
            if ($e->getCode() == 23000) {
                return redirect()->route('users.create')
                    ->with('success', 'Terdapat masalah menghasilkan pengguna. Sila semak input anda.');

                // return response()->json([
                //     'message' => 'User can not be created'
                // ], 404);
            }
         }



        // return back()
        //     ->with('success', 'Pengguna berjaya dimasukkan');

        $user = Auth::user();

        if ($user->hasRole('Super Admin')) {
            $route = 'userstaf';
        }

        if ($user->hasRole('Admin')) {
            $route = 'userstaf';
        }

        if ($user->hasRole('Staf')) {
            $route = 'userowner';
        }

        if ($user->hasRole('Owner')) {
            $route = 'usertenant';
        }


        return redirect()->route($route)
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        // dd($user);
        $roles = Role::select('id', 'name')->get();
        $userRole = $user->roles->pluck('id')->first();

        $user1 = Auth::user();

        if ($user1->hasRole('Super Admin')) {
            $roles = Role::whereIn('id', array(1, 2, 3))->select('id', 'name')->get();
        }

        if ($user1->hasRole('Admin')) {
            $roles = Role::whereIn('id', array(2, 3, 4))->select('id', 'name')->get();
        }

        if ($user1->hasRole('Staf')) {
            $roles = Role::where('id', 4)->select('id', 'name')->get();
        }

        if ($user1->hasRole('Owner')) {
            $roles = Role::where('id', 5)->select('id', 'name')->get();
        }


        // dd($userRole);

        return view('users.edit', compact('user', 'roles', 'userRole'));
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

        // dd($request);

        $user_to_update = User::find($id);

        // if($request['email'] == $user_to_update->email){
        //     unset($request['email']);
        // }

        $user = Auth::user();

        if ($user->hasRole('Owner')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'. $user_to_update->id,
                'phone_no' => 'required',
                // 'password' => 'required|same:confirm-password',
                'date_subscribe' => 'required',
                'period_before_end_subscribe' => 'required|numeric|min:1|max:12',
                'roles' => 'required'
            ]);
        }

        if ($user->hasRole('Staf')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'. $user_to_update->id,
                'phone_no' => 'required',
                // 'password' => 'required|same:confirm-password',
                'date_subscribe' => 'required',
                'period_before_end_subscribe' => 'required|numeric|min:1|max:12',
                'roles' => 'required'
            ]);
        }

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if ($user->hasRole('Staf|Owner')) {
            $date_subscribe = Carbon::createFromFormat('d/m/Y', $request->date_subscribe)->format('Y-m-d');
            $period = $request->period_before_end_subscribe;
            $input['period_before_end_subscribe'] = $period ;
            $input['date_expired'] = date('Y-m-d', strtotime($date_subscribe . ' + ' . $period . ' months'));

        }


        $user_to_update = User::find($id);

        $user_to_update->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user_to_update->assignRole($request->input('roles'));

        if ($user->hasRole('Staf')) {
            return redirect()->route('userowner')
            ->with('success', 'User updated successfully');
        }

        if ($user->hasRole('Owner')) {
            return redirect()->route('usertenant')
            ->with('success', 'User updated successfully');
        }
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Pengguna telah berjaya dihapuskan!');
    }

    public function block_user($id)
    {
        // $user = User::find($id);
        // $user->update(['status' => 0]);

        User::find($id)->update(['status' => 0]);
        $success = 'Pengguna telah berjaya disekat!';
        return $success;

        // return redirect()->route('users.index')
        //     ->with('success', 'Pengguna telah berjaya disekat!');
    }

    public function active_user($id)
    {
        // $user = User::find($id);
        // $user->update(['status' => 0]);

        User::find($id)->update(['status' => 1]);
        $success = 'Pengguna telah berjaya diaktifkan!';
        return $success;

        // return redirect()->route('users.index')
        //     ->with('success', 'Pengguna telah berjaya disekat!');
    }

    public function resend_verify_email($id)
    {
        // $user = User::find($id);
        // $user->update(['status' => 0]);

        $user = User::find($id);
        // dd($user);
        $user->sendEmailVerificationNotification();
        $success = 'Emel pengesahan telah berjaya dihantar kepada pengguna!';
        return $success;

        // return redirect()->route('users.index')
        //     ->with('success', 'Pengguna telah berjaya disekat!');
    }

    public function change_password()
    {
        // dd('test');
        $user = Auth::user();

        return view('auth.passwords.reset2');
    }

    public function update_password(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        // dd($user);
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // $user = Auth::user();
        // dd($user);
        // $user->password = bcrypt($request->get('password'));
        $user->update(['password' => bcrypt($request->get('password'))]);
        // dd($user);
        // $user->save();

        return redirect()->back()->with("success","Kata laluan anda telah dikemaskini !");

    }
}