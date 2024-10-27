<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>사이드</title>
    <link rel="stylesheet" href="../style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon"/>

    <style>
        .progress,
        .progress-stacked {
            --bs-progress-bar-bg: #222222 !important;
        }
    </style>
</head>

<body>
<div class="progress" style="height: 10px; margin-bottom: 20px; border-radius:0;">
    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
         aria-valuemin="0" aria-valuemax="100"></div>
</div>

<div class="container" style="margin-top: 40px;">
    <div class="top-bar">
    </div>
    <h3><span id="introduce-step">이름</span>을 입력해주세요.</h3>
    <input id="input-field" class="form-control form-control-lg mb-3 mt-3" type="text" placeholder="이름">

    <div id="message" style="display: none; margin-top: 10px; width: 100%;">
        만약 인증 코드를 잊어버리셨다면 담임 선생님께 문의해주세요!
    </div>

    <div class="fixed-bottom">
        <button id="next-button" class="btn join btn-dark btn-lg" style="width: 100%;">다음</button>
    </div>
</div>

<form id="signup-form" action="join_process.php" method="post" style="display: none;">
    <input type="hidden" name="name">
    <input type="hidden" name="email">
    <input type="hidden" name="pw">
    <input type="hidden" name="grade">
    <input type="hidden" name="class">
    <input type="hidden" name="number">
</form>

<script>
    const steps = [{
        placeholder: '이름',
        name: 'name'
    },
        {
            placeholder: '이메일 주소',
            name: 'email',
            type: 'email'
        },
        {
            placeholder: '비밀번호',
            name: 'pw',
            type: 'password'
        },
        {
            placeholder: '학년',
            name: 'grade',
            type: 'number'
        },
        {
            placeholder: '반',
            name: 'class',
            type: 'number'
        },
        {
            placeholder: '번호',
            name: 'number',
            type: 'number'
        }
    ];

    let currentStep = 0;
    const inputField = document.getElementById('input-field');
    const nextButton = document.getElementById('next-button');
    const stepDescription = document.getElementById('step-description');
    const signupForm = document.getElementById('signup-form');
    const introduceStep = document.getElementById('introduce-step');
    const progressBar = document.getElementById('progress-bar');

    nextButton.addEventListener('click', () => {
        const value = inputField.value.trim();
        if (!value) {
            alert('값을 입력하세요.');
            return;
        }
        const currentStepInfo = steps[currentStep];

        // 비밀번호 단계에서의 유효성 검사
        if (currentStepInfo.name === 'pw' && value.length < 8) {
            alert('비밀번호는 8자 이상이어야 합니다.');
            return;
        }

        const hiddenInput = signupForm.querySelector(`input[name="${currentStepInfo.name}"]`);
        hiddenInput.value = value;

        currentStep++;
        if (currentStep < steps.length) {
            const nextStepInfo = steps[currentStep];
            inputField.value = '';
            inputField.placeholder = nextStepInfo.placeholder;
            inputField.type = nextStepInfo.type || 'text';
            introduceStep.innerText = nextStepInfo.placeholder;
            updateProgressBar(currentStep, steps.length);

            message.style.display = 'none';
        } else {
            signupForm.submit();
        }
    });

    function updateProgressBar(currentStep, totalSteps) {
        const progress = (currentStep / totalSteps) * 100;
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute('aria-valuenow', progress);
    }

    introduceStep.innerText = steps[0].placeholder;
    updateProgressBar(currentStep, steps.length);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>
