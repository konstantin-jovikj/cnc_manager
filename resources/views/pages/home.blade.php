@extends('layout.main')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col text-center">
                <h1 class="display-6 fw-bold">Murata WIedemann Centrum 300Q</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                {{-- <livewire:home-chart/> --}}
            </div>
            <div class="col-6">
                <livewire:program-count/>
            </div>
        </div>
    </div>
@endsection
