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
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    id="searchTools"
                    class="form-control" placeholder="Search Tools">
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
                            {{-- <td>
                            <div style="width: 75px" class="mx-auto">
                                <img src="{{ asset('storage/images/' . $tool->tool_drawing) }}" class="img-thumbnail w-75 rounded " alt="tool{{ $tool->id }}img"
                            </div>
                        </td> --}}
                            <td>
                                <button wire:click="view({{ $tool->id }})" class="btn btn-info btn-sm" href="">View</button>
                                <a href="{{route('edit.tool', $tool->id)}}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{-- MODAL TEST --}}
    <div>

            @if ($isOpen)
            <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title">
                                Add Post
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit="store">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Post Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Enter post title">
                                </div>
                                <div class="mb-3">
                                    <label for="body" class="form-label">Post Body</label>
                                    <textarea class="form-control" id="body" rows="4" placeholder="Enter post body"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                                <button wire:click="closeModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
            @endif
        </div>
    </div>



</div>
