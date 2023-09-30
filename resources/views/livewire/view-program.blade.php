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
                <table class="table table-hover table-bordered border-info">
                    <thead class="card-body text-dark h6 table-secondary border-info">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="w-50">Note</th>
                            <th scope="col" class="w-25">Creation date</th>
                            <th scope="col" class="w-25">Last Update</th>
                        </tr>
                    </thead>
                    <tbody class="" style="font-size: 13px">
                        @if ($program[0]->notes->isEmpty())
                            <tr>
                                <td colspan="5">This program does not have any notes</td>
                            </tr>
                        @else
                            @foreach ($program[0]->notes as $note)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $note->note }}</td>
                                    <td>{{ $note->created_at }}</td>
                                    <td>{{ $note->updated_at }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
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
                        <div class="card-header" >Used Tools</div>

                        <div class="card-body text-dark" style="font-size: 13px">
                            <ul>
                                @foreach ($program[0]->tools as $tool)
                                <li id="tools">{{ $tool->position }} - {{ $tool->dimension }} - {{$tool->shape}} - {{$tool->station}}-Statiion</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card border-info mb-3">
                        <div class="card-header" >Sheet Metal Dimension</div>

                        <div class="card-body text-dark" style="font-size: 13px">
                            <ul>
                                <li >{{$program[0]->dimension}}</li>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>


        <button id="printButton" class="btn btn-outline-primary w-25 d-print-none">Print</button>
        {{-- <a class="btn btn-warning mr-2" href="{{ route('edit.program', $program->id)}}">Edit</a> --}}
    </div>
</div>
