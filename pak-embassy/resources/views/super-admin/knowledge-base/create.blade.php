@extends('layouts.master')

@section('content')
    @include('super-admin.knowledge-base.__form')
@endsection
@section('js-file')
    <script src="{{ asset('js/SuperAdmin/knowledge-base.js') }}"></script>
@endsection
