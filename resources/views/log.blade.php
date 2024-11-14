<!DOCTYPE html>
<html>
<body>
<title>Vk Test</title>
<h2>Vk Test</h2>
<p>Войдите по кнопке снизу</p>


@php
	if (session()->has('code_verifier')) {
		echo '12312312312321313';
	}
@endphp



@php
	$url = app('App\Http\Controllers\AuthController')
         ->createUrlAuthorizeRequest();

	echo $url;
@endphp


<button 
	onclick="window.location.href = '{{ $url }}';"
>
	Нажми	
</button>

{{ dd(session()->all()) }}

</body>
</html>
