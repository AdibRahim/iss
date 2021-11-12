<?php

namespace App\Http\Controllers;

use App\Models\ISS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ISSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
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
        //initialize and concate to variable time, create a format day,time
        $time = $request->date.' '.$request->time;
        $timeFormated = Carbon::createFromFormat('Y-m-d H:i', $time);
        $timestamps = array(
            $timeFormated->timestamp
        );

        //check if time more than current date
        if($timeFormated->gt(Carbon::now())){
            abort(404);
        }

        //format subtract an hour 
        $data = Carbon::createFromFormat('Y-m-d H:i', $time);
        $limit = Carbon::createFromFormat('Y-m-d H:i:s', $timeFormated);
        $limit->subHour();

        while ($data->gt($limit)) {
            $data->subMinutes(10);    
            array_push($timestamps, $data->timestamp);
        }

        // foreach($timestamps as $timestamp){
        //     dump(Carbon::createFromTimestamp($timestamp)->toDateTimeString());
        // }
        // dd($timestamps);

        $data2 = Carbon::createFromFormat('Y-m-d H:i', $time);
        $limitAfter = Carbon::createFromFormat('Y-m-d H:i:s', $timeFormated);
        $limitAfter->addHour();
        while ($data2->lt($limitAfter)) {
            if($data2->gt(Carbon::now())){
                break;
            }
            $data2->addMinutes(10);    
            array_push($timestamps, $data2->timestamp);
        }

        // foreach($timestamps as $timestamp){
        //         dump(Carbon::createFromTimestamp($timestamp)->toDateTimeString());
        //     }
        // dd($timestamps);
        sort($timestamps);

        $latitude = array();
        $longitude = array();

        foreach($timestamps as $timestamp){
            $iss = Http::withoutVerifying()->get('https://api.wheretheiss.at/v1/satellites/25544/positions',['timestamps'=> $timestamp])->throw()->json();
            array_push($latitude,$iss[0]['latitude']);
            array_push($longitude,$iss[0]['longitude']);
        }

        $locations = array();
        $google = array();


        for($i=0;$i<count($latitude);$i++){
            $iss = Http::withoutVerifying()->get('https://api.wheretheiss.at/v1/coordinates/'.$latitude[$i].','.$longitude[$i])->throw()->json();   
            $check = $iss['country_code'] == "??" ? "Undefined" : $iss['country_code'];
            
            array_push($locations,$check);
            array_push($google,empty($iss['map_url']) ? "#" : $iss['map_url']);
        }


        return view('result')->with('timestamps',$timestamps)->with('locations',$locations)->with('google',$google)->with('timeFormated',$timeFormated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ISS  $iSS
     * @return \Illuminate\Http\Response
     */
    public function show(ISS $iSS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ISS  $iSS
     * @return \Illuminate\Http\Response
     */
    public function edit(ISS $iSS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ISS  $iSS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ISS $iSS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ISS  $iSS
     * @return \Illuminate\Http\Response
     */
    public function destroy(ISS $iSS)
    {
        //
    }
}
