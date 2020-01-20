function onClickBtnFavoris(event) {
    event.preventDefault();
    const url = this.href;
    const spanFavorisNum = this.querySelector("span.js-favoris-num");
    const icone = this.querySelector("i");
    axios.get(url)
        .then(function (response) {
            spanFavorisNum.textContent = response.data.favoris;
            if (icone.classList.contains('fas')) {
                icone.classList.replace('fas', 'far');
            } else {
                icone.classList.replace('far', 'fas');
            }
        });
}

document.querySelectorAll("a.js-favoris").forEach(function (link) {
        link.addEventListener('click', onClickBtnFavoris);
    }
);

