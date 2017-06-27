let cards = document.querySelectorAll('#cards > *');
let bettingButtons = document.querySelectorAll('.bet-btn');
let dealButton = document.querySelector('.deal-btn');

let  cardsToDraw = [];

function toggleClass() {
    bettingButtons.forEach(e => {
        if (e === this) { return; }
        e.classList.remove('pressed');
    });
    this.classList.toggle('pressed');
}

function dealCards() {
    let array = Array.of(...bettingButtons);
    let found = array.find(hasClass);

    if (! found) {
        alert('You must bet to play.');
        return;
    }
    
    // Bet was made
    let bet = found.textContent.slice(-1);
    window.location.href = '/video-poker/app/game/deal/' + bet;
}

function hasClass(element) {
    return element.classList.contains('pressed');
}

bettingButtons.forEach(bettingButton => {
    bettingButton.addEventListener('click', toggleClass)
});



// dealButton.addEventListener('click', dealCards);

function toggleCard() {
    this.classList.toggle('selected-card');
}

if (window.location.href.includes('/hand')) {
    cards.forEach(card => {
        card.addEventListener('click', toggleCard);
    });
}

function drawCards() {
    cardsToDraw = [];

    cards.forEach(card => {
        if (card.classList.contains('selected-card')) {
            cardsToDraw.push(card.id);
        }
    });

    let s = (cardsToDraw.toString()).replace(/,/g,"");

    window.location.href = '/video-poker/app/game/draw/' + s;
}
