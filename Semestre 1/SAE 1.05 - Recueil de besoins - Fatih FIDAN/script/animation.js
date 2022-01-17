//Barre de navaigation
const toggleButton = document.getElementsByClassName('bouton_3_barres')[0]
const navbarLinks = document.getElementsByClassName('barre_de_navigation_liens')[0]
toggleButton.addEventListener('click', () => {
  navbarLinks.classList.toggle('active')
})

$(function(){
  var position_top_raccourci = $("#navigation").offset().top;
  $(window).scroll(function () {
  if ($(this).scrollTop() > position_top_raccourci) {
  $('#navigation').addClass("fixNavigation"); 
  } else {
  $('#navigation').removeClass("fixNavigation");
  }
});
});


//------------------------------------------------------------------------------------------------------------------------------------------------


//Diapo
let img__diapo = document.getElementsByClassName('img__diapo');
let etape=0;
let nbr__img=img__diapo.length;
let precedent=document.querySelector('.precedent');
let suivant=document.querySelector('.suivant');
function enleverActiveImages(){
  for(let i=0;i<nbr__img; i++){
    img__diapo[i].classList.remove('active');
  }
}
suivant.addEventListener('click', function(){
  etape++;
  if(etape >= nbr__img){
    etape=0; 
  }
  enleverActiveImages();
  img__diapo[etape].classList.add('active');
})
precedent.addEventListener('click',function(){
  etape--;
  if(etape <0){
    etape=nbr__img-1;
  }
  enleverActiveImages();
  img__diapo[etape].classList.add('active');
})
setInterval(function(){
  etape++;
  if(etape>=nbr__img){
    etape=0;
  }
  enleverActiveImages();
  img__diapo[etape].classList.add('active');
},5000)


//------------------------------------------------------------------------------------------------------------------------------------------------


//Compte à rebour
const text = document.querySelector('.compte_a_rebour');

function getChrono(){
  const now = new Date().getTime();
  const countdownDate = new Date('May 28, 2022').getTime();
  const distanceBase = countdownDate - now;
  const days = Math.floor(distanceBase / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distanceBase % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distanceBase % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distanceBase % (1000 * 60)) / 1000);
  text.innerText = `| ${days} j : ${hours} h : ${minutes} m : ${seconds} s |`
}

getChrono()
const countDownInterval = setInterval(() =>{
  getChrono()
}, 1000);


//------------------------------------------------------------------------------------------------------------------------------------------------


//Meteo [Mon api:c1fb4de6b15686300be49229049c162e]
const iconElement = document.querySelector(".meteo_icon");
const tempElement = document.querySelector(".meteo_temperature p");
const descElement = document.querySelector(".meteo_description p");
const locationElement = document.querySelector(".meteo_localisation p");
const notificationElement = document.querySelector(".notification_meteo");


const weather = {};
weather.temperature = {
    unit : "celsius"
}


const KELVIN = 273;


const key = "c1fb4de6b15686300be49229049c162e";


if('geolocation' in navigator){
    navigator.geolocation.getCurrentPosition(setPosition, showError);
}else{
    notificationElement.style.display = "block";
    notificationElement.innerHTML = "<p>Le navigateur ne prend pas en charge la géolocalisation</p>";
}


function setPosition(position){
    let latitude = position.coords.latitude;
    let longitude = position.coords.longitude;    
    getWeather(latitude, longitude);
}


function showError(error){
    notificationElement.style.display = "block";
    notificationElement.innerHTML = `<p> ${error.message} </p>`;
}


function getWeather(latitude, longitude){
    let api = `http://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${key}`;    
    fetch(api)
        .then(function(response){
            let data = response.json();
            return data;
        })
        .then(function(data){
            weather.temperature.value = Math.floor(data.main.temp - KELVIN);
            weather.description = data.weather[0].description;
            weather.iconId = data.weather[0].icon;
            weather.city = data.name;
            weather.country = data.sys.country;
        })
        .then(function(){
            displayWeather();
        });
}


function displayWeather(){
    iconElement.innerHTML = `<img src="img/icons/${weather.iconId}.png"/>`;
    tempElement.innerHTML = `${weather.temperature.value}°<span>C</span>`;
    descElement.innerHTML = weather.description;
    locationElement.innerHTML = `${weather.city}, ${weather.country}`;
}


function celsiusToFahrenheit(temperature){
    return (temperature * 9/5) + 32;
}


tempElement.addEventListener("click", function(){
    if(weather.temperature.value === undefined) return;
    
    if(weather.temperature.unit == "celsius"){
        let fahrenheit = celsiusToFahrenheit(weather.temperature.value);
        fahrenheit = Math.floor(fahrenheit);
        
        tempElement.innerHTML = `${fahrenheit}°<span>F</span>`;
        weather.temperature.unit = "fahrenheit";
    }else{
        tempElement.innerHTML = `${weather.temperature.value}°<span>C</span>`;
        weather.temperature.unit = "celsius"
    }
});


//------------------------------------------------------------------------------------------------------------------------------------------------


// Chat
var coll = document.getElementsByClassName("chat_plie");
for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}


function getTime() {
    let today = new Date();
    hours = today.getHours();
    minutes = today.getMinutes();
    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    let time = hours + ":" + minutes;
    return time;
}


function firstBotMessage() {
    let firstMessage = "Salut ! C'est moi Dana 😃, comment vas-tu ?"
    document.getElementById("msg_du_bot").innerHTML = '<p class="texte_bot"><span>' + firstMessage + '</span></p>';
    let time = getTime();
    $("#chat_tps").append(time);
    document.getElementById("msg_utilisateur").scrollIntoView(false);
}
firstBotMessage();


function getHardResponse(userText) {
    let botResponse = getBotResponse(userText);
    let botHtml = '<p class="texte_bot"><span>' + botResponse + '</span></p>';
    $("#boite_chat").append(botHtml);
    document.getElementById("barre_du_chat").scrollIntoView(true);
}


function getResponse() {
    let userText = $("#ecrire_msg").val();
    if (userText == "") {
        userText = "";
    }
    let userHtml = '<p class="userText"><span>' + userText + '</span></p>';
    $("#ecrire_msg").val("");
    $("#boite_chat").append(userHtml);
    document.getElementById("barre_du_chat").scrollIntoView(true);
    setTimeout(() => {
        getHardResponse(userText);
    }, 1000)
}


function buttonSendText(sampleText) {
    let userHtml = '<p class="userText"><span>' + sampleText + '</span></p>';
    $("#ecrire_msg").val("");
    $("#boite_chat").append(userHtml);
    document.getElementById("barre_du_chat").scrollIntoView(true);
}

$("#ecrire_msg").keypress(function (e) {
    if (e.which == 13) {
        getResponse();
    }
});


// Reponse bot
function getBotResponse(input) {
    if (input == "Programme de la journée") {
        return "Voici le programme : 😉" + '<br/>' + "27/05 : 20h - Départ de Marseille vers Bastia" + '<br/>' + "28/05 : 7h - Petit déjeuner" + '<br/>' + "8h - Départ vers le « Désert des Agriates »" + '<br/>' + "9h15 - arriver au « Désert des Agriates »" + '<br/>' + "12h - Déjeuner" + '<br/>' + "13h - Départ pour Bastia" + '<br/>' + "14h15 - arriver à Bastia" + '<br/>' + "15h - Mariage civil" + '<br/>' + "18h - Dîner" + '<br/>' + "20h - Début de la fête" + '<br/>' + "00h00 - Fin de la fête" + '<br/>' + "29/05 : 7h - départ Bastia vers Marseille";
    } else if (input == "Notre rencontre") {
        return "On s’est rencontré à Djerba juste avant la crise du covid, Dana était en voyage pour faire de SUPER vlog 📷 pour sa chaîne YouTube ! Et Al lui a été notre guide touristique, il nous a fait visité ce SUPERBE endroit ! Depuis nous avons gardé le contact et le feeling est passé 😍 et nous avons enfin décidé de franchir un pas vers l’avant et de nous marier. ❤️";
    } else if (input == "Informations sur la journée") {
        return "En début de journée Al va nous faire une visite de la « Corse » 😊, nous allons visiter le « Désert des Agriates ». Après la visite nous partirons a la mairie de « Bastia » afin de faire le mariage civil. La journée se terminera le soir 🌆, lors d'une fête dans le yacht.";
    } else if (input == "Hébergement"){
        return "Nous avons pensé à vous ! Le yacht réserver possède des cabines pour plus de 300 passagers 😉, vous pourrez passé la nuit dans le yacht gratuitement. Le repas est également offert, le yacht est conçu pour être confort. Vous pourrez passer une agréable nuit dans le yacht après la cérémonie 😴.";
    } else if (input == "Cagnotte"){
        return "Une cagnotte est organisée pour payer notre voyage au soleil, vous pouvez y participer en cliquant sur le lien --> https://www.paypal.com/donate/?hosted_button_id=NC4C5SVVT36N2";
    } else if (input == "Informations sur Dana"){
        return "Âge : 26 ans" + '<br/>' + "Lieu de naissance : Paris, Île-de-France" + '<br/>' + "Lieu d’habitation : Avenue Beauregard, Cannes, PACA" + '<br/>' + "Profession : modèle, youtubeuse" + '<br/>' + "Je suis maintenant depuis 9 ans sur Youtube sur ma chaîne @theonlydana. Je suis une influenceuse lifestyle et makeup. À force d’être invitée, j’ai réussi à décrocher un contrat d’ambassadrice chez Sephora, et j’ai des voyages sponsorisés tout le temps. À force de voyager, j’ai tout un réseau de copines partout, c’est génial. J’adore les voyages, le soleil, la mode.";
    } else if (input == "Informations sur Al"){
        return "Âge : 31 ans" + '<br/>' + "Lieu de naissance : Lyon, ARA" + '<br/>' + "Lieu d’habitation : Rue Simone de Beauvoir, Vénissieux, ARA" + '<br/>' + "Profession : Guide touristique" + '<br/>' + "Je suis guide à Lyon, mais j’aimerais bouger et ça pourrait être une occasion. J’ai profité de la fin du COVID pour explorer d’autres villes françaises. Tout le monde m’adore, je parle suffisamment 5 langues pour faire des visites guidées du Vieux Lyon et autres grands lieux touristiques. J’adore voir les gens, je lis beaucoup et je fais du tennis. Alors, s’il-vous-plaît, faites quelque chose qui me correspond !";
    } else if (input == "Invités Francais"){
        return "Luc Thiers" + '<br/>' + "Gérôme Brugière" + '<br/>' + "Emmanuel Kaplan" + '<br/>' + "Arthur Berthelot" + '<br/>' + "Xavier Descombes" + '<br/>' + "Pascal Montgomery" + '<br/>' + "Hippolyte Fresnel" + '<br/>' + "Hippolyte Lièvremont" + '<br/>' + "Max Aliker" + '<br/>' + "Albert Gainsbourg" + '<br/>' + "Louis Subercaseaux" + '<br/>' + "Estienne Allais" + '<br/>' + "Maxence Galopin" + '<br/>' + "Jonathan Grosjean" + '<br/>' + "Nicolas Sharpe" + '<br/>' + "Maxence Deshaies" + '<br/>' + "Cyril Donnet" + '<br/>' + "Thomas Lahaye" + '<br/>' + "Roland Chardin" + '<br/>' + "Jacob De Verley" + '<br/>' + "Ange Génin" + '<br/>' + "Gaspard Alard" + '<br/>' + "Pierre Dembélé" + '<br/>' + "Dimitri Charbonneau" + '<br/>' + "Lucrèce Pasquier" + '<br/>' + "Adrien Regnard" + '<br/>' + "Xavier Crépin" + '<br/>' + "Armel Chappelle" + '<br/>' + "Jean-Joël Corne" + '<br/>' + "Jean-Paul Plouffe" + '<br/>' + "Nadine Doisneau" + '<br/>' + "Clarisse Bettencourt" + '<br/>' + "Simonne Boudier" + '<br/>' + "Suzanne Matthieu" + '<br/>' + "Mariette Botrel" + '<br/>' + "Diane Dupuis" + '<br/>' + "Rosalie Rossignol" + '<br/>' + "Alix Marchant" + '<br/>' + "émilie Delafose" + '<br/>' + "Jeannette Barthélemy" + '<br/>' + "Sonia Marchant" + '<br/>' + "Bethsabée Bouthillier" + '<br/>' + "Elodie Dutertre" + '<br/>' + "Adélie Blaise" + '<br/>' + "Peggy Sharpe" + '<br/>' + "Aliénor Calvet" + '<br/>' + "Adélie Vigouroux" + '<br/>' + "Honorine Kléber" + '<br/>' + "Anne-Laure Bessette" + '<br/>' + "Alexandra Cordonnier" + '<br/>' + "Rose Nicollier" + '<br/>' + "Charlotte Camille" + '<br/>' + "Océane Grosjean" + '<br/>' + "Rebecca Ouvrard" + '<br/>' + "Gaëtane Gérin-Lajoie" + '<br/>' + "Martine Asselineau" + '<br/>' + "Aimée Du Toit" + '<br/>' + "Fiona Ancel" + '<br/>' + "Marlène Pelletier" + '<br/>' + "Yseult Vérany";
    } else if (input == "Invités du Royaume Uni"){
        return "Gary Cooley" + '<br/>' + "Alexander Hull" + '<br/>' + "Randall Slater" + '<br/>' + "Chris Anderson" + '<br/>' + "Larry Tucker" + '<br/>' + "Kathleen Benjamin" + '<br/>' + "Loretta Weber" + '<br/>' + "Kim Cooper" + '<br/>' + "Tanya Stone" + '<br/>' + "Hattie Hayes" + '<br/>' + "Erma Slater" + '<br/>' + "Constance Ward" + '<br/>' + "Sheri Young" + '<br/>' + "Shelia Lawson" + '<br/>' + "Kristine White";
    } else if (input == "Invités Américains"){
        return "Gary Cooley" + '<br/>' + "Alexander Hull" + '<br/>' + "Randall Slater" + '<br/>' + "Chris Anderson" + '<br/>' + "Larry Tucker" + '<br/>' + "Kathleen Benjamin" + '<br/>' + "Loretta Weber" + '<br/>' + "Kim Cooper" + '<br/>' + "Tanya Stone" + '<br/>' + "Hattie Hayes" + '<br/>' + "Erma Slater" + '<br/>' + "Constance Ward" + '<br/>' + "Sheri Young" + '<br/>' + "Shelia Lawson" + '<br/>' + "Kristine White";
    } else if (input == "Invités Catalans"){
        return "Salvador Escandel" + '<br/>' + "Albí Escudero" + '<br/>' + "Jacint Suriol" + '<br/>' + "Jordi Gallar" + '<br/>' + "Llúcia Rigall" + '<br/>' + "Cristina Gabarros" + '<br/>' + "Marlena Brunat" + '<br/>' + "Rita Vericat" + '<br/>' + "Estel Clavel" + '<br/>' + "àgape Varela";
    } else if (input == "Invités Italiens"){
        return "Quirino Flore" + '<br/>' + "Bertolfo Ciaramella" + '<br/>' + "Roberto Addeo" + '<br/>' + "Palladio Vinciguerra" + '<br/>' + "Amadeo Doro" + '<br/>' + "Plutarco Sorbo" + '<br/>' + "Cronida Molinaro" + '<br/>' + "Azzurra Riso" + '<br/>' + "Debora Corbi" + '<br/>' + "Elaide Seno" + '<br/>' + "Carmen Flori" + '<br/>' + "Viviana Politano";
    } else if (input == "Invités Marocains"){
        return "Zaky Ksikes" + '<br/>' + "Said Oufkir" + '<br/>' + "Tazim Bahéchar" + '<br/>' + "Abderrahman Kaghat" + '<br/>' + "Abdelhak Abécassis" + '<br/>' + "El Hassan Chatt" + '<br/>' + "Nahila Tabbal" + '<br/>' + "Najat Berrada" + '<br/>' + "Namira Oufkir" + '<br/>' + "Mariam Oufkir" + '<br/>' + "Rahma Sabila" + '<br/>' + "Nasra Sinaceur";
    } else if (input == "Invités Australiens"){
        return "Cooper Collins" + '<br/>' + "Oscar Morgan" + '<br/>' + "Jett Arnold" + '<br/>' + "Milla Lucas" + '<br/>' + "Mackenzie Walsh" + '<br/>' + "Freya Crowe" + '<br/>' + "Gabriella Kidman" + '<br/>' + "Lucy James";
    } else if (input == "Invités Camerounais"){
        return "Diddi Ekotto" + '<br/>' + "Amaniyatou Linda" + '<br/>' + "Kien Ndòsi";
    }
    if (input == "Help") {
        return "Je peux te donner plusieurs informations, tu sais 😉 il suffit d'écrire l'une de ces phrases :" + '<br/>' + '<br/>' + "- Programme de la journée" + '<br/>' + "- Notre rencontre" + '<br/>' + "- Informations sur la journée" + '<br/>' + "- Hébergement" + '<br/>' + "- Cagnotte" + '<br/>' + "- Informations sur Dana" + '<br/>' + "- Informations sur Al" + '<br/>' + "- Invités Francais" + '<br/>' + "- Invités du Royaume Uni" + '<br/>' + "- Invités Américains" + '<br/>' + "- Invités Catalans" + '<br/>' + "- Invités Italiens" + '<br/>' + "- Invités Marocains" + '<br/>' + "- Invités Australiens" + '<br/>' + "- Invités Camerounais";
    } else {
        return "Ecrit 'Help' pour plus d'information";
    }

}