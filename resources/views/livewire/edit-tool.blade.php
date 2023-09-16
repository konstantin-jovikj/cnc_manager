<div class="container ">
    <div class="row vh-100">
        <div class="col-8 offset-2 my-auto border shadow p-3">
            <h3>Edit selected Tool</h3>
            <form class="border p-4 rounded ">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="">
                                <label for="pos" class="form-label">Position</label>
                                <select class="form-select" id="pos" ">
                                        @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ $position->id == $tool->id ? 'selected' : '' }}>
                                        {{ $position->position }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="">
                                <label for="pos" class="form-label">Station</label>
                                <select class="form-select" id="pos" ">
                                    @foreach ($stations as $station)
                                    <option value="{{ $station->id }}"
                                        {{ $station->station == $tool->station ? 'selected' : '' }}>
                                        {{ $station->station }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="pos" class="form-label">Shape</label>
                                <select class="form-select" id="pos" ">
                                @foreach ($shapes as $shape)
                                    <option value="{{ $shape->id }}"
                                        {{ $shape->shape == $tool->shape ? 'selected' : '' }}>
                                        {{ $shape->shape }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="pos" class="form-label">Dimension</label>
                                <input type="text" class="form-control" id="dimension"
                                    value="{{ $tool->dimension }}">
                            </div>
                            <div class="mb-3">
                                <label for="drawing" class="form-label">Choose File</label>
                                <input class="form-control" type="file" id="drawing">
                            </div>
                        </div>


                        <div class="col-6">
                            <div style="width: 100%" class="mx-auto my-auto">
                                <img src="{{ asset('storage/images/' . $tool->tool_drawing) }}"
                                    class="img-fluid  rounded " alt="tool{{ $tool->id }}img" </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
