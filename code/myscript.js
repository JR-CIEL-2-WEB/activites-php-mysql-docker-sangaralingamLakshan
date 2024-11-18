function verifierFormulaire() {

    var name = document.querySelector('input[name="name"]');
    var prénom = document.querySelector('input[name="prénom"]');
    var email = document.querySelector('input[name="email"]');
    var password = document.querySelector('input[name="password"]');
    var message = document.querySelector('textarea[name="message"]');
    var checkbox = document.querySelector('input[type="checkbox"]');
    var isValid = true;

    name.style.borderColor = '';
    prénom.style.borderColor = '';
    email.style.borderColor = '';
    password.style.borderColor = '';
    message.style.borderColor = '';
    checkbox.style.outline = '';

    if (name.value.trim() === '') {
        name.style.borderColor = 'red';
        isValid = false;
    } else {
        name.style.borderColor = 'green';
    }

    if (prénom.value.trim() === '') {
        prénom.style.borderColor = 'red';
        isValid = false;
    } else {
        prénom.style.borderColor = 'green'; 
    }

    if (email.value.trim() === '') {
        email.style.borderColor = 'red';
        isValid = false;
    } else {
        email.style.borderColor = 'green';
    }

    if (password.value.trim() === '') {
        password.style.borderColor = 'red';
        document.querySelector('.text-danger').classList.remove('invisible');
        isValid = false;
    } else {
        document.querySelector('.text-danger').classList.add('invisible');
        password.style.borderColor = 'green';
    }

    if (message.value.trim() === '') {
        message.style.borderColor = 'red';
        isValid = false;
    } else {
        message.style.borderColor = 'green'; 
    }

    // Vérifier la case à cocher
    if (!checkbox.checked) {
        checkbox.style.outline = '2px solid red';
        isValid = false;
    } else {
        checkbox.style.outline = '2px solid green'; 
    }

}
