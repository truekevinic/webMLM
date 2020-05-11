@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header"><h3>Pending Pin</h3></div>
                    <div class="card-body">
                        <table border="1">
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Pin</th>
                                <th>Approved</th>
                                <th>Reject</th>
                            </tr>
                            @foreach($pin_pending as $p)
                                <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->referral_id}}</td>
                                    <td>{{$p->code}}</td>
                                    <td>
                                        <form action="approved-pin/{{$p->id}}" method="post">
                                            {{csrf_field()}}
                                            <input type="submit" value="Approved">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="reject-pin/{{$p->id}}" method="post">
                                            {{csrf_field()}}
                                            <input type="submit" value="Reject">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{$pin->links()}}
                </div>
            </div>
            <div class="">
                <div class="card">
                    <div class="card-header"><h3>Pin</h3></div>
                    <div class="card-body">
                        <table border="1">
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Pin</th>
                            </tr>
                            @foreach($pin as $p)
                                <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->referral_id}}</td>
                                    <td>{{$p->code}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{$pin->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
