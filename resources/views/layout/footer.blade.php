<footer class="common-footer">
    <div class="container">
        <h4 style="color: #fff;">Created By 柠檬味的炮灰</h4>
    </div>
</footer>

<script src="/js/header.js"></script>
<script type="text/javascript" src="/js/toastr.min.js"></script>




<script>
    $(function() {
        toastr.options.positionClass = 'toast-top-center'

        @foreach($errors->all() as $type => $message)
            toastr.error("{{stripslashes($message)}}")
        @endforeach

        @if ($messages != 0)
            @foreach($messages as $key => $message)
                toastr.{{$key}}("{{stripslashes($message)}}")
        @endforeach
        @endif
    })
</script>