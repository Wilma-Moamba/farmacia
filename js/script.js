// console.log('heloo');
function acrescentar(IDmedicamento){
    var quantidade = prompt("Quantidade a acrescentar:");
        if (quantidade == null || quantidade == "") {
            alert("Impossível efectuar a operação!");
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open("POST",  "../../routes/medicineRoutes.php?action=update&id=" + IDmedicamento, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText); 
                location.reload(); 
            }
        };
            xhr.send("id=" + IDmedicamento + "&quantidade=" + quantidade + "&action=acrescentar");
        }
}
function reduzir(IDmedicamento){
    var quantidade = prompt("Quantidade a reduzir:");
        if (quantidade == null || quantidade == "") {
            alert("Impossível efectuar a operação!");
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open("POST",  "../../routes/medicineRoutes.php?action=update&id=" + IDmedicamento, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText); 
                location.reload();
            }
        };
            xhr.send("id=" + IDmedicamento + "&quantidade=" + quantidade + "&action=reduzir");
        }
}
