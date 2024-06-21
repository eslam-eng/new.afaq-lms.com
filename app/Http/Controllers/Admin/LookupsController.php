<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Lookup;
use App\Models\LookupType;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class LookupsController extends Controller
{
    use MediaUploadingTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type_slug)
    {
        abort_if(Gate::denies($type_slug . '_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lookup_type = LookupType::where('slug', $type_slug)->first();

        $lookups = Lookup::where('lookup_type_id', $lookup_type->id)->get();

        return view('admin.lookups.index', compact('lookup_type', 'lookups','type_slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type_slug)
    {
        abort_if(Gate::denies($type_slug . '_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lookup_type = LookupType::where('slug', $type_slug)->first();

        if($type_slug == 'course_classifications'){
            $parent_lookups = Lookup::where('lookup_type_id',$lookup_type->id)->where('parent_id',null)->get();
        }else{
            $parent_lookups = null;
        }
        return view('admin.lookups.create', compact('lookup_type','type_slug','parent_lookups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type_slug)
    {
        abort_if(Gate::denies($type_slug . '_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lookup_type = LookupType::where('slug', $type_slug)->first();

        $request->merge(['lookup_type_id' => $lookup_type->id]);

        $data = $request->all();
        if(isset($data['image']) && is_file($data['image'])){
            $data['image'] =  $data['image']->store('lookupImages','public');
        }

        $data['slug'] = \Str::slug(isset($data['title_en']) ? $data['title_en'] : isset($data['title_ar']));

        $lookup = Lookup::create($data);

        if($request->ajax()){
            return response()->json($lookup,200);
        }else{
            return redirect()->route('admin.lookups.index', ['type_slug' => $type_slug]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type_slug, $id)
    {
        abort_if(Gate::denies($type_slug . '_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lookup_type = LookupType::where('slug', $type_slug)->first();

        $lookup = Lookup::where('id', $id)->where('lookup_type_id', $lookup_type->id)->first();

        if($type_slug == 'course_classifications'){
            $parent_lookups = Lookup::where('lookup_type_id',$lookup_type->id)->where('id','!=',$lookup->id)->where('parent_id',null)->get();
        }else{
            $parent_lookups = null;
        }

        return view('admin.lookups.update', compact('lookup_type', 'lookup','type_slug','parent_lookups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type_slug, $id)
    {
        abort_if(Gate::denies($type_slug . '_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lookup_type = LookupType::where('slug', $type_slug)->first();

        $lookup = Lookup::where('id', $id)->where('lookup_type_id', $lookup_type->id)->first();

        $data = $request->all();
        if(isset($data['image'])){
            $data['image'] =  $data['image']->store('lookupImages','public');
        }

        // $data['slug'] = \Str::slug(isset($data['title_en']) ? $data['title_en'] : isset($data['title_ar']));

        if ($lookup) {
            $lookup->update($data);
        }

        return redirect()->route('admin.lookups.index', ['type_slug' => $type_slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$type_slug)
    {
        abort_if(Gate::denies($type_slug . '_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lookup_type = LookupType::where('slug', $type_slug)->first();

        Lookup::where('id', $request->id)->where('lookup_type_id', $lookup_type->id)->delete();

        return redirect()->route('admin.lookups.index', ['type_slug' => $type_slug])->with('message', __('global.delete_account_success'));
    }
}
