<?php 
// Library Twitter API
require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth; ?>

<?php
// Authentication Twitter API
$consumerkey = 'BGuLfVNNwXwLUIaS1Tv4asHbN';
$consumersecret = 'nwpFwnrYHu9vYOatJ5Ndryd0NlcPGjqdhdq2Qc28s7fQiR5Dzq';
$accesstoken = '1469222839-w78n89eGcppCEM6GLoYJH34OrsrJSapqx1fF0uI';
$accesstokensecret = '98dZ175JFF3ypdw8rL4rGp7JasStjNKWT61RNILDhXyK0';

$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

$content = $connection->get("account/verify_credentials");

?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
        <title>Tweets | TweetAnalyzer</title>
    </head>
    <body>
    	<!-- Navigation Bar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href = "index.php" class="navbar-brand"><strong>TweetAnalyzer</strong></a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li ><a href="index.php">Home</a></li>
                        <li class="active"><a href="displayTweets.php">Tweets</a></li>
                        <li><a href="about.html">About</a></li> 
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron">
            <h1>TweetAnalyzer</h1> 
            <p>Classify tweet with string matching algorithm based on the public service in Bandung</p> 
        </div>
        <div class="container">
        <?php

        //--- Function to display tweets category : unknown
        function displayTweets($keyword, $lines) {
        	$i = 1;
        	echo '<table>';
        	foreach ($lines as $line) { 
        		if ($i == 1){
        			echo '<tr><td bgcolor="#f0f8ff">';
        			$i = 2;
        		} else {
        			echo '<tr><td bgcolor="#fffffa">';
        			$i = 1;
        		}
        		$line = str_replace("#|","<br>",$line);
        		//dicek apakah sama dengan keyword pencarian, jika iya penulisan di bold <strong> hitam, 
				//jika tidak, ditampilkan dengan style normal hitam
        		$pos = strpos(strtolower($line), $keyword);
				if ($pos !== false){
					echo substr($line,0,$pos);
					echo '<strong>'.substr($line,$pos,strlen($keyword)).'</strong>';
					echo substr($line,$pos + strlen($keyword));
					echo '<br><br>';
				} else {
					echo $line.'<br>';
				}
				echo '</tr></td>';
			}
			echo '</table>';
        }

        // Function to display tweets with category
        function displayTweets2($f, $l, $x){
        	$i = 1;
        	echo '<table>';
        	foreach ($l as $line) { 
        		if ($i == 1){
        			echo '<tr><td bgcolor="#f0f8ff">';
        			$i = 2;
        		} else {
        			echo '<tr><td bgcolor="#fffffa">';
        			$i = 1;
        		}
				$patterns = explode("; ",strtolower($f[$x]));
				$n = count($patterns);
				$patterns[$n-1] = substr($patterns[$n-1],0,-1);
				$line = str_replace("#|","<br>",$line);
				$text = explode(" ", $line);
				echo ' ';
				//cek per kata jika sama dengan pattern didisplay dengan warna merah,
				foreach ($text as $t) {
					$match = false;
					foreach ($patterns as $pattern) {
						$pos = strpos(strtolower($t),$pattern);
						if ($pos !== false) {
							if ($pos == 0) {
								echo ' <font color="red">'.substr($t,0,strlen($pattern)).'</font>';
							} else {
								echo ' '.substr($t,0,$pos);
								echo '<font color="red">'.$pattern.'</font>';	
							}
							echo substr($t,$pos+strlen($pattern));
							$match = true;
						}
					}
					//jika tidak cocok dengan pattern manapun, dicek apakah sama dengan 
					//keyword pencarian, jika iya penulisan di bold <strong> hitam, 
					//jika tidak, ditampilkan dengan style normal hitam
					if (!$match) {
						$keyword = substr($f[0],0,-1);
						$pos = strpos(strtolower($t),$keyword);
						if ($pos !== false) {
							if ($pos == 0) {
								echo ' <strong>'.substr($t,0,strlen($keyword)).'</strong>';
							} else {
								echo ' '.substr($t,0,$pos);
								echo '<strong>'.$keyword.'</strong>';	
							}
							echo substr($t,$pos+strlen($keyword));
						} else {
							echo ' '.$t;
						}	
					}
				}
				
				echo '</tr></td>';
				//echo '<br><br>';
			}
			echo '</table>';
        }
        //pembacaan file txt berisi data form
        $form = file("C:/xampp/htdocs/TweetAnalyzer/text/form.txt");

        //search tweets dengan Twitter API sesuai keyword
        $keyword = substr($form[0],0,-1);
        if (strcmp($keyword,"#pemkotbdg") == 0) {
        	$tweets = $connection->get("search/tweets", ["q" => "%23pemkotbdg", "count" => 100 , "result_type" => "recent"]);
        } elseif (strcmp($keyword,"pemkotbdg") == 0) {
        	$tweets = $connection->get("search/tweets", ["q" => "pemkotbdg", "count" => 100 , "result_type" => "recent"]);
        }  elseif (strcmp($keyword,"infobdg") == 0) {
        	$tweets = $connection->get("search/tweets", ["q" => "infobdg", "count" => 100 , "result_type" => "recent"]);
        } elseif (strcmp($keyword,"diskominfobdg") == 0) {
        	$tweets = $connection->get("search/tweets", ["q" => "diskominfobdg", "count" => 100 , "result_type" => "recent"]);
        } elseif (strcmp($keyword,"infobandung") == 0) {
        	$tweets = $connection->get("search/tweets", ["q" => "infobandung", "count" => 100 , "result_type" => "recent"]);
        } elseif (strcmp($keyword,"ridwankamil") == 0) {
        	$tweets = $connection->get("search/tweets", ["q" => "ridwankamil", "count" => 100 , "result_type" => "recent"]);
        } 
		
		$string_tweets = "";
		if(isset($tweets->statuses) && is_array($tweets->statuses)) {
    		if(count($tweets->statuses)) {
    			//menyatukan string tweet menjadi sebuah string dan menyimpannya di file txt
        		foreach($tweets->statuses as $tweet) {
            		$string_tweets .= str_replace("\n","#|",$tweet->text)."\n";
        		}
        		$outputFile = "C:/xampp/htdocs/TweetAnalyzer/text/tweets.txt";
				file_put_contents($outputFile,$string_tweets);

				//eksekusi file exe algortima string matching sesuai option (KMP or BM)
				if (strcmp($form[6],"KMP") == 0){
					echo exec("c:/xampp/htdocs/TweetAnalyzer/bin/StringMatchingKMP");
				} else {
					echo exec("c:/xampp/htdocs/TweetAnalyzer/bin/StringMatchingBM");
				}

				//menampilkan hasil klasifikasi tweets beserta waktu analisis
				echo "<font color='#fff'><h2><strong>Hasil Analisis Tweets</strong></h2>";
				?>
				<script type="text/javascript">
         			var dt = Date();
         			document.write("Per Date and Time : " + dt ); 
      			</script>
      			<?php
				echo "<br>";

				//--- Dinas 1
				$count = 0;
				$lines = file("C:/xampp/htdocs/TweetAnalyzer/text/dinas1.txt");
				foreach ($lines as $line) { $count += 1; }
				echo "<br><h4><strong>Kategori PDAM</strong><br>Jumlah Tweets = ".$count."<br>Daftar Tweets</h4></font>";
				displayTweets2($form, $lines, 1);
				//---

				//--- Dinas 2
				$count = 0;
				$lines = file("C:/xampp/htdocs/TweetAnalyzer/text/dinas2.txt");
				foreach ($lines as $line) { $count += 1; }
				echo "<font color='#fff'><br><br><h4><strong>Kategori Dinas Bina Marga dan Pengairan</strong><br>Jumlah Tweets = ".$count."<br>Daftar Tweets</h4></font>";
				displayTweets2($form, $lines,2);
				//---

				//---Dinas 3
				$count = 0;
				$lines = file("C:/xampp/htdocs/TweetAnalyzer/text/dinas3.txt");
				foreach ($lines as $line) { $count += 1; }
				echo "<font color='#fff'><br><br><h4><strong>Kategori Dinas Perhubungan (Dishub)</strong><br>Jumlah Tweets = ".$count."<br>Daftar Tweets</h4></font>";
				displayTweets2($form, $lines, 3);
				//---

				//---Dinas 4
				$count = 0;
				$lines = file("C:/xampp/htdocs/TweetAnalyzer/text/dinas4.txt");
				foreach ($lines as $line) { $count += 1; }
				echo "<font color='#fff'><br><br><h4><strong>Kategori Dinas Pengelola Lingkungan Hidup (DPLH)</strong><br>Jumlah Tweets = ".$count."<br>Daftar Tweets</h4></font>";
				displayTweets2($form, $lines, 4);
				//---

				//---Dinas 5
				$count = 0;
				$lines = file("C:/xampp/htdocs/TweetAnalyzer/text/dinas5.txt");
				foreach ($lines as $line) { $count += 1; }
				echo "<font color='#fff'><br><br><h4><strong>Kategori Dinas Pendidikan (Disdik)</strong><br>Jumlah Tweets = ".$count."<br>Daftar Tweets</h4></font>";
				displayTweets2($form, $lines, 5);
				//---

				//---Tidak terkategori
				$count = 0;
				$lines = file("C:/xampp/htdocs/TweetAnalyzer/text/else.txt");
				foreach ($lines as $line) { $count += 1; }
				echo "<font color='#fff'><br><br><h4><strong>Tidak terkategori</strong><br>Jumlah Tweets = ".$count."<br>Daftar Tweets</h4></font>";
				displayTweets($keyword, $lines);
    		}
    		else {
        		echo 'The result is empty';
    		}
		}
		?>
		<footer>
            © Copyright 2014, BackgroungImage Source : http://headerjunction.com/category/Abstract
        </footer>
		</div>
    </body>
</html>


