<div class="container">
    <div class="row">
        <div class="col">

        </div>
    </div>
    <div class="row ">
        <div class="col my-auto">
            <div class="row mt-4">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input wire:model.live.debounce.100ms="search" type="text"
                            class="form-control form-control-sm rounded-pill" placeholder="Search Programs">
                        <label class="ms-4" for="searchPrograms">Search Programs</label>
                    </div>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end">
                    <button wire:click='OpenNewProgramModul' class="btn btn-primary">Add new Program</button>
                </div>
            </div>

            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Program Name</th>
                        <th scope="col">Note</th>
                        <th scope="col">Creation date</th>
                        <th scope="col">Last Update</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$program->name}}</td>
                        <td>{{$program->note}}</td>
                        <td>{{$program->created_at}}</td>
                        <td>{{$program->updated_at}}</td>
                        <td>
                            <button class="btn btn-warning btn-sm">View /
                                Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

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
                                    <div class="col-8">
                                        <label for="name" class="form-label">Program Name</label>
                                        <input wire:model='name' type="text" class="form-control" id="name">
                                        <div class="row mt-2">
                                            @foreach ( $tools as $tool )
                                            <div class="col-3">
                                                    <input wire:model='selectedTools' type="checkbox" class="btn-check bg-primary" id="btn-check-{{$tool->id}}"
                                                    autocomplete="off" value="{{$tool->id}}">
                                                    <label class="btn btn-sm btn-outline-dark w-100 m-1" for="btn-check-{{$tool->id}}">{{ $tool->position}} - {{$tool->dimension}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="note" class="form-label">Notes</label>
                                                    <textarea wire:model='note' class="form-control " id="note" rows="8"></textarea>
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

</div>
