<div class="container">
    <div class="row">
        <div class="col">

        </div>
    </div>
    <div class="row ">
        <div class="col my-auto">
            <div class="row my-4">
                <div class="col-6 offset-3">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    {{-- <div class="form-floating mb-3">
                        <input wire:model.live.debounce.100ms="search" type="text"
                            class="form-control form-control-sm rounded-pill" placeholder="Search Programs">
                        <label class="ms-4" for="searchPrograms">Search Programs</label>
                    </div> --}}
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end">
                    <button wire:click='OpenNewProgramModul' class="btn btn-primary">Add new Program</button>
                </div>
            </div>

            <livewire:programs/>

        </div>
    </div>


    {{-- New Program Modal --}}
    <div>
        @if ($isOpenNewProgram)
            <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Program</h1>
                            <button wire:click='CloseNewProgramModul' type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit='saveProgram'>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="program" class="form-label">Program</label>
                                            <textarea wire:model='program' class="form-control text-uppercase font-monospace fw-bold" id="program" rows="28"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-8 pe-5">
                                        <div class="row">
                                            <div class="col-12 ">
                                                <label for="name" class="form-label">Program Name</label>
                                                <input wire:model='name' type="text" class="form-control" id="name">
                                            </div>
                                            <div class="col-12">
                                                <label for="dimension" class="form-label">Sheet Metal Dimension</label>
                                                <input wire:model='dimension' type="text" class="form-control" id="dimension">
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            @foreach ($tools as $tool)
                                                <div class="col-3">
                                                    <input wire:model='toolUsed' type="checkbox" class="btn-check "
                                                        id="btn-check-{{ $tool->id }}" autocomplete="off"
                                                        value="{{ $tool->id }}">
                                                    <label class="btn btn-sm btn-outline-dark w-100 m-1"
                                                        for="btn-check-{{ $tool->id }}">{{ $tool->position }} -
                                                        {{ $tool->dimension }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3 p-4">
                                                    <label for="note" class="form-label">Notes</label>
                                                    <input wire:model='note' class="form-control" id="note"
                                                        type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif
    </div>

    {{-- End of New Program Modal --}}


    {{-- Edit Program Modal --}}
    <div>
        @if ($isEditOpen)
            <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Program</h1>
                            <button wire:click='closeEditModal' type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit='update({{ $programId }})'>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">

                                            <label for="editProgram" class="form-label">Program</label>
                                            <textarea wire:model='editProgram' class="form-control text-uppercase font-monospace fw-bold" id="programEdit"
                                                rows="22">{{ $editProgram }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="editName" class="form-label">Program Name</label>
                                                <input wire:model='editName' type="text" class="form-control"
                                                id="EditName" value="{{ $editName }}">
                                            </div>

                                            <div class="col-12">

                                                <label for="editDimension" class="form-label">Sheet Metal Dimension</label>
                                                <input wire:model='editDimension' type="text" class="form-control"
                                                id="editDimension" value="{{ $editDimension }}">
                                            </div>


                                        </div>
                                        <div class="row mt-2">
                                            @foreach ($tools as $tool)
                                                <div class="col-3">
                                                    <input wire:model='usedTools' type="checkbox"
                                                        class="btn-check bg-primary"
                                                        id="btn-check-edit-{{ $tool->id }}" autocomplete="off"
                                                        value="{{ $tool->id }}"
                                                        {{ $usedTools->contains('tool_id', $tool->id) ? 'checked' : '' }}>
                                                    <label
                                                        class="btn btn-sm
                                                    {{ $usedTools->contains('tool_id', $tool->id) ? 'btn-dark' : 'btn-outline-dark' }} w-100 m-1"
                                                        for="btn-check-edit-{{ $tool->id }}">
                                                        {{ $tool->position }} - {{ $tool->dimension }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Notes</label>
                                                    <table class="table table-hover table-bordered border-primary">
                                                        <thead class="table-primary">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Note</th>
                                                                <th scope="col">Creation date</th>
                                                                <th scope="col">Last Update</th>
                                                                <th scope="col">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($editNotes as $note)
                                                                <tr>
                                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                                    <td>{{ $note->note }}</td>
                                                                    <td>{{ $note->created_at }}</td>
                                                                    <td>{{ $note->updated_at }}</td>
                                                                    <td>

                                                                        <button
                                                                            wire:click='OpenEditNoteNodal({{ $note->id }})'
                                                                            class="btn btn-warning btn-sm">Edit</button>

                                                                        <button
                                                                            wire:click='deleteNote({{ $note->id }})'
                                                                            class="btn btn-danger btn-sm">Delete</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <div class="container border shadow p-3 my-4">
                                <div class="row">
                                    <div class="col">
                                        <h4>Add new Note</h4>
                                    </div>
                                </div>
                                <div class="row  px-4 my-2">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <input wire:model='note' type="text" class="form-control border"
                                                id="note">
                                        </div>
                                    </div>
                                    <div class="col-4">

                                        <button wire:click='addNote({{$programId}})' class="btn btn-primary">Add new Note</button>

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

    {{-- End of Edit Program Modal --}}


    {{-- Delete MODAL  --}}
    <div>

        @if ($isDeleteOpen)
            <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary-subtle text-dark">
                            <h5 class="modal-title">
                                Do you realy want to delete this Program?
                            </h5>
                            <button wire:click="closeDeleteModal" type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <button wire:click='delete({{ $deleteProgramId }})'
                                        class="btn btn-danger w-100 h-100">Yes, Delete the Program</button>
                                </div>
                                <div class="col-6">
                                    <button wire:click="closeDeleteModal" class="btn btn-secondary w-100 h-100">No,
                                        Do not delete the Program</button>
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
{{-- Dele MODAL End  --}}

{{-- Edit Note Modal --}}

<div>

    @if ($isEditNoteOpen)
        <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary-subtle text-dark">
                        <h5 class="modal-title">
                            Edit Note
                        </h5>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 py-4">
                                <input wire:model='note' type="text" class="form-control border" id="note">
                            </div>
                            <div class="col-6">
                                <button wire:click="updateNote({{ $noteId }})" class="btn btn-primary w-100 h-100">Update</button>
                            </div>
                            <div class="col-6">
                                <button wire:click="CloseEditNoteModal" class="btn btn-secondary w-100 h-100">Close</button>
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

{{-- Edit Note Modal End --}}

</div>
