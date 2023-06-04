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
const signUp = document.getElementById("btnSignUp");
//======end=======User SignUp elements========end==============

const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
const usernameRegex = /[~!@#$%^&*()+={}<>?/\\|]/;
const nameRegex = /[~!@#$%^&*()_+={}<>?/\\|]/;
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

login.addEventListener('click', ()=>{

    if(iLogName.value.length < 2)
    {
        Alert.classList.remove('hide');
        Alert.classList.add('show');   
        message.innerHTML = 'Never seen a name with less than 2 characters';
        iLogName.focus();
    }
    else{
        if(iLogPassword.value.length < 1 )
        {
            Alert.classList.remove('hide');
            Alert.classList.add('show');   
            message.innerHTML = 'Lets be serious';

            iLogPassword.focus();
        }
        else{
            //check with api if credentials are correct and correspond
        }
    }
})

signUp.addEventListener('click', ()=>{

    if(iName.value.length < 2 || iName.value.match(nameRegex))
    {
        Alert.classList.remove('hide');
        Alert.classList.add('show');   
        message.innerHTML = 'Name must contain more than 1 character within [A-Z,a-z, 0-9]';
        iName.focus();
    }
    else{
        if(iType.value.length < 2 || iType.value.match(nameRegex))
        {
            Alert.classList.remove('hide');
            Alert.classList.add('show');   
            message.innerHTML = 'Type must contain more than 1 characters within [A-Z,a-z]';
            iType.focus();
        }
        else{
            if(iLocation.value.length < 2 || iLocation.value.match(nameRegex))
            {
                Alert.classList.remove('hide');
                Alert.classList.add('show');   
                message.innerHTML = 'Location must contain more than 1 characters within [A-Z,a-z]';
                iLocation.focus();
            }
            else{
                if(iEmail.value.length < 1 || !iEmail.value.match(emailRegex))
                {
                    Alert.classList.remove('hide');
                    Alert.classList.add('show');   
                    message.innerHTML = 'Invalid Email';
                    iEmail.focus();
                }
                else{

                    if(!iPassword.value.match(passwordRegex))
                    {
                        Alert.classList.remove('hide');
                        Alert.classList.add('show');   
                        message.innerHTML = 'Invalid password. Password must be 6-15 characters and contain each of these:\nLower case letter, Upper case letter, Numerical digit, and a special character';
                        iPassword.focus();
                    }
                    else{

                    }
                }
               //check with db through api if there already exist such a winery
            }
        }
    }
})


