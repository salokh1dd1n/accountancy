<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('libs/parsley/parsley.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').parsley({
            errorClass: 'is-invalid',
            successClass: 'is-valid',

            errorsWrapper: '<span class="invalid-feedback" role="alert"></span>',
            errorTemplate: '<strong></strong>',
        });
    });
</script>
