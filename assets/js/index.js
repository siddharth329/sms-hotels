console.log('mohak siddharth')

const onFormReset = () => confirm("Do you wan't to reset? All data will be lost.");

const onRegisterFormSubmit = (event) => {
    const errors = [];

    if (! /^[a-zA-Z]{2,30}$/.test(document.getElementById('name').value)) {
    	errors.push({ field: 'name', msg: 'not valid name' });
    }

    var email = window.document.registerform.email.value;
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        errors.push({ field: 'email', msg: 'enter valid email' });
    }

    var password = window.document.registerform.password.value;
    if ( !/^[A-Za-z]\w{7,14}$/.test(password)) {
        errors.push({ field: 'password', msg: 'not strong password' });
    }

    if (window.document.registerform.mobilenumber.value.length!==10) {
        errors.push({ field: 'mobilenumber', msg: 'not valid mobile number' });
    }

    var confirmpassword = window.document.registerform.cnfppassword.value
    if( password !== confirmpassword) {
    	errors.push({ field: 'confirm password', msg: 'pass and cnfp should match' });
    }

    if (errors.length) {
        alert(errors.map((err) => `Field: ${err.field}, Error: ${err.msg}`).join('\n'));
        return false;
    } else return confirm('do you want to sbumit, once submitted no correction can be done and after confirming');
};

const onLoginFormSubmit = (event) => {
    const errors = [];

    var email = window.document.loginform.email.value;
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        errors.push({ field: 'email', msg: 'enter valid email' });
    }

    var password = window.document.loginform.password.value;
    if ( !/^[A-Za-z]\w{7,14}$/.test(password)) {
        errors.push({ field: 'password', msg: 'invalid password' });
    }

    if (errors.length) {
        alert(errors.map((err) => `Field: ${err.field}, Error: ${err.msg}`).join('\n'));
        return false;
    } else return confirm('do you want to sbumit, once submitted no correction can be done and after confirming');
};
