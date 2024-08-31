document.addEventListener('DOMContentLoaded', function () {
    let modal = document.getElementById('bookingModal');
    let modalOverlay = document.querySelector('.modal-overlay');
    let modalElements = document.querySelectorAll('.open-modal-div');
    let modalClose = document.querySelector('.modal .close');
    let modalProductId = document.getElementById('modalProductId');
    let modalUserId = document.getElementById('modalUserId');

    modalElements.forEach(function (element) {
        element.addEventListener('click', function () {
            let productId = element.dataset.productId;
            let userId = element.dataset.userId;

            // Met à jour le contenu du modal avec les données du produit et de l'utilisateur
            if (modalProductId && modalUserId) {
                modalProductId.textContent = productId;
                modalUserId.textContent = userId;
            } else {
                console.error('Les éléments pour les données du produit et de l\'utilisateur n\'ont pas été trouvés.');
            }

            // Affiche le modal et l'overlay
            modal.style.display = 'block';
            modalOverlay.style.display = 'block';
        });
    });

    // Ferme le modal si l'on clique sur le bouton de fermeture ou sur l'overlay
    modalClose.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', closeModal);

    function closeModal() {
        modal.style.display = 'none';
        modalOverlay.style.display = 'none';
    }
});


function updateDateDisplay() {
    const startInput = document.getElementById('start_reservation').value;
    const endInput = document.getElementById('end_reservation').value;

    // Vérifie si les deux dates ont été sélectionnées
    if (startInput && endInput) {
        const startDate = new Date(startInput);
        const endDate = new Date(endInput);

        // Calcule la différence en millisecondes entre les deux dates
        const diffInMs = endDate - startDate;

        // Convertit la différence de millisecondes en jours
        const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

        // Affiche la durée en jours
        document.getElementById('result').textContent =
            `La durée de la réservation est de ${diffInDays} jours.`;
    } else {
        document.getElementById('result').textContent = 'Veuillez sélectionner les deux dates.';
    }
}

// Ajoute des événements de changement aux champs de saisie
document.getElementById('start_reservation').addEventListener('change', updateDateDisplay);
document.getElementById('end_reservation').addEventListener('change', updateDateDisplay);
