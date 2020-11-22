@if(session()->has('success'))
    <script>
        new Noty({
            theme: 'light',
            type: 'alert',
            layout: 'topRight',
            text: '{{ session('success') }}',
            timeout: 2000,
            killer: true,

        }).show();
    </script>
@endif
