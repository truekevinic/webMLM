<section class="management-hierarchy">
    <div class="hv-container">
        <div class="hv-wrapper">
            {!! $html !!}
        </div>
    </div>

{{--    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            var filed = '';--}}

{{--            function loopPackage(user) {--}}
{{--                var filled3 = '<div class="hv-item-parent">\n' +--}}
{{--                    '<div class="person">\n' +--}}
{{--                    '<img src="https://pbs.twimg.com/profile_images/762654833455366144/QqQhkuK5.jpg" alt="" />' +--}}
{{--                    '<p class="name">'+ user.name +'<b>/ '+user.id+'</b></p>' +--}}
{{--                    '</div></div>';--}}

{{--                return filled3;--}}
{{--            }--}}

{{--            function loopChild(parent_, child_) {--}}
{{--                console.log(parent_)--}}
{{--                console.log(child_)--}}
{{--                var filled2 = '<div class="hv-item">';--}}

{{--                filled2 += loopPackage(parent_);--}}
{{--                var len = child_.length;--}}

{{--                if (len > 0) {--}}
{{--                    filled2 += '<div class="hv-item-children">';--}}

{{--                    for (let i = 0; i < len; i++) {--}}
{{--                        filled2 += '<div class="hv-item-child">' +--}}
{{--                            '<div class="hv-item">';--}}
{{--                        filled2 += loopPackage(child_[i]);--}}
{{--                        filled2 += '</div></div>';--}}

{{--                        --}}{{--var parent__ = {!!  !!}--}}
{{--                        --}}{{--loopChild();--}}
{{--                    }--}}

{{--                    filled2 += '</div>';--}}
{{--                }--}}

{{--                return filled2;--}}
{{--            }--}}

{{--            $.ajax({--}}
{{--                url: "{{url('child/1')}}",--}}
{{--                method: 'GET',--}}
{{--                success: function (data) {--}}

{{--                    var parent_ = {!! $parent = $user; $user !!}--}}
{{--                    var child_ = {!! $child = $parent->child_users !!}--}}

{{--                    var filled = loopChild(parent_, child_);--}}
{{--                    // var filled = ''--}}

{{--                    $('#outer-container').html(filled)--}}

{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
</section>
