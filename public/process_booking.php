<?php 
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require __ROOT__ . "/admin/include/connect.php";

// Impostiamo l'intestazione della risposta per restituire JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera il contenuto della richiesta
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    var_dump($data);
    exit();

    // Controlla se la decodifica ha avuto successo
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        // Rispondi con un JSON di errore
        echo json_encode(['success' => false, 'message' => 'Errore nella decodifica del JSON: ' . json_last_error_msg()]);
        exit();
    }

    // Rimuovi il debug var_dump
    // var_dump($data);
    // exit();

    // Esegui le operazioni necessarie con $data (es. inserimento nel database)

    // Rispondi con un JSON di successo
    echo json_encode(['success' => true, 'message' => 'Dati ricevuti correttamente']);
    exit();
} else {
    // La richiesta non è una POST
    echo json_encode(['success' => false, 'message' => 'Richiesta non valida']);
    exit();
}
?>
