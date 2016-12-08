<?php
 
namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
	/**
	 * Display all the user groups.
	 * 
	 * @return Illuminate\Http\Response
	 */
    public function index() {
    	$groups = Group::paginate(10);
    	return view('admin.group.index', compact('groups'));
    }

    public function create() {
    	return view('admin.group.create');
    }

    public function store(Request $request, Group $group) {
        $this->validate($request, [
            'name'          => 'required|unique:groups|min:3|max:255',
            'color'         => 'min:7|max:9',
            'permissions'   => 'required'
        ]);

        $group->create([
            'name'          => $request->name,
            'color'         => $request->color,
            'permissions'   => json_encode($request->permissions)
        ]);

        return redirect()->route('group.index');
    }

    public function edit(Group $group) {
        $permission = json_decode($group->permissions, true);
        return view('admin.group.edit', compact('group', 'permission'));
    }

    public function update(Request $request, Group $group) {
        $this->validate($request, [
            'name'          => 'required|min:3|max:255|unique:groups,name,'.$group->id,
            'color'         => 'min:7|max:9',
            'permissions'   => 'required'
        ]);

        $group->update([
            'name'          => $request->name,
            'color'         => $request->color,
            'permissions'   => json_encode($request->permissions)
        ]);

        return back();        
    }

    public function destroy(Group $group) {
        $group->delete();

        return back();
    }
}
