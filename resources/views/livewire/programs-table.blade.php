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
                        <input wire:model.live.debounce.300ms="search" type="text" id="searchTools"
                            class="form-control form-control-sm" placeholder="Search Tools">
                        <label for="searchTools">Search Programs</label>
                    </div>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end">
                    <button wire:click='OpenNewProgramModul' class="btn btn-primary">Add new Program</button>
                </div>
            </div>

            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Program Name</th>
                        <th scope="col">Note</th>
                        <th scope="col">Creation date</th>
                        <th scope="col">Last Update</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($tools as $tool) --}}
                    <tr>
                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button class="btn btn-warning btn-sm">View /
                                Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>

        </div>
    </div>


    {{-- New Program Modal --}}
    <div>
        @if ($isOpenNewProgram)
            <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Program</h1>
                            <button wire:click='CloseNewProgramModul' type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Example
                                                textarea</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="22"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="program-name" class="form-label">Program Name</label>
                                        <input type="text" class="form-control" id="program-name">

                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="btn-check" id="btn-check-4"
                                                autocomplete="off">
                                            <label class="btn" for="btn-check-4">T01</label>
                                        </div>
                                    </div>

                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button wire:click='CloseNewProgramModul' type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif
    </div>

    {{-- End of New Program Modal --}}

</div>
