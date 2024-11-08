// Archivo: search.js
// En este archivo se define la logica de la busqueda 
// Creado por: Pablo Hernández García el 23/10/2024
// Historial de cambios:
// 23/10/2024 - Creado

/*

<a href="../restricted/cardDetails.php"> 
    <section class="card">
        <img class="mainImg" src="../assets/img/houses/house1.png" alt="">
        <h1 class="title">Piso en Madrid</h1>

        <section class="info">
            <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
            <p><i class="fa-solid fa-tag"></i> 200.000€</p>
        </section>
    </section>
</a>

*/

var cards;
var selectedField = "title";
var selectedSortType = 1;

// Funciones relacionadas con añadir y eleminar tarjetas

function clearHouses() {
    const houses = document.getElementById("houses")

    while (houses.firstChild) {
        houses.removeChild(houses.lastChild);
    }
}

function createCard(image, title, location, price, link) {

    const houses = document.getElementById("houses")

    const a = document.createElement("a")
    a.href = `../restricted/${link}`

    const section = document.createElement("section")
    section.classList.add("card")

    const img = document.createElement("img")
    img.src = `../assets/img/houses/${image}`
    img.classList.add("mainImg")
    section.appendChild(img)

    const h1 = document.createElement("h1")
    h1.textContent = title
    h1.classList.add("title")
    section.appendChild(h1)

    const innerSection = document.createElement("section")
    innerSection.classList.add("info")

    const p1 = document.createElement("p")
    const i1 = document.createElement("i")

    i1.classList.add("fa-solid", "fa-location-dot")
    p1.appendChild(i1)
    p1.innerHTML += ` ${location}`

    innerSection.appendChild(p1)
    
    const p2 = document.createElement("p")
    const i2 = document.createElement("i")
    
    i2.classList.add("fa-solid", "fa-tag")
    p2.appendChild(i2)
    p2.innerHTML += ` ${price}€`
    innerSection.appendChild(p2)

    section.appendChild(innerSection)
    a.appendChild(section)

    houses.appendChild(a)

}

function generateCards() {
    sortHouses()
    for (let card in cards) {
        createCard(
            cards[card].image,
            cards[card].title,
            cards[card].location,
            cards[card].price,
            cards[card].link
        )
    }
}

// Funciones relacionedas con el orden de las tarjetas

function changeField(field) {    
    selectedField = field;
}

function changeSortType(sortType) {
    selectedSortType = sortType
}

// Funcion de ordenar tarjetas

function sortHouses() {
    switch (selectedField) {
        case "title":
            cards.sort( (a, b) => (sortString(a, b, "title") * selectedSortType ) )
            break;

        case "date": 
            cards.sort( (a, b) => (sortDate(a, b)  * selectedSortType ) )
            break;

        case "city": 
            cards.sort( (a, b) => (sortString(a, b,  "city")  * selectedSortType ) )
            break;

        case "order-country": 
            cards.sort( (a, b) => (sortString(a, b,  "location")  * selectedSortType ) )
            break;

        case "order-price": 
            cards.sort( (a, b) => (sortString(a, b,  "price")  * selectedSortType ) )
            break;
    
        default:
            break;
    }

    clearHouses();

    for (let card in cards) {
        createCard(
            cards[card].image,
            cards[card].title,
            cards[card].location,
            cards[card].price,
            cards[card].link
        )
    }
}

// Funciones de ordenacion

function sortString(card1, card2, key) {
    console.log(card1, card2, key);
    
    const s1 = card1[key].toString().toLowerCase();
    const s2 = card2[key].toString().toLowerCase();

    if( s1 > s2 ){ return 1;  }
    if( s1 < s2 ){ return -1; }

    return 0;
}

function sortDate(card1, card2) {
    const d1 = new Date(card1.date)
    const d2 = new Date(card2.date)
    
    return d1 - d2

}

// Funcion init

function init() {
    cards = [
        {
            image: "house1.png",
            title:  "A",
            location: "C",
            price: "2",
            link: "cardDetails.php?id=11",
            date: "03/29/2004",
            city: "AB"
        },
        {
            image: "house1.png",
            title:  "B",
            location: "B",
            price: "4",
            link: "cardDetails.php?id=12",
            date: "12/23/2004",
            city: "AA"
        },
        {
            image: "house1.png",
            title:  "C",
            location: "A",
            price: "7",
            link: "cardDetails.php?id=13",
            date: "10/30/2004",
            city: "BB"
        }
    ]

    generateCards()
}