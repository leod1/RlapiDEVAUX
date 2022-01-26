document.addEventListener("DOMContentLoaded", async () => {
    await load_data();
});
async function load_data() {
    const contentElement = document.getElementById("content");
    const request = await fetch("/apiNew2/list.php");
    const cars = await request.json();
    contentElement.innerHTML = "";
    for (const car of cars) {
        contentElement.innerHTML += `
        <div class="item" id="${car.id}">
            <img src="${car.imageLink}"><br>
            Name: ${car.name}<br>
            Rarity: ${car.rarity}<br>
            Difficulty: ${car.difficulty}<br>
            <button onclick="edit_car('${car.id}')">Edit</button>
            <button onclick="delete_car('${car.id}')">Delete</button>
        </div>
        `;
    }
}

async function set_img(setIt){
    if (setIt === "")
        return ("https://static.wikia.nocookie.net/rocketleague/images/c/cf/Backfire_body_icon.png/revision/latest?cb=20170527083720");
    else
        return(setIt);
}
async function send_champion() {
    const car = {
        "name": document.getElementById("name_input").value,
        "difficulty" : parseInt(document.getElementById("difficulty_input").value),
        "rarity" : document.getElementById("rarity_input").value,
        "imageLink": document.getElementById("img_input").value
    };
    await fetch("/apiNew2/add.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(car)
    });
    await load_data();
}

async function edit_car(car_id){
    const carElement = document.getElementById(`${car_id}`);
    const car = {
        "id": car_id,
        "name": carElement.name,
        "difficulty" : carElement.difficulty,
        "rarity" : carElement.rarity,
    };
    const request = await fetch("/apiNew2/list.php");
    const cars = await request.json();
    let temp_car;
    for (const car of cars) {
        if (car.id == car_id){
            temp_car = car;
        };
    }
    document.getElementById(`${car.id}`).innerHTML = `
        <img src="${temp_car.imageLink}"><br>
        Name: <input id="edit_name_input" value="${temp_car.name}"></input><br>
        Rarity: <input id="edit_rarity_input" value="${temp_car.rarity}"></input><br>
        Difficulty: <input id="edit_difficulty_input" value="${temp_car.difficulty}"></input><br>
        ImageUrl: <input id="edit_imgLink_input" value="${temp_car.imageLink}"></input>
        <button onclick="valide_edit_car(${temp_car.id})">Valider</button>
        
    `;
}

async function valide_edit_car(car_id){
    const car = {
        "id": car_id,
        "name": document.getElementById("edit_name_input").value,
        "difficulty" : parseInt(document.getElementById("edit_difficulty_input").value),
        "rarity" : document.getElementById("edit_rarity_input").value,
        "imageLink": document.getElementById("edit_imgLink_input").value
        
    };
    await fetch("/apiNew2/edit.php", {
        method: "PUT",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(car)
    });
    await load_data();
}

async function delete_car(car_id){
    const car = {
        "id": car_id,
    };
    await fetch("/apiNew2/delete.php", {
        method: "DELETE",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(car)
    });
    await load_data();
}

async function open_creation_menu() {
    if (document.getElementById("creation_menu").innerHTML == false){
        document.getElementById("creation_menu").innerHTML += 
    `
    <div >
        Name: <input type="text" id="name_input">
        Rarity: <input type="text" id="rarity_input">
        Difficulty: <input type="number" id="difficulty_input">
        Image: <input type="text" id="img_input">
        <button onclick="send_champion()">Ajouter</button>
    </div>
    `;
    }
    else {
        document.getElementById("creation_menu").innerHTML = "";
    }
}