<x-mail::message>
email ini untuk mereset password
<br><a href="{{ route('forgot_password_enter_password.index',$user->id) }}">klik disini.</a>
<br>Thanks,<br>
{{ $user->name }}
</x-mail::message>