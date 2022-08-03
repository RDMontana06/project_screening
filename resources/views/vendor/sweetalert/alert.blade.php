@if (config('sweetalert2.alwaysLoadJS') === true && config('sweetalert2.neverLoadJS') === false )
    <script src="{{ $cdn ?? asset('vendors/sweetalert2/sweetalert.all.js')  }}"></script>
@endif
@if (Session::has('alert.config'))
    @if(config('sweetalert2.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert2.animatecss') }}">
    @endif
    @if (config('sweetalert2.alwaysLoadJS') === false && config('sweetalert2.neverLoadJS') === false)
        <script src="{{ $cdn ?? asset('vendors/sweetalert2/sweetalert.all.js')  }}"></script>
    @endif
    <script>
        Swal.fire({!! Session::pull('alert.config') !!});
    </script>
@endif
