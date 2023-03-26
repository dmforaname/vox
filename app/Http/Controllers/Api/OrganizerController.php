<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Traits\ApiResponser;

class OrganizerController extends Controller
{
    use ApiResponser;

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
        
        $client = new Client([
            'allow_redirects' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => request()->header('Authorization')
            ]
        ]);

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
        
        $client = new Client([
            'allow_redirects' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => request()->header('Authorization')
            ]
        ]);

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
        //
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
        //
    }
}
