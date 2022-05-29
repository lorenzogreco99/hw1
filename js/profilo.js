
function closeModale(){
    const modale = document.querySelector('#modale');
    modale.classList.add('hidden');
    document.body.classList.remove('no-scroll');
    const text = document.querySelector('#info');
    text.textContent="";
    const foto = document.querySelector('#picture');
    foto.textContent="";
    const commento = document.getElementById('commento');
    commento.textContent="";
}

function fetchLikeJson(json) {
    console.log(json);
    const info = document.querySelector('#info');
    info.textContent = "Like: " + json[0].nlikes 

}

function fetchCommentiJson(json) {
    console.log(json);
    const commento = document.getElementById('commento');
    if(!json.length){
        console.log("commento non trovato");
    }else{
        for(var i=0 ; i<json[0].ncomments ; i++){
            console.log(i);
            const com = document.createElement('div');
            com.classList.add('com');
            com.textContent= json[i].username + ": "+ json[i].text ;
            commento.appendChild(com);
        }
    }

}


function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}


function seleziona(event){
    const modale = document.querySelector('#modale');
    modale.classList.remove('hidden');
    document.body.classList.add('no-scroll');
    const image = document.createElement('img');
    image.classList.add('img-modale');
    image.src = event.currentTarget.src;
    const select = document.querySelector('#picture');
    select.appendChild(image);
    fetch("fetch_commenti.php", {method: 'post', 
    body: "foto="+image.src,
        headers: {
        "Content-Type": "application/x-www-form-urlencoded"
        }
    }).then(fetchResponse).then(fetchCommentiJson);

    fetch("fetch_like.php", {method: 'post', 
    body: "foto="+image.src,
        headers: {
        "Content-Type": "application/x-www-form-urlencoded"
        }
    }).then(fetchResponse).then(fetchLikeJson);

}

const boxes = document.querySelectorAll('.foto');
for (const k1 of boxes)
{
    k1.addEventListener('click', seleziona);
}

const exit = document.querySelector('#exit');
exit.addEventListener('click', closeModale);