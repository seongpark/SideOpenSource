<?php
$kakaoConfig = array(
    // ![수정필요] 카카오 REST API 키값 , 카카오 개발자 사이트 > 내 애플리케이션 > 요약정보에서 REST API 키값
    'client_id' => '',

    // ![수정필요] 카카오 개발자 사이트 > 내 애플리케이션 > 카카오로그인 > 보안 에서 생성가능
    'client_secret' => '',

    // 로그인 인증 URL
    'login_auth_url' => 'https://kauth.kakao.com/oauth/authorize?response_type=code&client_id={client_id}&redirect_uri={redirect_uri}&state={state}',

    // 로그인 인증토큰 요청 URL
    'login_token_url' => 'https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id={client_id}&redirect_uri={redirect_uri}&client_secret={client_secret}&code={code}',

    // 프로필정보 호출 URL
    'profile_url' => 'https://kapi.kakao.com/v2/user/me',

    // ![수정필요] 로그인 인증 후 Callback url 설정 - 변경시 URL 수정 필요, 카카오 개발자 사이트 > 내 애플리케이션 > 카카오로그인 > Redirect URI 에서 등록가능
    'redirect_uri' => 'http' . (!empty($_SERVER['HTTPS']) ? 's' : null) . '://' . $_SERVER['HTTP_HOST'] . '/oauth.php',
);

// 함수: 카카오 curl 통신
function curl_kakao($url, $headers = array())
{
    if (empty($url)) {
        return false;
    }

    // URL에서 데이터를 추출하여 쿼리문 생성
    $purl = parse_url($url);
    $postfields = array();
    if (!empty($purl['query']) && trim($purl['query']) != '') {
        $postfields = explode("&", $purl['query']);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    if (count($headers) > 0) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    ob_start(); // prevent any output
    $data = curl_exec($ch);
    ob_end_clean(); // stop preventing output

    if (curl_error($ch)) {
        return false;
    }

    curl_close($ch);
    return $data;
}

// 정보치환
$replace = array(
    '{client_id}' => $kakaoConfig['client_id'],
    '{redirect_uri}' => $kakaoConfig['redirect_uri'],
    '{state}' => md5(mt_rand(111111111, 999999999)),
);
setcookie('state', $replace['{state}'], time() + 300); // 300 초동안 유효

$login_auth_url = str_replace(array_keys($replace), array_values($replace), $kakaoConfig['login_auth_url']);
?>
<script src="//code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script><?php // http://craftpip.github.io/jquery-confirm/ ?>

<div class="kakao-login">
    <a href="<?php echo $login_auth_url ?>" id="kakao-login"><img alt="resource preview"
                                                                  src="https://k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg"></a>
</div>