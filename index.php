

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
        <title>Home | TweetAnalyzer</title>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" bgcolor="#191970">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand"><strong>TweetAnalyzer</strong></a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="displayTweets.php">Tweets</a></li>
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
        <div id="block-how-to" class="col-sm-3">
            <h2>How to use Tweet Analyzer ?</h2>
            <p>1) Isi form di sebelah. Pilih kata kunci pencarian pada form bagian 'Search Keyword for Tweets'.</p>
            <p>2) Isi kolom keyword untuk masing-masing dinas pemerintahan. Jika kata kunci untuk satu kolom lebih dari satu, dipisahkan dengan "; " (titik koma kemudian spasi).</p>
            <p>3) Pilih algoritma string matching</p>
            <p>4) Jika semua kolom sudah terisi, klik tombol Analyze. Tunggu dan ketika sudah muncul, klik link 'Hasil Analisis Tweets'</p>
        </div>
        <div id="block-form" class="col-sm-7">
            <h3>Analyze Tweet with TweetAnalyzer</h3>
            <form name="analyzer-from" class = "form-horizontal" role = "form" method="POST" onsubmit="return validate_form()">
                <div class = "form-group">
                    <label for = "search" class = "col-sm-4 control-label">Search Keywords for Tweets</label>        
                    <div class="col-sm-7">
                        <select name="dropdown">
                            <option value="pemkotbdg" selected>pemkotbdg</option>
                            <option value="diskominfobdg">diskominfobdg</option>
                            <option value="infobdg">infobdg</option>
                            <option value="infobandung">infobandung</option>
                            <option value="ridwankamil">ridwankamil</option>
                            
                        </select>
                    </div>
                </div>
                <div class = "form-group">
                    <label for = "dinas1" class = "col-sm-4 control-label">Keywords for PDAM</label>
                    <div class="col-sm-7">
                        <input type = "text" class = "form-control" name = "dinas1" id = "dinas1">
                    </div>
                </div>
                <div class = "form-group">
                    <label for = "dinas2" class = "col-sm-4 control-label">Keywords for Dinas Bina Marga dan Pengairan</label>
                    <div class="col-sm-7">
                        <input type = "text" class = "form-control" name = "dinas2" id = "dinas2">
                    </div>
                </div>
                <div class = "form-group">
                    <label for = "dinas3" class = "col-sm-4 control-label">Keywords for Dishub</label>
                    <div class="col-sm-7">
                        <input type = "text" class = "form-control" name = "dinas3" id = "dinas3">
                    </div>
                </div>
                <div class = "form-group">
                    <label for = "dinas4" class = "col-sm-4 control-label">Keywords for DPLH</label>
                    <div class="col-sm-7">
                        <input type = "text" class = "form-control" name = "dinas4" id = "dinas4">
                    </div>
                </div>
                <div class = "form-group">
                    <label for = "dinas5" class = "col-sm-4 control-label">Keywords for Disdik</label>
                    <div class="col-sm-7">
                        <input type = "text" class = "form-control" name = "dinas5" id = "dinas5">
                    </div>
                </div>
                <div class = "form-group">
                    <div class = "col-sm-offset-4">
                        <label class = "checkbox-inline">
                            <input type = "radio" name = "optionsRadiosinline" id = "optionsRadios3" value = "KMP" checked> KMP
                        </label>
                        <label class = "checkbox-inline">
                            <input type = "radio" name = "optionsRadiosinline" id = "optionsRadios4" value = "BM"> Booyer-Moore
                        </label>
                    </div>
                    <div class = "col-sm-offset-10">
                        <button type = "submit" name = "submit" class = "btn btn-default">Analyze</button>
                    </div>
                </div>
            </form>
            <?php
                //menyimpan informasi dari form ke file txt
                if (isset($_POST['submit'])){
                    $outputFile = "C:/xampp/htdocs/TweetAnalyzer/text/form.txt";
                    $string_form =  $_POST['dropdown']."\n".
                                    $_POST['dinas1']."\n".
                                    $_POST['dinas2']."\n".
                                    $_POST['dinas3']."\n".
                                    $_POST['dinas4']."\n".
                                    $_POST['dinas5']."\n".
                                    $_POST['optionsRadiosinline'];
                    file_put_contents($outputFile,$string_form);

                    ?>
                        <div class="col-sm-12" id = "link_result"><a href = "displayTweets.php"><h4>Hasil Analisis Tweets...</h4></a></div>
                    <?php
                }



            ?>
        </div>
        <footer class="col-sm-12">
            © Copyright 2014, BackgroungImage Source : http://headerjunction.com/category/Abstract
        </footer>
        </div>
        
        

    </body>
</html>