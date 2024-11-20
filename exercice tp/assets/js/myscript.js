function verifierFormulaire(){

    let password = document.getElementById('password');
  
    if (password.value.length < 8) {
      password.classList.add('border-danger');
      pwd.classList.remove('invisible');
      password.classList.remove('border-valide');
    } 
    else {
      password.classList.remove('border-danger');
      pwd.classList.add('invisible');
      password.classList.add('border-valide');
    }
    let name = document.getElementById('name');
  
    if (name.value.length == "") {
      name.classList.add('border-danger');
      name.classList.remove('border-valide')
    } 
    else {
      name.classList.remove('border-danger');
      name.classList.add('border-valide');
    }
  
    let prénom = document.getElementById('prénom');
  
    if (prénom.value.length == "") {
      prénom.classList.add('border-danger');
      prénom.classList.remove('border-valide')
    } 
    else {
      prénom.classList.remove('border-danger');
      prénom.classList.add('border-valide');
    }
  
    let message = document.getElementById('message');
  
    if (message.value.length == "") {
      message.classList.add('border-danger');
      message.classList.remove('border-valide')
    } 
    else {
      message.classList.remove('border-danger');
      message.classList.add('border-valide');
    }
    let email = document.getElementById('email');
  
    if (email.value == "3" || !email.value.includes('@') || email.value == "3" ||  !email.value.includes('.')) {
      email.classList.add('border-danger');
      email.classList.remove('border-valide')
      
    } 
    else {
      email.classList.remove('border-danger');
      email.classList.add('border-valide');
    }
  
  
     let cocher = document.getElementById('formCheck-1');
     let age =document.getElementById('label')
  
  
     if(!cocher.checked){
      age.classList.add('text-danger');
      age.classList.remove('text-valide');
     }else{ if(cocher.checked){
      age.classList.remove('text-danger');
      age.classList.add('text-valide');
     }
    }
     
  }