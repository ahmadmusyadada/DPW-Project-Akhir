<?php
$filename = $_GET['file']; //get the filename

if (unlink('file/instrumental/'.DIRECTORY_SEPARATOR.$filename)) {
    echo "<script>
        alert('data berhasil dihapus');
        document.location.href='admin.php';
        </script>";
    // "The file $filename success";
} else if (unlink('file/music/'.DIRECTORY_SEPARATOR.$filename)){
    echo "<script>
    alert('data berhasil dihapus');
    document.location.href='admin.php';
    </script>";
} else {
    echo "<script>
    alert('data tdk berhasil dihapus');
    document.location.href='admin.php';
    </script>";
}
//delete it
?>