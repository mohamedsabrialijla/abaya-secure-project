
@isset($replies)
    @foreach($replies as $reply)
                    <div>
                        {{$reply->reply}}
                    </div>
        @endforeach
@endisset
