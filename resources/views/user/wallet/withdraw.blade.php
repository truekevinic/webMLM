@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="card" method="post" action="{{route('withdraw')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="card-header"><p>Your Wallet</p></div>
                    <div class="card-body">
                        @foreach($wallets as $w)
                            <div class="child-member">
                                <div class="card-body">
                                    <input type="number" class="wallet" name="wallet{{$w->wallet_type_id}}" id="wallet{{$w->wallet_type_id}}" max="{{$w->balance}}" min="0" value="0">
                                    {{'Bonus '.$w->walletTypes->type_name.'    '.$w->balance}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="total">Total 0</div>
                    <input type="submit" value="Withdraw">
                </form>
                @foreach($errors->all() as $e)
                    <div>{{$e}}</div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.wallet').change(function () {
                $.ajax({
                    url: "{{url('wallet/withdraw/'.\Illuminate\Support\Facades\Auth::user()->id)}}",
                    method: 'GET',
                    success: function (data) {
                        var total = 0;
                        for (let i=1;i<=3;i++){
                            total += parseInt($('#wallet'+i).val());
                        }
                        $('#total').html("Total " + total);
                    }
                });
            });
        });
    </script>
@endsection
