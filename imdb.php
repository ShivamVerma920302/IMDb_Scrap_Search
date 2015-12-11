
<?php
error_reporting(E_ERROR | E_PARSE);
error_reporting(0);
	include('simple_html_dom.php');
 class Imdb
{   
    public function getActorInfo($title)
    {
        $imdbId = $this->getIMDbIdFromSearch(trim($title));
        if($imdbId === NULL){
            $arr = array();
           $arr['error'] = "No Title found in Search Results!";
            return arr;
        }
		else{
        return $this->getActorInfoById($imdbId, $getExtraInfo);
		return $arr;
		}
    }
     
    // Get movie information by IMDb Id.
    public function getActorInfoById($imdbId)
    {
        $arr = array();
        $imdbUrl = "http://www.imdb.com/name/" . trim($imdbId) . "/";
        return $this->scrapeActorInfo($imdbUrl, $getExtraInfo);
    }
     
    // Scrape movie information from IMDb page and return results in an array.
    private function scrapeActorInfo($imdbUrl)
    {
        $arr = array();
        $html = $this->geturl("${imdbUrl}");
        $title_id = $this->match('/<link rel="canonical" href="http:\/\/www.imdb.com\/name\/(nm\d+)\/" \/>/ms', $html, 1);
        if(empty($title_id) || !preg_match("/nm\d+/i", $title_id)) {
            $arr['error'] = "No Title found on IMDb!";
			return $arr;
        }
        $arr['title_id'] = $title_id;
        $arr['imdb_url'] = $imdbUrl;
		
		$name = $this->getMovieUrl($imdbUrl);
		
		
		
		$arr['movie_url'] = $name;
		
		//$str  = preg_split('/\//',implode(" ",$name),-1,PREG_SPLIT_NO_EMPTY);
		preg_match_all('/tt\d+/',implode(" ",$name),$matches);
		 foreach($matches as $match){
			$mat = array_unique($match);
			$a = implode(" ",$mat);
			$b = explode(" ",$a);
		 }
		 $y = array();
		 $x = array();
		 for($i=0;$i<3;$i++){
			$array[$i] = $this->getMovieInfoById($b[$i]);
			// $review[$i] = 
		//	$abc[$i] = $this->getMovieReview($b[$i]);
			 // echo '<pre>';print_r($abc[$i]);'</pre>'; 
		    array_push($y,$array[$i]);
		//	array_push($x,$abc[$i]);
			
		 }
		/*  $fp = fopen('results.json', 'w');
         fwrite($fp, json_encode($abc));
         fclose($fp);
		 $fp = fopen('results.json', 'a');
         fwrite($fp, json_encode($y));
		 fclose($fp); */
		// $a = array();
		// array_push($a,$x,$y);
		// echo json_encode($a);
		   //$data = json_encode($y);
		/* 	  echo '<pre>'.$data.'</pre>';  */
		 		return $y;
		
    }
		/*  echo implode(' ', array_map(function ($entry) {
         return $entry['genres'];}, $array[$i]));
			 */
			//echo '<pre>'; print_r($array[$i]); echo '<pre/><hr>';
			// echo '<pre>'; print_r($review[$i]); echo '<pre/>';
			
			


			
		
		//$arr['id'] = $str1;
		
		//$array = $this->getMovieInfoById($str1);
		
		//$arr['review'] = $this->getMovieReview($str1);
		
		
		//$arr = array_merge($arr,$array[$i]);
		 
		//$i = new Imdb();
		//$mArr = array_change_key_case($i->getActorInfo($movieName), CASE_UPPER);

	
	public function getMovieReview($str1){
		
		$imdbUrl = "http://www.imdb.com/title/" . trim($str1) . "/reviews?ref_=tt_urv";
		return $this->getMovieReview_Inside($imdbUrl);
		
	}
	
	private  function getMovieReview_Inside($imdbUrl){
		
			$html = file_get_html($imdbUrl);
	
			$element = $html->find('div',1) ;
			 $i=0;
			 $j=0;
			$k=0; 
			$n=0;
			foreach($element->find('h2') as $x){
				$heading[$i] = $x->innertext;
				// echo '<pre>'.$new->innertext.'</pre>';
				$i++;
			}
			 foreach($html->find('a') as $x){
				
				if($this->match("/\/user\/(ur\d+).*?/", $x->href)){
				                   $name[$j]= $x->plaintext;
								   $j++;
				  //echo '<pre>'.$x->innertext.'</pre>';
				}
					
			}
			 foreach($html->find('small') as $x){
				
				if($this->match("/from[,]*/", $x->innertext)){
				                   $place[$n]= $x->innertext;
								   $n++;
				 // echo '<pre>'.$x->innertext.'</pre>';
				}
					
			}
			$name_know=array_values(array_filter($name));
			 	
		
				foreach($html->find('p') as $x){
					if(strlen($x->innertext)>500){
						$rev = $x->innertext;
						$review[$k] = $this->myTruncate2($rev,500);
						$k++;
					  //echo '<pre>'.$x->innertext.'</pre><hr>';
					}
				} 
			/* 	for($l=0;$l<3;$l++){
					// echo json_encode($heading[$l]);
					  //echo json_encode($user[2*$l+1]);
					 //  echo json_encode($review[$l]);
					 echo '<pre>'; print_r($heading[$l]); echo '<pre/><hr>';
					echo '<pre>'; print_r($user[2*$l+1]); echo '<pre/><hr>';
					echo '<pre>'; print_r($review[$l]); echo '<pre/><hr>'; 
				}  */
				$user['user'] =array_slice($name_know,0,3);
				$user['review'] =array_slice($review,0,3);
				$user['heading'] = array_slice($heading,0,3);
				$user['place'] = array_slice($place,0,3);
				
				//echo'<pre>'; print_r($user);echo'</pre>';
				return $user;
    }
	
	private function myTruncate2($string, $limit, $break=" ", $pad="...")
{
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  $string = substr($string, 0, $limit);
  if(false !== ($breakpoint = strrpos($string, $break))) {
    $string = substr($string, 0, $breakpoint);
  }

  return $string . $pad;
}
		
	/* 	$ids = $this->match_all('/<a.*?href="\/user\/(ur\d+).*?".*?>.*?<\/a>/ms', $this->geturl($imdbUrl), 1);
		
			foreach($html->find('a') as $x){
				if(preg_match("/ur\d+/i", $ids[$i]))
				 echo '<pre>'.$x->innertext.'</pre>' 
			}
				for($i=0;$i<sizeof($ids);$i++){
				if(preg_match("/ur\d+/i", $ids[$i]))
				 echo '<pre>'.$x->innertext.'</pre>' ;
				}
				
		} */
			
		 

 	
			
		

  public function getMovieInfoById($imdbId)
    {
        $arr = array();
        $imdbUrl = "http://www.imdb.com/title/" . trim($imdbId) . "/";
        return $this->scrapeMovieInfo($imdbUrl, $getExtraInfo);
    }
	private function getMovieUrl($imdbUrl) 
	{
		$html = file_get_html($imdbUrl);
        $i=0;
        foreach($html->find('div[id=knownfor]') as $element) {
	    foreach($element->find('div') as $new){
		  foreach($new->find('a') as $v){
			   $title[$i] = $v->href;
			   $i++;
		  }
		 
	  }
   }
   return $title;
}
	
	

     
    // Scrape movie information from IMDb page and return results in an array.
    private function scrapeMovieInfo($imdbUrl)
    {
        $arr = array();
        $html = $this->geturl("${imdbUrl}combined");
        $title_id = $this->match('/<link rel="canonical" href="http:\/\/www.imdb.com\/title\/(tt\d+)\/combined" \/>/ms', $html, 1);
        if(empty($title_id) || !preg_match("/tt\d+/i", $title_id)) {
            $arr['error'] = "No Title found on IMDb!";
            return $arr;
        }
       $arr['title_id'] = $title_id;
       $arr['imdb_url'] = $imdbUrl;
	   
	   
        $arr['title'] = str_replace('"', '', trim($this->match('/<title>(IMDb \- )*(.*?) \(.*?<\/title>/ms', $html, 2)));

		
        $arr['year'] = trim($this->match('/<title>.*?\(.*?(\d{4}).*?\).*?<\/title>/ms', $html, 1));
        $arr['rating'] = $this->match('/<b>(\d.\d)\/10<\/b>/ms', $html, 1);
		$arr['votes'] = $this->match('/>([0-9,]*) votes</ms', $html, 1);
        $arr['genres'] = $this->match_all('/<a.*?>(.*?)<\/a>/ms', $this->match('/Genre.?:(.*?)(<\/div>|See more)/ms', $html, 1), 1);	
        $arr['mpaa_rating'] = $this->match('/MPAA<\/a>:<\/h5><div class="info-content">Rated (G|PG|PG-13|PG-14|R|NC-17|X) /ms', $html, 1);
        $arr['release_date'] = $this->match('/Release Date:<\/h5>.*?<div class="info-content">.*?([0-9][0-9]? (January|February|March|April|May|June|July|August|September|October|November|December) (19|20)[0-9][0-9])/ms', $html, 1);
        $arr['poster'] = $this->match('/<div class="photo">.*?<a name="poster".*?><img.*?src="(.*?)".*?<\/div>/ms', $html, 1);
        $arr['poster_large'] = "";
        $arr['poster_full'] = "";
        if ($arr['poster'] != '' && strpos($arr['poster'], "media-imdb.com") > 0) { //Get large and small posters
            $arr['poster'] = preg_replace('/_V1.*?.jpg/ms', "_V1._SY200.jpg", $arr['poster']);
            $arr['poster_large'] = preg_replace('/_V1.*?.jpg/ms', "_V1._SY500.jpg", $arr['poster']);
            $arr['poster_full'] = preg_replace('/_V1.*?.jpg/ms', "_V1._SY0.jpg", $arr['poster']);
        } else {
            $arr['poster'] = "";
        }
        $arr['runtime'] = trim($this->match('/Runtime:<\/h5><div class="info-content">.*?(\d+) min.*?<\/div>/ms', $html, 1));
        $arr['country'] = $this->match_all('/<a.*?>(.*?)<\/a>/ms', $this->match('/Country:(.*?)(<\/div>|>.?and )/ms', $html, 1), 1);
		
         
         
        return $arr;
    }
	

    private function getIMDbIdFromSearch($title, $engine = "google"){
        switch ($engine) {
            case "google":  $nextEngine = "bing";  break;
            case "bing":    $nextEngine = "ask";   break;
            case "ask":     $nextEngine = FALSE;   break;
            case FALSE:     return NULL;
            default:        return NULL;
        }
        $url = "http://www.${engine}.com/search?q=imdb+" . rawurlencode($title);
        $ids = $this->match_all('/<a.*?href="http:\/\/www.imdb.com\/name\/(nm\d+).*?".*?>.*?<\/a>/ms', $this->geturl($url), 1);
        if (!isset($ids[0]) || empty($ids[0])) //if search failed
            return $this->getIMDbIdFromSearch($title, $nextEngine); //move to next search engine
        else
		   return $ids[0]; //return first IMDb result
    }
     
    private function geturl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $ip=rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/".rand(3,5).".".rand(0,3)." (Windows NT ".rand(3,5).".".rand(0,2)."; rv:2.0.1) Gecko/20100101 Firefox/".rand(3,5).".0.1");
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }
 
    private function match_all_key_value($regex, $str, $keyIndex = 1, $valueIndex = 2){
        $arr = array();
        preg_match_all($regex, $str, $matches, PREG_SET_ORDER);
        foreach($matches as $m){
            $arr[$m[$keyIndex]] = $m[$valueIndex];
        }
        return $arr;
    }
     
    private function match_all($regex, $str, $i = 0){
        if(preg_match_all($regex, $str, $matches) === false)
            return false;
        else
            return $matches[$i];
    }
 
    private function match($regex, $str, $i = 0){
        if(preg_match($regex, $str, $match) == 1)
            return $match[$i];
        else
            return false;
    }
}
?>


