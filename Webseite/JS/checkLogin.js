function checkLoginData()//formular
{
	var AlertString="";
	var currentCheck =document.getElementById('login_usr').value.length;
	alert(currentCheck);
	if(currentCheck<3||currentCheck>20)
	{
		AlertString=AlertString+"Bitte username checken!\n";
		document.getElementById('login_usr').style.border="solid red";
	}
	var currentCheck=document.getElementById('login_pw').value;//Pw check
	var regex= /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
	
	if(currentCheck.match(regex)==false||currentCheck.length<5)
	{
		AlertString=AlertString+"Bitte Passwort checken!\n";
		document.getElementById('login_pw').style.border="solid red";}//pw check end
		
	if(AlertString=="")
	{
	return true;
	}
	else return false;
}