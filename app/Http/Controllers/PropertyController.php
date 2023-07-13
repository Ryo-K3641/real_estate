<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    private $property;
    private $user;
    private $property_type;
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    public function __construct(Property $property, PropertyType $property_type, User $user)
    {
        $this->property         = $property;
        $this->user             = $user;
        $this->property_type    = $property_type;
    }

    public function index()
    {
        $all_properties = $this->property->latest()->get();
        return view('properties.index')->with('all_properties', $all_properties);
    }

    public function create()
    {
        $all_agents         = $this->user->all();
        $property_types     = $this->property_type->all();
        
        return view('properties.create')
                ->with('property_types', $property_types)
                ->with('all_agents', $all_agents);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description'       => 'required|max:50',
            'summary'           => 'required|max:1000',
            'property_type_id'  => 'required|numeric',
            'bedrooms'          => 'required|numeric',
            'bathrooms'         => 'required|numeric',
            'floor_area'        => 'required|numeric',
            'agent'             => 'required|array',
            'country'           => 'required|max:50',
            'address'           => 'required|max:255',
            'image'             => 'required|mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        $this->property->description = $request->description;
        $this->property->summary = $request->summary;
        $this->property->property_type_id = $request->property_type_id;
        $this->property->bedrooms = $request->bedrooms;
        $this->property->bathrooms = $request->bathrooms;
        $this->property->floor_area = $request->floor_area;
        $this->property->country = $request->country;
        $this->property->address = $request->address;
        $this->property->image = $this->saveImage($request);
        $this->property->save();

        foreach ($request->agent as $agent_id) {
            $property_user[] = ['user_id' => $agent_id];
        }
        $this->property->propertyUser()->createMany($property_user);

        return redirect()->route('index');
    }

    private function saveImage($request)
    {
        $image_name = time() . "." . $request->image->extension();
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    public function show($id)
    {
        $property = $this->property->findOrFail($id);
        $agents = $this->getSelectedAgents($property);
        return view('properties.show')->with('property', $property)->with('agents', $agents);
    }

    public function edit($id)
    {
        $property           = $this->property->findOrFail($id);

        if (!in_array(Auth::user()->id, $this->getSelectedAgents($property))) {
            return redirect()->route('index');
        }

        $property_types     = $this->property_type->all();
        $all_agents         = $this->user->all();
        $selected_agents    = $this->getSelectedAgents($property);

        return view('properties.edit')
                ->with('property', $property)
                ->with('property_types', $property_types)
                ->with('all_agents', $all_agents)
                ->with('selected_agents', $selected_agents);
    }

    private function getSelectedAgents($property)
    {
        $selected_agents = [];
        foreach ($property->propertyUser as $property_user) {
            $selected_agents[] = $property_user->user_id;
        }
        return $selected_agents;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description'       => 'required|max:50',
            'summary'           => 'required|max:1000',
            'property_type_id'  => 'required|numeric',
            'bedrooms'          => 'required|numeric',
            'bathrooms'         => 'required|numeric',
            'floor_area'        => 'required|numeric',
            'agent'             => 'required|array',
            'country'           => 'required|max:50',
            'address'           => 'required|max:255',
            'image'             => 'mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        $property                   = $this->property->findOrFail($id);
        $property->description      = $request->description;
        $property->summary          = $request->summary;
        $property->property_type_id = $request->property_type_id;
        $property->bedrooms         = $request->bedrooms;
        $property->bathrooms        = $request->bathrooms;
        $property->floor_area       = $request->floor_area;
        $property->country          = $request->country;
        $property->address          = $request->address;
        if ($request->image) {
            $this->deleteImage($property->image);
            $property->image = $this->saveImage($request);
        }
        $property->save();
        
        $property->propertyUser()->delete();

        foreach ($request->agent as $agent_id) {
            $property_user[] = ['user_id' => $agent_id];
        }
        $property->propertyUser()->createMany($property_user);

        return redirect()->route('property.show', $id);
    }

    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if (Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function destroy($id)
    {
        $property = $this->property->findOrFail($id);
        $this->deleteImage($property->image);
        $property->delete();

        return redirect()->route('index');
    }
}
