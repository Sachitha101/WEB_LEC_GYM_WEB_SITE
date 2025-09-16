<?php
// Simulate client: get csrf token then signup then login
$base = 'http://localhost/fitness_win11/api/auth.php';

function call($url,$data=null){
    $opts = ['http'=>['method'=> $data? 'POST':'GET','header'=>'Content-Type: application/json','content'=>$data? json_encode($data):null]];
    $context = stream_context_create($opts);
    return @file_get_contents($url,false,$context);
}

// Get CSRF via GET
$csrf = @file_get_contents($base.'?action=csrf');
if (!$csrf) { echo "Could not fetch CSRF token via HTTP. If running locally without Apache, test via browser.\n"; exit; }
$j = json_decode($csrf,true);
$token = $j['csrf_token'] ?? null;
if (!$token) { echo "No token in response: $csrf\n"; exit; }

echo "CSRF token: $token\n";

// Signup
$signupPayload = ['name'=>'Test User','email'=>'testuser@example.com','password'=>'testpass123','age'=>25,'csrf_token'=>$token];
$resp = call($base.'?action=signup',$signupPayload);
echo "Signup response: $resp\n";

// Login
$loginPayload = ['email'=>'testuser@example.com','password'=>'testpass123','csrf_token'=>$token];
$resp = call($base.'?action=login',$loginPayload);
echo "Login response: $resp\n";
