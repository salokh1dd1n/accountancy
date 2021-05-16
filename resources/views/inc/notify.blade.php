@if(Session::has('flash_notification.message'))
<script src="{{ asset('libs/noty/noty.min.js') }}"></script>
    <script>
        new Noty({
            type: '{{ Session::get('flash_notification.level') }}',
            theme: 'nest',
            text: '{{ Session::get('flash_notification.message') }}',
            timeout: '5000',
            killer: true,
        }).show();
    </script>
@endif
