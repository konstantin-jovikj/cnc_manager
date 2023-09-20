<div>
    <div class="container border my-4 p-4 ">
        <div class="row">
            <div class="col-12">
                <h3 class="font-bold h4">Program Number: <span class="text-info h3 fw-bold"
                        id="prog-name">{{ $program[0]->name }}</span></h3>
                <p class="text-danger py-0 my-0">Created at: {{ $program[0]->created_at }}</p>
                <p class="text-danger">Last Update at: {{ $program[0]->updated_at }}</p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-info mb-3">
                    <div class="card-header">Notes</div>
                    <div class="card-body text-dark h5" id="note">
                        {{ $program[0]->note }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="text-uppercase font-monospace fw-bold h5" id="prog-display">
                    @php
                        $parts = explode(';', $program[0]->program);
                    @endphp

                    @foreach ($parts as $part)
                        <div>{{ $part }};</div>
                    @endforeach
                </div>
            </div>
            <div class="col-6">


                    <div class="card border-info mb-3">
                        <div class="card-header">Used Tools</div>

                        <div class="card-body text-dark h6">
                            <ul>
                                @foreach ($program[0]->tools as $tool)
                                <li id="tools">{{ $tool->position }} - {{ $tool->dimension }} - {{$tool->shape}} - {{$tool->station}}-Statiion</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
            </div>
        </div>


        <button id="printButton" class="btn btn-outline-primary w-25 d-print-none">Print</button>
        {{-- <a class="btn btn-warning mr-2" href="{{ route('edit.program', $program->id)}}">Edit</a> --}}
    </div>
</div>
