@extends('layouts.app')

@section('title', $property->description)

@section('content')
    <div class="container">
        <h2 class="h3">{{ $property->description }}
            @can('admin')
            <a href="#" class="fs-5 text-secondary "><i class="fa-solid fa-pen"></i> Edit</a>
            @endcan
        </h2>
        <p>{{ $property->type->name }} in <span class="fw-bold">{{ $property->address }}, {{ $property->country }}</span></p>

        

        <img src="{{ asset('storage/images/' . $property->image) }}" alt="{{ $property->image }}" class="rounded-3 property-img-wide">

        <div class="row gx-5 mt-5">
            <div class="col-9">
                <div class="row gx-5 mb-5">
                    <div class="col-auto">
                        <p class="fs-3 mb-0"><i class="fa-solid fa-bed"></i> {{ $property->bedrooms }}</p>
                        <span class="text-secondary">Bedroom</span>
                    </div>
                    <div class="col-auto">
                        <p class="fs-3 mb-0"><i class="fa-solid fa-bath"></i> {{ $property->bathrooms }}</p>
                        <span class="text-secondary">Bathroom</span>
                    </div>
                    <div class="col-auto">
                        <p class="fs-3 mb-0"><i class="fa-solid fa-ruler-combined"></i> {{ $property->floor_area }} <span class="fs-6">sqm</span></p>
                        <span class="text-secondary">Floor Area</span>
                    </div>
                </div>

                <h3 class="h4">About this property</h3>
                <p>{!! nl2br(e($property->summary)) !!}</p>


            </div>
            <div class="col-3">
                <h3 class="h4">Agent(s)</h3>

                @foreach ($property->propertyUser as $property_user)
                    <div class="my-3">
                        <a href="#" class="text-dark">{{ $property_user->agent->name }}</a>
                        <p class="mb-0">{{ $property_user->agent->email }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

