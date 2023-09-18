@extends('layouts.master2')
@section('title')
  Delete Acount
@stop
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
@livewire('admin.delete-acount-livewire')

@endsection
@section('js')
@endsection
@section('script')
<script>
    window.addEventListener('open-modal', event => {
        $('#deleteUserModal').modal('show');
    })
    window.addEventListener('close-modal', event => {
        $('#deleteUserModal').modal('hide');
    })
</script>
@endsection
