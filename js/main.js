function togglePassword(){
    var userPassword = document.getElementById('pswd');
    if(userPassword.type === 'password'){
        userPassword.type = 'text';
        document.getElementById('#toggle').innerText =  "Hide Password";
    }
    else{
        userPassword.type = 'password';
        document.getElementById('#toggle').innerText = "Show Password";
    }

}	

function increament(){
    document.getElementById("quantity").innerText + 1;
}