@extends('layouts.master')

@section('content')
    @include('super-admin.Acl.roles.__form')
@endsection
@section('js-file')
    <script src="{{ asset('js/managerole/addnewrole.js') }}"></script>
@endsection
