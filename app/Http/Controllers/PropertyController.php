<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use App\Models\PropertyType;

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
        $all_properties = $this->property->all();
        return view('properties.index')->with('all_properties', $all_properties);
    }

    public function create()
    {
        $agents         = $this->user->where('role_id', User::AGENT_ROLE_ID)->get();
        $property_types = $this->property_type->all();
        
        return view('properties.create')
                ->with('property_types', $property_types)
                ->with('agents', $agents);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description'       => 'required|max:30',
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
        return view('properties.show')->with('property', $property);
    }
}
