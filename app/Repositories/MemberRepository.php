<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class MemberRepository implements MemberRepositoryInterface
{

    public function all()
    {
        return User::latest()->paginate(10);
    }

    public function Store($data)
    {
        return User::create($data);
    }

    public function findbyid($id)
    {
        return User::where('uuid',$id)->get();
    }

    public function update($data)
    {
        $updates = User::where('uuid', $data['uuid'])->update($data);
        return $updates;
    } 
    public function updates($data)
    {
        $updates = User::where('uuid', $data['uuid'])->update([
            'password'=> Hash::make($data['password']) 
        ]);
        return $updates;
    } 
}