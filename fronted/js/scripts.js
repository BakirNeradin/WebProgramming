/*!
* Start Bootstrap - Modern Business v5.0.7 (https://startbootstrap.com/template-overviews/modern-business)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-modern-business/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

    let petitionCounts = { 1: 0, 2: 0, 3: 0 };

    function signPetition(id) {
        petitionCounts[id]++;
        updatePetitionCount(id);
    }

    function unsignPetition(id) {
        if (petitionCounts[id] > 0) {
            petitionCounts[id]--;
            updatePetitionCount(id);
        }
    }

    function updatePetitionCount(id) {
        document.getElementById(`petition-count-${id}`).innerText = `Potpisa: ${petitionCounts[id]}`;
    }
    
    