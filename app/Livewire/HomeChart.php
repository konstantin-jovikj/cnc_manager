<?php

namespace App\Livewire;

// namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UsedTool;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class HomeChart extends Component
{

    public $mostUsedTools = [];



    public function mupTools()
    {
        // $this->mostUsedTools = UsedTool::select('tool_id', 'name', DB::raw('COUNT(*) as count'))
        //     ->groupBy('tool_id', 'name')
        //     ->orderByDesc('count')
        //     ->get()
        //     ->groupBy('tool_id');
        $this->mostUsedTools = UsedTool::join('tools', 'used_tools.tool_id', '=', 'tools.id')
        ->select('used_tools.tool_id', 'tools.position', 'tools.dimension', DB::raw('COUNT(*) as count'))
        ->groupBy('used_tools.tool_id', 'tools.position', 'tools.dimension')
        ->orderByDesc('count')
        ->get()
        ->groupBy('used_tools.tool_id');
    }



    public function mount()
    {
        $this->mupTools();
    }

    public function render()
    {
        return view('livewire.home-chart', [
            'mostUsedTools' => $this->mostUsedTools,
        ]);
    }


}
