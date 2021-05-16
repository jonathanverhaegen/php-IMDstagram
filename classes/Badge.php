<?php 

include_once(__DIR__."/../includes/autoloader.inc.php");

class Badge{


    public static function countryBadge( $user_id){

        $countriesPosts = Post::getCountriesForUser($user_id);

        
        
        foreach($countriesPosts as $c){
            
            $numberOfCountry = Post::countCountryForUser($user_id,$c["country"]);

            
            if($numberOfCountry > 1){
                    
                // $countryBadge[] = $c["country_code"];
                
                $countryBadge[] = [
                    "country_code" => $c["country_code"],
                    "country" => $c["country"]
                ];
            }
            
        }

        return $countryBadge;
        
    }


    public static function postBadge($numberOfPosts){
        if($numberOfPosts > 2){
            $postBadge = '<a class="badges"  href="" title="Post badge: Post more than 2 posts">📷</a>';
            return $postBadge;
        }
    }

    public static function travellerbadge($user_id){
        
        $numberOfCountries = Post::numberOfCountries($user_id);

        

        if($numberOfCountries > 2){
            $travellerBadge = '<a class="badges"  href="" title="Traveller badge: Visit more than 2 countries">🧳</a>';
            return $travellerBadge;
        }
    }

    public static function distanceBadge($user_id){
        $numberOfCities = Post::countCitiesForUser($user_id);
        
        if($numberOfCities > 2){
            $distanceBadge = '<a class="badges" href="" title="Distance badge: Visit over 2 cities">✈️</a>';
            return $distanceBadge;
        }
    }






}