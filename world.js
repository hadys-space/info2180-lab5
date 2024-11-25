document.addEventListener('DOMContentLoaded', function(){
        const lookupbtn = document.getElementById("lookup");
        const result = document.getElementById("result");
        const countrySearch = document.getElementById("country");

        lookupbtn.addEventListener('click', function(){
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
});