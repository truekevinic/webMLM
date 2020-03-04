@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Profile</p></div>
                    <table style="margin: 1.5em;"  >
                        <tr>
                            <td style="font-weight: bold">Wallet</td>
                            <td style="font-weight: bolder;color: #636b6f;">$ {{$wallet}}</td>
                        </tr>
                        @if($user->name != "admin")
                            <tr>
                                <td>Level</td>
                                <td>{{$user->account_id}}</td>
                            </tr>
                        @endif
                        <tr>
                            <td style="font-weight: bold">Members</td>
                        </tr>
                        @foreach($children as $c)
                            <tr>
                                <td class="profile-member-list"> <li >{{$c->name}}</li></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
