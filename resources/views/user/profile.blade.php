@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Profile</p></div>
                    <table style="margin: 1.5em;"  >
                        <tr>
                            <td>Members<hr></td>
                        </tr>
                        @foreach($children as $c)
                            <tr>
                                <td class="profile-member-list"> <li style="list-style: none;">{{$c->name}}</li></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
