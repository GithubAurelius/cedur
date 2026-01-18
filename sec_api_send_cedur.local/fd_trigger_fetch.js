function trigger_post(post_file, saveButton, pseudonym, patienten_email) {
    const feedbackIcon = document.getElementById('feedback-icon');
    // UI auf "Wird geladen" setzen
    if (feedbackIcon) feedbackIcon.textContent = '⏳';
    saveButton.disabled = true; // Button während des Ladevorgangs deaktivieren

    // Daten für den PHP-Post-Request vorbereiten
    const formData = new URLSearchParams();
    formData.append('pseudonym', pseudonym);
    formData.append('patienten_email', patienten_email);
    // Hier könnten weitere Daten hinzugefügt werden, z.B. Token etc.

    // Asynchronen Fetch-Aufruf starten
    fetch(post_file, { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData
    }) 
        .then(response => {
            // HTTP-Fehler (z.B. 404, 500) hier abfangen
            if (!response.ok) {
                throw new Error(`HTTP Error! Status: ${response.status}`);
            }
            // Versucht, die JSON-Antwort zu parsen
            return response.json();
        })
        .then(data => {
            // JSON-Ergebnis verarbeiten
            if (data.status === 'OK') {
                if (feedbackIcon) feedbackIcon.textContent = '✅'; // Erfolg
                // Optional: Tooltip oder Logik für data.message
                console.log(`✅ Aktion erfolgreich. Meldung: ${data.message}`);
            } else {
                if (feedbackIcon) feedbackIcon.textContent = '❌'; // Logischer Fehler (z.B. Validierung)
                console.error('Server-Logikfehler:', data.message);
            }
        })
        .catch(error => {
            // Verbindung/Netzwerkfehler abfangen
            if (feedbackIcon) feedbackIcon.textContent = '❌';
            alert(`Ein kritischer Fehler ist aufgetreten. Der Server konnte nicht kontaktiert werden. (${error.message})`);
            console.error('Fetch-Fehler:', error);
        })
        .finally(() => {
            // UI zurücksetzen
            saveButton.disabled = false;
            // Das ⏳ wird erst am Ende durch ✅ oder ❌ ersetzt
        });
}
