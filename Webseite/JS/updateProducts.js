var product_category = 'Alle';

function updateProducts() {
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("products").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","php/livesearch.php?category=" + product_category +
        '&search='+document.getElementById('search').value,true);
    xmlhttp.send();
}

function updateCategory(button) {
    //Change category
    product_category = button.innerHTML;
    //Update search
    updateProducts();
}