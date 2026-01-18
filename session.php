<?php
if (!isset($_SESSION)) session_start();
// <?php echo $_SESSION['update_intervall'] 

$pre_link = "";
$from = $FROM ?? "";
if ($from == 'forms') $pre_link = "../";
?>
<script>
    const ping_intervall = parseInt(<?php echo json_encode($_SESSION['PING_INTERVAL'] ?? 0) ?>);
    const show_console = <?php echo json_encode($_SESSION['PING_SHOW'] ?? "")?>;
    const PING_INTERVAL = ping_intervall * 1000; // 1 Minute
    let accessToken = <?php echo json_encode($_SESSION['access_token'] ?? null); ?>;
    let expiresIn = <?php echo json_encode($_SESSION['access_expires'] ?? null); ?>;

    console.log("%c🔄 Session acitive", "color:darkgreen;font-weight:bold;");
    if (show_console) {
        console.log("%c🔄 Session-Debug gestartet", "color:orange;font-weight:bold;");
        console.log("Aktuelles Access-Token:", accessToken);
        console.log("Läuft ab um:", new Date(expiresIn * 1000).toLocaleTimeString());
        console.log("Cookies sichtbar im JS:", document.cookie || "(keine Cookies sichtbar)");
    }

    // ---------------------------------------------------------------------------
    // 🧩 1) Session-Ping
    // ---------------------------------------------------------------------------
    async function update_user_log() {
        try {
            const res = await fetch(<?php echo json_encode($pre_link)?> + 'session_fetch_user_log.php', {
                method: 'POST'
            });

            const result = await res.json();

            if (result.status === "ok") {
                if (show_console) console.log("✅ Log erfolgreich aktualisiert (Sessiondaten verwendet).");
            } else {
                console.warn("⚠️ Log Update fehlgeschlagen.");
            }

        } catch (error) {
            console.error("❌ Log Fetch-Fehler:", error);
        }
    }

    async function pingSession() {
        if (show_console) console.log("%c[PING] --> /session_keepalive.php", "color:deepskyblue;");
        try {
            const res = await fetch(<?php echo json_encode($pre_link)?> + 'session_keepalive.php', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${accessToken}`
                },
                credentials: 'same-origin'
            });

            const data = await res.json();
             if (show_console) console.log("%c[PING-Response]", "color:deepskyblue;", data);

            switch (data.status) {
                case 'ok':
                    if (show_console) console.log("✅ Session aktiv — nächste Verlängerung:", new Date((Date.now() + PING_INTERVAL)).toLocaleTimeString());
                    update_user_log();
                    break;
                case 'expired':
                    console.warn("⚠️ Access-Token abgelaufen — versuche Refresh");
                    await refreshToken();
                    break;
                case 'no_token':
                    console.warn("🚫 Kein Access-Token auf Server vorhanden.");
                    break;
                default:
                    console.log("ℹ️ Unbekannter Status:", data.status);
            }
        } catch (err) {
            console.error("❌ Ping-Fehler:", err);
        }
    }

    // ---------------------------------------------------------------------------
    // 🧩 2) Refresh-Token anfordern
    // ---------------------------------------------------------------------------
    async function refreshToken() {
        if (show_console) console.log("%c[REFRESH] --> /session_token_refresh.php", "color:limegreen;");

        try {
            const res = await fetch(<?php echo json_encode($pre_link)?> + 'session_token_refresh.php', {
                credentials: 'same-origin'
            });
            const data = await res.json();

            if (show_console) console.log("%c[REFRESH-Response]", "color:limegreen;", data);

            if (data.status === 'refreshed') {
                accessToken = data.access_token;
                expiresIn = Math.floor(Date.now() / 1000) + data.expires_in;
                console.log("🔁 Neues Access-Token erhalten:", accessToken);
                console.log("⏰ Gültig bis:", new Date(expiresIn * 1000).toLocaleTimeString());
            } else {
                console.warn("⚠️ Refresh fehlgeschlagen:", data.status);
                alert('Session abgelaufen – bitte neu einloggen.');
                window.location.href = <?php echo json_encode($pre_link)?> + 'login.php';
            }
        } catch (err) {
            console.error("❌ Refresh-Fehler:", err);
        }
    }

    // ---------------------------------------------------------------------------
    // 🧩 3) Sichtbare Cookies regelmäßig prüfen
    // ---------------------------------------------------------------------------
    function checkCookies() {
        if (show_console) console.log("%c[Cookie-Check]", "color:gray;", document.cookie || "(keine Cookies sichtbar)");
    }

    // ---------------------------------------------------------------------------
    // 🔁 Intervall-Timer starten
    // ---------------------------------------------------------------------------
    setInterval(() => {
        checkCookies();
        pingSession();
    }, PING_INTERVAL);
</script>