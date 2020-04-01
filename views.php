<?php
function getProfiles(){
    require_once "bootstrap.php";
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET");
    header('Content-Type: application/json');
    http_response_code(200);
    $profileRepository = $entityManager->getRepository('Profile');
    $profiles = $profileRepository->findAll();
    $array_profiles = array();

    foreach ($profiles as $profile) {
        $dict_profile = objectProfileToDict($profile);
        array_push($array_profiles, $dict_profile);
    }

    $json_profiles = dictToPrettyJSON($array_profiles);
    return $json_profiles;
}

function optionsInsertProfile(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: OPTIONS, POST");
    header("Content-Type: application/json");
    header("Content-Length: 0");
    http_response_code(200);
    return "";
}

function insertProfile(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: POST");
    header('Content-Type: application/json');
    $entityBody = json_decode(stream_get_contents(detectRequestBody()), true);
    $name =  $entityBody['nombre'];
    $title =  $entityBody['titulo'];
    $image = $entityBody['image'] || "";
    require_once "bootstrap.php";
    $profile = new Profile();
    $profile->setName($name);
    $profile->setTitle($title);
    $profile->setImage($image);
    $entityManager->persist($profile);
    $entityManager->flush();
    $dict_profile = objectProfileToDict($profile);
    $json_profile = dictToPrettyJSON($dict_profile);
    http_response_code(200);
    return $json_profile;
}

function uploadImage($profileId){
    require_once 'vendor/autoload.php';
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: POST");
    header('Content-Type: application/json');
    $image = file_get_contents($_FILES["image"]["tmp_name"]);
    $imgur_response = json_decode(sendImageToImgur($image), true);

    require_once "bootstrap.php";
    $profileRepository = $entityManager->getRepository('Profile');
    $profile = $profileRepository->find($profileId);
    $profile->setImage($imgur_response["data"]["link"]);
    $entityManager->persist($profile);
    $entityManager->flush();
    $dict_profile = objectProfileToDict($profile);
    $json_profile = dictToPrettyJSON($dict_profile);
    http_response_code(200);
    return $json_profile;
}

function objectProfileToDict($profile){
    return [
        '_id' => $profile->getId(),
        'imagen' => $profile->getImage(),
        'titulo' => $profile->getTitle(),
        'fecha' => $profile->getDate()
    ];
}

function dictToPrettyJSON($dict){
    return json_encode($dict, JSON_UNESCAPED_SLASHES, JSON_PRETTY_PRINT);
}

function detectRequestBody() {
    $rawInput = fopen('php://input', 'r');
    $tempStream = fopen('php://temp', 'r+');
    stream_copy_to_stream($rawInput, $tempStream);
    rewind($tempStream);
    return $tempStream;
}

function sendImageToImgur($image){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    require_once "vendor/autoload.php";
    $imgur_client_id = getenv('IMGUR_CLIENT_ID');
    $imgur_url = getenv('IMGUR_URL');
    $image_in_base64 = base64_encode($image);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, $imgur_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Client-ID $imgur_client_id"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ["image" => $image_in_base64]);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
