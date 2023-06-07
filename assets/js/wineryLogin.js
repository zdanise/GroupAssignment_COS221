const signUpButton = document.getElementById('signUp');
const logInButton = document.getElementById('logIn');
const container = document.getElementById('container');
const Alert = document.getElementById('alert');
var closeBtn = document.getElementById('close-btn');
var message = document.getElementById('msg');
//=============Winery Login elements======================
const iLogName = document.getElementById('iLoginName');
const iLogPassword = document.getElementById('iLoginPass');
const login = document.getElementById("btnLogin");
// ====end======Winery Login elements======end=========


//=============User SignUp elements======================
const iName = document.getElementById('iSignName');
const iType = document.getElementById('iSignType');
const iLocation = document.getElementById('iSignLocation');
const iEmail = document.getElementById('iSignEmail');
const iPassword = document.getElementById('iSignPassword');
const iRepeatPass = document.getElementById('iRepeatPassword');
const signUp = document.getElementById("btnSignUp");
//======end=======User SignUp elements========end==============

const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
const usernameRegex = /[~!@#$%^&*()+={}<>?/\\|]/;
const nameRegex = /[~!@#$%^&*()_+={}<>?/\\|]/;
const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,15}$/;
const locationRegex = /^[A-Z][a-z]+([\s]{0,1}[A-Z][a-z]+)*, [A-Z][a-z]+([\s]{0,1}[A-Z][a-z]+)*$/

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

function validateWineryLogin(){
    if(iLogName.value.length < 2)
    {
        Alert.classList.remove('hide');
        Alert.classList.add('show');   
        message.innerHTML = 'Name must have more than 1 character';
        iLogName.focus();
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
        else{
            //check with api if credentials are correct and correspond
        }
    }
}

function validateWinerySignUp(){

    if(iName.value.length < 2 || iName.value.match(nameRegex))
    {
        Alert.classList.remove('hide');
        Alert.classList.add('show');   
        message.innerHTML = 'Name must contain more than 1 character within [A-Z,a-z, 0-9]';
        iName.focus();
        return false;
    }
    else{
        if(iType.value.length < 2 || iType.value.match(nameRegex))
        {
            Alert.classList.remove('hide');
            Alert.classList.add('show');   
            message.innerHTML = 'Type must contain more than 1 characters within [A-Z,a-z]';
            iType.focus();
            return false;
        }
        else{
            if(iLocation.value.length < 2 || !iLocation.value.match(locationRegex))
            {
                Alert.classList.remove('hide');
                Alert.classList.add('show');   
                message.innerHTML = 'Location must contain more than 1 characters within [A-Z,a-z]';
                iLocation.focus();
                return false;
            }
            else{
                if(iEmail.value.length < 1 || !iEmail.value.match(emailRegex))
                {
                    Alert.classList.remove('hide');
                    Alert.classList.add('show');   
                    message.innerHTML = 'Invalid Email';
                    iEmail.focus();
                    return false;
                }
                else{

                    if(!iPassword.value.match(passwordRegex))
                    {
                        Alert.classList.remove('hide');
                        Alert.classList.add('show');   
                        message.innerHTML = 'Invalid password. Password must be 6-15 characters and contain each of these:\nLower case letter, Upper case letter, Numerical digit, and a special character';
                        iPassword.focus();
                        return false;
                    }
                    else{

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
               //check with db through api if there already exist such a winery
            }
        }
    }
}


