<div class="modal fade" id="delete-property-{{ $property->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> Delete Property
                </h3>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <h2 class="h3">{{ $property->description }}</h2>
                    <p>{{ $property->type->name }} in <span class="fw-bold">{{ $property->address }}, {{ $property->country }}</span></p>
                    <img src="{{ asset('/storage/images/' . $property->image) }}" alt="{{ $property->image }}" class="property-img-icon rounded-3">
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('property.destroy', $property->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>