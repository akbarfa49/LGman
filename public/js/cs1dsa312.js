$("#signin").click((e) => {
    e.preventDefault();
         jsonData = {
            "email": $("#inputEmail").val(),
            "pass": $("#inputPassword").val()
        };
        if (jsonData["email"] == "" || jsonData["pass"]==""){
            alert("Email or Password must be filled out");
            return
        }
        $.ajax({
            url: '/api/admin/login',
            type: 'post',
            data: jsonData,
            success: (data) => {
                if (data.message=="success"){
                    window.location = data.location;
                }
                alert(data.message);
            }
        });

    });