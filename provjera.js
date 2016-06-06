var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};

var ukinuto = [];
var ukinutoStr = [];

if(sessionStorage.getItem('ukinuto') != null)
{
	ukinutoStr = sessionStorage.getItem('ukinuto');

	var ukinuto = ukinutoStr.split(',').map(function(item) {
    	return parseInt(item);
		});

}

function profilObjekta(ID)
{
	window.location = "novost.php?obavijestid=" + ID;
}




document.addEventListener("DOMContentLoaded",function() {
    
    

	var provjeriKomentareKorisnika = setInterval(function(){

		 var ajax = new XMLHttpRequest();

   		 ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200)
        {
        		var result = ajax.responseText;
				var nizObjekataSaKomentarima = JSON.parse(result);

			  	document.getElementById("obavijest").innerHTML = "";

			  	for(var i = 0; i < nizObjekataSaKomentarima.length; i++)
			  	{
			  		

			  		if(contains.call(ukinuto, parseInt(nizObjekataSaKomentarima[i].ObjekatID)))
			  			continue;

			  		var notifikacija = document.createElement('div');
			  		notifikacija.className = 'row';

			  		notifikacija.innerHTML = "<div class='obavijest'>" +
			  			"<a href='novost.php?obavijestid="+nizObjekataSaKomentarima[i].ObjekatID+"' >" + nizObjekataSaKomentarima[i].Naziv + "</a>" +
					    "<br />" + 
					    " Imate " + nizObjekataSaKomentarima[i].BrojNovihKomentara +  
					    " novih komentara za post</div> "; 

					document.getElementById("obavijest").appendChild(notifikacija);
			  	}
			  	var nesto = "avbas";
        }
            
        if (ajax.readyState == 4 && ajax.status == 404)
           console.log("error: " + message);
            
    }

    ajax.open("GET", "provjeraKomentara.php", true);
    ajax.send();

		
	}, 2000);

});