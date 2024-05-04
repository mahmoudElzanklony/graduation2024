<?php

namespace App\Http\Controllers;

use App\Actions\ImageModalSave;
use App\Http\Requests\hallFormRequest;
use App\Http\Resources\HallResource;
use App\Models\halls;
use App\Models\images;
use App\Services\Messages;
use Illuminate\Http\Request;
use App\Http\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;

class HallsControlerResourceApi extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = halls::query()->with('city')->with('images')->orderBy('id','DESC')->get();
        return HallResource::collection($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function save_hall($data , $request)
    {
        DB::beginTransaction();
        $hall = halls::query()->updateOrCreate([
            'id'=>$data['id'] ?? null
        ],$data);
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image){
                $photo = $this->upload($image,'halls');
                ImageModalSave::make($hall->id,'halls','halls/'.$photo);
            }
        }
        DB::commit();
        return Messages::success('hall info has been saved successfully');
    }
    public function store(hallFormRequest $request)
    {
        //
        return $this->save_hall($request->validated() , $request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(hallFormRequest $request)
    {
        return $this->save_hall($request->validated() , $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        halls::query()->find($id)->delete();
        return Messages::success('hall deleted successfully');
    }
}
