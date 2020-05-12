@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Jackpot Wallet<span class="badge badge-secondary">Balance: ${{$bonus->balance}}</span></h3>
            <br>
            <div class="container-card-deck container-decorate">
                <h3 class="primary-color-text text-center">Summaries</h3>
                <br>
                @foreach($summaries as $s)
                    <div class="container-card-deck-child">
                        {{$s->text}}
                        @if($s->status == "increment")
                            <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                        @else
                            <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                        @endif
                    </div>
                @endforeach
            </div>
<<<<<<< HEAD
            <br>
            <form action="/wallet/withdraw/jackpot" method="post">
                {{csrf_field()}}
                <div class="child-member">
                    <input type="number" min="0" name="wallet3" class="decorative-input">
                    <input type="submit" value="Withdraw" class="primary-color-btn">
=======
            <div class="my-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Withdraw</h3>
                    </div>
                    <form action="/wallet/withdraw/3" method="post">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="child-member">
                                <input type="number" min="2" id="wallet" name="wallet" max="{{$bonus->balance}}" value="0">
                            </div>
                            <div class="child-member">
                                <div>20% from your withdrawal will be donated to the community</div>
                                <div>
                                    <div>
                                        What will you divide your withdrawal into?
                                    </div>
                                    <div id="max_get">Max: 0</div>
                                    <div>
                                        <div>BCA: <input type="number" name="bank" value="0"></div>
                                        <div>Registration Point: <input type="number" name="registration" value="0"></div>
                                        <div>Activation Point: <input type="number" name="activation" value="0"></div>
                                        <div>MCD Point: <input type="number" name="mcd" value="0"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Withdraw">
                        </div>
                    </form>
                    @foreach($errors->all() as $e)
                    <div>{{$e}}</div>
                    @endforeach
>>>>>>> 7a47e409a8172284a8366e28cf883d1e4c644a2a
                </div>
            </form>
            @foreach($errors->all() as $e)
            <div>$e</div>
            @endforeach
        </div>
    </div>
</div>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#wallet').change(function () {
            $.ajax({
                url: "{{url('package')}}",
                method: 'GET',
                success: function (data) {
                    var max = 0
                    if ($('#wallet').val() != '') {
                        var max = Math.floor(parseFloat($('#wallet').val())*0.8);
                    } else {
                        $('#wallet').val(0)
                    }
                    $('#max_get').html('Max: ' + max)
                }
            });
        });
    });
</script>
@endsection
