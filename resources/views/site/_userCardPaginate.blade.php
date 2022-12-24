@foreach(collect($users) as $user)
    @include('SitePartials.user-card',$user)
@endforeach


<div class="pages">


    {{ $users->links('vendor.pagination.custom') }}


</div>
