//Generates navbar links

function generateNavItems(rank) {
    //Retrieve right XML file


    var xhttp = new XMLHttpRequest();
    var navItems;
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET",  rank, true);
    xhttp.send();
}

function test() {
    var item = document.getElementById('nav_products');
    item.innerText = "Dickbutt";
}