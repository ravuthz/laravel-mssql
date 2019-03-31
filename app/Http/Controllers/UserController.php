<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class UserController extends Controller
{
    private $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = request()->get('filter');
        $size = request()->get('size', 10);
        $sort = request()->get('sort', 'id') ?: 'id';
        $desc = request()->get('desc',  false) ? 'desc' : 'asc';

        return User::select('id', 'name', 'token', 'email')
            ->when($filter, function($query) use ($filter) {
                return $query
                    ->where('name', 'like', "%{$filter}%")
                    ->orWhere('email', 'like', "%{$filter}%");                    
            })
            ->orderBy($sort, $desc)
            ->paginate($size);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size = request()->get('size', 10);
        return User::findOrFail($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules);
        $data['password'] = bcrypt('123123');
        $data['token'] = (string) Uuid::generate();
        return User::create($data);
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
        $this->rules['email'] = "required|string|email|max:255|unique:users,email,{$id}";
        $user = User::findOrFail($id);
        $data = $request->validate($this->rules);
        $data['password'] = bcrypt('123123');
        $data['token'] = (string) Uuid::generate();
        $user->update($data);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}
