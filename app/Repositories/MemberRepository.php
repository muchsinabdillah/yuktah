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
    public function showsocmed($id)
    {
        return User::select(['socialmedia_fb','socialmedia_twiter','socialmedia_linkedin','socialmedia_ig','socialmedia_line'])
        ->where('uuid',$id)
        ->get();
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
    public function socmed($data)
    {
        $updates = User::where('uuid', $data['uuid'])->update([
            'socialmedia_fb'=> $data['socialmedia_fb'],
            'socialmedia_twiter'=> $data['socialmedia_twiter'],
            'socialmedia_linkedin'=> $data['socialmedia_linkedin'],
            'socialmedia_ig'=> $data['socialmedia_ig'],
            'socialmedia_line'=> $data['socialmedia_line']
        ]);
        return $updates;
    } 
    public function personal($data)
    {
        $updates = User::where('uuid', $data['uuid'])->update([
            'firstname'=> $data['firstname'],
            'lastname'=> $data['lastname'],
            'dateofbirth'=> $data['dateofbirth'],
            'gender'=> $data['gender'],
            'mobilephone'=> $data['mobilephone'],
            'domicilieprovince'=> $data['domicilieprovince'],
            'domicilieprovincename'=> $data['domicilieprovincename'],
            'domicilieregency'=> $data['domicilieregency'],
            'domicilieregencyname'=> $data['domicilieregencyname'],
            'domicilieaddress'=> $data['domicilieaddress'] 
        ]);
        return $updates;
    } 
    public function showPersonalData($id)
    {
        return User::select(['firstname','lastname','dateofbirth','gender','mobilephone','domicilieprovince',
                        'domicilieprovincename','domicilieregency','domicilieregencyname','domicilieaddress','email'])
        ->where('uuid',$id)
        ->get();
    }
    public function updatesprivillageMentor($data)
    {
        $updates = User::where('uuid', $data['useruuid'])->update([
            'privillage'=>  'teacher'
        ]);
        return $updates;
    } 
    
}