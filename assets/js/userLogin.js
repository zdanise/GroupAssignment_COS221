const signUpButton = document.getElementById('signUp');
const logInButton = document.getElementById('logIn');
const container = document.getElementById('container');
const Alert = document.getElementById('alert');
var closeBtn = document.getElementById('close-btn');
var message = document.getElementById('msg');
//=============User SignUp elements======================
const iName = document.getElementById('iSignName');
const iSurname = document.getElementById('iSignSurname');
const iUsername = document.getElementById('iSignUsername');
const iEmail = document.getElementById('iSignEmail');
const iPassword = document.getElementById('iSignPassword');
const iRepeatPass = document.getElementById('iSignRPassword');
const fSignup = document.getElementById('signupForm')
const signUp = document.getElementById("btnSignUp");
//======end=======User SignUp elements========end==============


//=============User Login elements======================
const iLogUsername = document.getElementById('iLoginUsername');
const iLogPassword = document.getElementById('iLoginPassword');
const fLogin = document.getElementById('loginForm')
const login = document.getElementById("btnLogin");
// ====end======User Login elements======end=========



const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
const usernameRegex = /[~!@#$%^&*()+={}<>?/\\|]/;
const nameRegex = /[0-9~!@#$%^&*()_+={}<>?/\\|]/;
const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,15}$/;

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

logInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});


closeBtn.addEventListener('click', ()=>{
    Alert.classList.add('hide');
    Alert.classList.remove('show'); 
})

function validateUserSignUp(){
    if(iName.value.length < 2 || iName.value.match(nameRegex))
    {
        Alert.classList.remove('hide');
        Alert.classList.add('show');   
        message.innerHTML = 'Name must contain more than 1 character and must be [A-Z,a-z]';
        iName.focus();
        return false;
    }
    else{
        if(iSurname.value.length < 2 || iSurname.value.match(nameRegex))
        {
            Alert.classList.remove('hide');
            Alert.classList.add('show');   
            message.innerHTML = 'Surname must contain more than 1 characters and must be [A-Z,a-z]';
            iSurname.focus();
            return false;
        }
        else{
            if(iUsername.value.length < 5 || iUsername.value.match(usernameRegex))
            {
                Alert.classList.remove('hide');
                Alert.classList.add('show');   
                message.innerHTML = 'Username must be have more than 4 characters and must be [A-Z,a-z, 0-9]';
                iUsername.focus();
                return false;
            }
            else{

                if(!iEmail.value.match(emailRegex))
                {
                    Alert.classList.remove('hide');
                    Alert.classList.add('show');   
                    message.innerHTML = 'Invalid email';
                    iEmail.focus();
                    return false;
                }
                else{
                    if(!iPassword.value.match(passwordRegex))
                    {
                        Alert.classList.remove('hide');
                        Alert.classList.add('show');   
                        message.innerHTML = 'Invalid password. Password must be 6-15 characters and contain each these:\nLower case letter\nUpper case letter\nNumerical digit\nAnd special character';
                        iPassword.value = "";
                        iPassword.focus();
                        return false;
                    }
                    else
                    {
                        if(iRepeatPass.value != iPassword.value)
                        {
                            Alert.classList.remove('hide');
                            Alert.classList.add('show');   
                            message.innerHTML = 'Passwords must match';
                            iRepeatPass.focus();
                            return false;
                        }
                    }
                }
            }
        }
    }
}



function validateUserLogin(){

    if(iLogUsername.value.length < 2)
    {
        Alert.classList.remove('hide');
        Alert.classList.add('show');   
        message.innerHTML = 'Name must have more than 1 character';
        iLogUsername.focus();
        return false;
    }
    else{
        if(iLogPassword.value.length < 1 )
        {
            Alert.classList.remove('hide');
            Alert.classList.add('show');   
            message.innerHTML = 'Password field required';
            iLogPassword.focus();
            return false;
        }
    }
}
