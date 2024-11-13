<!DOCTYPE html>
<html>
<body>
<title>Vk Test</title>
<h2>Vk Test</h2>
<p>Войдите по кнопке снизу</p>

<button 
	onclick="window.location.href = '<?php echo e(app('App\Http\Controllers\AuthController')->sendAuthorizeRequest()); ?>';"
>
	Нажми	
</button>

</body>
</html>
<?php /**PATH /home/tobecomeawind/Devs/vk/resources/views/log.blade.php ENDPATH**/ ?>