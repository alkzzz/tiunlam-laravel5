<?php namespace contoh\Http\Controllers;

use contoh\Http\Requests;
use contoh\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use contoh\Http\Requests\RoleRequest;
use contoh\Http\Requests\UserRequest;
use contoh\Role;
use contoh\User;

class UserController extends Controller {

	public function role()
    {
        $roles = Role::oldest()->paginate(5);
        return view('user.role', compact('roles'));
    }

    public function tambahrole()
	{
		return view('user.tambahrole');
	}

	public function simpanrole(RoleRequest $request)
	{
		$input = $request->all();
		$input['name'] = str_slug($request->input('display_name'));

		try 
		{
		Role::create($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Nama role yang anda masukkan sudah ada dalam database.');
		}

		return redirect()->route('admin-role')->with('message', 'Role baru telah ditambahkan...');
	}

	public function editrole($nama)
	{
		$role = Role::whereName($nama)->firstOrFail();
		return view('user.editrole', compact('role'));
	}

	public function updaterole(RoleRequest $request, $nama)
	{
		$role = Role::whereName($nama)->firstOrFail();

		$input = $request->all();
		$input['name'] = str_slug($request->input('display_name'));

		try 
		{
		$role->update($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Nama role yang anda masukkan sudah ada dalam database.');
		}

		return redirect()->route('admin-role')->with('message', 'Role telah diupdate...');
	}

	public function showdeleterole($nama)
	{
		$role = Role::whereName($nama)->firstOrFail();
		return view('user.showdeleterole', compact('role'));
	}

	public function deleterole($nama)
	{
		$role = Role::whereName($nama)->firstOrFail();

		$role->delete();

		return redirect()->route('admin-role')->with('message', 'Role telah dihapus...');
	}


	public function tambahuser()
	{
		$roles = Role::latest()->get();
		return view('user.tambahuser', compact('roles'));
	}

	public function simpanuser(UserRequest $request)
	{
		$input = $request->all();
		$input['password'] = bcrypt($request->input('password'));

		try 
		{
		User::create($input);
		$user = User::latest()->firstOrFail();
		$role = Role::whereName($request->input('role'))->firstOrFail();
		$user->attachRole($role);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Username yang anda masukkan sudah ada dalam database.');
		}
		
		return redirect()->route('admin-user')->with('message', 'User baru telah ditambahkan...');
	}

	public function edituser($username)
	{
		$user = User::whereUsername($username)->firstOrFail();
		foreach ($user->roles as $roles) 
		{
			$role_user = $roles;
		}
		$roles = Role::where('name','!=', $role_user->name)->get();

		return view('user.edituser', compact('user','role_user','roles'));
	}

	public function updateuser(UserRequest $request, $username)
	{
		$user = User::whereUsername($username)->firstOrFail();
		foreach ($user->roles as $roles) 
		{
			$role = Role::whereName($roles->name)->firstOrFail();
			$user->detachRole($role);
		}

		$input = $request->all();
		$input['password'] = bcrypt($request->input('password'));

		try 
		{
		$user->update($input);
		$role = Role::whereName($request->input('role'))->firstOrFail();
		$user->attachRole($role);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Username yang anda masukkan sudah ada dalam database.');
		}
		
		return redirect()->route('admin-user')->with('message', 'User telah diupdate...');
	}

	public function showdeleteuser($username)
	{
		$user = User::whereUsername($username)->firstOrFail();
		return view('user.showdeleteuser', compact('user'));
	}

	public function deleteuser($username)
	{
		$user = User::whereUsername($username)->firstOrFail();

		$user->delete();

		return redirect()->route('admin-user')->with('message', 'User telah dihapus...');
	}


}
