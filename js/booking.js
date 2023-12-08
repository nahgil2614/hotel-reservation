function getRooms() {
    let dateStart = document.getElementById('checkInDate').value;
    let dateEnd = document.getElementById('checkOutDate').value;
    let listRooms = document.getElementById('listRooms');

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           let rooms = JSON.parse(xhr.responseText)['rooms'];

           for (let room of rooms) {
                listRooms.innerHTML += `<div class="room">
        <h1 class="room-heading">${room["name"].toUpperCase()}</h1>
        <div class="room-detail">
            <img src="../images/room.jpg">
            <div class="room-description">

                <p style="font-size: 25px; font-weight: bold;">${room["name"]} Room - ${room["id"]}</p>


                <p style="font-size: 20px; font-weight: 500;">${room["noPeople"]} guests</p>
                <ul style="font-size: 20px; font-weight: normal; margin-left: -20px;">
                    <li>
                        <p>Free wifi and NetFlix</p>
                    </li>
                    <li>
                        <p>Hot tub</p>
                    </li>
                    <li>
                        <p>18m2 beds</p>
                    </li>
                </ul>
                <div class="booking">
                    <!-- <div class="num-room">
                        <label>Choose number of room:</label> <br>
                        <input type="number" placeholder="0" required min='0' max='8'>
                    </div> -->
                    <div class="price">
                        <input type ="submit" value = "$${room["price"]}" onclick="registerRoom(${room["id"]}, ${userId}, '${dateStart}', '${dateEnd}')">
                    </div>
                </div>

            </div>
        </div>
    </div>`
           }
        }
    };
    xhr.open("GET", `api/get-room?dateStart=${dateStart}&dateEnd=${dateEnd}`, false);
    xhr.send();
}

function registerRoom(roomId, userId, dateStart, dateEnd) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (JSON.parse(xhr.responseText)['code'] === 0) {
                location.reload();
            }
        }
    };

    let body = new FormData();
    body.append("roomId", roomId);
    body.append("userId", userId);
    body.append("dateStart", dateStart);
    body.append("dateEnd", dateEnd);

    xhr.open("POST", "api/reserve-room", false);
    xhr.send(body);
}