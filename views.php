<?php
function getProfiles(){
    require_once "bootstrap.php";

    $profileRepository = $entityManager->getRepository('Profile');
    $profiles = $profileRepository->findAll();
    $array_profiles = array();

    foreach ($profiles as $profile) {
        $dict_profile = array(
            'id' => $profile->getId(),
            'image' => $profile->getImage(),
            'title' => $profile->getTitle(),
            'date' => $profile->getDate()
        );
        array_push($array_profiles, $dict_profile);
    }

    $json_profiles = json_encode(
        $array_profiles,
        JSON_UNESCAPED_SLASHES,
        JSON_PRETTY_PRINT
    );
    return $json_profiles;
}
