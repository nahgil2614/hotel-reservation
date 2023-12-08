//setcookie("user", json_encode($result->user), time() + (86400 * 30), "/");

const signInBtn = document.getElementById('signInBtn');

signInBtn.addEventListener('click', () => {
    const emailField = document.getElementById('email');
    const pwordField = document.getElementById('password');

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = xhr.responseText;
            if (response["code"] === 0) {
                document.cookie = `JSON.stringify(response["user"])`
            }
        }
    };

    let body = new FormData();
    body.append("email", emailField.value);
    body.append("password", pwordField.value);

    xhr.open("POST", `api/verify-user`, false);
    xhr.send(body);
});