<!DOCTYPE html>
<html>
<body>
<title>Vk Test</title>
<h2>Vk Test</h2>
<p>Войдите по кнопке снизу</p>


<?php
	if (session()->has('code_verifier')) {
		echo '12312312312321313';
	}
?>



<?php
	$url = app('App\Http\Controllers\AuthController')
         ->createUrlAuthorizeRequest();

	echo $url;
?>


<button 
	onclick="window.location.href = '<?php echo e($url); ?>';"
>
	Нажми	
</button>

<?php echo e(dd(session()->all())); ?>


</body>
</html>
<?php /**PATH /home/tobecomeawind/Devs/vk/resources/views/log.blade.php ENDPATH**/ ?>