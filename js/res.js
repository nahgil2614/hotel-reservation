const listRooms = document.getElementById('listRooms');

const xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       let rooms = JSON.parse(xhr.responseText)['rooms'];

       for (let room of rooms) {
            listRooms.innerHTML += `<div class="room">
    <div class="room-detail">
        <img src="../images/room.jpg">
        <div class="room-description">

            <p style="font-size: 25px; font-weight: bold;">Room ${room["roomId"]}</p>

            <ul style="font-size: 20px; font-weight: normal; margin-left: -20px;">
                <li>
                    <p>Checkin day: ${room["dateStart"]}</p>
                </li>
                <li>
                    <p>Checkout day: ${room["dateEnd"]}</p>
                </li>
            </ul>
            <div class="booking">
                <!-- <div class="num-room">
                    <label>Choose number of room:</label> <br>
                    <input type="number" placeholder="0" required min='0' max='8'>
                </div> -->
                <div class="price">
                    <input type ="submit" value = "Cancel room" onclick="cancel('${room["cancelLink"]}')">
                </div>
            </div>

        </div>
    </div>
</div>`
       }
    }
};
xhr.open("GET", `api/get-reservations?id=${userId}`, false);
xhr.send();

function cancel(url) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (JSON.parse(xhr.responseText)['code'] === 0) {
                location.reload();
            }
        }
    };

    xhr.open("GET", url, false);
    xhr.send();
}