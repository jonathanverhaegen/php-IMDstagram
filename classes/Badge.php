<?php 

include_once(__DIR__."/../includes/autoloader.inc.php");

class Badge{


    public static function countryBadge( $user_id){

        $countriesPosts = Post::getCountriesForUser($user_id);
        
        foreach($countriesPosts as $c){
            
            $numberOfCountry = Post::countCountryForUser($user_id,$c["country"]);

            
            if($numberOfCountry > 1){
                    
                $countryBadge[] = $c["country_code"];
 
            }
            
        }

        return $countryBadge;
        
    }


    public static function postBadge($numberOfPosts){
        if($numberOfPosts > 2){
            $postBadge = '<a href="" title="post badge">📷</a>';
            return $postBadge;
        }
    }

    public static function travellerbadge($user_id){
        
        $numberOfCountries = Post::numberOfCountries($user_id);

        

        if($numberOfCountries > 2){
            $travellerBadge = '<a href="" title="traveller badge">🧳</a>';
            return $travellerBadge;
        }
    }

    public static function distanceBadge($user_id){
        $numberOfCities = Post::countCitiesForUser($user_id);
        
        if($numberOfCities > 2){
            $distanceBadge = '<a href="" title="distance badge">✈️</a>';
            return $distanceBadge;
        }
    }






}