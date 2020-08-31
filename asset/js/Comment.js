//VERIFICATION DES COMMENTAIRES

class Comment {
    constructor(){
        this.button = document.getElementById("button-comment");
        this.pseudo = document.getElementById("pseudo-comment");
        this.comment = document.getElementById("comment");
        this.errors = document.getElementById("ul-comment");
        this.button.addEventListener('click', this.valid.bind(this));
    }

    valid = (event) =>{
        let error = [];
        this.errors.innerHTML = null;
        if(this.pseudo.value.length > 20){
            event.preventDefault();
            error.push("Votre pseudo comporte plus de 20 caracteres !");
        }
        if(this.pseudo.value.length === 0 || this.comment.value.length === 0){ 
            event.preventDefault();
            error.push("Veuillez rentrer toutes les informations !");
        }
        if(this.comment.value.length > 255){
            event.preventDefault();
            error.push("Votre commentaire comporte plus de 255 caracteres !");
        }
        else{}

        for (var i = 0; i < error.length; i++) {
            var li = document.createElement("li");
            let text = document.createTextNode(error[i]);
            li.appendChild(text);
            this.errors.appendChild(li);
        }
    }
}

let newComment = new Comment();