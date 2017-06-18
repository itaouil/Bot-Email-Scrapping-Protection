<?php

echo obscure('itaouil@gmail.com');

function obscure($value) {

  $obscured   = null;
  $identifier = md5(uniqid(true));

  // Allowed email character set
  $charset = "+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz";

  // Shuffle charset
  $key = str_shuffle($charset);

  // Map email to key and charset
  for ($i = 0; $i < strlen($value); $i++) {
    $obscured .= $key[strpos($charset, $value[$i])];
  }

  // Output JavaScript
  $output = <<<EOT
    <span id="{$identifier}">[email protected]</span>
    <script>
      (function (k, o) {

        var c = k.split("").sort().join("");
        var r = "";

        for (var i = 0; i < o.length; i++) {
          r += c.charAt(k.indexOf(o.charAt(i)))
        }

        document.getElementById("${identifier}").innerText = r;

      })("${key}", "${obscured}")
    </script>
EOT;

  return trim(preg_replace("/\s+/", " ", $output));

}

?>
