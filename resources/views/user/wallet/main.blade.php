@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User</div>
                    <a class="card-body" href="/child/{{$user->id}}">
                        {{$user->name}}
                    </a>
                </div>
                <br>
                <div class="card">
                    <div class="card-header"><p>Your Members</p></div>
                    <div class="card-body">
                        @foreach($children as $c)
                            <div class="child-member">
                                <a class="card-body" href="/child/{{$c->id}}">
                                    {{$c->name}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
