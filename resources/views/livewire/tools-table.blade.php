<div class="container">
    <div class="row">
        <div class="col">

        </div>
    </div>
    <div class="row ">
        <div class="col my-auto">
            {{-- <div class="mb-4">
                <label for="perPage">Per Page</label>
                <select
                    wire:model.live='perPage'
                    class="" name="perPage" id="perPage">
                    <option value="5">5</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="15">15</option>
                </select>
            </div> --}}
            <div class="form-floating mb-3">
                <input wire:model.live.debounce.300ms="search" type="text" id="searchTools" class="form-control"
                    placeholder="Search Tools">
                <label for="searchTools">Search Tools</label>
            </div>
            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Position</th>
                        <th scope="col">Station</th>
                        <th scope="col">Shape</th>
                        <th scope="col">Dimension (mm)</th>
                        {{-- <th scope="col">Drawing</th> --}}
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tools as $tool)
                        <tr>
                            {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                            <td>{{ $tool->position }}</td>
                            <td>{{ $tool->station }}</td>
                            <td>{{ $tool->shape }}</td>
                            <td>{{ $tool->dimension }}</td>
                            <td>
                                {{-- <button wire:click="view({{ $tool->id }})" class="btn btn-success btn-sm"
                                    href="">View</button> --}}

                                <button wire:click="edit({{ $tool->id }})" class="btn btn-warning btn-sm">View /
                                    Edit</button>
                                <button wire:click="OpenDeleteConfirmation({{ $tool->id }})"
                                    class="btn btn-danger btn-sm">Delete</button>
                                {{-- <a href="{{ route('edit.tool', $tool->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{-- Delete MODAL  --}}
    <div>

        @if ($isDeleteConfirmationOpen)
            <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary-subtle text-dark">
                            <h5 class="modal-title">
                                Do you realy want to delete this Tool?
                            </h5>
                            <button wire:click="CloseDeleteConfirmation" type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <button wire:click='delete({{ $tool->id }})'
                                        class="btn btn-danger w-100">Yes, Delete the Tool</button>
                                </div>
                                <div class="col-6">
                                    <button wire:click="CloseDeleteConfirmation" class="btn btn-secondary w-100">No,
                                        Do not delete the Tool</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>
{{-- Edit MODAL  --}}


<div>

    @if ($isEditOpen)
        <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary-subtle text-dark">
                        <h5 class="modal-title">
                            Edit Tool
                        </h5>
                        <button wire:click="closeEditModal" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form wire:submit.prevent="update" class="p-4  ">

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="">
                                            <label for="positionEdit" class="form-label">Position : <span
                                                    class="text-danger fs-6">{{ $positionEdit }}</span> </label>
                                            <select wire:model="positionEdit" class="form-select" id="positionEdit">
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->position }}"
                                                        {{ $position->position == $positionEdit ? 'selected' : '' }}>
                                                        {{ $position->position }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="">
                                            <label for="stationEdit" class="form-label">Station : <span
                                                    class="text-danger fs-6">{{ $stationEdit }}</span> </label>
                                            <select wire:model='stationEdit' class="form-select" id="stationEdit">
                                                @foreach ($stations as $station)
                                                    <option value="{{ $station->station }}"
                                                        {{ $station->station == $stationEdit ? 'selected' : '' }}>
                                                        {{ $station->station }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="shapeEdit" class="form-label">Shape : <span
                                                    class="text-danger fs-6">{{ $shapeEdit }}</span></label>
                                            <select wire:model='shapeEdit' class="form-select" id="shapeEdit">
                                                @foreach ($shapes as $shape)
                                                    <option value="{{ $shape->shape }}"
                                                        {{ $shape->shape == $shapeEdit ? 'selected' : '' }}>
                                                        {{ $shape->shape }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="dimensionEdit" class="form-label">Dimension : <span
                                                    class="text-danger fs-6">{{ $dimensionEdit }}</span></label>

                                            <input wire:model="dimensionEdit" type="text" class="form-control"
                                                id="dimensionEdit" name="dimension" value="{{ $dimensionEdit }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="drawingEdit" class="form-label">Choose File</label>
                                            <input wire:model='drawingEdit' class="form-control" type="file"
                                                id="drawingEdit">
                                            @error('drawingEdit')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <img src="{{ asset('storage/images/' . $drawingEdit) }}"
                                            class="img-fluid  rounded " alt="tool{{ $tool->id }}" < />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-outline-success w-100">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>


</div>
