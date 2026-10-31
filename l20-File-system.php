<?php  
// basename
$path = "uploads/images/photo.jpg";
echo basename($path)."\n";
echo basename($path, ".jpg")."\n";

// dirname
echo dirname($path)."\n";
echo dirname($path, 2)."\n";

// copy
copy("./copy/old.txt", "./copy/new.txt");

// file
$data = file("./copy/old.txt");
print_r($data);

// file_exists()
if (file_exists("./copy/old.txt")) {
    echo "File exists"."\n";
} else {
    echo "File not found"."\n";
}

// file_get_contents()
$content = file_get_contents("./copy/old.txt");
echo $content."\n";

// filesize()
$size = filesize("./copy/old.txt");
echo $size."\n";

// filetype()
echo filetype("./copy/old.txt")."\n";

// is_dir
if (is_dir("./copy")) {
    echo "This is a directory"."\n";
}

// is_file
if (is_file("./copy/old.txt")) {
    echo "This is a file"."\n";
}

// link()
link("./copy/old.txt", "./copy/other.txt");

// unlink()
unlink("./copy/other.txt");

// mkdir
mkdir("./codemanbd");

// rmdir()
rmdir("./codemanbd");

// move_uploaded_file()

// pathinfo
$path = "uploads/images/photo.jpg";
print_r(pathinfo($path));
?>