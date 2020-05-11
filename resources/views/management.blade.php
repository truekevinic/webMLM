<section class="management-hierarchy">
    <div class="hv-container">
        <div class="hv-wrapper">
            {!! $html !!}
        </div>
    </div>

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{url('child/1')}}",
                method: 'get',
                success: function (data) {
                    $('.person').click(function () {
                        $.ajax({
                            url: "{{url('add-member')}}",
                            method: 'POST',
                            data: {member_id:$('#member_id').val(), parent_1: $(this).attr('class').split(' ')[1]},
                            success: function (data) {
                                // console.log(data)
                                window.location.reload();
                            },
                            error: function (data) {
                                console.log(data.responseJSON.errors)
                            }
                        });
                    });
                }
            });
        });
    </script>
</section>
