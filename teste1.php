<html><head>
    <style>
    .diff td{
      vertical-align : top;
      white-space    : pre;
      white-space    : pre-wrap;
      font-family    : monospace;
    }
    .diffUnmodified { background-color: #F8F9FA; }
    .diffDeleted { background-color:#F8F9FA;color:#C64188; }
    .diffInserted { background-color: #F8F9FA;color:#008000; }
    </style>
</head>
<body>
    // output the result of comparing two files as a table
    <?php 
    require_once 'class.Diff.php';
    echo "<code>".Diff::toTable( Diff::compareFiles('arquivo1.txt', 'arquivo2.txt') )."</code>"; 
    ?>
</body></html>