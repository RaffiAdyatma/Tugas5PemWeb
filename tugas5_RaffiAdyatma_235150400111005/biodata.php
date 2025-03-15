<?php
    session_start();

    if(!$_SESSION["logtrue"]){
        header("Location: login.php");
        exit;
    }

    $nama = $_SESSION["biodata"]["nama"];
    $email = $_SESSION["biodata"]["email"];
    $alamat = $_SESSION["biodata"]["alamat"];
    $tglLahir = $_SESSION["biodata"]["tglLahir"];
    $sd = $_SESSION["biodata"]["SD"];
    $smp = $_SESSION["biodata"]["SMP"];
    $sma = $_SESSION["biodata"]["SMA"];
    $foto = $_SESSION["biodata"]["foto"];

?>




<html>

<head>
    <link rel="stylesheet" href="css/biodata.css">
</head>

<body>
    <div class="box">
        <div class="left">
            <img src=<?php echo $foto;?> alt="foto diri">
            <h2 class="nama"><?php echo $nama; ?></h2>
            <p class="email"><?php echo $email; ?></p>
            <p class="tgl">Tgl Lahir : <br><?php echo $tglLahir; ?></p>
            <p class="alamat">Alamat tempat tinggal :<br><?php echo $alamat; ?></p>
            
        </div>
        
        <div class="right">
            <!-- <div class="edukasi"> -->
                <h2>Riwayat Pendidikan</h2>
                <li><?php echo $sd?></li>
                <li><?php echo $smp?></li>
                <li><?php echo $sma?></li>
            <!-- </div> -->
        </div>
    </div>
</body>

</html>