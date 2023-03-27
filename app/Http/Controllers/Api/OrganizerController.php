<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizerUpdateRequest;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Traits\ClientTrait;
use Illuminate\Support\Facades\Log;

class OrganizerController extends Controller
{
    use ApiResponser,ClientTrait;

    protected $organizers_url;

    public function __construct()
    {
        $this->organizers_url = config('app.api_v1').'/organizers';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = [];
        if (request()->page) {

            $page = ['page' => request()->page];
        }

        $perPage = [];
        if (request()->perPage) {

            $perPage = ['perPage' => request()->perPage];
        }

        $params = ['query' => array_merge($page,$perPage)];
        $client = $this->clientAuth(request()->header('Authorization'));
        $response = $client->request('GET', $this->organizers_url ,$params);

        return $this->responseJson(
            json_decode($response->getBody(), true),
            $response->getStatusCode()
        );
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
        $params = $request->all();
        $client = $this->clientAuth(request()->header('Authorization'));
        $response = $client->request('POST', $this->organizers_url, ['json' => $params]);

        return $this->responseJson(
            json_decode($response->getBody(), true),
            $response->getStatusCode()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->clientAuth(request()->header('Authorization'));
        $response = $client->request('GET', $this->organizers_url.'/'.$id );

        return $this->responseJson(
            json_decode($response->getBody(), true),
            $response->getStatusCode()
        );
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
     * @param  \Illuminate\Http\Request\OrganizerUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizerUpdateRequest $request, $id)
    {
        $params = $request->validated();
        $client = $this->clientAuth(request()->header('Authorization'));
        
        try {

            $response = $client->request('PUT', $this->organizers_url.'/'.$id ,['json' => $params]);

            if ($response->getStatusCode() != 204) {

                throw new \Exception;
            }

        }catch (\Exception $e){

            Log::info($response->getBody());
            return $this->responseJson(
                json_decode($response->getBody(), true),
                $response->getStatusCode()
            );
        }
        
        return $this->success(
            $params,
            __('message.update',['X' => 'Organizer']),
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
