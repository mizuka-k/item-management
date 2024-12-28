let passwordField = document.getElementById('password');
let toggleIcon = document.getElementById('eye1');

let passwordField2 = document.getElementById('password2');
let toggleIcon2 = document.getElementById('eye2');

let passwordField3 = document.getElementById('password3');
let toggleIcon3 = document.getElementById('eye3');

toggleIcon.addEventListener('click', function(){
    switchPasswordVisibility(passwordField,toggleIcon)
});
toggleIcon2.addEventListener('click', function(){
    switchPasswordVisibility(passwordField2,toggleIcon2)
});
toggleIcon3.addEventListener('click', function(){
    switchPasswordVisibility(passwordField3,toggleIcon3)
});

function switchPasswordVisibility(passwordField,toggleIcon){
        if(passwordField.type == 'password'){
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }else{
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
}