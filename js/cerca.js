
function download(event){
    event.preventDefault();
    const foto = document.querySelector('.img-modale');
    console.log(foto.src);
    fetch("download.php", {method: 'post', 
    body: "foto="+foto.src,
        headers: {
        "Content-Type": "application/x-www-form-urlencoded"
        }
    }).then(onResponse).then(fetchJson);



    closeModale();

}
function fetchJson(json){
    console.log(json);

}

function onResponse(response) {
    console.log(response)
    return response.json();
}

function closeModale(){
    const modale = document.querySelector('#modale');
    modale.classList.add('hidden');
    document.body.classList.remove('no-scroll');
    const foto = document.querySelector('#bloccofoto');
    foto.textContent="";
}

function seleziona(){
    const modale = document.querySelector('#modale');
    modale.classList.remove('hidden');
    document.body.classList.add('no-scroll');
    const image = document.createElement('img');
    image.classList.add('img-modale');
    image.src = event.currentTarget.src;
    const select = document.querySelector('#bloccofoto');
    select.appendChild(image);  
    document.querySelector('#txt').classList.remove('hidden');
}


function onTokenJson1(json){
    console.log(json)
    token = json.access_token;

}
function onTokenResponse1(response) {
    return response.json();
}

function searchJson(json)
{
    console.log(json);
    const sezione1 = document.querySelector('.risposta');
    if((json.tracks)){
        for(var i= 0; i<9; i++){    
            const image1 = document.createElement('img');
            image1.classList.add('img');
            if(json.tracks.items[i].album.images[0]){
                image1.src = json.tracks.items[i].album.images[0].url;
                sezione1.appendChild(image1);
            }
            
        }
    }
    else if(json[1][1]){   
        for(var i= 0; i<3; i++){ 
            const image1 = document.createElement('img');
            image1.classList.add('img');
            image1.src = json[i][i];
            sezione1.appendChild(image1);
        }
    }
    else if(json[0].show){
        for(var i= 0; i<9; i++){ 
            const image1 = document.createElement('img');
            image1.classList.add('img');
            if(json[i].show.image){
                image1.src = json[i].show.image.original;
                sezione1.appendChild(image1);
            }
            
        }
    }

    const boxes = document.querySelectorAll('.risposta img');
    for (const k1 of boxes)
    {
    k1.addEventListener('click', seleziona);
    }
}
function onResponse1(response){
    return response.json();
}






function search1(event){
    event.preventDefault();
    const sezione1 = document.querySelector('.risposta');
    sezione1.innerHTML = '';
    const genere_input = document.querySelector('#sezione');
    const oggetto_input = document.querySelector('#oggetto');
    const oggetto = encodeURIComponent(oggetto_input.value);
    const genere = encodeURIComponent(genere_input.value);
    console.log(genere);
    fetch("fetch_cerca.php?type="+genere+"&q="+oggetto).then(onResponse1).then(searchJson);
    
}




const form1 = document.querySelector('#domanda1');
form1.addEventListener('submit', search1);

const bottone = document.querySelector('#form_b');
bottone.addEventListener('click', download);

const exit = document.querySelector('#exit');
exit.addEventListener('click', closeModale);