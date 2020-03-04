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
    $title = $entityBody['title'];
    $image = $entityBody['image'];
    $request_has_title_and_image = $title && $image;
    if($request_has_title_and_image){ // both are required
        require_once "bootstrap.php";
        $profile = new Profile();
        $profile->setTitle($title);
        $profile->setImage($image);
        $entityManager->persist($profile);
        $entityManager->flush();
        $dict_profile = objectProfileToDict($profile);
        $json_profile = dictToPrettyJSON($dict_profile);
        http_response_code(200);
        return $json_profile; // on success send the new object
    }
    // error messages if no title or image
    http_response_code(400);
    $nor_title_nor_image = !$request_has_title_and_image;
    $error_message = "";
    if($nor_title_nor_image){
        $error_message = "title and image are required";
    }
    else if(!$image){
        $error_message = "image are required";
    }
    else if(!$title){
        $error_message = "title are required";
    }
    $dict_error = array("error" => $error_message);
    $json_error = dictToPrettyJSON($dict_error);
    return $json_error;
}

function objectProfileToDict($profile){
    return $dict_profile = array(
        'id' => $profile->getId(),
        'image' => $profile->getImage(),
        'title' => $profile->getTitle(),
        'date' => $profile->getDate()
    );
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