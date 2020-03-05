<?php
function getProfiles(){
    require_once "bootstrap.php";
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

function insertProfile(){
    header('Content-Type: application/json');
    $entityBody = json_decode(stream_get_contents(detectRequestBody()), true);
    $name =  $entityBody['nombre'];
    $title =  $entityBody['titulo'];
    $image = $entityBody['imagen'];
    require_once "bootstrap.php";
    $profile = new Profile();
    $profile->setName($name);
    $profile->setTitulo($titulo);
    $profile->setImage($image);
    $entityManager->persist($profile);
    $entityManager->flush();
    $dict_profile = objectProfileToDict($profile);
    $json_profile = dictToPrettyJSON($dict_profile);
    http_response_code(200);
    return $json_profile;
}

function objectProfileToDict($profile){
    return [
        'id' => $profile->getId(),
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