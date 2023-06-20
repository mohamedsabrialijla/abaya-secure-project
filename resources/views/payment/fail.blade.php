
@if(app()->getLocale()=='ar')
        <p>{{@$message_ar}}</p>
@else
    <p>{{@$message_en}}</p>
@endif
