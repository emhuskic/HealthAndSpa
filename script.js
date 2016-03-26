var val = 0;

function img_create(src, alt, title) {
    var img = document.createElement('img');
    img.src = src;
    img.setAttribute('class', 'newsicon');
    if (alt != null) img.alt = alt;
    if (title != null) img.title = title;
    return img;
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
            if (vrijeme == 1 || vrijeme == 0)
                posts[i].style.display = 'table-row';
            else
                posts[i].style.display = 'none';
        }
    } else if (x == "mjesecne") {
        for (i = 0, j = posts.length; i < j; i++) {
            d = new Date(posts[i].getElementsByClassName("pomlabel")[0].innerHTML);
            vrijeme = timeSpan(d);
            if (vrijeme == 2 || vrijeme == 1 || vrijeme == 0)
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
    if (interval%10 == 1) {
        return 'Prije ' + interval + " dan";
    } else if (interval%10 >= 2 && interval%10 < 7) {
        return 'Prije ' + interval + " dana";
    } else if (interval == 7) {
        return 'Prije 1 sedmicu';
    } else if (interval > 7 && interval < 14) {
        return 'Prije 1 sedmicu';
    } else if (interval >= 14 && interval < 21) {
        return 'Prije 2 sedmice';
    } else if (interval >= 22 && interval < 28) {
        return 'Prije 3 sedmice';
    } else if (interval > 0 && interval <= 31) {
        return 'Prije 4 sedmice';
    }
    interval = Math.floor(seconds / 3600);
    if (interval%10 == 1) {
        return 'Prije ' + interval + " sat";
    } else if (interval%10 >= 2 && interval%10 <= 4) {
        return 'Prije ' + interval + " sata";
    } else if (interval > 4) {
        return interval + " sati";
    }
    interval = Math.floor(seconds / 60);
    if (interval%10 == 1) {
        return 'Prije ' + interval + " minutu";
    } else if (interval%10 >= 2 && interval%10 <= 4) {
        return 'Prije ' + interval + " minute";
    } else if (interval > 4) {
        return 'Prije ' + interval + " minuta";
    }

    interval = Math.floor(seconds);
    if (interval == 1) {
        return 'Prije ' + interval + " sekundu";
    } else if (interval >= 2 && interval <= 4) {
        return 'Prije ' + interval + " sekunde";
    } else  {
       return 'Prije ' + interval + " sekundi";
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
    var content = document.getElementById('contentarea').value;
    var headline = document.getElementById('headlinearea').value;
    var newimg = img_create(img, 'Image could not be loaded', 'ImagePost');
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