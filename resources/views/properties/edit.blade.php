@extends('layouts.app')

@section('title', $property->description)

@section('content')
    <div class="container">
        <form action="{{ route('property.update', $property->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col me-5">
                    <div class="mb-4">
                        <label for="description" class="form-label fw-light">Short Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $property->description) }}" aria-describedby="description-help" autofocus>
                        <div id="description-help" class="form-text">
                            ex. Modern Condo with City View, Tropical home by the beach
                        </div>
                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="summary" class="form-label fw-light">About this property</label>
                        <textarea name="summary" id="summary" rows="5" class="form-control">{{ old('summary', $property->summary) }}</textarea>
                        @error('summary')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="property-type" class="form-label fw-light">Type</label>
                        <select name="property_type_id" id="property-type" class="form-select">
                            <option value="" hidden>Select a Property Type</option>
                            @foreach ($property_types as $type)
                                @if ($property->property_type_id == $type->id)
                                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                @endif
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('property_type_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label for="bedrooms" class="form-label fw-light">Beds</label>
                                <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms', $property->bedrooms) }}">
                                @error('bedrooms')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="bathrooms" class="form-label fw-light">Baths</label>
                                <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms', $property->bathrooms) }}" step="any">
                                @error('bathrooms')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="floor_area" class="form-label fw-light">Floor Area (sqm)</label>
                                <input type="number" name="floor_area" id="floor_area" class="form-control" value="{{ old('floor_area', $property->floor_area) }}" step="any">
                                @error('floor_area')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label for="country" class="form-label fw-light">Country</label>
                                <select name="country" id="country" class="form-select">
                                    <option value="" hiddden>Select a country</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Australia">Australia</option>
                                </select>
                                @error('country')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="address" class="form-label fw-light">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $property->address) }}">
                                @error('address')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="form-label fw-light">Photo of the property</label>
                        <img src="{{ asset('storage/images/' . $property->image) }}" alt="{{ $property->image }}" class="property-img-icon rounded-3 mb-1">
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <p class="form-label fw-light">Agent(s)</p>
                        @forelse ($all_agents as $agent)
                            <div class="form-check">
                                @if (in_array($agent->id, $selected_agents))
                                    <input type="checkbox" name="agent[]" id="{{ $agent->id }}" class="form-check-input" value="{{ $agent->id }}" checked>
                                @else
                                    <input type="checkbox" name="agent[]" id="{{ $agent->id }}" class="form-check-input" value="{{ $agent->id }}">
                                @endif
                                <label for="{{ $agent->id }}" class="form-check-label">{{ $agent->name }}</label>
                            </div>
                        @empty
                            <div class="small text-muted">No agent registered.</div>
                        @endforelse
                        @error('agent')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row gx-1">
                        <div class="col">
                            <a href="{{ route('property.show', $property->id) }}" class="btn btn-dark w-100" title="Cancel"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100" title="Save"><i class="fa-solid fa-check"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection