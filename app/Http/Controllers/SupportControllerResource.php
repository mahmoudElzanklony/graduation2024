<?php

namespace App\Http\Controllers;

use App\Http\Requests\supportFormRequest;
use App\Http\Resources\SupportResource;
use App\Models\support;
use App\Services\Messages;
use Illuminate\Http\Request;

class SupportControllerResource extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $support = support::query()->with(['user','hall'])->orderBy('id','DESC')->get();
        return SupportResource::collection($support);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function save($data)
    {
        //
        $data['user_id'] = auth()->id();
        support::query()->updateOrCreate([
            'id'=>$data['id'] ?? null
        ],$data);
        return Messages::success('question support saved successfully');
    }

    public function store(supportFormRequest $request)
    {

        return $this->save($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(supportFormRequest $request, string $id)
    {
        return $this->save($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        support::query()->find($id)->delete();
        return Messages::success('support deleted successfully');
    }
}
