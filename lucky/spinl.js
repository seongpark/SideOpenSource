const emojis = ['🍒', '🍋', '🍉', '🍊', '🍇', '🍓', '⭐', '🍀'];

function spin() {
    const slot1 = document.getElementById('slot1');
    const slot2 = document.getElementById('slot2');
    const slot3 = document.getElementById('slot3');
    const result = document.getElementById('result');

    // 꽝이 나오도록 각각 다른 이모지 설정
    slot1.innerHTML = emojis[Math.floor(Math.random() * emojis.length)];
    slot2.innerHTML = emojis[Math.floor(Math.random() * emojis.length)];
    slot3.innerHTML = emojis[Math.floor(Math.random() * emojis.length)];

    result.innerHTML = `아쉬워요, 꽝이에요.\n다음 이벤트를 기대해주세요! 😢`;

    function end() {
        location.href = '../';
    }

    document.getElementById("lets").onclick = function () {
        end();
    };
    document.getElementById("lets").innerText = "확인";
    document.getElementById("warning").style.display = "none";
}