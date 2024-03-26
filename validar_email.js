function ValidateEmail(inputText){
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.value.match(mailformat)){
        //alert("Email valido!");
        email.setCustomValidity("");
        document.form.email.focus();

        //Inserir validações

        return true;
    }
    else{
        alert("Email invalido!");
        email.setCustomValidity("Email inválido, corrija-o e tente novamente!");
        email.reportValidity();
        document.form.email.focus();
        return false;
    }
}