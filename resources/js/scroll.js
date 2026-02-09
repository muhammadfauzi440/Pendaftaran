window.scrollToTop = function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

window.onscroll = function() {
    const btn = document.getElementById("btnBackToTop");
    if (this.document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        btn.classList.remove("hidden");
        btn.classList.add("animate-bounce-short");
    } else {
        btn.classList.add("hidden");
    }
}