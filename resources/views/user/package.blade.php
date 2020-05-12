@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <br><br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container-card-deck container-decorate-2">
                    <h3 style="text-align:center;" class="primary-color-text">Package</h3>
                    <div class="mx-auto">
                    <table class="tablePackage table" style="margin: 1.5em;"  >
{{--                        @foreach($packages as $p)--}}
{{--                            <tr>--}}
{{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->package_cost}}</li></td>--}}
{{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->max_balance}}</li></td>--}}
{{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->max_withdraw}}</li></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                    </table>
                </div>
                    <div class="card-footer">
                        <div>Add Package</div>
                        <table class="table">
                            <tr>
                                <th > <li style="list-style: none;">Package Cost</li></th>
                                <th > <li style="list-style: none;">Max Balance</li></th>
                                <th > <li style="list-style: none;">Max Withdraw</li></th>
                            </tr>
                            <tr>
                                <td><input type="number" name="addPackageCost" id="addPackageCost"></td>
                                <td><input type="number" name="addMaxBalance" id="addMaxBalance"></td>
                                <td><input type="number" name="addMaxWithdraw" id="addMaxWithdraw"></td>
                            </tr>
                        </table>
                        <div>
                            <button class="primary-color-btn" id="btnAdd" >Add</button>
                        </div>
                    </div>
=======

<div class="container py-5">



    <div class="row col-10">
        <h3>Package</h3>
    </div>
    <div class="row mx-auto ">


        <table class="tablePackage table" style="margin: 1.5em;">
            {{--                        @foreach($packages as $p)--}}
            {{--                            <tr>--}}
            {{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->package_cost}}
            </li>
            </td>--}}
            {{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->max_balance}}
            </li>
            </td>--}}
            {{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->max_withdraw}}
            </li>
            </td>--}}
            {{--                            </tr>--}}
            {{--                        @endforeach--}}
        </table>
    </div>
    <div class="row col-10 mx-auto">
        <div class="col-12"><h3> Add Package</h3></div>
       
            <form class="row">

                <div class="form-group col-lg-4">
                    <label style="list-style: none;">Package Cost</label>
                    <input type="number" class="form-control" name="addPackageCost" id="addPackageCost">
                </div>
                <div class="form-group col-lg-4">
                    <label style="list-style: none;">Max Balance</label>
                    <input type="number" class="form-control" name="addMaxBalance" id="addMaxBalance">
>>>>>>> 7a47e409a8172284a8366e28cf883d1e4c644a2a
                </div>
                <div class="form-group col-lg-4">
                    <label style="list-style: none;">Max Withdraw</label>
                    <input type="number" class="form-control" name="addMaxWithdraw" id="addMaxWithdraw">
                </div>
                <button class="btn btn-secondary" id="btnAdd">Add</button>
            </form>

       





    </div>

</div>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).ready(function () {
        // var package = [];
        var packageList = {!! json_encode($packages->toArray()) !!};
        // console.log(package)

        function loopPackage() {
            var packageDiv = "";

            packageDiv += '<tr>' +
                '<th > <li style="list-style: none;">Package Cost</li></th>' +
                '<th > <li style="list-style: none;">Max Balance</li></th>' +
                '<th > <li style="list-style: none;">Max Withdraw</li></th>' +
            '</tr>'

            for (let i = 0; i < packageList.length ; i++) {
                packageDiv += '<tr>'+
                    '<td > <li style="list-style: none;">'+packageList[i].package_cost+'</li></td>'+
                    '<td > <li style="list-style: none;">'+packageList[i].max_balance+'</li></td>'+
                    '<td > <li style="list-style: none;">'+packageList[i].max_withdraw+'</li></td>'+
<<<<<<< HEAD
                    '<td > <li style="list-style: none;"><button onclick="" class="btnDelete primary-color-btn" id="btnDeletePackage'+i+'">Remove</button></li></td>' +
=======
                    '<td class="mx-auto" > <li style="list-style: none;"><button onclick="" class="btnDelete btn btn-secondary" id="btnDeletePackage'+i+'">Remove</button></li></td>' +
>>>>>>> 7a47e409a8172284a8366e28cf883d1e4c644a2a
                    '</tr>'
            }
            $('.tablePackage').html(packageDiv);
        }

        $.ajax({
            url: "{{url('package')}}",
            method: 'GET',
            success: function (data) {
                loopPackage();
            }
        });

        $('#btnAdd').click(function () {
            console.log("c")
            $.ajax({
                url: "{{url('package')}}",
                method: 'GET',
                success: function (data) {
                    packageList.push({
                        'package_cost': parseInt($('#addPackageCost').val()),
                        'max_balance': parseInt($('#addMaxBalance').val()),
                        'max_withdraw': parseInt($('#addMaxWithdraw').val())
                    });
                    console.log(packageList);
                    loopPackage()
                }
            });
        });

        $('.tablePackage').on('click', '.btnDelete', function (e) {
            $.ajax({
                url: "{{url('package')}}",
                method: 'GET',
                success: function (data) {
                    // console.log($(this).attr("id"))
                    console.log(e.target.id)
                    var idx = parseInt(e.target.id.split("btnDeletePackage")[1])
                    packageList.splice(idx,1);
                    loopPackage();
                }
            });
        });
    });
<<<<<<< HEAD
    </script>
    <br><br><br>
=======
</script>
>>>>>>> 7a47e409a8172284a8366e28cf883d1e4c644a2a

@endsection