<?php session_start();
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

function jwt_encode($payload, $key) {
  $header = base64_encode(json_encode(array('typ' => 'JWT', 'alg' => 'HS256')));
  $payload = base64_encode(json_encode($payload));
  $signature = hash_hmac('sha256', "$header.$payload", $key, true);
  $signature = base64_encode($signature);
  return "$header.$payload.$signature"; 
}

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'utente' && $password === 'prova') {
  // Emetti un token JWT valido


  $key = "14071973";
  $payload = array(
      "user_id" => 123,
      "username" => "esempio",
      "email" => "esempio@example.com",
      "exp" => time() + 3600 // Scadenza del token dopo 1 ora (tempo in formato UNIX)
  );
  
  $token = jwt_encode($key, 'chiave-segreta');
  $_SESSION['token'] = $token;
  echo json_encode(array('token' => $token));

} else {
  http_response_code(401); // Non autorizzato
  echo json_encode(array('message' => 'Credenziali non valide'));
}
?>
