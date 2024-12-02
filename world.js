document.addEventListener('DOMContentLoaded', function(){
        const lookupCountrybtn = document.getElementById("lookupCountry");
        const lookupCitiesbtn = document.getElementById("lookupCities");
        const result = document.getElementById("result");
        const countrySearch = document.getElementById("country");

        lookupCountrybtn.addEventListener('click', function(){
            const getCountry = new XMLHttpRequest();
            let countrylookup = countrySearch.value.trim();


            getCountry.onreadystatechange = function(){
            
                if(getCountry.readyState === XMLHttpRequest.DONE){
                    if(getCountry.status === 200){
                        result.innerHTML = getCountry.responseText;
                    }
                    else{
                        result.innerHTML = `<p>Error: Unable to fetch country's data.</p>`;
                    }
                }
            };

            getCountry.open('GET', `./world.php?country=${encodeURIComponent(countrylookup)}`, true);
            getCountry.send();
        });

        lookupCitiesbtn.addEventListener('click', function(){
            const getCity = new XMLHttpRequest();
            let citylookup = countrySearch.value.trim();


            getCity.onreadystatechange = function(){
            
                if(getCity.readyState === XMLHttpRequest.DONE){
                    if(getCity.status === 200){
                        result.innerHTML = getCity.responseText;
                    }
                    else{
                        result.innerHTML = `<p>Error: Unable to fetch city's data.</p>`;
                    }
                }
            };

            getCountry.open('GET', `./world.php?city=${encodeURIComponent(citylookup)}`, true);
            getCountry.send();
        });
});