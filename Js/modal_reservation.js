document.addEventListener('DOMContentLoaded', function () {
    let modal = document.querySelector('.modal');
    let modalOverlay = document.querySelector('.modal-overlay');
    let modalButtons = document.querySelectorAll('.open-modal-btn');
    let modalClose = document.querySelector('.modal .close');
    let modalProductId = document.getElementById('modalProductId');
    let modalUserId = document.getElementById('modalUserId');

    modalButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            let productId = button.dataset.productId;
            let userId = button.dataset.userId;

            // Aggiorna il contenuto del modal con i dati del prodotto e dell'utente
            modalProductId.textContent = productId;
            modalUserId.textContent = userId;

            // Mostra il modal e l'overlay
            modal.style.display = 'block';
            modalOverlay.style.display = 'block';
        });
    });

// document.addEventListener('DOMContentLoaded', function () {
//     var modalButtons = document.querySelectorAll('.open-modal-btn');
//     modalButtons.forEach(function (button) {
//         button.addEventListener('click', function () {
//             var productId = button.dataset.productId;
//             var userId = button.dataset.userId;
//             console.log('Product ID:', productId);
//             console.log('User ID:', userId);
//             // Continua con il resto della logica
//         });
//     });


    // Chiudi il modal se si clicca sul pulsante di chiusura o sull'overlay
    modalClose.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', closeModal);

    function closeModal() {
        modal.style.display = 'none';
        modalOverlay.style.display = 'none';
    }

    // Gestione dell'invio del form di prenotazione
    let bookingForm = document.getElementById('bookingForm');
    bookingForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita il comportamento di default del form

        let start_reservation = document.getElementById('start_reservation').value;
        let end_reservation = document.getElementById('end_reservation').value;
        
        

        // Esempio di invio dei dati al server in formato JSON tramite fetch API
        let requestData = {
            productId: modalProductId.textContent,
            userId: modalUserId.textContent,
            start_reservation: start_reservation,
            end_reservation: end_reservation
        };

        console.log('Dati inviati al server:', requestData);

        fetch(' /public/process_booking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestData)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Errore HTTP, stato ' + response.status);
                }
                return response.text(); // Otteniamo la risposta come testo
            })
            .then(text => {
                console.log('Risposta ricevuta dal server:', text); // Log della risposta testuale

                if (text.trim() === "") {
                    throw new Error('Risposta vuota dal server');
                }

                try {
                    const data = JSON.parse(text); // Tentiamo di parare il testo come JSON
                    console.log(data);
                    closeModal();
                    if (data.success) {
                        alert('Prenotazione registrata con successo!');
                    } else {
                        alert('Errore durante la registrazione della prenotazione: ' + data.message);
                    }
                } catch (error) {
                    console.error('Errore nel parsing JSON:', error, text);
                    alert('Errore durante la registrazione della prenotazione.');
                }
            })
            .catch(error => {
                console.error('Errore durante l\'invio della prenotazione:', error);
                alert('Errore durante l\'invio della prenotazione.');
            });

    });
});
