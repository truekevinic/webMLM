@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
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
                </div>
            </div>
        </div>
    </div>
@endsection
