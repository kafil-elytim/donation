function limitInputLength(input) {
    const maxLength = 15;
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
}
function isUserAgentBot() {
    const userAgent = navigator.userAgent.toLowerCase();
    const bots = ['googlebot', 'bingbot', 'yahoo', 'bot', 'crawl', 'spider'];

    for (const bot of bots) {
        if (userAgent.includes(bot)) {
            return true;
        }
    }

    return false;
}

// Example usage
window.onload = function () {
    if (isUserAgentBot()) {
        alert('You are a bot!');
  }
};

const emo = document.getElementById("emo");
const btnEmo = document.querySelectorAll(".btn-emo");

btnEmo.forEach(emo =>{
    emo.addEventListener('click', () => {

        document.getElementById("Emo").value = emo.textContent


        console.log(emo.textContent);
    })
    
})