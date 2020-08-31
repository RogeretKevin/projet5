//VERIFICATION DES MESSAGES DU FORMULAIRE

class Form {
    constructor(){
        this.button = document.getElementById("button");
        this.name = document.getElementById("name");
        this.email = document.getElementById("email");
        this.message = document.getElementById("message");
        this.nameRegx = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/;
        this.emailRegx = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        this.errors = document.getElementById("ul-form");
        this.button.addEventListener('click', this.valid.bind(this));
    }

    

    valid = (event) =>{
        let error = [];
        this.errors.innerHTML = null;
        if (this.name.value.length > 30){
            event.preventDefault();
            error.push("Votre nom comporte plus de 30 caracteres !");
        }
        if(this.nameRegx.test(this.name.value) == false && this.name.value.length !== 0){ 
            event.preventDefault();
            error.push("Votre non comporte des chiffres ou CP");
        }
        if(this.emailRegx.test(this.email.value) == false && this.email.value.length !== 0){ 
            event.preventDefault();
            error.push("Entrez une adresse email valide !");
        }
        if(this.name.value.length === 0 || this.message.value.length === 0 || this.email.value.length === 0){ 
            event.preventDefault();
            error.push("Veuillez rentrer toutes les informations !");
        }
        if(this.message.value.length > 255){
            event.preventDefault();
            error.push("Votre message comporte plus de 255 caracteres !");
        }

        for (var i = 0; i < error.length; i++) {
            var li = document.createElement("li");
            let text = document.createTextNode(error[i]);
            li.appendChild(text);
            this.errors.appendChild(li);
        }
    }
}

let newForm = new Form();