<?php 
/**
* 
*/
class Thing 
{

	public function getFromName()
	{
		return 'Address Name';
	}

	public function getFrom()
	{
		return 'address@location';
	}
}
	
	$mail = new Thing();
	$name = $mail->getFromName();
	$from = !empty($name) ? array($name => $mail->getFrom()) : array($mail->getFrom());

	var_dump($from) 
 ?>