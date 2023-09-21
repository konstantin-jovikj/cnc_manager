<div class="border p-4 rounded">
    <h5 class="p-0 text-center fw-bold mb-3">Most Used Tools</h5>
    @foreach ($mostUsedTools as $toolId => $usedTools)
        <div class="" >
            <ul class="list-group list-group-numbered ">
                @foreach ($usedTools as $usedTool)
                    <li class="border d-flex justify-content-between align-items-center px-4 py-2">
                        <span class="text-danger fw-bold">{{ $usedTool->position }} {{$usedTool->dimension}} mm</span>
                        is used in
                        <span class="badge bg-primary rounded-pill">{{ $usedTool->count }}</span>
                        programs
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>

