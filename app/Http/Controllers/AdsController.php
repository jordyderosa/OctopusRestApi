<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ads;
use App\Http\Resources\Ads as AdsResource;
use Illuminate\Support\Facades\DB;


class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all ads ordered by create_at desc
        //

        $ads=DB::table('ads')->orderByDesc('created_at')->paginate(15);

        return AdsResource::collection($ads);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        if ($user=DB::table('users')->where('authtoken', $request->authtoken)->first())
        {

            //return "ok";

            $ads = $request->isMethod('put') ? Ads::findOrFail($request->ads_id) : new Ads;


            $ads->id = $request->input('ads_id');
            $ads->title = $request->input('title');
            $ads->description = $request->input('description');
            $ads->id_users = $user->id;
            $price=$request->input('price');
            if(is_numeric($request->input('price')))
            $ads->price = $price;
            else
            return response('Bad Request:price should be numeric',400);
            $ads->created_at = now();
           if($request->isMethod('put'))
           {
               if($ads->id_users != $user->id)
                   return response("Unauthorized",401);

           }
            if ($ads->save()) {
               if($request->isMethod('post'))
               {
                 //share new ads on social channel
                   //
                   share_on_social($ads);
               }
                return new AdsResource($ads);
            }

        } else {
           return response('Unauthorized',401);

        }


    }
    public function share_on_social($ads)
    {
        //you have to create credential, for example Facebook you can create new facebook app easly.
        /*
         *Once created a new app you can access to the Facebook's page using appid and access_token provided by the facebook app.
         * So what you have to do is to call the Facebook API to post ads and send appid and access_token with your ads's contents.
         *
         */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ads =Ads::findOrFail($id);
        //return a single ads as a resource
        return new AdsResource($ads);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads =Ads::findOrFail($id);
        if($ads->delete())
        {
            return new AdsResource($ads);
        }
    }
}
