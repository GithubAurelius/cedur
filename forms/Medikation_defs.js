
// 2. Ebene: Medikamente
  
const val_med_select2_a = [
    ["Anti-Durchfall Mittel", "Codein Tropfen|Codein Tabletten|Imodium|Lopedium|Loperamid|Opium Tropfen|Paracodin Tropfen|andere Anti-Durchfall Mittel"],
    ["Biologika", "Amgevita (Adalimumab)|Cimzia (Certolizumab)|Entyvio intravenös (Vedolizumab)|Entyvio subcutan (Vedolizumab)|Flixabi (Infliximab)|Fymskina (Ustekinumab)|Hukyndra (Adalimumab)|Hulio (Adalimumab)|Humira (Adalimumab)|Hyrimoz (Adalimumab)|Idacio (Adalimumab)|Imraldi (Adalimumab)|Imuldosa (Ustekinumab)|Inflectra (Infliximab)|Omvoh (Mirikizumab) - CU|Omvoh (Mirikizumab) - MC|Otulfi (Ustekinumab)|Pyzchiva (Ustekinumab)|Remicade (Infliximab)|Remsima (Infliximab) als Infusion|Remsima (Infliximab) als subcutan Spritze|Simponi (Golimumab)|Skyrizi (Risankizumab) - CU|Skyrizi (Risankizumab) - MC|Stelara (Ustekinumab)|Steqeyma (Ustekinumab)|Tremfya (Guselkumab) - CU|Tremfya (Guselkumab) - MC|Tysabri (Natalizumab)|Uzpruvo (Ustekinumab)|Wezenla (Ustekinumab)|Yuflyma (Adalimumab)|Yesintek (Ustekinumab)|Zessly (Infliximab)|andere Biologika"],
    ["Budesonid", "Budenofalk (Budesonid oral)|Budenofalk uno (Budesonid oral)|Cortiment (Budesonid oral)|Entocort (Budesonid oral)|Budenofalkschaum (Budesonid rektal)|Entocort-Einläufe (Budesonid rektal)|andere Budesonid"],
    ["Cortison-Präparate", "Prednisolon (Cortisonpräparat oral)|Decortin (Cortisonpräparat oral)|andere Cortisonpräparate oral|Betnesol Klysmen (Cortisonpräparate rektal)|Colifoam Rektalschaum (Cortisonpräparate rektal)|Postericort (Cortisonpräparate rektal)|andere Cortisonpräparate rektal"],
    ["Immunsenker", "Azathioprin|Mercaptopurin|Methotrexat|Puri-Nethol|Jyseleca (Filgotinib)|Rinvoq (Upadacitinib)|Velsipity (Etrasimod)|Xeljanz (Tofacitinib)|Zeposia (Ozanimod)|andere Immunsenker"],
    ["Mesalazine", "Asacol (Mesalazin)|Claversal (Mesalazin)|Mezavant (Mesalazin)|Pentasa (Mesalazin)|Salofalk (Mesalazin)|Sulfasalazin (Mesalazin)|andere Mesalazine"],
    ["Schmerzmittel", "Ibuprofen|Diclofenac|Paracetamol|Acetylsalicylsäure (ASS)|andere Schmerzmittel"],
    ["andere Medikamente", "Eisen als Infusion|Eisen als Spritze|Eisentabletten|Eisentropfen|Cholestagel (Gallensäurebinder)|Colestyramin (Gallensäurebinder)|Lipocol (Gallensäurebinder)|Omeprazol (Magenschutz)|Pantozol (Magenschutz)|Vitamin B12|Vitamin B6|Vitamin D|Vitamin D plus Calcium|andere Medikamente"]
];

// 3. Ebene: Dosis
const val_med_select3_a = [
    ["Amgevita (Adalimumab)", "Start Dosis (Spritze / PEN  160mg/80mg oder 80mg/40mg)|alle 2 Wochen 1 Spritze / PEN à 40mg|jede Woche 1 Spritze / PEN à  40mg|alle 2 Wochen Spritze / PEN à 80mg|jede Woche Spritze / PEN à 80mg|alle 4 Wochen|< 4 Wochen"],
    ["Cimzia (Certolizumab)", "Start Dosis (Woche 0-2-4)|alle 2 Wochen Spritze à 200mg|jede Woche 1 Spritze à 200mg"],
    ["Entyvio intravenös (Vedolizumab)", "Start-Dosis (Infusion Woche 0-2-6)|Infusion alle 8 Wochen|Infusion alle 4 Wochen"],
    ["Entyvio subcutan (Vedolizumab)", "1 Spritze / PEN alle 2 Wochen|1 Spritze / PEN wöchentlich"],
    ["Flixabi (Infliximab)", "Start-Dosis (Infusion Woche 0-2-6 )|Infusion alle 8 Wochen|alle 7 Wochen|alle 6 Wochen|alle 5 Wochen|alle 4 Wochen|< 4 Wochen"],
    ["Fymskina (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Hukyndra (Adalimumab)", "Start Dosis (Spritze / PEN  160mg/80mg oder 80mg/40mg)|alle 2 Wochen 1 Spritze / PEN à 40mg|jede Woche 1 Spritze / PEN à  40mg|alle 2 Wochen Spritze / PEN à 80mg|jede Woche Spritze / PEN à 80mg|alle 4 Wochen|< 4 Wochen"],
    ["Hulio (Adalimumab)", "Start Dosis (Spritze / PEN  160mg/80mg oder 80mg/40mg)|alle 2 Wochen 1 Spritze / PEN à 40mg|jede Woche 1 Spritze / PEN à  40mg|alle 2 Wochen Spritze / PEN à 80mg|jede Woche Spritze / PEN à 80mg|alle 4 Wochen|< 4 Wochen"],
    ["Humira (Adalimumab)", "Start Dosis (Spritze / PEN  160mg/80mg oder 80mg/40mg)|alle 2 Wochen 1 Spritze / PEN à 40mg|jede Woche 1 Spritze / PEN à  40mg|alle 2 Wochen Spritze / PEN à 80mg|jede Woche Spritze / PEN à 80mg|alle 4 Wochen|< 4 Wochen"],
    ["Hyrimoz (Adalimumab)", "Start Dosis (Spritze / PEN  160mg/80mg oder 80mg/40mg)|alle 2 Wochen 1 Spritze / PEN à 40mg|jede Woche 1 Spritze / PEN à  40mg|alle 2 Wochen Spritze / PEN à 80mg|jede Woche Spritze / PEN à 80mg|alle 4 Wochen|< 4 Wochen"],
    ["Idacio (Adalimumab)", "Start Dosis (Spritze / PEN  160mg/80mg oder 80mg/40mg)|alle 2 Wochen 1 Spritze / PEN à 40mg|jede Woche 1 Spritze / PEN à  40mg|alle 2 Wochen Spritze / PEN à 80mg|jede Woche Spritze / PEN à 80mg|alle 4 Wochen|< 4 Wochen"],
    ["Imraldi (Adalimumab)", "Start Dosis (Spritze / PEN  160mg/80mg oder 80mg/40mg)|alle 2 Wochen 1 Spritze / PEN à 40mg|jede Woche 1 Spritze / PEN à  40mg|alle 2 Wochen Spritze / PEN à 80mg|jede Woche Spritze / PEN à 80mg|alle 4 Wochen|< 4 Wochen"],
    ["Imuldosa (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Inflectra (Infliximab)", "Start-Dosis (Infusion Woche 0-2-6 )|Infusion alle 8 Wochen|alle 7 Wochen|alle 6 Wochen|alle 5 Wochen|alle 4 Wochen|< 4 Wochen"],
    ["Omvoh (Mirikizumab) - CU", "Start-Dosis (Infusion 300mg Woche 0-4-8)|Erweiterte Induktion (Infusion Woche 12-16-20)|2 Spritzen / PEN (200mg) alle 4 Wochen|Re-Induktion (Infusion 300mg Woche 0-4-8)"],
    ["Omvoh (Mirikizumab) - MC", "Start-Dosis (Infusion 900mg Woche 0-4-8)||2 Spritzen / PEN (300mg) alle 4 Wochen"],
    ["Otulfi (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Pyzchiva (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Remicade (Infliximab)", "Start-Dosis (Infusion Woche 0-2-6 )|Infusion alle 8 Wochen|alle 7 Wochen|alle 6 Wochen|alle 5 Wochen|alle 4 Wochen|< 4 Wochen"],
    ["Remsima (Infliximab) als Infusion", "Start-Dosis (Infusion Woche 0-2-6 )|Infusion alle 8 Wochen|alle 7 Wochen|alle 6 Wochen|alle 5 Wochen|alle 4 Wochen|< 4 Wochen"],
    ["Remsima (Infliximab) als subcutan Spritze ", "Start-Dosis (Infusion Woche 0-2-6 )|Infusion alle 8 Wochen|alle 7 Wochen|alle 6 Wochen|alle 5 Wochen|alle 4 Wochen|< 4 Wochen"],
    ["Simponi (Golimumab)", "alle 4 Wochen 1 Spritze / PEN 100mg|alle 2 Wochen 1 Spritze / PEN 100mg"],
    ["Skyrizi (Risankizumab) - CU", "Start-Dosis (Infusion 1200mg Woche 0-4-8)|OBI: 360mg alle 8 Wochen|OBI / Spritze: 180mg alle 8 Wochen|OBI: 360mg <8 Wochen|OBI / Spritze: 180mg < 8 Wochen"],
    ["Skyrizi (Risankizumab) - MC", "Start-Dosis (Infusion 600mg Woche 0-4-8)|OBI: 360mg alle 8 Wochen|OBI: 360mg <8 Wochen"],
    ["Stelara (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Steqeyma (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Tremfya (Guselkumab) - CU", "Start-Dosis (Infusion 200mg Woche 0-4-8)||1 Spritze/PEN à 100mg alle 8 Wochen|1 Spritze/PEN à 200mg alle 4 Wochen"],
    ["Tremfya (Guselkumab) - MC", "Start-Dosis A (Infusion 200mg Woche 0-4-8)|Start-Dosis B (400mg subcutan Woche 0-4-8)|1 Spritze/PEN à 100mg alle 8 Wochen|1 Spritze/PEN à 200mg alle 4 Wochen"],
    ["Tysabri (Natalizumab)", "Infusion alle 4 Wochen"],
    ["Uzpruvo (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Wezenla (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Yuflyma (Adalimumab)", "Start Dosis (Spritze / PEN  160mg/80mg oder 80mg/40mg)|alle 2 Wochen 1 Spritze / PEN à 40mg|jede Woche 1 Spritze / PEN à  40mg|alle 2 Wochen Spritze / PEN à 80mg|jede Woche Spritze / PEN à 80mg|alle 4 Wochen|< 4 Wochen"],
    ["Yesintek (Ustekinumab)", "Start-Dosis (1 Infusion (6mg/kg/KG)|1 Spritze / PEN alle 8 Wochen|1 Spritze / PEN alle 6 Wochen|1 Spritze / PEN alle 4 Wochen|Andere"],
    ["Zessly (Infliximab)", "Start-Dosis (Infusion Woche 0-2-6 )|Infusion alle 8 Wochen|alle 7 Wochen|alle 6 Wochen|alle 5 Wochen|alle 4 Wochen|< 4 Wochen"],
    ["andere Biologika", ""],
    ["Prednisolon (Cortisonpräparat oral)", ">20mg tgl.|<20mg tgl."],
    ["Decortin (Cortisonpräparat oral)", ">20mg tgl.|<20mg tgl."],
    ["andere Cortisonpräparate oral", ">20mg tgl.|<20mg tgl."],
    ["Jyseleca (Filgotinib)", "200mg 1xtgl."],
    ["Rinvoq (Upadacitinib", "45mg 1xtgl.|30mg 1xtgl.|15mg 1xtgl."],
    ["Velsipity (Etrasimod)", "2mg 1xtgl."],
    ["Velsipity (Etrasimod)", "2mg 1xtgl."],
    ["Xeljanz (Tofacitinib)", "10mg  2xtgl.|5mg Tabletten 2xtgl."],
    ["Zeposia (Ozanimod)", "0,92mg Tabletten  1xtgl."]
];


// const val_med_select2_a = med_sources.map(item => {
//     const categoryName = item[0].trim();
//     const medList = item.slice(1).map(medString => {
//         const splitMeds = medString.split('|');
//         return splitMeds.map(med => med.trim()).join('|');
//     });
//     return [categoryName, ...medList];
// });

// const val_med_select3_a = med_doses.map(item => {
//     const medName = item[0].trim();
//     const trimmedOptions = item.slice(1).map(optionString => {
//         const cleanedString = optionString.replace(/\s/g, ' ').trim();
//         return cleanedString;
//     });
//     return [medName, ...trimmedOptions];
// });

// console.log(val_med_select3_a)