<?php


function diretorio($path) {

global $tamanho_arquivo, $tamanho_total, $total_pastas;

if ($dir = opendir($path)) {

while (false !== ($file = readdir($dir))) {

if (is_dir($path."/".$file)) {

if ($file != '.' && $file != '..') {

echo '<li><b>' . $file . '</b></li><ul>';

diretorio($path."/".$file);

echo '</ul>';

$total_pastas++;

}

}

else {

$tab = " ";

$filesize = $tab . '(' . filesize ($path.'/'.$file) . ' kb)';

echo '<li>' . $file . $filesize . '</li>';

$tamanho_total = $tamanho_total + filesize ($path.'/'.$file);

$tamanho_arquivo++;

}

}

closedir($dir);

}

}

diretorio("all_files/1/Meu armazenamento");//path da sua pasta

$tamanho_total = round($tamanho_total / 1024 / 1024, 2);

echo"<br><br>
<b>Total de Arquivos</b> - $tamanho_arquivo arquivos<br>

<b>Total de Pastas</b> - $total_pastas uma pasta<br>

<b>Tamanho da Pasta</b> - $tamanho_total MB<br>

";


?>