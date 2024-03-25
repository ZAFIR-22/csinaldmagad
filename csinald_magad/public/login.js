function validate() {
    var email = document.getElementById("exampleInputEmail1").value;
    var password = document.getElementById("exampleInputPassword1").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert("Sikeres bejelentkezés");
                window.location.href = "/";
            } else {
                alert("Sikertelen bejelentkezés ellenőrizd az adatokat");
            }
        }
    };
    xhr.send("email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));
}

