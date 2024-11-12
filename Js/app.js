const submit = document.querySelector("#submit");
const pass = document.querySelector("#pass");

submit.addEventListener("click", (e) => {
    e.preventDefault();
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;
    const data = {
        email: email,
        password: password,
    };
    const options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    };
    fetch("/login", options)
    .then((res) => res.json())
    .then((data) => {
        if (data.success) {
            window.location.href = "/";
        } else {
            pass.style.display = "block";
        }
    })
    .catch((err) => {
        console.log(err);
    });
    // console.log(email, password);
    // console.log(data);
    // console.log(options);
});

// the below code fragment can be found in: 

// const submit = document.querySelector("#submit"); : Sélectionne l'élément HTML avec l'ID "submit", probablement un bouton de soumission de formulaire.

// const pass = document.querySelector("#pass"); : Sélectionne l'élément HTML avec l'ID "pass", probablement un élément d'affichage d'erreur.

// submit.addEventListener("click", (e) => { ... }); : Ajoute un écouteur d'événements de clic au bouton de soumission. Lorsque le bouton est cliqué, la fonction fléchée est déclenchée.

// e.preventDefault(); : Empêche le comportement par défaut du formulaire, qui est le rechargement de la page lors de la soumission.

// const email = document.querySelector("#email").value; : Récupère la valeur du champ d'entrée de l'email.

// const password = document.querySelector("#password").value; : Récupère la valeur du champ d'entrée du mot de passe.

// const data = { email: email, password: password }; : Crée un objet data contenant l'email et le mot de passe.

// const options = { ... }; : Crée un objet options pour configurer la requête HTTP à l'aide de la méthode POST et le corps de la requête contenant les données au format JSON.

// fetch("/login", options) : Envoie une requête POST vers l'URL "/login" avec les options spécifiées.

// .then((res) => res.json()) : Récupère la réponse de la requête HTTP et la convertit en format JSON.

// .then((data) => { ... }) : Traite les données de réponse JSON.

// if (data.success) { ... } else { ... } : Vérifie si la réponse contient une propriété "success" définie à true. Si oui, redirige l'utilisateur vers la page d'accueil, sinon affiche un message d'erreur.

// .catch((err) => { console.log(err); }); : Capture les erreurs de la requête et les affiche dans la console.