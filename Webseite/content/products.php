<div class="container">
    <script src="JS/updateProducts.js"></script>
    <div class="container">
        <h1>Produkte</h1>
        <label>Kategorie</label>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" onclick="updateCategory(this)">Alle</button>
            <button type="button" class="btn btn-primary" onclick="updateCategory(this)">Aepfel</button>
            <button type="button" class="btn btn-primary" onclick="updateCategory(this)">Birnen</button>
        </div>
        <div class="form-group">
            <label for="search">Suchen</label>
            <input type="text" class="form-control" id="search" onkeyup="updateProducts()">
        </div>
        <div id="products"></div>
    </div>
    <script> updateProducts() </script>
</div>