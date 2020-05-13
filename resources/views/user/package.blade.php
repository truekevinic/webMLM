@extends('layouts.app')

@section('content')
<br><br><br>
<div class="container">

    <div class="container container-card-deck container-decorate">
        <h3 style="text-align:center;" class="primary-color-text">Package</h3>
        <div class="row mx-auto col-10 ">
            <table class="tablePackage table" style="margin: 1.5em;">
                
            </table>
        </div>
        <div class="row col-10 mx-auto">
            <div class="col-12">
                <h3 style="text-align:center;" class="primary-color-text">Add Package</h3>
            </div>
            <form class="row">
                
                <div class="form-group col-lg-4">
                    <label style="list-style: none;">Package Cost</label>
                    <input type="number" class="form-control" name="addPackageCost" id="addPackageCost">
                </div>
                <div class="form-group col-lg-4">
                    <label style="list-style: none;">Max Balance</label>
                    <input type="number" class="form-control" name="addMaxBalance" id="addMaxBalance">
                    
                </div>
                <div class="form-group col-lg-4">
                    <label style="list-style: none;">Max Withdraw</label>
                    <input type="number" class="form-control" name="addMaxWithdraw" id="addMaxWithdraw">
                </div>
                <div class="form-group col-lg-4">
                    
                    <button class="primary-color-btn " id="btnAdd">Add</button>
                </div>
            </form>
        </div>
    </div>
    <br><br><br>
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
                    '<td class="mx-auto" > <li style="list-style: none;"><button onclick="" class="btnDelete primary-color-btn" id="btnDeletePackage'+i+'">Remove</button></li></td>' +

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

</script>
@endsection
