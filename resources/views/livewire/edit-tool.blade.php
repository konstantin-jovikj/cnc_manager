<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <h3>Edit selected Tool</h3>
            <form>
                <div class="mb-3">
                    <label for="pos" class="form-label">Position</label>

                    <select class="form-select" id="pos" ">
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ $position->id == $tool->id ? 'selected' : '' }}>{{ $position->position }}</option>
                        @endforeach
                    </select>


                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div
