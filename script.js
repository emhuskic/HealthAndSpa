var val = 0;

function img_create(src, alt, title) {
    var img = document.createElement('img');
    img.src = src;
    img.setAttribute('class', 'newsicon');
    if (alt != null) img.alt = alt;
    if (title != null) img.title = title;
    return img;
}
function dropdownSortChanged(){
    var x = document.getElementById("dropdownSort").value; //Sort alphabetically, sort by date
  
}
function dropdownChanged() {
    var x = document.getElementById("dropdown").value; //danasnje, sedmicne, mjesecne, sve
    var posts = document.getElementsByClassName("post");
    var d = "";
    var vrijeme = 0;
    if (x == "danasnje") {
        for (i = 0, j = posts.length; i < j; i++) {
            d = new Date(posts[i].getElementsByClassName("pomlabel")[0].innerHTML);
            vrijeme = timeSpan(d);
            if (vrijeme == 0)
                posts[i].style.display = 'table-row';
            else
                posts[i].style.display = 'none';
        }
    } else if (x == "sedmicne") {
        for (i = 0, j = posts.length; i < j; i++) {
            d = new Date(posts[i].getElementsByClassName("pomlabel")[0].innerHTML);
            vrijeme = timeSpan(d);
            var prviDan = new Date(d.getFullYear(), d.getMonth(), 1).getDay();
            var sedmica = Math.ceil((d.getDate() + prviDan) / 7);
            var sedmicasad = new Date();
            var prviDanSad = new Date(sedmicasad.getFullYear(), sedmicasad.getMonth(), 1).getDay();
            var sedmicasad = Math.ceil((sedmicasad.getDate() + prviDanSad) / 7);
            if (d.getMonth() == 3) {

                console.log(d + " " + sedmica);
                console.log(sedmicasad);
            }
            var mjesec = d.getMonth();
            var mjesecsad = new Date();
            mjesecsad = mjesecsad.getMonth();
            /*  if (vrijeme == 1 || vrijeme == 0)
                  posts[i].style.display = 'table-row';
              else
                  posts[i].style.display = 'none';*/
            if (sedmica == sedmicasad && mjesec == mjesecsad)
                posts[i].style.display = 'table-row';
            else
                posts[i].style.display = 'none';
        }
    } else if (x == "mjesecne") {
        for (i = 0, j = posts.length; i < j; i++) {
            d = new Date(posts[i].getElementsByClassName("pomlabel")[0].innerHTML);
            vrijeme = timeSpan(d);
            var mjesec = d.getMonth();
            var mjesecsad = new Date();
            mjesecsad = mjesecsad.getMonth();
            /* if (vrijeme == 2 || vrijeme == 1 || vrijeme == 0)
                 posts[i].style.display = 'table-row';
             else
                 posts[i].style.display = 'none';*/
            if (mjesec == mjesecsad)
                posts[i].style.display = 'table-row';
            else
                posts[i].style.display = 'none';

        }

    } else {
        for (i = 0, j = posts.length; i < j; i++) {
            d = new Date(posts[i].getElementsByClassName("pomlabel")[0].innerHTML);
            vrijeme = timeSpan(d);
            posts[i].style.display = 'table-row';
        }

    }
}

function timeSpan(date) {
    var seconds = Math.floor((new Date() - date) / 1000);
    var interval = Math.floor(seconds / 31536000);
    //0 danasnje
    //1 sedmicne
    //2 mjesecne
    //3 ostalo
    if (interval >= 1) {
        return 3; //interval + " godina";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval >= 1) {
        return 3; //interval + " mjeseci";
    }
    interval = Math.floor(seconds / 86400);
    if (interval == 1) {
        return 1;
    } else if (interval >= 2 && interval < 7)
        return 1;
    else if (interval == 7)
        return 1;
    else if (interval > 7 && interval < 14)
        return 2;
    else if (interval >= 14 && interval < 21)
        return 2;
    else if (interval >= 22 && interval < 28)
        return 2;
    else if (interval > 0 && interval <= 31)
        return 2;
    interval = Math.floor(seconds / 3600);
    if (interval == 1) {
        return 0;
    } else if (interval >= 2 && interval <= 4)
        return 0;
    else if (interval > 4) return 0;
    interval = Math.floor(seconds / 60);
    if (interval == 1) {
        return 0;
    } else if (interval >= 2 && interval <= 4)
        return 0;
    else if (interval > 4) return 0;
    interval = Math.floor(seconds);
    if (interval == 1) return 0;
    else if (interval >= 2 && interval <= 4) return 0;
    else return 0;
}

function timeSince(date) {
    var seconds = Math.floor((new Date() - date) / 1000);
    var interval = Math.floor(seconds / 31536000);
    if (interval >= 1) {
        return date; //interval + " godina";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval >= 1) {
        return date; //interval + " mjeseci";
    }
    console.log(interval);
    interval = Math.floor(seconds / 86400);
    if (interval == 1) {
        return 'Novost objavljena prije ' + interval + " dan";
    } else if (interval >= 2 && interval < 7) {
        return 'Novost objavljena prije ' + interval + " dana";
    } else if (interval == 7) {
        return 'Novost objavljena prije 1 sedmicu';
    } else if (interval > 7 && interval < 14) {
        return 'Novost objavljena prije 1 sedmicu';
    } else if (interval >= 14 && interval < 21) {
        return 'Novost objavljena prije 2 sedmice';
    } else if (interval >= 22 && interval < 28) {
        return 'Novost objavljena prije 3 sedmice';
    } else if (interval > 0 && interval <= 31) {
        return 'Novost objavljena prije 4 sedmice';
    }
    interval = Math.floor(seconds / 3600);
    if (interval % 10 == 1) {
        return 'Novost objavljena prije ' + interval + " sat";
    } else if (interval % 10 >= 2 && interval % 10 <= 4) {
        return 'Novost objavljena prije ' + interval + " sata";
    } else if (interval > 4) {
        return 'Novost objavljena prije ' + interval + " sati";
    }
    interval = Math.floor(seconds / 60);
    if (interval % 10 == 1) {
        return 'Novost objavljena prije ' + interval + " minutu";
    } else if (interval % 10 >= 2 && interval % 10 <= 4) {
        return 'Novost objavljena prije ' + interval + " minute";
    } else if (interval > 4) {
        return 'Novost objavljena prije ' + interval + " minuta";
    }

    interval = Math.floor(seconds);
    if (interval == 1) {
        return 'Novost objavljena prije ' + interval + " sekundu";
    } else if (interval >= 2 && interval <= 4) {
        return 'Novost objavljena prije ' + interval + " sekunde";
    } else {
        return 'Novost objavljena prije ' + interval + " sekundi";
    }
}

function validate(x) {
    if (x == null || x == "") {
        return false;
    }
    return true;
}

function validateContent() {
    if (trimAll(document.getElementById('contentarea').value) === '') {

        return false;
    }
    return true;
}

function trimAll(sString) {
    while (sString.substring(0, 1) == ' ') {
        sString = sString.substring(1, sString.length);
    }
    while (sString.substring(sString.length - 1, sString.length) == ' ') {
        sString = sString.substring(0, sString.length - 1);
    }
    return sString;
}

function validateAJAX() {
    var country = document.getElementById('country').value;
    var telephone = document.getElementById('telephone').value;
    if (country.length > 0 && telephone.length > 0) {
        if (country.length != 2) {
            alert("Bad country format");
            return false;
        }

        var xmlhttp = new XMLHttpRequest();
        console.log(country);
        xmlhttp.open("GET", "https://restcountries.eu/rest/v1/alpha?codes=" + country, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var obj = JSON.parse(xmlhttp.responseText);
                if (country.toUpperCase() == obj[0]["alpha2Code"]) {
                    if (telephone[0] + telephone[1] + telephone[2] + telephone[3] == "+" + obj[0]["callingCodes"].toString()) {
                        return true;
                    } else {
                        alert('telephone and country do not match');
                        return false;
                    }
                } else if (telephone[0] + telephone[1] + telephone[2] + telephone[3] == "+" + obj[0]["callingCodes"].toString()) {
                    if (country.toUpperCase() == obj[0]["alpha2Code"]) {
                       return true;
                    } else {
                        alert('telephone and country do not match');
                        return false;
                    }
                } else {
                    if (strPhone.length > 0) {
                        console.log("OK");
                        alert('ok');
                        return true;
                    } else {
                        alert('not ok');
                        console.log("Not OK");
                        return false;
                    }
                }
            }
            //document.getElementById("porukica").innerHTML = obj[0]["callingCodes"];

        };

    } else {
        return false;
    }

}

function addElement() {
    var ni = document.getElementById('leftie');
    val = val + 1;
    var num = val;
    var newdiv = document.createElement('div');
    var divIdName = 'my' + num + 'Div';
    newdiv.setAttribute('id', divIdName);
    newdiv.setAttribute('class', 'post');
    var img = document.getElementById('imagearea').value;
    if (!validate(img)) {
        console.log('tu');
        document.getElementById('imagearea').style.backgroundColor = "#EFDBB1";
        document.getElementById('imagearea').setCustomValidity('Fill this field');
        return;
    } else {

        document.getElementById('imagearea').setCustomValidity('');
        document.getElementById('imagearea').style.backgroundColor = "white";
    }
    var content = document.getElementById('contentarea').value;
    if (!validateContent()) {
        document.getElementById('contentarea').style.backgroundColor = "#EFDBB1";
        document.getElementById('contentarea').setCustomValidity('Fill this field');
        return;
    } else {
        document.getElementById('contentarea').style.backgroundColor = "white";
        document.getElementById('contentarea').setCustomValidity('');
    }
    var headline = document.getElementById('headlinearea').value;
    if (!validate(headline)) {
        document.getElementById('headlinearea').style.backgroundColor = "#EFDBB1";
        document.getElementById('headlinearea').setCustomValidity('Fill this field');
        return;
    } else {

        document.getElementById('headlinearea').setCustomValidity('');
        document.getElementById('headlinearea').style.backgroundColor = "white";
    }
    var newimg = img_create(img, 'Image could not be loaded', 'ImagePost');

    var tel = document.getElementById('telephone').value;
    var country = document.getElementById('country').value;
    if (!validate(country)) {
        document.getElementById('country').style.backgroundColor = "#EFDBB1";
        document.getElementById('country').setCustomValidity('Fill this field');
        return;
    } else {
        document.getElementById('country').style.backgroundColor = "white";
        document.getElementById('country').setCustomValidity('');
    }
     if (!validate(tel)) {
        document.getElementById('telephone').style.backgroundColor = "#EFDBB1";
        document.getElementById('telephone').setCustomValidity('Fill this field');
        return;
    } else {
        document.getElementById('telephone').style.backgroundColor = "white";
        document.getElementById('telephone').setCustomValidity('');
    }
    var newheadline = document.createElement('h3');
    newheadline.innerHTML = headline;
    var newcontent = document.createElement('span');
    newcontent.innerHTML = content;
    var newdate = document.createElement('label');
    newdate.setAttribute('class', 'datelabel');
    newdate.innerHTML = 'Date:';
    var pomlab = document.createElement('label');
    pomlab.setAttribute('class', 'pomlabel');
    pomlab.innerHTML = new Date();
    newdiv.appendChild(newimg);
    newdiv.appendChild(newdate);
    newdiv.appendChild(pomlab);
    newdiv.appendChild(newheadline);
    newdiv.appendChild(newcontent);
    var d = new Date();
    newdate.innerHTML = timeSince(d);
    ni.appendChild(newdiv);
}

window.onload = function () {
    var datelabels = document.getElementsByClassName("datelabel");
    var pomlabels = document.getElementsByClassName("pomlabel");
    for (var i = 0; i < datelabels.length; i++) {
        var d = new Date(datelabels[i].innerHTML);
        pomlabels[i].innerHTML = datelabels[i].innerHTML;
        datelabels[i].innerHTML = timeSince(d);
    }
}