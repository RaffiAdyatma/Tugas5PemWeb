<?php
    session_start();

    if(!$_SESSION["logtrue"]){
        header("Location: login.php");
        exit;
    }

    if (isset($_POST["submit"])) {
        $error = handleBiodata();
    }

    function handleBiodata(){
        if ($_POST["nama"]=="") {
            return "Kolom Nama Kosong";
        }
        else if ($_POST["tglLahir"]=="") {
            return "Masukkan Tanggal Lahir";
        }
        else if ($_POST["alamat"]=="") {
            return "Masukkan Alamat Tempat Tinggal";
        }
        else if ($_POST["SD"]=="" || $_POST["SMP"]=="" || $_POST["SMA"]=="") {
            return "Isi Semua Kolom Yang Kosong";
        }


        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {
            $filename = $_FILES["foto"]["name"];
            $filetype = $_FILES["foto"]["type"];
            $filesize = $_FILES["foto"]["size"];

            // memastikan folder upload tersedia
            $uploadDir = "upload/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // extensi file (.png / .jpeg / .jpg)
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 

            // membuat nama file
            $destination = $uploadDir . "foto." . $ext;

            // jika sudah ada dalam folder maka dihapus dulu
            // bagian ini bisa dihapus/dikomen, hanya ada untuk save space
            if (file_exists($destination)) {
                unlink($destination);
            }

            // copy file dari temp ke folder upload
            if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $destination)) {
                return "Error: gagal menyimpan gambar";
            }
        } else {
            return "tidak ada foto diri";
        }



        $_SESSION["biodata"]["nama"] = $_POST["nama"];
        $_SESSION["biodata"]["tglLahir"] = $_POST["tglLahir"];
        $_SESSION["biodata"]["alamat"] = $_POST["alamat"];
        $_SESSION["biodata"]["SD"] = $_POST["SD"];
        $_SESSION["biodata"]["SMP"] = $_POST["SMP"];
        $_SESSION["biodata"]["SMA"] = $_POST["SMA"];

        $_SESSION["biodata"]["foto"] = $destination;

        header("Location: biodata.php");
        exit;

    }

?>

<html>

<head>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <div class="form">

        <h2 class="dataDiri">Data Diri</h2>

        <form action="" enctype="multipart/form-data" method="post">
            <p>Nama      : <input type="text" name="nama"
                <?php
                    echo isset($_POST["nama"]) ? 'value="'.$_POST["nama"].'"' : "";
                ?>
            ></p>
            <p>Tgl Lahir : <input type="date" name="tglLahir" min="1920-01-01" max="2025-12-31"
                <?php
                    echo isset($_POST["tglLahir"]) ? 'value="'.$_POST["tglLahir"].'"' : "";
                ?>
            ></p>
            <p>Alamat    : <input type="text" name="alamat"
                <?php
                    echo isset($_POST["alamat"]) ? 'value="'.$_POST["alamat"].'"' : "";
                ?>
            ></p>

            <p class="RP"><b>Riwayat Pendidikan</b></p>
            <p class="sekolah">SD  : <input type="text" name="SD"
                <?php
                    echo isset($_POST["SD"]) ? 'value="'.$_POST["SD"].'"' : "";
                ?>
            ></p>
            <p class="sekolah">SMP : <input type="text" name="SMP"
                <?php
                    echo isset($_POST["SMP"]) ? 'value="'.$_POST["SMP"].'"' : "";
                ?>
            ></p>
            <p class="sekolah">SMA : <input type="text" name="SMA"
                <?php
                    echo isset($_POST["SMA"]) ? 'value="'.$_POST["SMA"].'"' : "";
                ?>
            ></p><br>
            <p class="foto">Pilih Foto untuk biodata<br>
            <input  type="file" 
                    name="foto" 
                    accept="image/*"></p>
            <p class="submitButton"><input type="submit" name="submit" value="submit"></p>
        </form>

        <h3>
            <?php
                echo isset($error) ? $error : "";
            ?>
        </h3>
    </div>
</body>

</html>