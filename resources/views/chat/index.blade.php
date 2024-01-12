@extends('layouts.main')

@section('content')
<div class="chat" id="chat">
    <div class="chat-header clearfix" id="chat_header">
        <div class="row">
            <div class="col-lg-6" id="chat_top">

            </div>
            <div class="col-lg-6 hidden-sm text-right">
                <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                <a href="javascript:void(0);" id="logout" class="btn btn-outline-warning"><i class="fa fa-sign-out"></i></a>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
    <script>
        var currentUserId = '{{ auth()->user()->id }}';
    </script>
@endpush
