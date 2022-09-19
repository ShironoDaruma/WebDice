<?php  
  function show_room ($room, $pass) {
    echo "
    <!DOCTYPE html>
    <html lang=\"ja\">
      <head>
        <meta charset=\"UTF-8\">
        <title>WebDice</title>
        <link rel=\"stylesheet\" href=\"./bin/css/WebDice.css\">
        <script src=\"https://code.jquery.com/jquery-3.3.1.min.js\" integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\" crossorigin=\"anonymous\"></script>
        <script src=\"./bin/js/Room.js\"></script>
      </head>
      <body>
        <div class=\"load\" id=\"load\"><img src=\"./bin/img/load.gif\" class=\"load-gif\"></div>
        <div class=\"header\">
          <h2><a href=\"http://shirodaruma.php.xdomain.jp/WebDice/\"><span class=\"textGreen\">WebDice</span></a></h2>
        </div>
        <div class=\"field\" id=\"field\">
          <div id=\"getData\">
            <input type=\"hidden\" id=\"sum\" value=\"0\" style=\"display:none\">
          </div>
        </div>
        <div class=\"footer\">
          <input type=\"text\" id=\"sendName\" placeholder=\"名前を入力\">
          <input type=\"button\" class=\"dice\" onclick=\"sendDice('1D4')\" value=\"1D4\">
          <input type=\"button\" class=\"dice\" onclick=\"sendDice('1D6')\" value=\"1D6\">
          <input type=\"button\" class=\"dice\" onclick=\"sendDice('1D8')\" value=\"1D8\">
          <input type=\"button\" class=\"dice\" onclick=\"sendDice('1D10')\" value=\"1D10\">
          <input type=\"button\" class=\"dice\" onclick=\"sendDice('tens')\" value=\"tens\">
          <input type=\"button\" class=\"dice\" onclick=\"sendDice('1D12')\" value=\"1D12\">
          <input type=\"button\" class=\"dice\" onclick=\"sendDice('1D20')\" value=\"1D20\"><br>
          <input type=\"text\" id=\"sendValue\" placeholder=\"ダイスを入力\"><input type=\"button\" id=\"send\" onclick=\"sendRoom()\" value=\"送信\">
        </div>
        <input type=\"hidden\" id=\"room\" value=\"$room\" style=\"display:none\">
        <input type=\"hidden\" id=\"pass\" value=\"$pass\" style=\"display:none\">
      </body>
    </html>
    ";
  }
?>