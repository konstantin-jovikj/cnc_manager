<?php

namespace App\Livewire;

use App\Models\Note;
use App\Models\Program;
use App\Models\UsedTool;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class Programs extends PowerGridComponent
{
    use WithExport;

    // public $search = '';
    public $isOpenNewProgram = 0;
    public $isEditOpen = 0;
    public $isDeleteOpen = 0;
    public $tools;
    public $toolUsed = [];
    public $name = '';
    public $program = '';
    public $note = '';
    public $programs;
    public $newUsedTool;
    public $dimension = '';

    public $programId;
    public $noteId;
    public $editName;
    public $editProgram;
    public $editDimension;
    public $editNotes = [];

    public $usedTools = [];
    public $toolUsedEdit = [];
    public $usedToolIds = [];
    public $toolIds = [];
    public $uniqueToolIds = [];
    public $seenToolIds = [];
    public $deleteProgramId;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Program::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')

            /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn (Program $model) => strtolower(e($model->name)))

            // ->addColumn('program')
            ->addColumn('dimension')
            ->addColumn('created_at_formatted', fn (Program $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Program $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
        // ->addColumn('created_at_formatted', fn (Program $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            // Column::make('Program', 'program')
            //     ->sortable()
            //     ->searchable(),

            Column::make('Dimension', 'dimension')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Updated at', 'updated_at_formatted', 'updated_at')
                ->sortable(),

            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('dimension')->operators(['contains']),
            Filter::datetimepicker('created_at'),
            Filter::datetimepicker('updated_at'),
            // Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }


    public function openEditModal($id)
    {
        $editProgram = Program::findOrFail($id);
        $this->programId = $id;

        $toolUsedEdit = UsedTool::where('program_id', $id)->get();
        $this->editName = $editProgram->name;
        $this->editProgram = $editProgram->program;
        $this->editDimension = $editProgram->dimension;

        $programNotes = Note::where('program_id', $id)->get();

        $this->editNotes = $programNotes;
        $this->usedTools = $toolUsedEdit;

        $this->isEditOpen = true;
    }




    public function actions(\App\Models\Program $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('btn btn-warning')
                ->dispatch('openEditModal', ['id' => $row->id])
            // ->openModal('new', []),
            // ->method('openEditModal', ['program' => $row->id])
            // ->dispatch('openEditModal', ['rowId' => $row->id])

            // Button::add('destroy')
            //     ->slot('Delete: '.$row->id)
            //     ->class('btn btn-outline-danger')
            //     ->dispatch('destroy', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
