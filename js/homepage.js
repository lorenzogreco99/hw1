
function insertCom(event){
    event.preventDefault();
    const url= document.querySelector('.img-modale');
    const commento = event.currentTarget.querySelector('#testo_c').value;
    console.log(commento);
    fetch("comment_post.php", {method: 'post', 
    body: "commento="+commento + "&url=" + url.src,
        headers: {
        "Content-Type": "application/x-www-form-urlencoded"
        }
    }).then(fetchResponse).then(fetchJsonCommento);

}


function fetchJsonCommento(json){
    console.log(json);
    const commento = document.querySelector('#commento');
    const com = document.createElement('div');
    com.classList.add('com');
    com.textContent =json[0].username +": "+ json[0].commento;
    commento.appendChild(com);
    document.querySelector('#testo_c').value = "";



}

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

function modale(event){
    const modale = document.querySelector('#modale');
    modale.classList.remove('hidden');
    document.body.classList.add('no-scroll');
    const image = document.createElement('img');
    image.classList.add('img-modale');
    image.src = event.currentTarget.querySelector('img').src;
    console.log(image.src);
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

function mettilike(event){
    let num =  parseInt(event.currentTarget.parentNode.parentNode.querySelector('.nlikes').innerText);
    console.log(num);
    
    
    const foto= event.currentTarget.parentNode.parentNode.parentNode.querySelector('.foto img');
    console.log(foto.src);

    console.log("mando url della foto");
    if(event.currentTarget.src==="http://localhost/homework1/img/like.png"){
        //togli like
        console.log((num--).toString());
        event.currentTarget.src="img/nolike.png";
        fetch("unlike_post.php", {method: 'post', 
        body: "foto="+foto.src,
        headers: {
        "Content-Type": "application/x-www-form-urlencoded"
        }
    }).then(fetchResponse).then(fetchJson);

    }else if(event.currentTarget.src==="http://localhost/homework1/img/nolike.png"){
        //metti like
        console.log((num++).toString());
        event.currentTarget.src="img/like.png";
        

        fetch("like_post.php", {method: 'post', 
            body: "foto="+foto.src,
            headers: {
            "Content-Type": "application/x-www-form-urlencoded"
            }
        }).then(fetchResponse).then(fetchJson);

    }
    event.currentTarget.parentNode.parentNode.querySelector('.nlikes').innerText= num.toString();
}

function fetchJson(json){
    console.log(json);

}

function fetchPostsJson(json) {
    console.log(json);
    const pagina = document.getElementById('pagina');
    for (let i in json) {
        const post = document.getElementById('post_template').cloneNode(true).querySelector(".post");
        const name = post.querySelector(".nome");
        name.textContent = json[i].username;
        const nlikes = post.querySelector(".nlikes");
        nlikes.textContent = json[i].nlikes;

        const sezioneimg = post.querySelector(".foto");
        const image = document.createElement('img');
        image.classList.add('foto');
        image.src = json[i].url;
        sezioneimg.appendChild(image);
        const likebox = post.querySelector(".likebox");
        const like = document.createElement('img');
        like.classList.add('imglike');
        
        if(json[i].likeuser==1){
            like.src= "img/like.png";
        }else{
            like.src="img/nolike.png";
        }
        likebox.appendChild(like);
        pagina.appendChild(post);
        //evento su like
        const box = post.querySelector(".imglike");
        box.addEventListener('click', mettilike);



        const com = post.querySelector(".foto");
        com.addEventListener('click', modale);



    }


}


function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}



//INIZIO
fetch("fetch_post.php").then(fetchResponse).then(fetchPostsJson);


const exit = document.querySelector('#exit');
exit.addEventListener('click', closeModale);

const comment = document.querySelector('#insert');
comment.addEventListener('submit', insertCom);


