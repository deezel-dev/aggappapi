<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/_init.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/account/requiresession.php";
//list the possible methods to be used
$possible_url = array(    
                "getSuggestions","getFlixMovies","getFlixMovie",
                "getExistingSuggestions","getCustomList",
                "getSubjects","getVendors", "getSubjectsByMovie",
                "getVendorsByMovie", "getNextFlixRemixId", "getFlixRemix", "getRemixDetails");

$value = "An error has occurred";
$token = "invalid";
$providerID = null;
$providerKey = null;
$userID = null;
$user = null;
//import Database class;

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url)){
  switch ($_GET["action"]) {
    case "getSuggestions":
        if(isAuthenticated()){
            $value = getSuggestions();
        } else {
            $value = "unathorized user";
        }
        break;
    case "getSubjects":
        if(isAuthenticated()){
            $value = getSubjectsALL();
        } else {
            $value = "unathorized user";
        }
        break;
    case "getNextFlixRemixId":
        if(isAuthenticated()){
            $value = getNextFlixRemixId();
        } else {
            $value = "unathorized user";
        }
        break;
    case "getFlixRemix":
        if(isAuthenticated()){
            $value = getFlixRemix();
        } else {
            $value = "unathorized user";
        }
        break;
    case "getRemixDetails":
        if(isAuthenticated()){
            $value = getRemixDetails();
        } else {
            $value = "unathorized user";
        }
        break;
    case "getVendors":
        if(isAuthenticated()){
            $value = getVendors();
        } else {
            $value = "unathorized user";
        }
        break;
    case "getFlixMovies":
        if(isAuthenticated()){
            $value = getFlixMovies();
        } else {
            $value = "unathorized user";
        }
        break;      
    case "getFlixMovie":
        if(isAuthenticated()){                         
            if (isset($_GET["product_id"])){
                $value = getFlixMovie($_GET["product_id"]);
            }  
        } else {
            $value = "unathorized user";
        }
        break;    
    case "getExistingSuggestions":
        if(isAuthenticated()){
            $value = getExistingSuggestions();
        } else {
            $value = "unathorized user";
        }
        break;  
    case "getSubjectsByMovie":
        if(isAuthenticated()){            
            
            if (isset($_GET["product_id"])){
                $value = getSubjectsByMovie($_GET["product_id"]);
            }        
            
        } else {
            $value = "unathorized user";
        }
        break; 
    case "getVendorsByMovie":
        if(isAuthenticated()){            
            
            if (isset($_GET["product_id"])){
                $value = getVendorsByMovie($_GET["product_id"]);
            }        
            
        } else {
            $value = "unathorized user";
        }
        break; 
    case "getCustomList":
        if(isAuthenticated()){               
            if (isset($_GET["where"])){
                $value = getCustomList($_GET["where"]);
            }               
        } else {
            $value = "unathorized user";
        }
        break; 
    case "isMember":
        if(isAuthenticated()){               
            if (isset($_GET["email"])){
                $value = 1;//isMember($_GET["email"]);
            }               
        } else {
            $value = "unathorized user";
        }
        break; 



        
      
      
      
    }
    }




function isAuthenticated(){
    $authenticUser = false;
    $sql = "SELECT
            provider_user.PROVIDER_ID,
            provider_user.PROVIDER_KEY,
            provider_user.USER_ID


            FROM provider_user
            WHERE provider_user.PROVIDER_KEY='" . $_GET["api_token"] . "'";
  $data = getDatabase();
  if ($data->open()) {
    $array = $data->getData($sql);
    if (count($array) < 1) {
      $value .= "result is null";
    } else {
      //$myArr[] = null;
      foreach ($array as $row) {
        $providerID=$row['PROVIDER_ID'];
        $providerKey = $row['PROVIDER_KEY'];
        $userID = $row['USER_ID'];
      }
    }
  }
    if ($userID!=null){
      $authenticUser = true;
    }
    return $authenticUser;
}

function getSuggestions() {

    $sql = "SELECT productsuggestion_id, date_submitted, entry, movie_link, ip_address, profile_id, subject, approved, approved_date, approved_by
        FROM productsuggestion WHERE approved = 0";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['productsuggestion_id'] <> '') {

            $_id = $row['productsuggestion_id'];
            $submission_date = $row['date_submitted'];
            $title = $row['entry'];
            $movie_link = $row['movie_link'];
            $ip_address = $row['ip_address'];
            $submitted_by = $row['profile_id'];
            $subject = $row['subject'];
            $approved = $row['approved'];
            $approved_date = $row['approved_date'];
            $approved_by  = $row['approved_by'];

            $movieArray[] = array(

                        "_id" => $_id,
                        "submission_date" => $submission_date,
                        "title" => $title,
                        "movie_link" => $movie_link,
                        "ip_address" => $ip_address,
                        "submitted_by" => $submitted_by,
                        "subject" => $subject,
                        "approved" => $approved,
                        "approved_date" => $approved_date,
                        "approved_by" => $approved_by,
                        "selected" => false

                        );

        }
      }
    }
    }
    return $results = $movieArray;
  }

function getMissingLinkMovies() {

    $sql = "SELECT 
    
                product.product_id, 
                product.title, 
                product.rating, 
                product.release_date, 
                product.release_year, 
                product.length, 
                product.description, 
                product.status_id, 
                product.age_max, 
                product.product_image, 
                product.director, 
                product.writer, 
                product.actors, 
                product.language, 
                product.country, 
                product.awards, 
                product.imdb_id, 
                product.type 

            FROM product 
            
            WHERE product.product_id NOT IN (SELECT product_vendors.product_id FROM product_vendors)
            
            ORDER BY title;";

    $data = getDatabase();
    
    if ($data->open()) {
        $array = $data->getData($sql);
        if (count($array) < 1) {
            $results .= "result is null";
        } else {

        foreach ($array as $row) {

        if($row['title']!=null){
            $myArr[] = array("title" => $row['title'],
                            "length" => intval($row['length']),
                            "rating" =>$row['rating'],
                            "product_id" => $row['product_id'],
                            "description" => $row['description'],
                            "age_max" => intval($row['age_max']),
                            "product_image" => $row['product_image'],
                            "release_date" => $row['release_date'],
                            "release_year" => $row['release_year'],
                            "director" => $row['director'],
                            "writer" => $row['writer'],
                            "actors" => $row['actors'],
                            "language" => $row['language'],
                            "country" => $row['country'],
                            "awards" => $row['awards'],
                            "imdb_id" => $row['imdb_id'],
                            "type" => $row['type']);
        }
      }
        $results = array('movies' => $myArr);
    }
  }
  return $results;
    
  }

function getMissingSubjectMovies() {

    $sql = "SELECT 
    
                product.product_id, 
                product.title, 
                product.rating, 
                product.release_date, 
                product.release_year, 
                product.length, 
                product.description, 
                product.status_id, 
                product.age_max, 
                product.product_image, 
                product.director, 
                product.writer, 
                product.actors, 
                product.language, 
                product.country, 
                product.awards, 
                product.imdb_id, 
                product.type 

            FROM product 
            
            WHERE product.product_id NOT IN (SELECT product_subjects.product_id FROM product_subjects)
            
            ORDER BY title;";

    $data = getDatabase();
    
    if ($data->open()) {
        $array = $data->getData($sql);
        if (count($array) < 1) {
            $results .= "result is null";
        } else {

        foreach ($array as $row) {

        if($row['title']!=null){
            $myArr[] = array("title" => $row['title'],
                            "length" => intval($row['length']),
                            "rating" =>$row['rating'],
                            "product_id" => $row['product_id'],
                            "description" => $row['description'],
                            "age_max" => intval($row['age_max']),
                            "product_image" => $row['product_image'],
                            "release_date" => $row['release_date'],
                            "release_year" => $row['release_year'],
                            "director" => $row['director'],
                            "writer" => $row['writer'],
                            "actors" => $row['actors'],
                            "language" => $row['language'],
                            "country" => $row['country'],
                            "awards" => $row['awards'],
                            "imdb_id" => $row['imdb_id'],
                            "type" => $row['type']);
        }
      }
        $results = array('movies' => $myArr);
    }
  }
  return $results;
    
  }


function getExistingSuggestions() {

    $sql = "SELECT productsuggestion_id, date_submitted, entry, movie_link, ip_address, profile_id, subject, approved, 
        approved_date, approved_by, p.title AS flixTitle, p.product_id AS flixID
        
        FROM productsuggestion AS ps, product AS p 
        WHERE ps.entry LIKE CONCAT('%', p.title, '%') AND ps.approved=0;";

    /*
        SELECT productsuggestion_id, date_submitted, entry, movie_link, ip_address, profile_id, subject, approved, 
        approved_date, approved_by, p.title, p.product_id
        
        FROM productsuggestion AS ps, product AS p 
        WHERE ps.entry LIKE CONCAT('%', p.title, '%');
        
        UPDATE productsuggestion SET 
        
        $sql = "UPDATE productsuggestion 
                    SET product_id = " . $product_id .",
                    approved = " . $approved .",
                    approved_date = '" . padSql($approved_date) ."',
                    approved_by = '" . padSql($approved_by) ."'  
                    
                    WHERE productsuggestion_id = " . $productsuggestion_id .";";
        
        
    */
    
    
    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['productsuggestion_id'] <> '') {

            $_id = $row['productsuggestion_id'];
            $submission_date = $row['date_submitted'];
            $title = $row['entry'];
            $movie_link = $row['movie_link'];
            $ip_address = $row['ip_address'];
            $submitted_by = $row['profile_id'];
            $subject = $row['subject'];
            $approved = $row['approved'];
            $approved_date = $row['approved_date'];
            $approved_by  = $row['approved_by'];
            $flixTitle  = $row['flixTitle'];
            $flixID  = $row['flixID'];

            $movieArray[] = array(

                        "_id" => $_id,
                        "submission_date" => $submission_date,
                        "title" => $title,
                        "movie_link" => $movie_link,
                        "ip_address" => $ip_address,
                        "submitted_by" => $submitted_by,
                        "subject" => $subject,
                        "approved" => $approved,
                        "approved_date" => $approved_date,
                        "approved_by" => $approved_by,
                        "flixTitle" => $flixTitle,
                        "flixID" => $flixID,
                        "selected" => false

                        );

        }
      }
    }
    }
    return $results = $movieArray;
  }

  function isMember($email){
      
    $sql = "SELECT email FROM profile WHERE email LIKE '" . $email . "'";
    echo $sql;
    $results = false;
    $data = getDatabase();
    if ($data->open()) {
        echo "open";
      $array = $data->getData($sql);
        echo "getData";
          if (count($array) >0 ) {
            echo "found something";
            $results = true;
          }
    }

    return $results;
  }

  function getNextFlixRemixIdMinApproach() {

    $sql = "SELECT MIN(flix_id) AS nextID 
            FROM flix_remix_ids 
            WHERE user_id=-1 AND 
                  used=0 AND 
                  date_used is NULL;";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['nextID'] <> '') {

            $nextID = intval($row['nextID']);
            if(updateFlixIdUsed($nextID)){
                $myArr[] = array(
                        "status" => "success",
                        "nextID" => $nextID);
            }
        }
      }
    }
    }
    return $results = array('nextID' => $myArr);
  }

  function getFlixRemix() {


    $remix_id = -1;

    if (isset($_GET["remix_id"])){
        $remix_id = $_GET["remix_id"];
    }

    if($remix_id > 0){
      
      $sql = "SELECT flix_remix_id, profile_id, product_id, 
            title, lesson_name, topic, submission_date
            FROM flix_remix_header 
            WHERE flix_remix_id = " . $remix_id . ";";


    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['flix_remix_id'] <> '') {

            $flix_remix_id = intval($row['flix_remix_id']);
            $profile_id = intval($row['profile_id']);
            $product_id = intval($row['product_id']);
            $title = $row['title'];
            $lesson_name = $row['lesson_name'];
            $topic = intval($row['topic']);
            $submission_date = $row['submission_date'];

            $remixArray[] = array(
                        "flix_remix_id" => $flix_remix_id,
                        "profile_id" => $profile_id,
                        "product_id" => $product_id,
                        "title" => $title,
                        "lesson_name" => $lesson_name,
                        "topic" => $topic,
                        "submission_date" => $submission_date);
                        //"details" => getRemixDetail($flix_remix_id));

          }
        }
       }
    }
    }

    $results = array('flix_remix_data' => $remixArray);

    return $results;

  }

  function getRemixDetails() {

    $remix_id = -1;

    if (isset($_GET["remix_id"])){
        $remix_id = $_GET["remix_id"];
    }
    if($remix_id > 0){
      
      $sql = "SELECT flix_remix_id, seq_id, time, 
            commentary, link, image,
            commentary_type, 
            option_1, option_2, option_3, option_4,
            correct_option

            FROM flix_remix_details


            WHERE flix_remix_id = " . $remix_id . ";";


    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['flix_remix_id'] <> '') {

            $flix_remix_id = intval($row['flix_remix_id']);
            $seq_id = intval($row['seq_id']);
            $time = $row['time'];
            $commentary = $row['commentary'];
            $link = $row['link'];
            $image = $row['image'];            
            $commentary_type = intval($row['commentary_type']);
            $option_1 = $row['option_1'];
            $option_2 = $row['option_2'];
            $option_3 = $row['option_3'];
            $option_4 = $row['option_4'];
            $correct_option = intval($row['correct_option']);

            $remixDetailArray[] = array(
                        "flix_remix_id" => $flix_remix_id,
                        "seq_id" => $seq_id,
                        "time" => $time,
                        "commentary" => $commentary,
                        "link" => $link,
                        "image" => $image,                        
                        "commentary_type" => $commentary_type,
                        "option_1" => $option_1,
                        "option_2" => $option_2,
                        "option_3" => $option_3,
                        "option_4" => $option_4,
                        "correct_option" => $correct_option);

          }
        }
       }
    }
    }

    $results = array('remixDetailArray' => $remixDetailArray);

    return $results;

  }

  function updateFlixIdUsed($flixID){

     $success = FALSE;
    
     $sql = "UPDATE flix_remix_ids SET user_id=1, used=1, date_used = now()
             WHERE flix_id=" . $flixID .";";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->updateData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $success = TRUE;
      }
    }

    return $success;

  }

  function getNextFlixRemixId() {

    $sql = "SELECT MAX(flix_remix_id) AS maxId 
            FROM flix_remix_ids;";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['maxId'] <> '') {

            $maxId = intval($row['maxId']);
            $nextVal =  $maxId + 1;
            if(addNextFlixRemixId($nextVal)==1){
                $myArr[] = array(
                        "status" => "success",
                        "maxId" => $maxId,
                        "nextVal" => $nextVal);
            }
          }
        }
      }
    }
    return $results = array('nextID' => $myArr);
  }
  
  function getSubjectsALL() {

    $sql = "SELECT subject_id, subject_name, type, parent_id FROM subject_ref ORDER BY subject_name, parent_id;";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['subject_id'] <> '') {

            $subject_id = intval($row['subject_id']);
            $subject_name = $row['subject_name'];
            $type = intval($row['type']);
            $parent_id = intval($row['parent_id']);


            $subjectArray[] = array(
                        "subject_id" => $subject_id,
                        "subject_name" => $subject_name,
                        "type" => $type,
                        "parent_id" => $parent_id

                        );

        }
      }
    }
    }
    return $results = array('subjects' => $subjectArray);
  }

  function getSubjects() {

    $sql = "SELECT subject_id, subject_name, type, parent_id FROM subject_ref WHERE parent_id = 0 ORDER BY subject_name;";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['subject_id'] <> '') {

            $subject_id = intval($row['subject_id']);
            $subject_name = $row['subject_name'];
            $type = intval($row['type']);
            $parent_id = intval($row['parent_id']);


            $subjectArray[] = array(
                        "subject_id" => $subject_id,
                        "subject_name" => $subject_name,
                        "type" => $type,
                        "parent_id" => $parent_id,
                        "SubTopics" => getSubTopics($subject_id)
                        );

        }
      }
    }
    }
    return $results = array('subjects' => $subjectArray);
  }


function getSubjectsByMovie($product_id) {

    $sql = "SELECT product_subjects.product_id,product_subjects.subject_id, subject_ref.subject_name
                FROM product_subjects
                INNER JOIN subject_ref
                ON product_subjects.subject_id = subject_ref.subject_id
                WHERE product_subjects.product_id = " . $product_id . 
                " ORDER BY product_subjects.subject_id;";

    $results = '';
    $subjectArray[] = null;
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['product_id'] <> '') {

            $subject_id = intval($row['subject_id']);
            $subject_name = $row['subject_name'];

            $subjectArray[] = array(
                        "subject_id" => $subject_id,
                        "subject_name" => $subject_name
                        );

        }
      }
    }
    }
    //return $results = array_filter($subjectArray);//array('subjects' => array_filter($subjectArray));
    return $results = array('subjects' => $subjectArray);
  }

function getVendorsByMovie($product_id) {

    $sql = "SELECT
        product_vendors.product_id,product_vendors.vendor_id,product_vendors.vendor_product_link,vendor_ref.vendor_logo,vendor_ref.vendor_name
        FROM product_vendors
        INNER JOIN vendor_ref
        ON product_vendors.vendor_id = vendor_ref.vendor_id
        WHERE product_vendors.product_id = " . $product_id . ";";

    $results = '';
    $vendorArray[] = null;
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['product_id'] <> '') {

            $vendor_id = intval($row['vendor_id']);
            $vendor_name = $row['vendor_name'];
            $vendor_logo = $row['vendor_logo'];
            $vendor_product_link = $row['vendor_product_link'];

            $vendorArray[] = array(
                        "vendor_id" => $vendor_id,
                        "vendor_name" => $vendor_name,
                        "vendor_logo" => $vendor_logo,
                        "vendor_product_link" => $vendor_product_link
                        );

        }
      }
    }
    }
    return $results = array_filter($vendorArray);
  }

  function getVendors() {

    $sql = "SELECT vendor_id, vendor_name, vendor_link, vendor_logo, vendor_search_url
            FROM vendor_ref ORDER BY vendor_name;";
      
    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['vendor_id'] <> '') {

            $vendor_id = intval($row['vendor_id']);
            $vendor_name = $row['vendor_name'];
            $vendor_link = $row['vendor_link'];
            $vendor_logo = $row['vendor_logo'];
            $vendor_search_url = $row['vendor_search_url'];


            $vendorArray[] = array(
                        "vendor_id" => $vendor_id,
                        "vendor_name" => $vendor_name,
                        "vendor_link" => $vendor_link,
                        "vendor_logo" => $vendor_logo,
                        "vendor_search_url" => $vendor_search_url
                        );

        }
      }
    }
    }
    return $results = array('vendors' => $vendorArray);
  }

  function getSubTopics($id) {

    $sql = "SELECT subject_id, subject_name, type, parent_id FROM subject_ref WHERE parent_id = " . $id . " ORDER BY subject_name;";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['subject_id'] <> '') {

            $subject_id = intval($row['subject_id']);
            $subject_name = $row['subject_name'];
            $type = intval($row['type']);
            $parent_id = intval($row['parent_id']);


            $subTopicArray[] = array(
                        "subject_id" => $subject_id,
                        "subject_name" => $subject_name,
                        "type" => $type,
                        "parent_id" => $parent_id

                        );

        }
      }
    }
    }
    return $results = $subTopicArray;
  }

  function getLastProductId() {

    $sql = "SELECT MAX(product_id) AS maxId FROM product;";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['maxId'] <> '') {

            $maxId = intval($row['maxId']);
            $nextVal =  $maxId + 1;

            $myArr[] = array(
                        "status" => "success",
                        "maxId" => $maxId,
                        "nextVal" => $nextVal);

        }
      }
    }
    }
    return $results = array('last_product_id' => $myArr);
  }

  function getLastProductId_internal() {

    $sql = "SELECT MAX(product_id) AS maxId FROM product;";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['maxId'] <> '') {

            $maxId = intval($row['maxId']);
            $nextVal =  $maxId + 1;
            return  $nextVal;

        }
      }
    }
    }
    return -1;
  }

  function getLastSubjectId() {

    $sql = "SELECT MAX(subject_id) AS maxId FROM subject_ref;";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->getData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $i = - 1;
        foreach ($array as $row) {
          $i++;
          if ($row['maxId'] <> '') {

            $maxId = intval($row['maxId']);
            $nextVal =  $maxId + 1;

            $myArr[] = array(
                        "status" => "success",
                        "maxId" => $maxId,
                        "nextVal" => $nextVal);

        }
      }
    }
    }
    return $results = array('last_subject_id' => $myArr);
  }



  function padSql($subject){
    return str_replace ("'","''",$subject);
  }


  function markSuggestionApproved($product_id) {

    $suggestion_id = -1;

    if (isset($_GET["suggestion_id"])){
        $suggestion_id = $_GET["suggestion_id"];
    }

    $sql = "UPDATE productsuggestion SET approved=1, product_id=" . $product_id . " WHERE productsuggestion_id=" . $suggestion_id . ";";

    $results = '';
    $data = getDatabase();
    if ($data->open()) {
      $array = $data->updateData($sql);
      if (count($array) < 1) {
        $results .= "result is null";
      } else {
        $myArr = array(
                "suggestion_id"  =>$suggestion_id,
                "product_id"  =>$product_id);
        }
    }
    return $results = array('suggeestion_approved' => $myArr);
  }

  function addNextFlixRemixId($nextID){

    $success = 1;

    $sql = "INSERT INTO flix_remix_ids (flix_remix_id, date_used)
            VALUES (" . $nextID . ", now())";

    $data = getDatabase();
    if ($data->open()) {
        if($data->insertData($sql)){
            $success = 1;
        }
    }

   return $success;

}



function getCustomList($where) {
  $sql = "SELECT product.product_id, 
            product.title, 
            product.rating, 
            product.release_date, 
            product.release_year, 
            product.length, 
            product.description, 
            product.status_id, 
            product.age_max, 
            product.product_image, 
            product.director, 
            product.writer, 
            product.actors, 
            product.language, 
            product.country, 
            product.awards, 
            product.imdb_id, 
            product.type 


            FROM product
            
            WHERE " .$where . " ORDER BY title" ;


  $data = getDatabase();
  if ($data->open()) {
    $array = $data->getData($sql);
    if (count($array) < 1) {
      $results .= "result is null";
    } else {

      //$myArr[] = null;
      foreach ($array as $row) {

      if($row['title']!=null){
          
          
          $product_id = intval($row['product_id']);
          
           $myArr[] = array("product_id" => $row['product_id'],
                            "title" => $row['title'],
                            "length" => intval($row['length']),
                            "rating" =>$row['rating'],
                            "description" => $row['description'],
                            "age_max" => intval($row['age_max']),
                            "product_image" => $row['product_image'],
                            "release_date" => $row['release_date'],
                            "release_year" => $row['release_year'],
                            "director" => $row['director'],
                            "writer" => $row['writer'],
                            "actors" => $row['actors'],
                            "language" => $row['language'],
                            "country" => $row['country'],
                            "awards" => $row['awards'],
                            "imdb_id" => $row['imdb_id'],
                            "type" => $row['type'],
                            "vendors" =>getVendorsByMovie($product_id),
                            "subjects" =>getSubjectsByMovie($product_id));
          
          
          }
      }
        $results = array('movies' => $myArr);
    }
  }
  return $results;
}

function getFlixMovies() {
  $sql = "SELECT product.product_id, 
            product.title, 
            product.rating, 
            product.release_date, 
            product.release_year, 
            product.length, 
            product.description, 
            product.status_id, 
            product.age_max, 
            product.product_image, 
            product.director, 
            product.writer, 
            product.actors, 
            product.language, 
            product.country, 
            product.awards, 
            product.imdb_id, 
            product.type 


            FROM product ORDER BY title";


  $data = getDatabase();
  if ($data->open()) {
    $array = $data->getData($sql);
    if (count($array) < 1) {
      $results .= "result is null";
    } else {

      //$myArr[] = null;
      foreach ($array as $row) {

      if($row['title']!=null){
          
          $product_id = intval($row['product_id']);
          
           $myArr[] = array("product_id" => $row['product_id'],
                            "title" => $row['title'],
                            "length" => intval($row['length']),
                            "rating" =>$row['rating'],
                            "description" => $row['description'],
                            "age_max" => intval($row['age_max']),
                            "product_image" => $row['product_image'],
                            "release_date" => $row['release_date'],
                            "release_year" => $row['release_year'],
                            "director" => $row['director'],
                            "writer" => $row['writer'],
                            "actors" => $row['actors'],
                            "language" => $row['language'],
                            "country" => $row['country'],
                            "awards" => $row['awards'],
                            "imdb_id" => $row['imdb_id'],
                            "type" => $row['type'],
                            "vendors" =>getVendorsByMovie($product_id),
                            "subjects" =>getSubjectsByMovie($product_id));
          
          
          }
      }
        $results = array('movies' => $myArr);
    }
  }
  return $results;
}

function getFlixMovie($product_id) {
  $sql = "SELECT product.product_id, 
            product.title, 
            product.rating, 
            product.release_date, 
            product.release_year, 
            product.length, 
            product.description, 
            product.status_id, 
            product.age_max, 
            product.product_image, 
            product.director, 
            product.writer, 
            product.actors, 
            product.language, 
            product.country, 
            product.awards, 
            product.imdb_id, 
            product.type 

            FROM product 
            WHERE product_id = " . $product_id . " ORDER BY title;";

  $data = getDatabase();
  if ($data->open()) {
    $array = $data->getData($sql);
    if (count($array) < 1) {
      $results .= "result is null";
    } else {

      //$myArr[] = null;
      foreach ($array as $row) {

      if($row['title']!=null){
          
          //$product_id = intval($row['product_id']);
          
           $myArr[] = array("product_id" => $row['product_id'],
                            "title" => $row['title'],
                            "length" => intval($row['length']),
                            "rating" =>$row['rating'],
                            "description" => $row['description'],
                            "age_max" => intval($row['age_max']),
                            "product_image" => $row['product_image'],
                            "release_date" => $row['release_date'],
                            "release_year" => $row['release_year'],
                            "director" => $row['director'],
                            "writer" => $row['writer'],
                            "actors" => $row['actors'],
                            "language" => $row['language'],
                            "country" => $row['country'],
                            "awards" => $row['awards'],
                            "imdb_id" => $row['imdb_id'],
                            "type" => $row['type'],
                            "vendors" =>getVendorsByMovie($product_id),
                            "subjects" =>getSubjectsByMovie($product_id));
          
          
          }
      }
        $results = array('movies' => $myArr);
    }
  }
  return $results;
}

//return JSON array
exit(json_encode($value));
?>


