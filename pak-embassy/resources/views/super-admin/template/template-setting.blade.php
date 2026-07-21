@extends('layouts.master')
@section('content')
    <div class="container-fluid px-0">
        @include('super-admin.template.setting.'.$template->template_file_path, ['data'=>$setting, 'pages' => $pages])
    </div>
@endsection