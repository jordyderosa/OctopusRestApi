<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Ads extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);


        return [
          'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'price'=>$this->price,
            'created_at'=>(string)$this->created_at,
            'name'=>DB::table('ads')->join('users','users.id','=','ads.id_users')->select('name')->where('users.id',$this->id_users)->first()->name,
            'email'=>DB::table('ads')->join('users','users.id','=','ads.id_users')->select('email')->where('users.id',$this->id_users)->first()->email,

        ];
        

    }
/*
        public function with($request)
        {

            return [
                'author' => 'Jordy De Rosa'
            ];
    }
*/
}
