<div id="plist" class="people-list">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
        <input type="text" class="form-control" placeholder="Search...">
    </div>
    <ul class="list-unstyled chat-list mt-2 mb-0">
        @foreach ($users as $user)
            @if(auth()->user()->id != $user->id)
                <li class="clearfix user__menu-item" data-user-id="{{ $user->id }}" id="user__item-{{ $user->id }}">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                    <div class="about">
                        <div class="name">{{ $user->name }}</div>
                        <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</div>
@push('scripts')
    <script>

    </script>
@endpush
