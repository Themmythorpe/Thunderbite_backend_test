<script>

    @if( Session::has('success') )
        swal({
            title: "Great!",
            text: "{{ Session::get('success') }}",
            timer: 1500,
            button: false,
            icon: 'success'
        });
    @endif

    @if( Session::has('info') )
        swal({
            title: "Info!",
            text: "{{ Session::get('info') }}",
            timer: 1500,
            button: false,
            icon: 'info'
        });
    @endif

</script>
