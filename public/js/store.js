let buyingButtons = document.querySelectorAll('.buy-btn');

function buyCredits() {
    let userConfirmed = confirm('Are you sure you want to buy ' + this.attributes['credits'].value + ' credits?');

    if (userConfirmed) {
        let formData = new FormData();

        formData.append('description', 'blank');
        formData.append('credits', this.attributes['credits'].value);

        let request = new XMLHttpRequest();

        request.open("POST", "/video-poker/app/store/buy-credits");

        request.onload = function() {
            let status = this.responseText;

            if (status === '401') alert('Unauthorized');

            location.reload();            
        };

        request.send(formData);
    }
}

buyingButtons.forEach(buyingButton => {
    buyingButton.addEventListener('click', buyCredits)
});

