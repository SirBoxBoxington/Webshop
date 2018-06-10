function checkRegistration()//formular
{

	var AlertString="";
	var currentCheck =document.getElementById('username').value.length;
	alert(currentCheck);
	if(currentCheck<3||currentCheck>20)
	{
		AlertString=AlertString+"Bitte username checken!\n";
		document.getElementById('username').style.border="solid red";
	}
	var currentCheck=document.getElementById('password').value;//Pw check
	var regex= /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
	
	if(currentCheck.match(regex)==false||currentCheck.length<5)
	{
		AlertString=AlertString+"Bitte Passwort checken!\n";
		document.getElementById('password').style.border="solid red";}//pw check end
		
	var currentCheck=document.getElementById('passwordRep').value;
	if(currentCheck!=document.getElementById('password').value)
	{
		AlertString=AlertString+"Passwort stimmt nicht ueberein!\n";
		document.getElementById('passwordRep').style.border="solid red";}//pwrepeat check end
		
	var currentCheck=document.getElementById('plz').value;
	regex=/^\d+$/;
	if(currentCheck.length>6||regex.test(currentCheck)==false)//NummerCheck
	{
		AlertString=AlertString+"Bitte Postleitzahl checken!\n";
		document.getElementById('plz').style.border="solid red";
		}//NuemmerCheckEnd
		
		
	var currentCheck=document.getElementById('email').value;
	regex=/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;//regex by Steven Smith, @regexlib.com
	if(regex.test(currentCheck)==false)//email check
	{
		AlertString=AlertString+"Bitte Email checken!\n";
		document.getElementById('email').style.border="solid red";
	}//email check end
	
	if(document.getElementById('vorname').value=="")
	{
		AlertString=AlertString+"Bitte Vornamen angeben!\n";
		document.getElementById('vorname').style.border="solid red";
	}
	
	if(document.getElementById('nachname').value=="")
	{
		AlertString=AlertString+"Bitte Nachnamen angeben!\n";
		document.getElementById('nachname').style.border="solid red";
	}
	
	if(document.getElementById('ort').value=="")
	{
		AlertString=AlertString+"Bitte Ort angeben!\n";
		document.getElementById('ort').style.border="solid red";
	}
	
	if(document.getElementById('adresse').value=="")
	{
		AlertString=AlertString+"Bitte Adresse angeben!\n";
		document.getElementById('adresse').style.border="solid red";
	}
	
	
	alert(AlertString);
	if(AlertString!="")
	{
	alert(AlertString);
	return false;
	}
	else{return true;}
}