<?php
?>
<html>
<head>
	<title>EXTRACT INTERGENIC REGIONS -> -> -> -></title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/dropzone.css">
<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>


</head>

<body>
    <a href="https://github.com/you"><img alt="Fork me on GitHub" src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" style="position: absolute; top: 0; right: 0; border: 0;"></a>

    <div id="tool">
        <div class="headbig" style="text-align: center">
            Extract <span style="color:#222222">Intergenic Regions</span>
        </div>

        <div class="headbigA" style="text-align: center">
            ↓
        </div>

        <div class="mainhold" style="text-align: center">
            <div id="donezone">
                <span class="headone" style="color:#336699">NCBI</span> <span class="headone" style="color:#222222">ACCESSION NO.</span><br>
                <br>

                <div style="text-align: center">
                    <input class="input" id="acc" placeholder="acc no." style="text-align:center;font-size:23px;font-weight:400;color:#336699;font-family: 'Fjalla One', sans-serif;" type="text"><br>
                    <span style="font-size: 14px;">or</span>

                    <form action="fileup.php" class="dropzone" id="yodropzone" name="yodropzone"></form>
                </div>

                <div id="len">
                    <span style="font-size:27px;">MINIMUM LENGTH:</span>&nbsp;&nbsp;&nbsp;&nbsp;<input class="input" id="acclen" placeholder="1" style="width:67px;font-size:18px;" type="number" value="1"> <span style="font-size:27px;">MAX LENGTH:</span>&nbsp;&nbsp;&nbsp;&nbsp;<input class="input" id="acclenm" placeholder="100000" style="width:77px;font-size:18px;" type="number" value="100000">
                </div>

                <div class="switch" data-off="danger" data-off-label="gene" data-on="warning" data-on-label="CDS" id="typess">
                    <input checked type="checkbox">
                </div>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="extract()" type="button">Extract Intergenic Regions</button>
            </div><span id="types" style="display:none;">CDS</span><span id="fileu" style="display:none;"></span><br>
            <img id="loader" src="360.gif" style="position:absolute;left:50%;margin-left:-70px;top:-172px;width:140px;display:none;"><br>
        </div>

        <div id="donezone2" style="text-align: center"></div>
    </div>

    <div id="seq">
        <br>
        <span style="font-size:27px;padding-left:30px;">VISUALIZED GENBANK FILE</span><br>
        <br>
        <canvas height="300px" id="canvass" style="margin-left:auto;margin-right:auto;height:300px;"></canvas>
    </div>

    <footer class="navbar navbar-fixed-bottom">
        <div class="footcopy" style="text-align:center;font-si">
            © 2013-2014 Mcmaster IIDR Bioinformatics. All Rights Reserved.
        </div>
    </footer>
</body>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/dropzone.js"></script>
<script src="js/scribe.min.js"></script>
<script src="js/dragscrollable.js"></script>
<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>



</html>



