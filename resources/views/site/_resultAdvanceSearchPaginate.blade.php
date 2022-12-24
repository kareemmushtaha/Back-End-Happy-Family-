<div class="users-area">
    <div>
        @foreach(collect($users) as $user)
            @include('SitePartials.user-card',$user)
        @endforeach

    </div>
</div><!-- end users -->
<div class="pages">
    {{ $users->links('vendor.pagination.custom') }}
</div>
