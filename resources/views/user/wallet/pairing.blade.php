@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Pairing Wallet</p></div>
                    <div class="card-body">
                        <div class="child-member">
                            <div class="card-body">{{$bonus->balance}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
