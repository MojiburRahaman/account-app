<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RequirdRequest;
use App\Mail\NewAccountCreated;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

use function PHPUnit\Framework\returnSelf;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->can('View Role')) {
            return view('backend.role.index', [
                'roles' => Role::with('Permissions')->latest()->simplepaginate(5),
            ]);
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Create Role')) {
            // $permission = Permission::create(['name' => 'Reset Password']);
            // $permission = Permission::create(['name' => 'Change Password']);
            // $permission = Permission::create(['name' => 'Subscriber']);
            // $permission = Permission::create(['name' => 'About']);
            // $permission = Permission::create(['name' => 'Setting']);
            // $permission = Permission::create(['name' => 'Banner']);
            // $permission = Permission::create(['name' => 'Order']);
            // $permission = Permission::create(['name' => 'Create Brand']);
            // $permission = Permission::create(['name' => 'View Brand']);
            // $permission = Permission::create(['name' => 'Add User']);
            // $permission = Permission::create(['name' => 'Admin Dashboard']);
            // $permission = Permission::create(['name' => 'Create Category']);
            // $permission = Permission::create(['name' => 'Edit Category']);
            // $permission = Permission::create(['name' => 'Delete Category']);
            // $permission = Permission::create(['name' => 'View Sub-Category']);
            // $permission = Permission::create(['name' => 'Create Sub-Category']);
            // $permission = Permission::create(['name' => 'Edit Sub-Category']);
            // $permission = Permission::create(['name' => 'Delete Sub-Category']);
            // $permission = Permission::create(['name' => 'View Product']);
            // $permission = Permission::create(['name' => 'Create Product']);
            // $permission = Permission::create(['name' => 'Edit Product']);
            // $permission = Permission::create(['name' => 'Delete Product']);
            // $permission = Permission::create(['name' => 'View Coupon']);
            // $permission = Permission::create(['name' => 'Create Coupon']);
            // $permission = Permission::create(['name' => 'Edit Coupon']);
            // $permission = Permission::create(['name' => 'Delete Coupon']);
            // $permission = Permission::create(['name' => 'View Color']);
            // $permission = Permission::create(['name' => 'Create Color']);
            // $permission = Permission::create(['name' => 'Edit Color']);
            // $permission = Permission::create(['name' => 'Delete Color']);
            // $permission = Permission::create(['name' => 'View Size']);
            // $permission = Permission::create(['name' => 'Create Size']);
            // $permission = Permission::create(['name' => 'Edit Size']);
            // $permission = Permission::create(['name' => 'Delete Size']);
            // $permission = Permission::create(['name' => 'View Role']);
            // $permission = Permission::create(['name' => 'Create Role']);
            // $permission = Permission::create(['name' => 'Edit Role']);
            // $permission = Permission::create(['name' => 'Delete Role']);
            // $permission = Permission::create(['name' => 'Customer Dashboard Access']);
            // $permission = Permission::create(['name' => 'Assign User']);
            // $permission = Permission::create(['name' => 'View Blog']);
            // $permission = Permission::create(['name' => 'Create Blog']);
            // $permission = Permission::create(['name' => 'Edit Blog']);
            // $permission = Permission::create(['name' => 'Delete Blog']);

            // $permission = Permission::create(['name' => 'Create Depot']);
            // $permission = Permission::create(['name' => 'View Depot']);
            //   $permission = Permission::create(['name' => 'Edit Depot']);
            //   $permission = Permission::create(['name' => 'Delete Depot']);


            //  $permission = Permission::create(['name' => 'Create Paymentmethod']);
            //  $permission = Permission::create(['name' => 'View Paymentmethod']);
            //    $permission = Permission::create(['name' => 'Edit Paymentmethod']);
            //    $permission = Permission::create(['name' => 'Delete Paymentmethod']);

            //  $permission = Permission::create(['name' => 'Create Bank']);
            //  $permission = Permission::create(['name' => 'View Bank']);
            //     $permission = Permission::create(['name' => 'Edit Bank']);
            //    $permission = Permission::create(['name' => 'Delete Bank']);

            return view('backend.role.create', [
                'Permissions' => Permission::select('name', 'id')->get()
            ]);
        } else {
            abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('Create Role')) {

            $request->validate([
                'role_name' => ['required'],
                'permission' => ['required'],
            ]);
            $role = Role::create(['name' => $request->role_name]);
            $role->givePermissionTo($request->permission);
            return redirect('admin/roles ')->with('success', 'Role Added Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ResetPass()
    {
        if (auth()->user()->can('Reset Password')) {
            return view('backend.role.reset', [
                'users' => User::with('Roles.permissions:name')->select('name', 'email', 'id')->get(),
            ]);
        }
        abort('404');
    }
    public function ResetPassPost(Request $request)
    {
        if (auth()->user()->can('Reset Password')) {
            $request->validate([
                'user_name' => ['required', 'exists:users,id'],
                'password' => ['required', 'min:8']
            ]);
            User::findorfail($request->user_name)->update(['password' => bcrypt($request->password)]);
            return back()->with('success', 'User password changed successfully');
        }
        abort('404');
    }
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('Edit Role')) {
            return view('backend.role.edit', [
                'role' => Role::find($id),
                'permissions' => Permission::all()

            ]);
        } else {
            abort('404');
        }
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
        if (auth()->user()->can('Edit Role')) {
            $role = Role::findorfail($id);
            $role->syncPermissions($request->permission);
            // $role->name = $request->role_name;
            $role->save();
            return redirect('/admin/roles')->with('success', 'Role Edited Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('Delete Role')) {
            Role::find($id)->delete();
            return back()->with('warning', 'Role Deleted Successfully');
        } else {
            abort('404');
        }
    }
    public function AssignUser()
    {
        if (auth()->user()->can('Assign User')) {
            return view('backend.role.assign-user', [
                'users' => User::with('Roles.permissions:name')->select('name', 'email', 'id')->get(),
                'roles' => Role::latest('id')->get(),
            ]);
        } else {
            abort('404');
        }
    }
    public function AssignUserPost(RequirdRequest  $request)
    {
        if (auth()->user()->can('Assign User')) {

            $user = User::findorfail($request->user_name);
            // foreach ($user->Roles as $role) {

            //     $user_role = $role->name;
            // }
            // if ($user_role != '') {
            //     return back()->with('warning', "The User Has Already A Role");
            // } else {
            // 
            // $user->assignRole($request->role_name);
            $user->syncRoles($request->role_name);
            return back()->with('success', 'User Role Assign Successfully');
            // return 'ok';
            // }
            // return 'yes';
        } else {
            abort('404');
        }
    }
    public function UserList()
    {
        if (auth()->user()->can('User List')) {
            return view('backend.role.user-list', [
                'users' => User::all(),
                'roles' => Role::all(),
            ]);
        } else {
            abort('404');
        }
    }
    public function UserListPost(Request $request)
    {
        if (auth()->user()->can('User List')) {
            $user = User::findorfail($request->user_id);
            if ($request->role_name == '') {
                return back();
            }
            $user->syncRoles($request->role_name);
            return back();
        } else {
            abort('404');
        }
    }
    public function CreateUser()
    {
        return view('backend.role.add-user', [
            'roles' => Role::all(),
        ]);
    }
    public function CreateUserPost(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255', 'unique:users,email',
            'role_name' => ['required',],
            'password' => ['required', 'min:8'],
        ]);
        $random_pass_genarate = Str::random(10);
        // return $request;
        $user = new User;
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = bcrypt($request->password);
        $user->email_verified_at = now();
        $user->save();
        $user->assignRole($request->role_name);
        // Mail::to($request->user_email)->send(new NewAccountCreated($random_pass_genarate, $request->user_name));
        return back()->with('success', 'User Created Successfully');
    }
}
