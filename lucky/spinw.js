const emojis = ['🍒', '🍋', '🍉', '🍊', '🍇', '🍓', '⭐', '🍀'];

function spin() {
    const slot1 = document.getElementById('slot1');
    const slot2 = document.getElementById('slot2');
    const slot3 = document.getElementById('slot3');
    const result = document.getElementById('result');

    // 항상 같은 이모지 설정 (랜덤으로 선택)
    const winningEmoji = emojis[Math.floor(Math.random() * emojis.length)];
    slot1.innerHTML = winningEmoji;
    slot2.innerHTML = winningEmoji;
    slot3.innerHTML = winningEmoji;

    // 당첨 메시지
    result.innerHTML = '당첨입니다! 🎉\n(초코송이 X 1개)';

    function end() {
        location.href = '../';
    }

    document.getElementById("lets").onclick = function () {
        end();
    };
    document.getElementById("lets").innerText = "확인";
    document.getElementById("warning").style.display = "none";
}