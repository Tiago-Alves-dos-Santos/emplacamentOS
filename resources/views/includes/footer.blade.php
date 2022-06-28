
@livewireScripts()
<script src="{{mix('js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="{{asset('js/layout/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/layout/sb-admin.js')}}"></script>
<script src="{{asset('js/footer.js')}}"></script>

@if(session()->has('msg'))
<script>
    showAlert("{{session('msg.title')}}", "{{session('msg.information')}}","{{session('msg.type')}}");
</script>
@php
    session()->forget('msg');
@endphp
@endif
