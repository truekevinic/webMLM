@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container-card-deck container-decorate">

                    <h3 class="primary-color-text text-center">Summaries</h3>
                    <br>
                    @foreach($summaries as $s)
                        <div class="centering container-card-deck-child">
                            {{$s->text}}
                            @if($s->status == "increment")
                                <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                            @else
                                <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
