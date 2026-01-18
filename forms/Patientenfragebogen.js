// BMI
function classify_bmi(bmi_info, val) {
    if (val > 0) {
        let cat = '';
        if (val) {
            if (val < 18.5) cat = 'Untergewicht';
            else if (val < 25) cat = 'Normalgewicht';
            else if (val < 30) cat = 'Übergewicht';
            else if (val < 35) cat = 'Adip. I';
            else if (val < 40) cat = 'Adip. II';
            else if (val >= 40) cat = 'Adip. permagna';
            col = 'gray';
            if (val < 18.5 || val > 29.9) col = 'orange';
            if (val > 39.9) col = 'red';
            bmi_info.innerHTML = "<span style='color:" + col + ";position:relative; top:5px'>&nbsp;&nbsp;" + cat + "&nbsp;</span>";
        }
    }
}

function set_bmi(bmi, bmi_info, gr, gw) {
    if (gr > 0) {
        if (gw && gr) {
            const bmi_val = gw / (gr / 100 * gr / 100);
            bmi.value = Math.round(bmi_val);
            const event = new Event('change', {
                bubbles: true
            });
            bmi.dispatchEvent(event);
            classify_bmi(bmi_info, bmi.value);
        } else return '';
    } else return '';
}

// CDAI

function get_weicherStuhl_cdai_score(cont) {
    let sf = 0;
    cont = document.getElementById('FF_' + cont).value;
    if (cont) {
        sf = parseInt(cont);
    }
    return sf;
}

function map_Bauchschmerzen(cont) {
    cont = document.getElementById('FF_' + cont).value;
    const mapping = {
        'keine': 0,
        'leichte': 1,
        'mäßige': 2,
        'schwere': 3
    };
    score = mapping[cont] !== undefined ? mapping[cont] : 0;
    return score;
}

function map_Allgemeinbefinden(cont) {
    cont = document.getElementById('FF_' + cont).value;
    const mapping = {
        'gut': 0,
        'beeinträchtigt': 1,
        'schlecht': 2,
        'sehr schlecht': 3,
        'unerträglich': 4
    };
    score = mapping[cont] !== undefined ? mapping[cont] : 0;
    return score;
}

function get_Ja_Nein_Factor(fieldNumbers) {
    let sum = 0;
    fieldNumbers.forEach(function (number) {
        const elementId = 'FF_' + number;
        const element = document.getElementById(elementId);
        if (element) {
            if (element.value === 'Ja') {
                sum += 1;
            }
        }
    });
    return sum;
}

function map_ResistenzAbdomen(cont) {
    cont = document.getElementById('FF_' + cont).value;
    const mapping = {
        'Nein': 0,
        'Ja': 5,
        'Fraglich': 2
    };
    score = mapping[cont] !== undefined ? mapping[cont] : 0;
    return score;
}

function calc_cdai_weight(geschlecht, gr, gw) {
    let norm_weight = 0; //(gr - 100); // not used
    if (geschlecht == 'weiblich' || geschlecht == 'divers') {
        norm_weight = (gr / 100) * (gr / 100) * 20.8;
    }
    if (geschlecht == 'männlich') {
        norm_weight = (gr / 100) * (gr / 100) * 22.1;
    }
    let factor = gw / norm_weight;
    let result = Math.round((1 - factor) * 100);
    // console.log("NW:" + norm_weight + " F:" + factor + " R:" + result);
    return result;
}

function calc_Haematokrit(geschlecht, cont) {
    cont = document.getElementById('FF_' + cont).value;
    if (geschlecht == 'weiblich' || geschlecht == 'divers') cont = 42 - cont;
    else if (geschlecht == 'männlich') cont = 47 - cont;
    else cont = 0;
    return cont;
}

function calculateTotalCdaiScore(sesScoreObject) {
    return Object.values(sesScoreObject).flat().reduce((sum, current) => sum + current, 0);
}

function set_cdai_score(gender_val, groesse_val, gewicht_val) {
    var cdai_score_a = {
        'weicherStuhl': 0,
        'Bauchschmerzen': 0,
        'Allgemeinbefinden': 0,
        'Extraintestinale': 0,
        'Durchfallmedikation': 0,
        'ResistenzAbdomen': 0,
        'Gewicht': 0,
        'Haematokrit': 0
    };
    cdai_score_a['Allgemeinbefinden'] = map_Allgemeinbefinden(104000);
    cdai_score_a['Bauchschmerzen'] = map_Bauchschmerzen(103900);
    cdai_score_a['ResistenzAbdomen'] = map_ResistenzAbdomen(116000);
    cdai_score_a['Extraintestinale'] = get_Ja_Nein_Factor([115900, 115600, 115700, 115800]);
    cdai_score_a['weicherStuhl'] = get_weicherStuhl_cdai_score(103500);
    const hbi_score = calculateTotalCdaiScore(cdai_score_a);
    cdai_score_a['Extraintestinale'] = get_Ja_Nein_Factor([115900, 115600, 115700, 104300, 104400, 115800]);
    cdai_score_a['Allgemeinbefinden'] = cdai_score_a['Allgemeinbefinden'] * 7 * 7;
    cdai_score_a['Bauchschmerzen'] = cdai_score_a['Bauchschmerzen'] * 7 * 5;
    cdai_score_a['ResistenzAbdomen'] = cdai_score_a['ResistenzAbdomen'] * 10;
    cdai_score_a['weicherStuhl'] = cdai_score_a['weicherStuhl'] * 7 * 2
    cdai_score_a['Extraintestinale'] = cdai_score_a['Extraintestinale'] * 20;
    cdai_score_a['Durchfallmedikation'] = get_Ja_Nein_Factor([103505]) * 30;
    if (gender_val && groesse_val) cdai_score_a['Gewicht'] = calc_cdai_weight(gender_val, groesse_val, gewicht_val);
    // else console.log('Geschlecht, Größe und Gewicht sind zur Berechnung des Aktivitätsindex CDAI notwendige Eingaben!');
    cdai_score_a['Haematokrit'] = calc_Haematokrit(gender_val, 110200) * 6;
    const total_score = calculateTotalCdaiScore(cdai_score_a);
    // console.log('CDAI:' + total_score + " HBI:" + hbi_score);
    return [total_score, hbi_score];
}

var cdai_score_a = {};

// SIDBQ / FACIT
function sum_object_vals(scoreObject) {
    return Object.values(scoreObject).reduce((sum, val) => sum + val, 0);
}

function getUserAnswers(keys) {
    return keys.map(key => {
        const field = document.getElementById(`FF_${key}`);
        return [key, field ? field.value : ""];
    });
}

function mapResponsesToScores(scaleDefinitions, userAnswers, score) {
    const valueMap = {};
    const scales = {};
    scaleDefinitions.forEach(entry => {
        const [key, values] = entry.split(';');
        scales[key] = values.split('|');
    });
    userAnswers.forEach(([key, response]) => {
        const options = scales[key];
        if (!options) {
            // console.warn(`Keine Skala für Schlüssel ${key} gefunden`);
            return;
        }
        const index = options.indexOf(response);
        if (index === -1) {
            // console.warn(`Antwort "${response}" nicht in Skala für Schlüssel ${key}`);
            return;
        }
        if (score === 'SIDBQ') valueMap[key] = index + 1; // Bewertung (1-basiert)
        if (score === 'FACIT') valueMap[key] = index;
        if (score === 'PROMIS_1-9') valueMap[key] = index + 1;
    });
    return valueMap;
}


function set_sidbq_score() {
    const userAnswers_sidbg = getUserAnswers([116700, 116800, 116900, 117000, 117100, 117200, 117300, 117400, 117500, 117600]);
    const userAnswers_to_val_sidbg = mapResponsesToScores(scaleDefinitions_sidbq, userAnswers_sidbg, 'SIDBQ');
    const total_score = sum_object_vals(userAnswers_to_val_sidbg);
    // console.log("SIDBQ:" + total_score);
    return total_score;
}

function set_facit_score() {
    const userAnswers_facit = getUserAnswers([117700, 117800, 117900, 118000, 118100, 118200, 118300, 118400, 118500, 118600, 118700, 118800, 118900]);
    const userAnswers_to_val_facit = mapResponsesToScores(scaleDefinitions_facit, userAnswers_facit, 'FACIT');
    const total_score = sum_object_vals(userAnswers_to_val_facit);
    // console.log("FACIT:" + total_score);
    return total_score;
}

function set_promis_score() {
    const userAnswers_promis = getUserAnswers([119100, 119110, 119120, 119130, 119140, 119150, 119160, 119170, 119180, 119190]);
    const userAnswers_to_val_promis = mapResponsesToScores(scaleDefinitions_promis, userAnswers_promis, 'PROMIS_1-9');
    const promis_10_val = parseInt(document.getElementById('FF_119190').value);
    const total_score = sum_object_vals(userAnswers_to_val_promis) + promis_10_val;
    // console.log("PROMIS:" + total_score);
    return total_score;
}

const scaleDefinitions_sidbq = ["116700;Ständig|Meistens|Ziemlich oft|Manchmal|Selten|Fast Nie|Nie",
    "116800;Ständig|Meistens|Ziemlich oft|Manchmal|Selten|Fast Nie|Nie",
    "116900;Sehr grosse Schwierigkeiten|Grosse Schwierigkeiten|Ziemliche Schwierigkeiten|Etwas Schwierigkeiten|Wenig Schwierigkeiten|Kaum Schwierigkeiten|Keine Schwierigkeiten",
    "117000;Ständig|Meistens|Ziemlich oft|Manchmal|Selten|Fast Nie|Nie",
    "117100;Ständig|Meistens|Ziemlich oft|Manchmal|Selten|Fast Nie|Nie",
    "117200;Sehr grosse Probleme|Grosse Probleme|Ziemliche Probleme|Etwas Probleme|Wenig Probleme|Kaum Probleme|Kein Problem",
    "117300;Sehr grosse Probleme|Grosse Probleme|Ziemliche Probleme|Etwas Probleme|Wenig Probleme|Kaum Probleme|Kein Problem",
    "117400;Ständig|Meistens|Ziemlich oft|Manchmal|Selten|Fast Nie|Nie",
    "117500;Ständig|Meistens|Ziemlich oft|Manchmal|Selten|Fast Nie|Nie",
    "117600;Ständig|Meistens|Ziemlich oft|Manchmal|Selten|Fast Nie|Nie"
];


const scaleDefinitions_facit = ["117700;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "117800;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "117900;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118000;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118100;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118200;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118300;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118400;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118500;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118600;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118700;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118800;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht",
    "118900;Sehr|Ziemlich|Mäßig|Ein wenig|Überhaupt nicht"
];

const scaleDefinitions_promis = ["119100;schlecht|einigermaßen|gut|sehr gut|ausgezeichnet",
    "119110;schlecht|einigermaßen|gut|sehr gut|ausgezeichnet",
    "119120;schlecht|einigermaßen|gut|sehr gut|ausgezeichnet",
    "119130;schlecht|einigermaßen|gut|sehr gut|ausgezeichnet",
    "119140;schlecht|einigermaßen|gut|sehr gut|ausgezeichnet",
    "119150;schlecht|einigermaßen|gut|sehr gut|ausgezeichnet",
    "119160;überhaupt nicht|ein wenig|halbwegs|größtenteils|vollständig",
    "119170;immer|oft|manchmal|selten|nie",
    "119180;sehr stark|stark|mäßig|schwach|keine Müdigkeit"
];



// SES
function map_Ulzeration(cont) {
    cont = document.getElementById('FF_' + cont).value;
    const mapping = {
        'keine': 0,
        'aphtoid < 0,5cm': 1,
        '0,5cm - 2cm': 2,
        '> 2cm': 3
    };
    return mapping[cont] !== undefined ? mapping[cont] : 0;
}

function map_Ausdehnung(cont) {
    cont = document.getElementById('FF_' + cont).value;
    const mapping = {
        'keine': 0,
        '< 10%': 1,
        '10 - 30%': 2,
        '> 30%': 3
    };
    return mapping[cont] !== undefined ? mapping[cont] : 0;
}

function map_Entzuendung(cont) {
    cont = document.getElementById('FF_' + cont).value;
    const mapping = {
        'keine': 0,
        '< 50%': 1,
        '50 - 75%': 2,
        '> 75%': 3
    };
    return mapping[cont] !== undefined ? mapping[cont] : 0;
}

function map_Stenose(cont) {
    cont = document.getElementById('FF_' + cont).value;
    const mapping = {
        'keine': 0,
        'singulär, passierbar': 1,
        'multipel, passierbar': 2,
        'nicht passierbar': 3
    };
    return mapping[cont] !== undefined ? mapping[cont] : 0;
}

function calculateTotalSesScore(sesScoreObject) {
    return Object.values(sesScoreObject).flat().reduce((sum, current) => sum + current, 0);
}

function set_ses_score_a() {
    var ses_score_a = {
        'Ileum': [0, 0, 0, 0],
        'Colon_r': [0, 0, 0, 0],
        'Colon_t': [0, 0, 0, 0],
        'Colon_l': [0, 0, 0, 0],
        'Rektum': [0, 0, 0, 0]
    };
    ses_score_a['Ileum'] = [map_Ulzeration(116202), map_Ausdehnung(116204), map_Entzuendung(116206), map_Stenose(116208)];
    ses_score_a['Colon_r'] = [map_Ulzeration(116302), map_Ausdehnung(116304), map_Entzuendung(116306), map_Stenose(116308)];
    ses_score_a['Colon_t'] = [map_Ulzeration(116402), map_Ausdehnung(116404), map_Entzuendung(116406), map_Stenose(116408)];
    ses_score_a['Colon_l'] = [map_Ulzeration(116502), map_Ausdehnung(116504), map_Entzuendung(116506), map_Stenose(116508)];
    ses_score_a['Rektum'] = [map_Ulzeration(116602), map_Ausdehnung(116604), map_Entzuendung(116606), map_Stenose(116608)];
    const total_score = calculateTotalSesScore(ses_score_a);
    // console.table(ses_score_a);
    // console.log('SES:' + total_score);
    return total_score;
}

var ses_score_a = {};

// MAYO

function calculateMayoScore(scoreObject) {
    // Holt alle Werte des Objekts als Array und addiert sie auf.
    return Object.values(scoreObject).reduce((sum, current) => sum + current, 0);
}

function set_mayo_score_a() {
    var mayo_score_a = {
        'stuhlfrequenz': 0,
        'rektalblutung': 0,
        'beurteilung': 0,
        'endoskopisch': 0
    };
    mayo_score_a['stuhlfrequenz'] = get_stuhlfrequenz_mayo_score(103500);
    mayo_score_a['rektalblutung'] = get_rektalblutung_score(103600);
    mayo_score_a['beurteilung'] = get_beurteilung_score(103700);
    mayo_score_a['endoskopisch'] = get_endoskopisch_score(103800);
    const total_score = calculateMayoScore(mayo_score_a);
    // console.table(mayo_score_a);
    mayo_score_a['endoskopisch'] = 0;
    const partial_score = calculateMayoScore(mayo_score_a);
    // console.log('MAYO:' + total_score + ' pMAYO:' + partial_score);
    return [total_score, partial_score];
}

function get_stuhlfrequenz_mayo_score(cont) { // MAYO CDAI
    cont = document.getElementById('FF_' + cont).value;
    const sf = parseInt(cont);
    if (sf === 0) mayo = 0;
    else if (sf > 0 && sf <= 2) mayo = 1;
    else if (sf >= 3 && sf <= 6) mayo = 2;
    else if (sf >= 7) mayo = 3;
    else mayo = 0;
    return mayo;
}

function get_rektalblutung_score(cont) {
    cont = document.getElementById('FF_' + cont).value;
    switch (cont) {
        case 'kein Blut':
            mayo = 0;
            break;
        case 'Blut bei weniger als der Hälfte der Stuhlgänge':
            mayo = 1;
            break;
        case 'deutliche Blutbeimengung':
            mayo = 2;
            break;
        case 'Blut auch ohne Stuhl':
            mayo = 3;
            break;
        default:
            mayo = 0;
    }
    return mayo;
}

function get_beurteilung_score(cont) {
    cont = document.getElementById('FF_' + cont).value;
    switch (cont) {
        case 'normal':
            mayo = 0;
            break;
        case 'mild':
            mayo = 1;
            break;
        case 'moderate Erkrankung':
            mayo = 2;
            break;
        case 'schwere Erkrankung':
            mayo = 3;
            break;
        default:
            mayo = 0;
    }
    return mayo;
}

function get_endoskopisch_score(cont) {
    cont = document.getElementById('FF_' + cont).value;
    switch (cont) {
        case 'normaler Befund oder inaktive Erkrankung':
            mayo = 0;
            break;
        case 'milde Colitis (Erythem, leicht spröde Schleimhaut)':
            mayo = 1;
            break;
        case 'moderate Colitis (deutliches Erythem, Erosionen, Gefässmuster verschwunden)':
            mayo = 2;
            break;
        case 'schwere Colitis (Ulzerationen, spontane Blutungen)':
            mayo = 3;
            break;
        default:
            mayo = 0;
    }
    return mayo;
}

var mayo_score_a = {};

// MISC

function tag_marker(nummernArray, tag, col) {
    nummernArray.forEach(fieldnr => {
        const elementId = 'C_' + fieldnr;
        element = document.getElementById(elementId);
        tag = '<span style="background-color:' + col + '">' + tag + '</span>';
        if (element) {
            element.innerHTML = element.innerHTML + tag + '&nbsp;';
            // element.style.backgroundColor = col;
        }
    });
}

function updateScoreTable(score_table, score_a) {
    if (score_table) {
        let elem = null;
        score_table.innerHTML = "";
        score_a['scoreElements'].forEach((el, index) => {
            const scoreLabels = score_a['scoreLabels'];
            const value = el?.value ?? el?.textContent ?? ""; // für <input> oder <span>
            const row = document.createElement("tr");
            let col = 'white';
            let marker = "";
            if (scoreLabels[index] == 'BOWEL') {
                if (el.value <= 2) col = 'rgba(207, 253, 220, 1)';
                if (el.value > 2) col = 'rgba(250, 255, 157, 1)';
                if (el.value >= 8) col = 'rgb(255, 156, 156)';
                marker = " style='background-color:#e9b0eeff'";
            }
            if (scoreLabels[index] == 'SES-CD') {
                if (el.value < 3) col = 'rgb(186, 255, 206)';
                if (el.value >= 3) col = 'rgba(250, 255, 157, 1)';
                if (el.value >= 7) col = 'rgba(255, 224, 84, 1)';
                if (el.value > 15) col = 'rgb(255, 156, 156)';
                marker = " style='background-color:#94e2ffff'";
            }
            if (scoreLabels[index] == 'CDAI') {
                if (el.value < 150) col = 'rgba(207, 253, 220, 1)';
                if (el.value >= 150) col = 'rgba(250, 255, 157, 1)';
                if (el.value > 220) col = 'rgba(255, 224, 84, 1)';
                if (el.value >= 450) col = 'rgb(255, 156, 156)';
                marker = " style='background-color:yellow'";
            }
            if (scoreLabels[index] == 'HBI') {
                if (el.value <= 4) col = 'rgba(207, 253, 220, 1)';
                if (el.value >= 5) col = 'rgba(250, 255, 157, 1)';
                if (el.value >= 8) col = 'rgba(255, 224, 84, 1)';
                if (el.value > 16) col = 'rgb(255, 156, 156)';
                marker = " style='background-color:orange'";
            }
            if (scoreLabels[index] == 'MAYO') {
                if (el.value < 3) col = 'rgba(207, 253, 220, 1)';
                if (el.value >= 3) col = 'rgba(250, 255, 157, 1)';
                if (el.value >= 6) col = 'rgba(255, 224, 84, 1)';
                if (el.value > 10) col = 'rgb(255, 156, 156)';
                marker = " style='background-color:silver'";
            }
            if (scoreLabels[index] == 'p.MAYO') {
                if (el.value < 2) col = 'rgba(207, 253, 220, 1)';
                if (el.value >= 2) col = 'rgba(255, 224, 84, 1)';
                if (el.value > 4) col = 'rgb(255, 156, 156)';
                marker = " style='background-color:silver'";
            }
            if (scoreLabels[index] == 'FACIT') {
                if (el.value <= 14) col = 'rgb(255, 156, 156)';
                if (el.value > 14) col = 'rgba(250, 255, 157, 1)';
                if (el.value >= 40) col = 'rgba(207, 253, 220, 1)';
            }
            if (scoreLabels[index] == 'PROMIS') {
                // if (el.value <40) col = 'rgb(255, 156, 156)';
                // if (el.value <=50) col = 'rgba(250, 255, 157, 1)';
                // if (el.value >50) col = 'rgba(207, 253, 220, 1)';
            }
            if (scoreLabels[index] == 'SIDBQ') {
                if (el.value <= 10) col = 'rgb(255, 156, 156)';
                if (el.value > 10) col = 'rgba(250, 255, 157, 1)';
                if (el.value > 60) col = 'rgba(207, 253, 220, 1)';
            }
            row.innerHTML = `<td><span` + marker + `>&nbsp;&nbsp;</span> ${scoreLabels[index]}</td><td style="background-color:${col}">${value.trim()}</td>`;
            score_table.appendChild(row);
        });
    }
}

function check_if_set(idNummern, idPrefix) {
    let is_filled = 1;
    idNummern.forEach(nummer => {
        const elementId = idPrefix + nummer;
        const element = document.getElementById(elementId);
        if (element) {
            if (element.value.trim() === "") is_filled = 0;
            // console.log(is_filled + " V:" + element.value + " ID:" + element.id);
        } else {
            console.warn('Score-Element nicht gefunden:', elementId);
        }
    });

    return is_filled;
}

function setBorderBottom(elementId) {
    const tempElement = document.getElementById(elementId);
    if (tempElement) {
        tempElement.style.borderBottom = '0.5px dashed gray';
    }
}

function setBorderTopForElements(idNummern) {
    setBorderBottom('SH_105100_a');
    setBorderBottom('SH_105100_b');
    setBorderBottom('SH_110200_a');
    setBorderBottom('SH_110200_b');
    setBorderBottom('SH_104800_a');
    setBorderBottom('SH_104800_b');

    idNummern.forEach(nummer => {
        const elementIdA = 'SH_' + nummer + '_a';
        const elementIdB = 'SH_' + nummer + '_b';
        const elementA = document.getElementById(elementIdA);
        if (elementA) {
            elementA.style.borderBottom = '0.5px dashed gray';
        }
        const elementB = document.getElementById(elementIdB);
        if (elementB) {
            elementB.style.borderBottom = '0.5px dashed gray';
        }
    });
}

function filter_patient_medic_view(user_is_patient, helper) {
    const block_unter = document.getElementById('FS_99991008');
    const block_labor = document.getElementById('FS_99991009');
    const block_sessc = document.getElementById('FS_99991010');
    const block_op___ = document.getElementById('FS_99991005');
    const block_vorme = document.getElementById('FS_99998001');
    const block_medik = document.getElementById('FS_99998002');
    const block_neben = document.getElementById('FS_99991003');
    const block_textp = document.getElementById('SH_5915');
    if (user_is_patient) {
        if (block_unter) block_unter.style.display = 'none';
        if (block_labor) block_labor.style.display = 'none';
        if (block_sessc) block_sessc.style.display = 'none';
        if (block_neben) block_neben.style.display = 'none';
        if (pre_visite) block_vorme.style.display = 'none';
    } else {
        block_color(block_op___);
        block_color(block_vorme);
        block_color(block_medik);
        block_color(block_unter);
        block_color(block_labor);
        block_color(block_sessc);
        block_color(block_neben);
        if (pre_visite) block_vorme.style.display = 'none';
        if (block_textp) block_textp.style.display = 'none';
        hide_header();
    }

    if (helper.value) { // filtered view for medics
        document.querySelectorAll(('fieldset')).forEach(el => {
            // check if element visible
            const style = window.getComputedStyle(el);
            if (style.display !== 'none' && style.visibility !== 'hidden') {
                el.style.display = 'none';
                // el.style.backgroundColor = 'red';
            }
        });
        // if (helper.value == 'labor') {
        //     block_labor.style.display = 'flex';
        // }
        if (helper.value == 'untersuchung') {
            block_op___.style.display = 'flex';
            block_unter.style.display = 'flex';
            block_neben.style.display = 'flex';
            block_labor.style.display = 'flex';
        }
    }
    if (!first_visit) {
        // block_op___.style.display = 'none';
    }
}