<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Broker;
use App\Models\PropertyType;

class PropertyController extends Controller
{
    private $property;
    private $broker;
    private $property_type;

    public function __construct(Property $property, PropertyType $property_type, Broker $broker)
    {
        $this->property         = $property;
        $this->broker           = $broker;
        $this->property_type    = $property_type;
    }

    public function create()
    {
        $brokers        = $this->broker->all();
        $property_types = $this->property_type->all();
        
        return view('properties.create')
                ->with('property_types', $property_types)
                ->with('brokers', $brokers);
    }
}
