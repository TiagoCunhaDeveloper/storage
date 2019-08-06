<?php
     error_reporting( E_ALL | E_STRICT | E_DEPRECATED );
     ini_set( 'display_errors', 'On' );
     $arquivo = fopen( 'arquivo1.txt', 'r' );
     echo '<pre>';
     while( !feof( $arquivo ) ){
     $linha = fscanf( $arquivo, '%[a-zA-Z0-9\s]' );
     for( $i = 0; $i < count( $linha ); ++$i ){
	  $linhas[ 'arquivo1' ][] = preg_replace( '/^\s/', null, $linha[ $i ] );
     }
     }
     fclose( $arquivo );
     $arquivo2 = fopen( 'arquivo2.txt', 'r' );
     while( !feof( $arquivo2 ) ){
     $linha2 = fscanf( $arquivo2, '%[a-zA-Z0-9\s]' );
     for( $i = 0; $i < count( $linha2 ); ++$i ){
	  $linhas[ 'arquivo2' ][] = preg_replace( '/^\s/', null, $linha2[ $i ] );
     }
     }
     print_r( array_diff( $linhas[ 'arquivo1' ], $linhas[ 'arquivo2' ] ) );
	 ?>