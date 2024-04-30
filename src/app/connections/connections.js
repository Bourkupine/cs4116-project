document.querySelector("#search").addEventListener("input", () => {
    const text = document.querySelector("#search").value.toLowerCase()
    for (const connection of document.getElementsByClassName("connection")) {
        if (connection.getAttribute("data-first-name").toLowerCase().includes(text) || (connection.getAttribute("data-surname").toLowerCase().includes(text))) {
            console.log("1")
            connection.style.display = "block"
        } else {
            connection.style.display = "none"
        }
    }
})

function load_messages() {
    const messages_box = document.querySelector("#messages-box")
    messages_box.innerHTML = ""
    let messages_box_html = ""
    fetch("get_messages.php", {
        method: "POST",
        header: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            "connection_id": cur_connection_id
        })
    }).then(async (response) => {
        return JSON.parse(await response.text())
    }).then((messages) => {
        for (const message of messages) {
            let align, pfp
            if (message["sender_id"] === user_id) {
                pfp = user_profile_pic
                align = "flex-row-reverse align-self-end"
            } else {
                pfp = other_user_pfp
            }
            messages_box_html += `
                    <div class="d-flex m-5 message text-center ${align}" >
                        <img src="${pfp}">
                        <p class="mx-3">${message["message"]}</p>
                    </div>
                    `
        }
        messages_box.innerHTML = messages_box_html
    })
}

for (const connection of document.getElementsByClassName("connection")) {
    connection.addEventListener("click", () => {
        cur_connection_id = connection.getAttribute("data-connection-id")
        other_user_pfp = connection.getAttribute("data-profile-pic")
        document.querySelector("#connection-name").innerHTML = `${connection.getAttribute("data-first-name")} ${connection.getAttribute("data-surname")}`
        load_messages()
        document.querySelector("#send-message-button").removeAttribute("disabled")
        document.querySelector("#send-message-text").removeAttribute("disabled")
        document.querySelector("#connection-top-bar").innerHTML += `    
        `
    })
}

document.querySelector("#send-message-form").addEventListener("submit", (e) => {
    e.preventDefault()
    const message = document.querySelector("#send-message-text")
    if (message.value === "") {
        return
    }

    fetch("message_submit.php", {
        method: "POST",
        header: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            "connection-id": cur_connection_id,
            "message": message.value,
            "sender-id": user_id
        })
    }).then(async (response) => {
        console.log(await response.text())
    }).then(() => {
        load_messages()
        message.value = ""
    })
})

