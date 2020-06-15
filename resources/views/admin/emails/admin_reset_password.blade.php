@component('mail::message')
# Reset Account
welcome {{$data['data']->name}}
The body of your message.

@component('mail::button', ['url' => 'admin/receive/rest/password/'.$data['token']])
Button Text
@endcomponent
Or <br>
Copy This Link
<a href="{{url('admin/receive/rest/password/'.$data['token'])}}">{{url('admin/receive/rest/password/'.$data['token'])}}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
