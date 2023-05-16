@extends('layouts.app')

@section('title', 'Latest')

@section('content')
<div class="container">
    {{-- <h2 class="display-6 fw-light">New Listings</h2> --}}

    <div class="row gx-5">
        @forelse ($all_properties as $property)
            <div class="col-3">
                <a href="{{ route('property.show', $property->id) }}">
                    <img src="{{ asset('storage/images/' . $property->image) }}" alt="{{ $property->image }}" class="rounded-3 property-img-icon mb-3">
                </a>

                <p class="fw-bold mb-0">{{ $property->country }}</p>

                <p class="text-secondary mb-0">{{ $property->type->name }}</p>

                <div class="row text-secondary">
                    <div class="col">
                        <i class="fa-solid fa-bed"></i> {{ $property->bedrooms }}
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-bath"></i> {{ $property->bathrooms }}
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-ruler-combined"></i> {{ $property->floor_area }} sqm
                    </div>
                </div>

                <p class="text-secondary mt-2">
                    <i class="fa-solid fa-user-tie"></i>
                    @foreach ($property->propertyUser as $property_user)
                        &emsp;<a href="#" class="text-secondary">{{ $property_user->agent->name }}</a>
                    @endforeach
                </p>
            </div>
        @empty
            <p class="display-6">No property found.</p>
            <a href="{{ route('property.create') }}" class="text-secondary">Add a new property here.</a>
        @endforelse
    </div>
</div>
@endsection