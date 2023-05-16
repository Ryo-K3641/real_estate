@extends('layouts.app')

@section('title', 'New Property')

@section('content')
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col rounded-3 me-5">
                    <div class="mb-4">
                        <label for="description" class="form-label fw-light">Short Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" aria-describedby="description-help" autofocus>
                        <div id="description-help" class="form-text">
                            ex. Modern Condo with City View, Tropical home by the beach
                        </div>
                        {{-- Error --}}
                    </div>
                    <div class="mb-4">
                        <label for="summary" class="form-label fw-light">About this property</label>
                        <textarea name="summary" id="summary" rows="5" class="form-control">{{ old('summary') }}</textarea>
                        {{-- Error --}}
                    </div>
                    <div class="mb-4">
                        <label for="broker" class="form-label fw-light">Broker</label>
                        <select name="broker_id" id="broker" class="form-select">
                            <option value="" hidden>Select a Broker</option>
                            @foreach ($brokers as $broker)
                                <option value="{{ $broker->id }}">{{ $broker->name }}</option>
                            @endforeach
                        </select>
                        @if ($brokers->isEmpty())
                            <a href="#" class="small text-muted">Create a broker here</a>
                        @endif
                        {{-- Error --}}
                    </div>
                    <div class="mb-4">
                        <label for="property-type" class="form-label fw-light">Type</label>
                        <select name="property_type_id" id="property-type" class="form-select">
                            <option value="" hidden>Select a Property Type</option>
                            @foreach ($property_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label for="bedrooms" class="form-label fw-light">Bedrooms</label>
                                <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms') }}">
                                {{-- Error --}}
                            </div>
                            <div class="col">
                                <label for="bathrooms" class="form-label fw-light">Bathrooms</label>
                                <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms') }}">
                                {{-- Error --}}
                            </div>
                            <div class="col">
                                <label for="floor_area" class="form-label fw-light">Floor Area (sqm)</label>
                                <input type="number" name="floor_area" id="floor_area" class="form-control" value="{{ old('floor_area') }}">
                                {{-- Error --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col  rounded-3">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label for="country" class="form-label fw-light">Country</label>
                                <select name="country" id="country" class="form-select">
                                    <option value="Philippines">Philippines</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="Malaysia">Malaysia</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="address" class="form-label fw-light">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                                {{-- Error --}}
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="image" class="form-label fw-light">Photo of the property</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100"><i class="fa-solid fa-house-circle-check"></i> Save This Property</button>
                </div>
            </div>

        </form>
    </div>
@endsection