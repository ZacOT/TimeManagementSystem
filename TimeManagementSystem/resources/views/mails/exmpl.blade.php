@component('mail::message')
Hello **{{$name}}**,  
You were recently absent for {{$course}}!  
To avoid being marked as absent please apply of a leave.  
@component('mail::button', ['url' => $link])
Apply for Leave Here
@endcomponent
Sincerely,
University of College.
@endcomponent