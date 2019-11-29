<?php

namespace App\Http\Controllers;

use App\Reporting;
use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function index(Request $request, Videos $videos, $id)
    {
        $auth_id = Auth::id();
        $parameters = $request->except('_token');

        DB::table('reportings')
            ->insert([
                'video_id' => $id,
                'reporter_id' => $auth_id,
                'content' => $parameters['content'],
                'created_at' => date('y-m-d h:m:s'),
                'updated_at' => date('y-m-d h:m:s')
            ]);
        return redirect()->route('video_show', $id)->with('video_reported', true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reporting  $reporting
     * @return Response
     */
    public function show(Reporting $reporting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reporting  $reporting
     * @return Response
     */
    public function edit(Reporting $reporting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reporting  $reporting
     * @return Response
     */
    public function update(Request $request, Reporting $reporting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reporting  $reporting
     * @return Response
     */
    public function destroy(Reporting $reporting)
    {
        //
    }
}
