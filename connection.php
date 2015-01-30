<?php

//require the BC api file
//ensure you have downloaded that from https://github.com/bigcommerce/bigcommerce-api-php
require 'bigcommerce-php/bigcommerce.php';

// if you will be running functions outside of the Client class you will
// need to make sure that the specific class is used as shown below with
// the Resources class.  
use Bigcommerce\Api\Client as Bigcommerce;
use Bigcommerce\Api\Resources as Resources;

//this will need to be retrieved through the bigcommerce
//store using the legacy api accounts. 
Bigcommerce::configure(array(
    'store_url' => 'https://store-url.mybigcommerce.com',
    'username'  => 'legacyApiUsername',
    'api_key'   => 'API23423432423KEY23432432432'
));

//REQUIRED IF NOT UGLY ERRORS ARISE. TRUST ME.
//reason it is required is that if you are not 
//building an app and only want to connect to 
//the api to push small amounts of data you 
//will not have an ssl by default and have 
//to set the cipher as it is defaulted to 
//something else.
Bigcommerce::setCipher('RC4-SHA');
Bigcommerce::verifyPeer(false);
       
//used to check all categories to ensure they are matching

//initialize the object used to call the api
$category = new Bigcommerce();

//get the count of categories in a store
$catCount = $category->getCategoriesCount();

//initialize an array to store the categories in
$storeCategories = array();

//this loop is used to go through all the pages of categories 
//and return them into the store categories array
for($x = 0; $x <= ceil($catCount/250); $x++ ){
    $categories = $category->getCategories(array(
        //the limit is 250 categories as per Bigcommerce
        //so this loop will get you all the categories over 250
        'limit' => 250,
        'page'  => $x
    ));
    //This foreach loop will go through the category array that is 
    //returned from the FOR loop above and will store it in an 
    //array that has the category ID and the category organized in 
    //a better manner.  This is NOT required but does help organization
    //wise as the Key for the array is the ID and the VALUE is the category name.
    foreach($categories as $cat) {
        $storeCategories[$cat->id] = $cat;    
    }
    
};

//This will format the array and dump it either in the response or on the page
echo '<pre>';
var_dump($storeCategories);
echo '</pre>';