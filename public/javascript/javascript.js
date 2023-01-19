// add Barang
let inputHarga = document.getElementById("harga");
let inputStok = document.getElementById("stok");

var invalidChars = ["-", "+", "e"];

inputHarga.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});
inputStok.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }

    let search = document.getElementById("search");
    search.addEventListener("click", function (e) {
        alert("ok");
    });
});

let qty = (document.getElementById("qty").innerHTML = "ok");
