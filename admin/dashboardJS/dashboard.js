document.addEventListener('DOMContentLoaded', function () {
    // Sélectionne tous les liens de la barre latérale
    const sidebarLinks = document.querySelectorAll('.sidebar_dash a');

    // Ajoute un événement de clic à chaque lien
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien

            // Supprime la classe "active" de tous les panneaux
            const panels = document.querySelectorAll('.panel');
            panels.forEach(panel => {
                panel.classList.remove('active');
            });

            // Ajoute la classe "active" à la section correspondante
            const targetId = this.getAttribute('href').substring(1); // Obtient l'ID de la section cible
            const targetPanel = document.getElementById(targetId);
            targetPanel.classList.add('active');
        });
    });

    // Affiche le premier panneau par défaut
    if (sidebarLinks.length > 0) {
        sidebarLinks[0].click();
    }
});

// Ajout d'un utilisateur

let modal_add = document.getElementById("addUserModal");
let btn = document.querySelector(".add-user-btn");
let span = document.querySelector(".modal .close_form");

// Affiche le modal lors du clic sur le bouton
btn.onclick = function () {
    modal_add.style.display = "block";
}

// Ferme le modal lors du clic sur "X"
span.onclick = function () {
    modal_add.style.display = "none";
}

// Ferme le modal si l'on clique en dehors de la fenêtre du modal
window.onclick = function (event) {
    if (event.target == modal_add) {
        modal_add.style.display = "none";
    }
}

// Suppression de l'utilisateur

document.addEventListener('DOMContentLoaded', () => {
    // Gère l'ouverture des modals
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            const userId = button.getAttribute('data-user-id');
            if (modal) {
                userIdInput.value = userId; // Définit l'ID de l'utilisateur dans le champ caché
                modal.style.display = 'flex'; // Affiche le modal
            }
        });
    });

    // Gère la fermeture des modals
    document.querySelectorAll('.close').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none'; // Masque le modal
            }
        });
    });

    // Ferme le modal si l'on clique en dehors de la fenêtre du modal
    window.addEventListener('click', (event) => {
        document.querySelectorAll('.modal').forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none'; // Masque le modal
            }
        });
    });
});

// Modification du compte utilisateur

document.addEventListener('DOMContentLoaded', () => {
    // Gère l'ouverture des modals
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
            }
        });
    });

    // Gère la fermeture des modals
    document.querySelectorAll('.close').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Ferme le modal si l'on clique en dehors de la fenêtre du modal
    window.addEventListener('click', (event) => {
        document.querySelectorAll('.modal').forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Obtient la chaîne de requête
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    // Vérifie le paramètre 'status'
    const status = urlParams.get('status');

    if (status === 'success') {
        document.getElementById('successBanner').style.display = 'block';
        setTimeout(() => {
            document.getElementById('successBanner').style.display = 'none';
        }, 5000); // Masque après 5 secondes
    } else if (status === 'error') {
        document.getElementById('errorBanner').style.display = 'block';
        setTimeout(() => {
            document.getElementById('errorBanner').style.display = 'none';
        }, 5000); // Masque après 5 secondes
    }
});



//reservation 

function openModal(modalElement) {
    modalElement.style.display = "block";
}

// Fonction pour fermer un modale spécifique
function closeModal(modalElement) {
    modalElement.style.display = "none";
}

// Événement pour ouvrir les modales
document.querySelectorAll('.btn_view').forEach(button => {
    button.addEventListener('click', function () {
        let reservationId = this.getAttribute('data-modal-id');
        let modalElement = document.querySelector(`.modal[data-reservation-id="${reservationId}"]`);
        if (modalElement) {
            openModal(modalElement);
        }
    });
});

// Événement pour fermer les modales
document.querySelectorAll('.close-modal').forEach(button => {
    button.addEventListener('click', function () {
        let modalElement = this.closest('.modal');
        if (modalElement) {
            closeModal(modalElement);
        }
    });
});

// Événement pour fermer le modale en cliquant en dehors
window.addEventListener('click', function (event) {
    if (event.target.classList.contains('modal')) {
        closeModal(event.target);
    }
});

function toggleCheckbox(clickedId) {
    const acceptCheckbox = document.getElementById('accept');
    const refuseCheckbox = document.getElementById('refuse');

    if (clickedId === 'accept') {
        if (acceptCheckbox.checked) {
            refuseCheckbox.checked = false;
            refuseCheckbox.disabled = true; // Disabilita "Refuser" quando "Accepter" è selezionato
        } else {
            refuseCheckbox.disabled = false; // Riabilita "Refuser" se "Accepter" viene deselezionato
        }
    } else if (clickedId === 'refuse') {
        if (refuseCheckbox.checked) {
            acceptCheckbox.checked = false;
            acceptCheckbox.disabled = true; // Disabilita "Accepter" quando "Refuser" è selezionato
        } else {
            acceptCheckbox.disabled = false; // Riabilita "Accepter" se "Refuser" viene deselezionato
        }
    }
}