function getRooms() {
    let dateStart = document.getElementById('checkInDate').value;
    let dateEnd = document.getElementById('checkOutDate').value;
    let noPeople = document.getElementById('noPeople').value;

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           console.log(xhr.responseText);
        }
    };
    xhr.open("GET", `api/get-room?dateStart=${dateStart}&dateEnd=${dateEnd}&noPeople=${noPeople}`, false);
    xhr.send();
}