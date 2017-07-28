
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