function validateConfirm(){
	var email = document.register.uemail.value;
	var password = document.register.upass.value;
	var confirm = document.register.upass2.value;
	if(password.length < 6 ){
		swal("Oops", "Password length must be greater than 6");
		return false;
	}if(password !== confirm){
		swal("Oops!", "Passwords do not match", "error");		
		return false;
	}
}

function formatPrice(arg){
	var id = getAttribute(arg);
	var inner = Number(document.getElementById(id).innerHTML);
	var converted = inner.toLocaleString();
	console.log(converted);
	//document.getElementById(id).innerHTML = converted;

}